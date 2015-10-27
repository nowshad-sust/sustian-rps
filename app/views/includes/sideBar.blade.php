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
                  {{-- Carrier Accounts --}}
                  <li>

                      <a href="{{route('classmates')}}">
                          <i class="fa fa-plane"></i>
                          <span>Classmates</span>
                      </a>
                  </li>


              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>