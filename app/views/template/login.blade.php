<!DOCTYPE html>
<html class="login-bg">
<head>
    <title>Pet Paws Sign In</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- stylesheet -->
    @foreach($css['internal'] as $css_file)
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}{{$asset_base_dir}}css/{{ $css_file }}" />
    @endforeach

    <!-- javascript global variable -->
    <script type="text/javascript">
    var global = {
    @foreach($global as $key => $val)
        {{$key}} : '{{$val}}',
    @endforeach
    };
    </script>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    <div class="row-fluid login-wrapper">
        <a href="{{URL::to('/')}}">
            <img src="{{asset('')}}{{$asset_base_dir}}img/logo_petpaws_signup.png" class="logo" />
        </a>

        <div class="span4 box">
            <div class="content-wrap">
                <form method="post" action="{{URL::to('user/login')}}" id="login">
                    @if(Session::get('message'))
                        <div class="alert alert-error">
                            <i class="icon-remove-sign"></i>{{ Session::get('message') }}
                        </div>
                    @endif

                    <h6>Log in</h6>
                    <input class="form-control" name="email" type="text" placeholder="E-mail address" @if(Session::get('email')) value="{{Session::get('email')}}" @endif />
                    <input class="form-control" name="password" type="password" placeholder="Your password" />
                    <a href="#reset" class="forgot" id="show-reset">Forgot password?</a>
                    <div class="remember">
                        <input id="remember-me" type="checkbox" name="remember" value="1" />
                        <label for="remember-me">Remember me</label>
                    </div>
                    <button class="btn-glow primary login" type="submit">Log in</button>
                </form>

                <form method="post" action="{{URL::to('user/reset')}}" class="hidden" id="reset">
                    @if(Session::get('message'))
                        <div class="alert alert-error">
                            <i class="icon-remove-sign"></i>{{ Session::get('message') }}
                        </div>
                    @endif

                    <h6>Reset Password</h6>
                    <input class="form-control" name="email" type="text" placeholder="E-mail address" @if(Session::get('email')) value="{{Session::get('email')}}" @endif />
                    <a href="#login" class="forgot show-login">Login</a>
                    <button class="btn-glow primary login" type="submit">Reset my password</button>
                </form>

                <form method="post" action="{{URL::to('user/signup')}}" class="hidden" id="signup">
                    @if(Session::get('message'))
                        <div class="alert alert-error">
                            <i class="icon-remove-sign"></i>{{ Session::get('message') }}
                        </div>
                    @endif

                    <h6>Sign Up</h6>
                    <input class="form-control validate[required]" name="CompanyName" id="signup_CompanyName" type="text" placeholder="Company Name" @if(Input::old('CompanyName')) value="{{Input::old('CompanyName')}}" @endif />
                    <input class="form-control validate[required]" name="Email" id="signup_Email" type="text" placeholder="E-mail address" @if(Input::old('Email')) value="{{Input::old('Email')}}" @endif />
                    <input class="form-control validate[required]" name="password" id="signup_password" type="password" placeholder="Password" @if(Input::old('password')) value="{{Input::old('password')}}" @endif />
                    <input class="form-control validate[required,equals[signup_password]]" name="confirm_password" id="signup_confirm_password" type="password" placeholder="Confirm Password" @if(Input::old('confirm_password')) value="{{Input::old('confirm_password')}}" @endif />
                    <button class="btn-glow primary login" type="submit">Sign Up</button>
                </form>
            </div>
        </div>

        <div class="span4 no-account">
            <p class="signup-link">Don't have account? <a href="#signup" id="show-signup">Sign Up</a></p>
            <p class="login-link hidden">Already have account? <a href="#login" class="show-login">Login</a></p>
        </div>
    </div>

    <!-- scripts -->
    @foreach($js['internal'] as $js_file)
    <script type="text/javascript" src="{{ asset($asset_base_dir) }}/js/{{ $js_file }}"></script>
    @endforeach
</body>
</html>