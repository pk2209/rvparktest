<?php

class AuthenticationController extends BaseController{

    /**
     * AuthenticationController::login
     * Provide login page for the user, or redirect to dashboard when user is already logged in
     */
    public function login()
    {
        if(Sentry::check()){
            return (Request::ajax())
                ? Response::json(
                    array(
                        'success'   => true,
                        'message'   => 'Authenticated'
                    )
                )
                : Redirect::to('/dashboard');
        }else{
            $this->enableValidation();
            $this->loadCss('compiled/signin.css');
            $this->loadJs('app/login.js');
            return View::make('template.login', $this->data);
        }
    }

    /**
     * AuthenticationController::logout
     * log out current logged in user
     */
    public function logout()
    {
        Session::flush();
        Sentry::logout();
        return Redirect::to('user/login');
    }

    /**
     * AuthenticationController::doLogin
     * process login based on given credential
     */
    public function doLogin()
    {
        $credential = Input::only('email','password');
        $remember   = Input::only('remember');
        $message    = '';

        try {
            $user   = Sentry::findUserByLogin( $credential['email'] );
            $match  = $user->checkPassword( $credential['password'] );


            if ($match && $remember){
                Sentry::loginAndRemember($user);
                return Redirect::intended('/dashboard');

            }else if($match){
                Sentry::login($user, false);
                return Redirect::intended('/dashboard');

            }else{
                $message = 'The password you entered is not correct.';
                return Redirect::to('user/login')->with('message', $message)->with('email', $credential['email']);
            }

        } catch (\Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $message = 'Login field is required.';
        } catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $message = 'User is registered but flagged as inactive.<br />Any further access is disabled';
        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $message = 'No user found matching that username.';
        }
        return Redirect::to('user/login')->with('message', $message);
    }

    /**
     * AuthenticationController::doSignup
     * process user sign up and redirect to proper page
     *
     */
    public function doSignup()
    {
        $data = Input::all();
        $message = '';

        if($data['password'] ==  $data['confirm_password']){

            try{
                $user = Sentry::getUserProvider()->create(array(
                    'Email'       => $data['Email'],
                    'Username'    => '',
                    'password'    => $data['password'],
                    'CompanyName' => $data['CompanyName'],
                    'hash'        => Crypt::encrypt($data['password']),
                    'FirstName'   => '',
                    'LastName'    => '',
                    'activated'   => 1,
                    'permissions' => array(
                        'admin'     => 0,
                        'dashboard' => 0,
                        'superuser' => 0
                    )
                ));

                $profiderField = array('PCID','SubID','Name','Street','City','State','Zip','Country','ZipCodeServiced', 'Phone','Email','Website','Latitude','Longitude','Ratings',);

                $provider = new Provider;

                foreach($profiderField as $field){
                    $provider->{$field} = '';
                }

                $provider->PCID = $user->ID;
                $provider->Name = $data['Name'];
                $provider->save();
                File::makeDirectory(public_path().'/images/uploaded/'.$user->ID, 0777, false, true);

                Sentry::login($user, false);
                return Redirect::to('user/info');
            }catch (Cartalyst\Sentry\Users\LoginRequiredException $e){
                $message = 'Login field is required.';
            }
            catch (Cartalyst\Sentry\Users\PasswordRequiredException $e){
                $message = 'Password field is required.';
            }
            catch (Cartalyst\Sentry\Users\UserExistsException $e){
                $message = 'User with this login already exists.';
            }
        }else{
            $message = 'Password and Confirmation password did not match';
        }
        return Redirect::to('user/login#signup')->with('message', $message)->withInput();
    }

    /**
     * AuthenticationController::authenticate
     * Check if user is logged in or not
     */
    public function authenticate()
    {
        if (!Sentry::check()) {
            return (!Request::ajax())
            ? Redirect::guest('user/login')
            : Response::json(array(
                'success' => false,
                'error'  => array(
                    'code'  => 401,
                    'message' => 'Unauthorized access!'
                )
            ));
        }
    }
}
