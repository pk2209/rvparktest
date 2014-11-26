<?php

use \Carbon\Carbon;

class OfferController extends BaseController {

    public function __construct(){
        parent::__construct();
        $this->registerGlobal('offerApiCall', URL::to('offer'));
        $this->beforeFilter('auth.dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $providerCredential = $this->data['providerCredential'];
        $currentRoute = Route::current()->getPath();

        if(Request::ajax()){

            $offer = Offer::select(
                array(
                    'Offers.ID',
                    'OfferImage',
                    'Name',
                    'Title',
                    'Description',
                    DB::raw('(ClaimedCount*FullPrice) as ClaimedCount'),
                    DB::raw('ClaimedCount as Purchased'),
                    'StartDate',
                    (Config::get('database.default') == 'mysql')
                    //mysql specific
                    ? DB::raw('( IF( DATE(NOW()) > EndDate, -1, OfferActive) ) as OfferActive')

                    //mssql specific
                    : DB::raw(
                        'CASE
                            WHEN (DATEDIFF(day, GETDATE(), [EndDate]) < 0 )
                            THEN -1
                            ELSE [OfferActive]
                        END
                        AS OfferActive'
                    )

                )
            )
            ->leftJoin('petpaws.Providers', 'petpaws.Offers.ProviderID', '=', 'Providers.ID');

            /** if is admin, and accessing from admin page, then display all offer */
            if(!($currentRoute == 'admin/offer' && $providerCredential->hasAccess('admin'))){
                $provider = $providerCredential->providers()->first();
                $offer->whereRaw('ProviderID = '.$provider->ID);
            }
            $datatables = Datatables::of($offer)
            ->edit_column('OfferImage', '<img src="{{asset($OfferImage)}}" style="width:100px; height:100px" />')
            ->edit_column('Title', '<a href="{{URL::to("'.$currentRoute.'/$ID")}}" data-id="{{$ID}}">{{$Title}}</a><br>{{substr($Description, 0, 200)}}')
            ->edit_column('ClaimedCount', '$ {{number_format($ClaimedCount)}}')
            ->edit_column(
                'OfferActive',
                '@if($OfferActive == -1) <span class="label label-default">Expired</span>'.
                '@elseif($OfferActive == 0) <span class="label label-info">Standby</span>'.
                '@elseif($OfferActive == 1) <span class="label label-success">Active</span>'.
                '@endif'
            )
            ->add_column(
                'action',
                (
                    ($currentRoute == 'admin/offer' && $providerCredential->hasAccess('admin'))
                    ? '<a href="{{URL::to("'.$currentRoute.'/$ID/edit")}}" class="btn btn-xs btn-success btn-offer-edit"><i class="icon-pencil"></i> edit</a> '
                    : '<a href="{{URL::to("'.$currentRoute.'/$ID/edit")}}" class="btn btn-xs btn-success btn-offer-edit" @if($OfferActive == 1) disabled="true" @endif><i class="icon-pencil"></i> edit</a> '
                ).
                '<a href="#" class="btn btn-xs btn-primary btn-offer-view" data-id="{{$ID}}"><i class="icon-search"></i> view</a> '.
                '<a class="btn btn-xs btn-danger btn-offer-delete" data-id="{{$ID}}" data-active="@if($OfferActive == 1){{1}}@else{{0}}@endif"><i class="icon-trash"></i> delete</a>'.
                '@if($Purchased > 0)<a class="btn btn-xs btn-info btn-offer-purchased" data-id="{{$ID}}"><i class="icon-money"></i> purchased</a>@endif'
            )
            ->remove_column('Description')
            ->remove_column('ID')
            ->remove_column('row_num');

            if($currentRoute != 'admin/offer'){
                $datatables->remove_column('Name');
            }

            return $datatables->make();
        }
        /** if loaded via standard page, display the table */
        else{
            $this->data['provider']     = $providerCredential->providers()->first();

            $this->registerGlobal('provider', $this->data['provider']);
            $this->enableDatatable();
            $this->loadJs('https://maps.googleapis.com/maps/api/js?key=AIzaSyDA-1jyffmerVIocTZSA_2NRJaErbtsIcc&sensor=false', array('location'=>'external'));
            $this->loadJs('app/offer.js');

            /** if admin, and manage offer via admin menu, show all offer by all user */
            if($currentRoute == 'admin/offer' && $providerCredential->hasAccess('admin')){
                $this->registerGlobal('offerApiCall', URL::to('admin/offer'));
                $this->registerGlobal('activeMenu', 'admin');
                $this->registerGlobal('activeSubMenu', 'admin.offer');
                $this->registerGlobal('isAdmin', true);
            }
            /** else, show offer by current user */
            else{
                $this->registerGlobal('offerApiCall', URL::to('offer'));
                $this->registerGlobal('activeMenu', 'offer');
                $this->registerGlobal('activeSubMenu', 'offer.index');
                $this->registerGlobal('isAdmin', false);
            }

            return View::make('offer.index', $this->data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $providerCredential = $this->data['providerCredential'];
        $provider = $providerCredential->providers()->first();


            $this->loadCss('compiled/form-showcase.css');
            $this->loadCss('lib/select2.css');
            $this->loadCss('lib/datepicker.css');

            $this->enableValidation();
            $this->loadJs('select2.min.js');
            $this->loadJs('bootstrap-datepicker.js');
            $this->loadJs('https://maps.googleapis.com/maps/api/js?key=AIzaSyDA-1jyffmerVIocTZSA_2NRJaErbtsIcc&sensor=false', array('location'=>'external'));
            $this->loadJs('app/create_offer.js');

            $this->data['offerTypes']   = OfferType::select(array('ID as id', 'Title', 'FinePrint', 'RedeemStep'))->get();
            $this->data['provider']     = $provider;
            $this->data['method']       = (isset($this->data['method'])) ? $this->data['method'] : 'POST';
            $this->data['services']     = $this->data['provider']->services()->select(array('Name', 'Services.ID as id'))->get();

            /** scanning image folder */
            $predefinedImages = array();
            $publicPath = public_path();
            $publicPathLength = strlen($publicPath);

            foreach ($this->data['services'] as $service) {
                $files = File::files($publicPath.'/images/predefined/'.$service->ID);

                foreach($files as $fileNum => $filePath){
                    $files[$fileNum] = substr($filePath, $publicPathLength);
                }

                $predefinedImages[$service->ID] = $files;
            }

            if(File::exists($publicPath.'/images/uploaded/'.$this->data['provider']->ID)){
                $uploadedImages = File::files($publicPath.'/images/uploaded/'.$this->data['provider']->ID);

                foreach($uploadedImages as $imageNum => $imagePath){
                    $uploadedImages[$imageNum] = substr($imagePath, $publicPathLength);
                }
            }else{
                $uploadedImages = array();
            }
            //dd($predefinedImages);

            $this->data['predefinedImages'] = $predefinedImages;
            $this->data['uploadedImages'] = $uploadedImages;

            $this->registerGlobal('activeMenu', 'offer');
            $this->registerGlobal('activeSubMenu', 'offer.create');
            $this->registerGlobal('offerTypes', $this->data['offerTypes']);
            $this->registerGlobal('services', $this->data['services']);
            $this->registerGlobal('advertisingLevels', AdvertisingLevel::select(array('ID as id', 'Name', 'Price'))->get());
            $this->registerGlobal('provider', $this->data['provider']);

            return View::make('offer.create', $this->data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $offerData = Input::all();
        $providerCredential = $this->data['providerCredential'];
        $provider = $providerCredential->providers()->first();

        unset($offerData['DiscountBy']);
        unset($offerData['_method']);
        unset($offerData['OfferImagePicker']);

        if($this->isOverLimit($provider) && $offerData['OfferActive'] == '1'){
            $message = 'Can not broadcast offer, active offer is exceeding subscription limit';

            return Redirect::back()
                    ->with('message', $message)
                    ->with('status', 'error')
                    ->withInput();
        }else{

            $offerData['StartDate']     = Carbon::createFromFormat('m/d/Y', $offerData['StartDate']);
            $offerData['EndDate']       = Carbon::createFromFormat('m/d/Y', $offerData['EndDate']);
            $offerData['RedeemByDate']  = Carbon::createFromFormat('m/d/Y', $offerData['RedeemByDate']);
            $offerData['ClaimedCount']  = 0;

            $offer = Offer::create($offerData);

            if($offer){
                return Redirect::to(URL::to('offer'));
            }else{
                $this->data['message'] = 'Error occured while trying to save offer data';
                return View::make('offer.error', $this->data);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if(Request::ajax()){
            $offer = Offer::with('provider')->find($id)->toArray();

            $remaining = date_diff(
                new Carbon,
                Carbon::createFromFormat('Y-m-d', $offer['EndDate'])
            );

            $offer['RedeemByDate'] = date('m/d/Y', strtotime($offer['RedeemByDate']));
            $offer['Description'] = nl2br($offer['Description']);
            $offer['FinePrint'] = nl2br($offer['FinePrint']);
            $offer['QuantityLimit'] = ($offer['QuantityLimit'] == 0) ? 'No Limit' : "{$offer['QuantityLimit']} Limited Quantity";
            $offer['Remaining'] = ($remaining->invert) ? $remaining->format('%a Days Overdue') : $remaining->format('%a Days Remaining');
            $offer['Discount'] = ($offer['PriceBeforeDiscount'] - $offer['FullPrice'] == $offer['Discount']) ? '$'.$offer['Discount'] : $offer['Discount'].'%';

            return Response::json($offer);
        }else{
            return View::make('offer.preview');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->data['offer']    = Offer::find($id);
        $this->data['method']   = 'PUT';
        $this->data['offer']->DiscountBy = ($this->data['offer']->PriceBeforeDiscount - $this->data['offer']->FullPrice == $this->data['offer']->Discount) ? '$':'%';
        $currentRoute = Route::current()->getPath();

        if(
            (time() < strtotime($this->data['offer']->EndDate) && $this->data['offer']->OfferActive == '1')
            && (strpos($currentRoute, 'admin/offer') === false || !$this->data['providerCredential']->hasAccess('admin'))
        ){
        	$this->data['message'] = 'Unable to edit active offer';
        	return View::make('offer.error', $this->data);
        }else{
        	return $this->create();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $offerData = Input::all();

        unset($offerData['DiscountBy']);
        unset($offerData['_method']);
        unset($offerData['OfferImagePicker']);

        if(isset($offerData['StartDate']) || isset($offerData['EndDate']) || isset($offerData['RedeemByDate'])){
            $offerData['StartDate']     = Carbon::createFromFormat('m/d/Y', $offerData['StartDate']);
            $offerData['EndDate']       = Carbon::createFromFormat('m/d/Y', $offerData['EndDate']);
            $offerData['RedeemByDate']  = Carbon::createFromFormat('m/d/Y', $offerData['RedeemByDate']);
        }

        $offer = Offer::find($id);

        foreach ($offerData as $key => $value) {
        	$offer->$key = $value;
        }

        $updated = $offer->save();
        $message = ($updated) ? 'Offer sucessfully updated' : 'Error occured while saving offer data';

        if(Request::ajax()){
            return Response::json(array(
                'success'   => $updated,
                'message'   => $message
            ));
        }
        if($offer){
            return Redirect::to(URL::to('offer'))->with('message', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $status = Offer::destroy($id);

        return Response::json(array(
            'success'    => $status
        ));
    }

    /**
     * Check if customer is overlimit
     */

    private function isOverLimit(Provider $provider){
        $subscriptionLevel = $provider->subscriptionLevel();

        $offer = Offer::where('OfferActive', '=', '1')
                ->where('ProviderID', '=', $provider->ID);

        if(Config::get('database.default') == 'mysql'){
            $offer->whereRaw('( StartDate BETWEEN (NOW() - INTERVAL 30 DAY) AND NOW() OR EndDate BETWEEN (NOW() - INTERVAL 30 DAY) AND NOW())');
        }else{
            $offer->whereRaw('(StartDate > DATEADD(day, -30, GETDATE()) OR EndDate > DATEADD(day, -30, GETDATE()))');
        }

        /** include free offer */
        return $offer->count() >= $subscriptionLevel->Offers;
    }

}
