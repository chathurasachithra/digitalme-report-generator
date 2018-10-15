<div class="topbar-left">


</div>
<!-- Button mobile view to collapse sidebar menu -->
<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-collapse2">

            <ul class="nav navbar-nav navbar-right top-navbar">
<!--                Notification area-->



                <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                <li class="dropdown topbar-profile">
                    <a href="/user/profile" class="dropdown-toggle" data-toggle="dropdown"><span class="rounded-image topbar-profile-image"><img src="<?php echo (Auth::user()->profileimage != '')?Auth::user()->profileimage:'/media/profile/default_profile.jpg'; ?>"></span> <strong>{{ Auth::user()->name }}</strong> <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu">

                        <li><a href="#"><i class="icon-help-2"></i> Help</a></li>
                        <li><a href="{{ URL::to('auth/logout') }}" class="md-trigger" data-modal="logout-modal"><i class="icon-logout-1"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>