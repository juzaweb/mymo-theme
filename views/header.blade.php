<header id="header">
    <div class="container">
        <div class="row" id="headwrap">
            <div class="col-md-2 col-sm-6 slogan">
                <h1 class="site-title"><a class="logo" href="/" rel="home">{{ get_config('title') }}</a></h1>
            </div>

            <div class="col-md-5 col-sm-6 mymo-search-form hidden-xs">
                <div class="header-nav">
                    <div class="col-xs-12">
                        <form id="search-form-pc" name="mymoForm" role="search" action="{{ route('search') }}" method="GET">
                            <div class="form-group">
                                <div class="input-group col-xs-12">
                                    <input id="search" type="text" name="q" value="" class="form-control" data-toggle="tooltip" data-placement="bottom" data-original-title="@lang('theme::app.press_enter_to_search')" placeholder="@lang('theme::app.search_movies_or_tv_series')" autocomplete="off" required>
                                    <i class="animate-spin hl-spin4 hidden"></i>
                                </div>
                            </div>
                            <input type="hidden" name="type" value="movies">
                        </form>
                        <ul class="ui-autocomplete ajax-results hidden"></ul>
                    </div>
                </div>
            </div>
            <div class="col-md-5 hidden-xs text-right">

                <div id="get-bookmark" class="box-shadow">
                    <i class="hl-bookmark"></i><span> @lang('theme::app.bookmark')</span>
                    <span class="count">0</span>
                </div>

                <div id="get-notification" class="box-shadow">
                    <i class="hl-bell"></i>
                    @if(Auth::check())
                        <span class="count">{{ Auth::user()->unreadNotifications()->count() }}</span>
                    @else
                        <span class="count">0</span>
                    @endif
                </div>

                <div class="user user-login-option box-shadow" id="pc-user-login">
                    <div class="dropdown">
                        @if(Auth::check())
                            <a href="javascript:void(0)" class="avt" id="userInfo2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <img src='http://1.gravatar.com/avatar/?s=20&#038;d=mm&#038;r=g' srcset='http://2.gravatar.com/avatar/?s=40&#038;d=mm&#038;r=g 2x' class='avatar avatar-20 photo avatar-default' height='20' width='20' />
                                <span class="name">@lang('theme::app.account')</span>
                            </a>
                            <ul class="dropdown-menu login-box" aria-labelledby="userInfo2">
                                @if(\Juzaweb\Models\User::find(Auth::id())->is_admin)
                                    <li><a href="{{ route('admin.dashboard') }}" data-turbolinks="false"><i class="hl-cog"></i> @lang('theme::app.admin_panel')</a></li>
                                @endif

                                <li><a href=""><i class="hl-user"></i> @lang('theme::app.profile')</a></li>

                                <li><a href="{{ route('auth.logout') }}" data-turbolinks="false"><i class="hl-off"></i> @lang('theme::app.logout')</a></li>
                            </ul>
                        @else
                        <a href="javascript:void(0)" class="avt" id="userInfo">
                            <img src='http://1.gravatar.com/avatar/?s=20&#038;d=mm&#038;r=g' srcset='http://2.gravatar.com/avatar/?s=40&#038;d=mm&#038;r=g 2x' class='avatar avatar-20 photo avatar-default' height='20' width='20' />
                            <span class="name">@lang('theme::app.login')</span>
                        </a>
                        @endif
                    </div>
                </div>

                <div id="bookmark-list" class="hidden bookmark-list-on-pc">
                    <ul style="margin: 0;"></ul>
                </div>

                <div id="notification-list" class="hidden notification-list-on-pc">
                    <ul style="margin: 0;"></ul>
                </div>
            </div>

        </div>
    </div>
</header>

<div class="navbar-container">
    <div class="container">
        <nav class="navbar mymo-navbar main-navigation" role="navigation" data-dropdown-hover="1">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse" data-target="#mymo" aria-expanded="false">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <button type="button" class="navbar-toggle collapsed pull-right" data-toggle="collapse" data-target="#user-info" aria-expanded="false">
                    <span class="hl-dot-3 rotate" aria-hidden="true"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right expand-search-form" data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                    <span class="hl-search" aria-hidden="true"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                    <i class="hl-bookmark" aria-hidden="true"></i>
                    <span class="count">0</span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="mymo">
                <div class="menu-main-menu-container">
                    <ul id="menu-main-menu" class="nav navbar-nav navbar-left">

                        <li  class="current-menu-item active" >
                            <a title="Home" href="/" >Home</a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div class="collapse navbar-collapse" id="search-form">
            <div id="mobile-search-form" class="mymo-search-form"></div>
        </div>
        <div class="collapse navbar-collapse" id="user-info">
            <div id="mobile-user-login"></div>
        </div>
    </div>
</div>
