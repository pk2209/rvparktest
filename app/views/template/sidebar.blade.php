<!-- sidebar -->
    <div id="sidebar-nav">
        <div class="offer">
            <span class="bold">Tell a <strong>friend</strong><br /> get $20*</span>
            <p class="right">
                <a href="#" id="share-button">
                    <span class="label label-primary">Share</span><br />
                </a>
                *When they sign up
            </p>
            <div class="clearfix"></div>
        </div>
        <ul id="dashboard-menu">
            <li @if($global['activeMenu'] == '' || $global['activeMenu'] == 'home') class="active" @endif >
                @if($global['activeMenu'] == '' || $global['activeMenu'] == 'home')
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                @endif
                <a class="tab2" href="{{URL::to('/')}}">
                    <i class="icon-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li @if($global['activeMenu'] == 'offer') class="active" @endif >
                @if($global['activeMenu'] == 'offer')
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                @endif
                <a href="{{URL::to('offer/create')}}">
                    <i class="icon-tags"></i>
                    <span>Offers</span>
                    <i class="icon-chevron-down dropdown-toggle"></i>
                </a>
                <ul id="offer-submenu" class="submenu" @if($global['activeMenu'] == 'offer') style="display:block" @endif>
                    <li><a href="{{URL::to('offer/create')}}" @if($global['activeSubMenu'] == 'offer.create') style="text-decoration:underline" @endif>Create Offer</a></li>
                    <li><a href="{{URL::to('offer/')}}" @if($global['activeSubMenu'] == 'offer.index') style="text-decoration:underline" @endif>Manage Offers</a></li>
                </ul>
            </li>
            <li @if($global['activeMenu'] == 'calendar') class="active" @endif >
                @if($global['activeMenu'] == 'calendar')
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                @endif
                <a class="tab3" href="{{URL::to('calendar')}}">
                    <i class="icon-calendar-empty"></i>
                    <span>Calendar</span>
                </a>
            </li>
            <li @if($global['activeMenu'] == 'customer') class="active" @endif >
                @if($global['activeMenu'] == 'customer')
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                @endif
                <a class="tab3" href="{{URL::to('customer')}}">
                    <i class="icon-group"></i>
                    <span>Customer</span>
                </a>
            </li>
            <li @if($global['activeMenu'] == 'user.info') class="active" @endif >
                @if($global['activeMenu'] == 'user.info')
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                @endif
                <a class="tab3" href="{{URL::to('user/info')}}">
                    <i class="icon-cog"></i>
                    <span>My Info</span>
                </a>
            </li>
            @if($providerCredential->hasAccess('admin'))
            <li @if($global['activeMenu'] == 'admin') class="active" @endif >
                @if($global['activeMenu'] == 'admin')
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                @endif
                <a href="#" class="dropdown-toggle">
                    <i class="icon-paws"></i>
                    <span>Admin</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu" @if($global['activeMenu'] == 'admin') style="display:block" @endif>
                    <li><a href="{{URL::to('admin/provider/')}}" @if($global['activeSubMenu'] == 'admin.provider') style="text-decoration:underline" @endif>Manage Users</a></li>
                    <li><a href="{{URL::to('admin/offer/')}}" @if($global['activeSubMenu'] == 'admin.offer') style="text-decoration:underline" @endif>Manage Offers</a></li>
                    <li><a href="{{URL::to('admin/service/')}}" @if($global['activeSubMenu'] == 'admin.service') style="text-decoration:underline" @endif>Manage Services</a></li>
                    <li><a href="{{URL::to('admin/advertising/')}}" @if($global['activeSubMenu'] == 'admin.advertising') style="text-decoration:underline" @endif>Manage Advertising Levels</a></li>
                    <li><a href="{{URL::to('admin/subscription/')}}" @if($global['activeSubMenu'] == 'admin.subscription') style="text-decoration:underline" @endif>Manage Subscription Levels</a></li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
    <!-- end sidebar -->