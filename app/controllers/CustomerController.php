<?php

class CustomerController extends BaseController {


    public function __construct(){
        parent::__construct();
        $this->beforeFilter('auth.dashboard');
        $this->registerGlobal('customerApiCall', URL::to('customer'));
        $this->registerGlobal('activeMenu', 'customer');
        $this->registerGlobal('catBreeds', StaticData::catBreeds(true));
        $this->registerGlobal('dogBreeds', StaticData::dogBreeds(true));
        $this->registerGlobal('states', StaticData::states(true));


        $this->loadCss('lib/select2.css');
        $this->loadJs('select2.min.js');
        $this->enableValidation();

        $this->data['action'] = URL::to('customer');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(Request::ajax()){
            $provider   = $this->data['providerCredential']->providers()->first();
            $customers  = Customer::select(
                            array(
                                'FirstName', 'LastName', 'Address', 'LastVisit', 'Phone', 'Email', 'ID'
                            )
                        )->where('ProviderID', '=', $provider->ID);

            return Datatables::of($customers)
                    ->edit_column('FirstName', '{{$FirstName}} {{$LastName}}')
                    ->remove_column('LastName')
                    ->edit_column(
                        'ID',
                        '<a href="{{URL::to(\'customer/\'.$ID.\'/edit\')}}" data-id="{{$ID}}" class="btn btn-xs btn-success btn-customer-edit"><i class="icon-edit"></i> edit</a>'.
                        '<a href="{{URL::to(\'customer/\'.$ID.\'\')}}" data-id="{{$ID}}" class="btn btn-xs btn-primary btn-customer-view"><i class="icon-search"></i> view</a>'.
                        '<a href="javascript:void(0);" data-id="{{$ID}}" class="btn btn-xs btn-danger btn-customer-delete"><i class="icon-trash"></i> delete</a>'
                    )
                    ->make();
        }else{
            $this->enableDataTable();

            $this->loadJs('app/customer.js');
            $this->loadJs('app/create_customer.js');
            return View::make('customer.index', $this->data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->loadJs('app/create_customer.js');
        return View::make('customer.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $customerData   = Input::get('Customer');
        $petData        = Input::get('Pet');
        $provider       = $this->data['providerCredential']->providers()->first();

        $customerData['ProviderID'] = $provider->ID;
        unset($customerData['ID']);

        $customerObject = new Customer;

        foreach($customerData as $field => $value){
            $customerObject->{$field} = $value;
        }

        $customerSaved = $customerObject->save();

        if($customerSaved){
            foreach($petData as $pet){
                unset($pet['ID']);
                $pet['CustomerID'] = $customerObject->ID;
                $petObject = CustomerPet::create($pet);
            }
        }

        if(Request::ajax()){
            return Response::json(array(
                'success'   => $customerSaved ? true : false,
                'message'   => $customerSaved ? 'Customer data created' : 'Error occured when creating record'
            ));
        }else{
            $redirectUrl = ($customerSaved) ? "costumer/{$customerObject->ID}/edit" : 'costumer/create';
            return Redirect::to(URL::to($redirectUrl))
                ->with('message', ($customerSaved ? 'Customer data created' : 'Error occured when creating record'))
                ->with('class', ($customerSaved ? 'success' : 'danger'));
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
        $customerObject = Customer::with('pets')->find($id);

        if(Request::ajax()){
            return Response::json($customerObject);
        }else{
            $this->data['customer'] = $customerObject->toArray();
            return View::make('customer.show', $this->data);
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
        $this->loadJs('app/create_customer.js');

        $customer = Customer::with('pets')->find($id);

        if($customer){
            $this->data['customer'] = $customer->toArray();
            $this->data['action'] = URL::to("customer/$id");
            return View::make('customer.create', $this->data);
        }else{
            return Response::make('Customer not found', 404);
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
        $customerData = Input::get('Customer');
        $petsData = Input::get('Pet');
        $petRemoved = Input::get('PetRemoved', false);

        $customerObject = Customer::find($id);

        /* remove pet from the database */
        if($petRemoved){
            CustomerPet::where('CustomerID', '=', $customerData['ID'])
                ->whereIn('ID', explode(',', $petRemoved))
                ->delete();
        }

        /* process customer data */
        foreach ($customerObject->toArray() as $field => $value) {
            if(isset($customerData[$field])){
                $customerObject->{$field} = $customerData[$field];
            }
        }

        $updated = $customerObject->save();

        /* process customer pet */
        foreach($petsData as $pet){
            if($pet['ID']){
                $petObject = CustomerPet::find($pet['ID']);

                foreach($pet as $field => $value){
                    $petObject->{$field} = $value;
                }
            }else{
                unset($pet['ID']);
                $petObject = CustomerPet::create($pet);
                $petObject->CustomerID = $customerObject->ID;
            }

            $petObject->save();
        }

        return Redirect::to(URL::to("customer/$id/edit"))
                ->with('message', ($updated ? 'Customer data updated' : 'Error occured when updating data'))
                ->with('class', ($updated ? 'success' : 'danger'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = Customer::find($id)->delete();

        if($deleted){
            CustomerPet::where('CustomerID', '=', $id)->delete();
        }

        if(Request::ajax()){
            return Response::json(array(
                'success'   => $deleted
            ));
        }else{
            return Redirect::to(URL::to('customer'));
        }
    }

}
