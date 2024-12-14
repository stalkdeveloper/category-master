<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
		
			
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#"><span></span></a>
        <a href="{{ url('/dashboard') }}" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
           <h4 style="color:#fff; padding-right: 30px;"></h4>
        </a>
        <a href="{{ url('/dashboard') }}" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            </li>
            <li class="nav-item">
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown drp-user mt-2">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <img src="assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image">
                            <span>{{ Auth::user()->name}}</span>
                            <a href="{{ route('logout') }}" onclick="return logout(event);" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
