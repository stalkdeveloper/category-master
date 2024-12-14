<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ asset('assets/images/user/avatar-2.jpg')}}" alt="User-Profile-Image">
                    <div class="user-details">
                        <span>{{Auth::user()->name}}</span>
                        <div id="more-details">{{Auth::user()->email}}<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="{{ route('logout') }}" onclick="return logout(event);"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Master Category</label>
                </li>
                <li class="nav-item">
                    <a href="{{url('/dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                @can('has_permission', 'category_access')
                    <li class="nav-item pcoded-hasmenu">
                        <a href="javascript:void(0)" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Category</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="{{route('categories.index')}}">Categories</a></li>
                        </ul>
                    </li>
                @endcan
                {{-- <li class="nav-item pcoded-menu-caption">
                    <label>UI Element</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:void(0)" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Basic</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="bc_alert.html">Alert</a></li>
                        <li><a href="bc_button.html">Button</a></li>
                        <li><a href="bc_badges.html">Badges</a></li>
                    </ul>
                </li> --}}
            </ul>
            
            
        </div>
    </div>
</nav>