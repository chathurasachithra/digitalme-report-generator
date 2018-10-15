<div class="sidebar-inner slimscrollleft">
    <!-- Search form -->
<!--    <form role="search" class="navbar-form">-->
<!--        <div class="form-group">-->
<!--            <input type="text" placeholder="Search" class="form-control">-->
<!--            <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>-->
<!--        </div>-->
<!--    </form>-->
<!--    <div class="clearfix"></div>-->
    <!--- Profile -->
    <div class="profile-info" style="margin-top: 10px;">
        <div class="col-xs-4">
            <a href="/user/profile" class="rounded-image profile-image"><img src="<?php echo (Auth::user()->profileimage != '')?Auth::user()->profileimage:'/media/profile/default_profile.jpg'; ?>"></a>
        </div>
        <div class="col-xs-8">
            <div class="profile-text">Welcome <b>{{ Auth::user()->name }}</b></div>
            <div class="profile-buttons">
                <a href="javascript:;"><i class="fa fa-envelope-o pulse"></i></a>
                <a href="#connect" class="open-right"><i class="fa fa-comments"></i></a>
                <a href="/auth/logout" title="Sign Out"><i class="fa fa-power-off text-red-1"></i></a>
            </div>
        </div>
    </div>
    <!--- Divider -->
    <div class="clearfix"></div>
    <hr class="divider" />
    <div class="clearfix"></div>
    <!--- Divider -->
    <div id="sidebar-menu">
        <ul>
            <li class='has_sub' onclick="window.location='/user/dashboard'">
                <a href='/user/dashboard'><i class='icon-home-3'>
                    </i><span>Dashboard</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                </a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div><br><br><br>
</div>
<div class="left-footer">
    <div class="progress progress-xs">
        <div class="progress-bar bg-green-1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
            <span class="progress-precentage">80%</span>
        </div>

        <a data-toggle="tooltip" title="See task progress" class="btn btn-default md-trigger" data-modal="task-progress"><i class="fa fa-inbox"></i></a>
    </div>
</div>