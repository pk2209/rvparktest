<?php

class ProviderController extends BaseController {

    public function __construct(){
        parent::__construct();
        $this->registerGlobal('activeMenu', 'admin');
        $this->registerGlobal('activeSubMenu', 'admin.provider');
    }

    /**
     * Display all registered provider
     */
    public function index(){

        if(Request::ajax()){
            /**
             * mysql> select PC.CompanyName,
             * GROUP_CONCAT(s.Name) as Services,
             * PC.updated_at AS SngUpDate,
             * ProviderID
             * from ProviderCredentials PC
             * join Providers p on(PC.ID = p.PCID)
             * join ProviderServices ps on(p.ID = ps.ProviderID)
             * join Services s on(ps.ServiceID = s.ID)
             * group by ps.ProviderID;
             */

            /**
             * MSSQL > SELECT
             *       PC.CompanyName,
             *       STUFF(
             *           ( SELECT  ',' + SI.Name FROM ProviderCredentials as PCI
             *               LEFT JOIN Providers AS PI ON PCI.ID = PI.PCID
             *               LEFT JOIN ProviderServices AS PSI ON PI.ID = PSI.ProviderID
             *               LEFT JOIN Services AS SI ON PSI.ServiceID = SI.ID
             *               WHERE PCI.ID = PC.ID
             *               FOR XML PATH ('')
             *           ),
             *           1, 1, ''
             *       )  AS Services,
             *       PC.updated_at AS SngUpDate,
             *       ProviderID
             *   FROM ProviderCredentials AS PC
             *   join Providers P on(PC.ID = P.PCID)
             *   join ProviderServices PS on(P.ID = PS.ProviderID)
             *   join Services S on(PS.ServiceID = S.ID)
             *   GROUP BY PC.ID, ProviderID, PC.CompanyName, PC.updated_at
             */

            $providers = DB::table('petpaws.ProviderCredentials AS PC')
            ->select(
                array(
                    'PC.CompanyName',
                    (Config::get('database.default') == 'mysql')
                    ? DB::raw('group_concat(S.Name) AS Services')
                    : DB::raw("STUFF(
                        ( SELECT  ', ' + SI.Name FROM petpaws.ProviderCredentials as PCI
                                LEFT JOIN petpaws.Providers AS PI ON PCI.ID = PI.PCID
                                LEFT JOIN petpaws.ProviderServices AS PSI ON PI.ID = PSI.ProviderID
                                LEFT JOIN petpaws.Services AS SI ON PSI.ServiceID = SI.ID
                                WHERE PCI.ID = PC.ID
                                FOR XML PATH ('')
                            ),
                            1, 1, ''
                        )  AS Services"),
                    'PC.created_at',
                    'PC.activated',
                    'PC.ID AS ID'
                )
            )
            ->leftJoin('petpaws.Providers AS P', 'PC.ID', '=', 'P.PCID')
            ->leftJoin('petpaws.ProviderServices AS PS', 'P.ID', '=', 'PS.ProviderID')
            ->leftJoin('petpaws.Services AS S', 'PS.ServiceID', '=', 'S.ID')
            ->groupBy('PS.ProviderID');

            if(Config::get('database.default') == 'sqlsrv'){
                $providers->groupBy('PC.CompanyName')
                          ->groupBy('PC.created_at')
                          ->groupBy('PC.activated')
                          ->groupBy('PC.ID');
            }

            //return $providers->toSql();

            return Datatables::of($providers)
            ->edit_column(
                'ID',
                '<a @if($activated == 0) disabled="true" @endif href="{{URL::to("admin/provider/$ID/edit")}}" class="btn btn-xs btn-success btn-provider-edit"><i class="icon-pencil"></i> edit</a> '.
                '@if($activated == 1)'.
                    '<a href="javascript:;" class="btn btn-xs btn-danger btn-provider-delete" data-id="{{$ID}}"><i class="icon-trash"></i> delete</a>'.
                '@else'.
                    '<a href="javascript:;" class="btn btn-xs btn-info btn-provider-restore" data-id="{{$ID}}"><i class="icon-reply"></i> restore</a>'.
                '@endif'
            )
            ->edit_column(
                'activated',
                '@if($activated == 1)'.
                    '<span class="label label-success">Active</span>'.
                '@else'.
                    '<span class="label label-danger">Inactive</span>'.
                '@endif'
            )
            ->make();
        }else{
            $this->registerGlobal('providerApiCall', URL::to('admin/provider'));
            $this->enableDatatable();
            $this->loadJs('app/provider.js');
            return View::make('user.index', $this->data);
        }
    }

    /**
     * UserController::info
     * user info form
     */
    public function info(){
        $this->loadCss('compiled/form-showcase.css');
        $this->loadCss('lib/select2.css');
        $this->loadJs('select2.min.js');
        $this->loadJs('app/userinfo.js');
        $this->enableValidation();

        $this->data['user'] = Sentry::getUser();
        $this->data['services'] = Service::all();
        $this->data['subscriptions'] = SubscriptionLevel::all();
        return View::make('user.info', $this->data);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        /** prepare asset for info page */
        $this->loadCss('compiled/form-showcase.css');
        $this->loadCss('lib/select2.css');
        $this->loadJs('select2.min.js');
        $this->loadJs('app/userinfo.js');
        $this->registerGlobal('activeMenu', 'admin');
        $this->registerGlobal('activeSubMenu', 'admin.provider');
        $this->enableValidation();

        /** prepare data for info page */
        $this->data['credential'] = isset($this->data['credential']) ? $this->data['credential'] : false;
        $this->data['provider'] = isset($this->data['provider']) ? $this->data['provider'] : false;
        $this->data['method']   = isset($this->data['method']) ? $this->data['method'] : 'POST';
        $this->data['action']   = isset($this->data['action']) ? $this->data['action'] : URL::to('admin/provider');
        $this->data['services'] = Service::all();
        $this->data['subscriptions'] = SubscriptionLevel::all();
        $this->data['states']   = StaticData::states();

        /** populate services offerred by provider */
        $this->data['providerServices'] = array();

        if($this->data['provider']){
            $providerServices = ProviderService::select(
                    array('ServiceID')
                )
                ->where('ProviderID','=',$this->data['provider']->ID)
                ->get()
                ->toArray();


            foreach($providerServices as $service){
                $this->data['providerServices'][] = $service['ServiceID'];
            }
        }

        return View::make('user.info', $this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $providerData = Input::get('Provider');
        $providerCredential = Input::get('ProviderCredential');
        $providerServices = Input::get('ProviderServices');
        $message = '';

        if($providerCredential['password'] == $providerCredential['confirm_password']){
            unset($providerCredential['confirm_password']);
            $providerCredential['hash'] = Crypt::encrypt($providerCredential['password']);
            $providerCredential['activated'] = 1;
            $providerCredential['UserName'] = '';
            $user = Sentry::getUserProvider()->create($providerCredential);

            if($user){
                $provider = new Provider;
                $provider->PCID = $user->ID;
                $provider->Email = $providerCredential['Email'];
                $provider->Name = $providerCredential['CompanyName'];

                File::makeDirectory(public_path().'/images/uploaded/'.$user->ID);

                foreach($providerData as $key => $val){
                    $provider->{$key} = $val;
                }

                $providerStatus = $provider->save();
                $providerServiceStatus = true;

                /** save provider service data */
                if($providerServices){
                    foreach($providerServices as $serviceID){
                        $providerService = new ProviderService;
                        $providerService->ProviderID = $provider->ID;
                        $providerService->ServiceID = $serviceID;

                        $providerServiceStatus = $providerServiceStatus && $providerService->save();
                    }
                }

                $message = ($user && $providerStatus && $providerServiceStatus)
                         ? 'User info successfully saved!'
                         : 'Error occured while saving provider data';
                $status = ($user && $providerStatus && $providerServiceStatus) ? 'success' : 'error';
                return Redirect::to('admin/provider/'.$user->ID.'/edit')->with('message', $message)->with('status', $status);

            }

        }else{
            $message = 'Password and confirmation password does not match';
            $status = 'error';
        }

        return Redirect::to('admin/provider/create')->with('message', $message)->with('status', $status);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return '';
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $this->data['credential'] = ProviderCredential::find($id);
        $this->data['provider'] = Provider::where('PCID','=',$this->data['credential']->ID)->get()->first();
        $this->data['method'] = 'PUT';
        $this->data['action'] = URL::to('admin/provider/'.$id);
        return $this->create();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $providerData = Input::get('Provider');
        $providerCredential = Input::get('ProviderCredential');
        $providerServices = Input::get('ProviderServices');
        $message = '';

        if($providerCredential['password'] == $providerCredential['confirm_password']){

            $user = ProviderCredential::find($id);
            $provider = Provider::where('PCID','=', $user->ID)->get();

            /** save provider credential details */
            unset($providerCredential['confirm_password']);
            foreach($providerCredential as $key => $value){
                $user->{$key} = $value;
            }

            $userStatus = $user->save();

            /** save provider's details */
            if($provider->isEmpty()){
                $provider = new Provider;
            }else{
                $provider = $provider->first();
            }

            $provider->PCID = $user->ID;
            $provider->Email = $providerCredential['Email'];
            $provider->Name = $providerCredential['CompanyName'];

            foreach($providerData as $key => $val){
                $provider->{$key} = $val;
            }

            $providerStatus = $provider->save();
            $providerServiceStatus = true;

            /** save provider service data */
            ProviderService::where('ProviderID','=',$provider->ID)->delete();
            if($providerServices){
                foreach($providerServices as $serviceID){
                    $providerService = new ProviderService;
                    $providerService->ProviderID = $provider->ID;
                    $providerService->ServiceID = $serviceID;

                    $providerServiceStatus = $providerServiceStatus && $providerService->save();
                }
            }

            $message = ($userStatus && $providerStatus && $providerServiceStatus)
                     ? 'User info successfully saved!'
                     : 'Error occured while saving user data';
            $status = ($userStatus && $providerStatus && $providerServiceStatus) ? 'success' : 'error';
        }else{
            $message = 'Password and confirmation password does not match';
            $status = 'error';
        }

        return Redirect::to('admin/provider/'.$id.'/edit')->with('message', $message)->with('status', $status);
	}

	/**
	 * Mark provider credential as inactive
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = ProviderCredential::find($id);

        $user->activated = 0;
        $status = $user->save();

        return Response::json(array(
            'success'    => $status
        ));
	}



    /**
     * Mark provider credential as active
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id)
    {
        $user = ProviderCredential::find($id);

        $user->activated = 1;
        $status = $user->save();

        return Response::json(array(
            'success'    => $status
        ));
    }

}
