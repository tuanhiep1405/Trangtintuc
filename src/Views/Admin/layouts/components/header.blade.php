<div class="topbar">
    <div class="topbar-left d-none d-lg-block" style="background-color: #78a5f2;">
        <div class="text-center">
            <a href="/admin" class="logo"><img src="/assets/{{ $_SESSION['settings']['logo'] }}" height="36"
                    alt="logo" /></a>
        </div>
    </div>
    <nav class="navbar-custom">
        <ul class="list-inline float-right mb-0">
            <li class="list-inline-item notification-list">
                <a class="nav-link arrow-none waves-effect" href="/" data-toggle="tooltip" data-placement="left"
                    title="" data-original-title="Home">
                    <i class="mdi mdi-home noti-icon"></i>
                </a>
            </li>
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false"><img
                        src="/assets/{{ $_SESSION['user']['avatar'] }}" alt="user" class="rounded-circle" /></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                    <a class="dropdown-item" href="/admin/profile"><i
                            class="mdi mdi-account-circle m-r-5 text-muted"></i>
                        Profile</a>
                    <a class="dropdown-item" href="/admin/settings"><span class="mdi mdi-settings m-r-5 text-muted"></i>
                            Settings</a>
                    <a class="dropdown-item" href="/auth/logout"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                </div>
            </li>
        </ul>
        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
        </ul>
        <div class="clearfix"></div>
    </nav>
</div>
