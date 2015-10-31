<header class="header white-bg">
          <div class="sidebar-toggle-box">
              <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
          </div>
          <!--logo start-->
          <a href="{{route('dashboard')}}" class="logo" >result<span>sust</span></a>
          <!--logo end-->

            <!-- notification option -->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->

                <ul class="nav top-menu">
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="fa fa-bell-o"></i>
                            @if($notification = Notification::where('status',1)->get())
                                @if($count=count($notification)>0)
                                    <span class="badge bg-warning">{{count($notification)}}</span>
                                @endif
                            @endif
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-yellow"></div>
                            <li>
                                <p class="yellow">You have {{count($notification)}} new notifications</p>
                            </li>
                            @foreach($notification as $notification)
                                <li>
                                        <span class="label label-success"><i class="fa fa-plus"></i></span>
                                        {{$notification->notification_text}}
                                        <span class="small italic"> {{$notification->updated_at->diffForHumans()}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- notification dropdown end -->
                </ul>
            </div>




          <div class="top-nav ">
              <ul class="nav pull-right top-menu">

                  <!-- user login dropdown start-->
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          {{ HTML::image(Auth::user()->userInfo->icon_url, 'alt', array( 'width' => 35, 'height' => 35 )) }}
                          <span class="username">{{Auth::user()->userInfo->fullName}}</span>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu extended logout">
                          <div class="log-arrow-up"></div>
                          <li><a href="{{route('profile')}}"><i class=" fa fa-suitcase"></i>Profile</a></li>

                          <li><a href="{{route('password.change')}}"><i class="fa fa-cog"></i> Change Password</a></li>
                          <li><a href="{{route('logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
                      </ul>
                  </li>

                  <!-- user login dropdown end -->

              </ul>
          </div>
      </header>