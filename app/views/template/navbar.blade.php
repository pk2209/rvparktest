    <header class="navbar navbar-inverse" role="banner" id="navbar">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" id="menu-toggler">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('/')}}"  style="padding:3px 10px"><img src="{{asset($asset_base_dir.'img/logo_petpaws.png')}}" style="height:40px"></a>
            <a href="{{URL::to('user/logout')}}" class="navbar-toggle pull-right visible-xs" style="font-size:20px;padding: 0">
                <i class="icon-signout" style="color:white">
                    <span style="font-size:16px;font-family:'Open Sans',sans-serif" class="visible-sm">logout</span>
                </i>
            </a>
        </div>
        <ul class="nav navbar-nav pull-right hidden-xs">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown">
                    {{$providerCredential->FirstName.' '.$providerCredential->LastName}}
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{URL::to('user/info')}}">Personal info</a></li>
                    <li><a href="{{URL::to('user/logout')}}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>