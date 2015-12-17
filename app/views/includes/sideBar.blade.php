<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

                <!-- dashboard -->

                  <li>

                      <a href="{{ URL::route('dashboard') }}">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  {{-- Task Manager --}}
                  <li>

                      <a href="{{route('profile')}}">
                          <i class="fa fa-tasks"></i>
                          <span>Profile</span>
                      </a>
                  </li>

                  <li>

                      <a href="{{route('messages')}}">
                          <i class="fa fa-envelope-o"></i>
                          <span>Messages</span>
                      </a>
                  </li>

                  {{-- Carrier Accounts --}}
                  <li>

                      <a href="{{route('classmates')}}">
                          <i class="fa fa-users"></i>
                          <span>Classmates</span>
                      </a>
                  </li>
                  @if(Entrust::hasRole(Config::get('customConfig.roles.user')))
                  {{-- Results --}}
                  <li>

                      <a href="{{route('resultsDataTable')}}">
                          <i class="fa fa-table"></i>
                          <span>Results</span>
                      </a>
                  </li>

                  <li>

                      <a href="{{route('chart.course-grade')}}">
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Charts</span>
                      </a>
                  </li>
                  @endif
                  <li>

                      <a href="{{route('posts')}}">
                          <i class=" fa fa-clipboard"></i>
                          <span>Posts</span>
                      </a>
                  </li>
                  @if(Entrust::hasRole(Config::get('customConfig.roles.manager')))
                  <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent">
                          <i class="fa fa-laptop"></i>
                          <span>Manage Data</span>
                      <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">

                        <li>
                          <a href="{{route('data.entry')}}">
                              <i class="fa fa-bell-o"></i>
                              <span>Results</span>
                          </a>
                        </li>
                        
                        <li>

                          <a href="{{route('course.show')}}">
                              <i class="fa fa-bell-o"></i>
                              <span>Course</span>
                          </a>
                        </li>

                        <li>
                            <a href="{{route('showDept')}}">
                                <i class="fa fa-bell-o"></i>
                                <span>Departments</span>
                            </a>
                        </li>
                        <li>

                          <a href="{{route('showBatch')}}">
                              <i class="fa fa-bell-o"></i>
                              <span>Batch</span>
                          </a>
                      </li>
                      </ul>
                  </li>
                  @endif

                  @if(Entrust::hasRole(Config::get('customConfig.roles.admin')))
                  <li>
                      <a href="{{route('users')}}">
                      <i class="fa fa-users"></i>
                      <span>Users</span>
                      </a>
                  </li>
                  <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent">
                          <i class="fa fa-laptop"></i>
                          <span>Admin Data Add</span>
                      <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">

                        <li>
                          <a href="{{route('viewNotifications')}}">
                              <i class="fa fa-bell-o"></i>
                              <span>Notifications</span>
                          </a>
                        </li>
                        <li>
                            <a href="{{route('showDept')}}">
                                <i class="fa fa-bell-o"></i>
                                <span>Departments</span>
                            </a>
                        </li>
                        <li>

                          <a href="{{route('showBatch')}}">
                              <i class="fa fa-bell-o"></i>
                              <span>Batch</span>
                          </a>
                      </li>
                      <li>

                          <a href="{{route('showCourse')}}">
                              <i class="fa fa-bell-o"></i>
                              <span>Course</span>
                          </a>
                      </li>
                      </ul>
                  </li>
                @endif

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
