<?php

use \Cartalyst\Sentry\Users\LoginRequiredException;
use \Cartalyst\Sentry\Users\UserNotActivatedException;
use \Cartalyst\Sentry\Users\UserNotFoundException;

class UserController extends BaseController
{

    /**
     * UserController::index
     * the user dashboard page
     */
    public function index()
    {
        $user = $this->data['providerCredential'];
        $today = date('Y-m-d');

        if($user->hasAccess('dashboard')){
            $provider = Provider::where('PCID','=', $user->ID)->first();
            $offer = Offer::where('ProviderID','=', $provider->ID)->where('OfferActive', '=', '1');

            if(Config::get('database.default') == 'mysql'){
                $offer->whereRaw('DATE(NOW()) < RedeemByDate');
            }else{
                $offer->whereRaw('(DATEDIFF(day, GETDATE(), [RedeemByDate]) > 0 )');
            }

            $this->data['offer_count'] = $offer->count();
            $this->data['appointment'] = Appointment::counter($today, $this->data['provider']->ID);

            $this->loadJs('app/dashboard.js');
            return View::make('template.dashboard', $this->data);
        }else{
            return Redirect::to(URL::to('user/info'))->with('status', 'error')->with('message', 'Please fill user info before go any further');
        }
    }

    /**
     * UserController::info
     * user info form
     */
    public function info()
    {
        /** prepare asset for info page */
        $this->loadCss('compiled/form-showcase.css');
        $this->loadCss('lib/select2.css');
        $this->loadJs('select2.min.js');
        $this->loadJs('app/userinfo.js');
        $this->registerGlobal('activeMenu', 'user.info');
        $this->enableValidation();

        /** prepare data for info page */
        $this->data['credential'] = $this->data['providerCredential'];
        $this->data['services'] = Service::all();
        $this->data['subscriptions'] = SubscriptionLevel::all();
        $this->data['states'] = StaticData::states();
        $this->data['action'] = URL::to('user/info');

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
     * UserController::saveInfo
     * Save all user information provided by user
     */
    public function saveInfo()
    {
        $providerData       = Input::get('Provider');
        $providerCredential = Input::get('ProviderCredential');
        $providerServices   = Input::get('ProviderServices');
        $zipCodeRemoved     = Input::get('ZipCodeRemoved');
        $zipCodeServiced    = $providerData['ZipCodeServiced'];
        $message            = '';

        if($providerCredential['password'] == $providerCredential['confirm_password']){

            $currentUser    = Sentry::getUser();
            $provider       = Provider::where('PCID','=', $currentUser->ID)->get();

            /** save provider credential details */
            unset($providerCredential['confirm_password']);
            foreach($providerCredential as $key => $value){
                $currentUser->{$key} = $value;
            }

            $currentUser->permissions = array(
                'dashboard' => 1
            );

            $userStatus = $currentUser->save();

            /** save provider's details */
            if($provider->isEmpty()){
                $provider = new Provider;
            }else{
                $provider = $provider->first();
            }

            $provider->PCID = $currentUser->ID;
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

            /** update ZipCodeServiced reference */
            if(trim($zipCodeRemoved)){
                $zipCodeRemoved = explode(',', $zipCodeRemoved);
                ZipService::where('ProviderID','=',$provider->ID)
                            ->whereIn('ZipCode', $zipCodeRemoved)
                            ->delete();
            }

            if(trim($zipCodeServiced)){
                $zipCodeServiced = explode(',', $zipCodeServiced);
                foreach ($zipCodeServiced as $zipCode) {
                    ZipService::firstOrCreate(array(
                        'ProviderID'    => $provider->ID,
                        'ZipCode'       => $zipCode
                    ));
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

        return Redirect::to('/')->with('message', $message)->with('status', $status);
    }
}
