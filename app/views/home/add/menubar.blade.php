
<!--header start-->
<header class="header-frontend">
    <div class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="fa fa-bars"></span>
                </button>
                <a class="navbar-brand" href="{{route('home')}}">
                {{ Config::get('customConfig.names.siteTitle.first')}}
                <span>{{ Config::get('customConfig.names.siteTitle.last')}}</span>
                <span style="color:blue;font-size:15px;">
                {{ Config::get('customConfig.names.siteTitle.version')}}
                </span>
                </a>
            </div>
            <div class="navbar-collapse collapse ">
                <ul class="nav navbar-nav">
                    @if(Route::currentRouteName() == 'home')
                        <li class="active"><a href="{{route('home')}}">Home</a></li>
                    @else
                        <li><a href="{{route('home')}}">Home</a></li>
                    @endif

                        @if(Route::currentRouteName() == 'about')
                            <li class="active"><a href="{{route('about')}}">About</a></li>
                        @else
                            <li><a href="{{route('about')}}">About</a></li>
                        @endif

                        @if(Route::currentRouteName() == 'features')
                            <li class="active"><a href="{{route('features')}}">Features</a></li>
                        @else
                            <li><a href="{{route('features')}}">Features</a></li>
                        @endif

                        @if(Route::currentRouteName() == 'contact')
                            <li class="active"><a href="{{route('contact')}}">Contact</a></li>
                        @else
                            <li><a href="{{route('contact')}}">Contact</a></li>
                        @endif
                    @if(!Auth::user())
                        @if(Route::currentRouteName() == 'login')
                            <li class="active"><a href="{{route('login')}}">Login</a></li>
                        @else
                            <li><a href="{{route('login')}}">Login</a></li>
                        @endif

                        @if(Route::currentRouteName() == 'register')
                            <li class="active"><a href="{{route('register')}}">Register</a></li>
                        @else
                            <li><a href="{{route('register')}}">Register</a></li>
                        @endif
                    @else
                        <li><a href="{{route('profile')}}">{{ Auth::user()->userInfo->fullName }}</a></li>
                        <li><a class="btn btn-success" href="{{route('dashboard')}}">ENTER MAIN SITE</a></li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</header>
<!--header end-->