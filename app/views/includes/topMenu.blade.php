<header class="header white-bg">
          <div class="sidebar-toggle-box">
              <div data-original-title="Toggle Navigation" data-placement="right" class="fa fa-bars tooltips"></div>
          </div>
          <!--logo start-->
          <a href="{{route('dashboard')}}" class="logo" >result<span>sust</span></a>
          <!--logo end-->

            <!-- notification option -->
            <div class="nav notify-row" id="top_menu">


                <ul class="nav top-menu">

                    <!-- mesage section-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="true">
                            <i class="fa fa-envelope-o"></i>
                            @if($message = Message::where('receiver_id',Auth::user()->id)
                                                    ->where('seen_status',false)
                                                    ->get())
                                @if($count=count($message)>0)
                                    <span class="badge bg-important">{{count($message)}}</span>
                                @endif
                            @endif
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-red"></div>
                            <li>
                                <p class="red">You have {{count($message)}} new messages</p>
                            </li>
                            <li>
                                @if(Entrust::hasRole(Config::get('customConfig.roles.user')))
                                <a href="{{route('writeMessage')}}" class="green"><i class="fa fa-pencil"></i> Send message</a>
                                @endif
                            </li>

                            @foreach($message as $message)
                                @if($sender_info = User::where('id',$message->sender_id)->first())
                                <li>
                                    <a href="{{route('messageDetails',$message->id)}}">
                                        <span class="photo">
                                            {{ HTML::image($sender_info->userInfo->icon_url, 'alt', array( 'width' => 35, 'height' => 35 )) }}
                                        </span>
                                        <span class="subject">{{ $message->subject }}</span>
                                        <span class="from">{{ $sender_info->userInfo->fullName }}<br>
                                        <span class="time">{{ $message->updated_at->diffForHumans() }} </span>
                                        </span>
                                        <span class="message">
                                            click for details
                                        </span>
                                    </a>
                                </li>
                                @endif
                            @endforeach

                            <li>
                                <a href="{{route('seeAllMessages')}}" class="green"> see older messages</a>
                            </li>
                        </ul>
                    </li>

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