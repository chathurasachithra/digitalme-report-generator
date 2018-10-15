<?php
/**
 * Created by PhpStorm.
 * User: dasitha
 * Date: 9/10/16
 * Time: 9:12 AM
 */
?>

@include('partials.message')

<!DOCTYPE html>
<html>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:48 GMT -->
<head>
    @include('layouts.master.header')
</head>
<body class="fixed-left">
<!-- Modal Start -->
<!-- Modal Task Progress -->
<div class="md-modal md-3d-flip-vertical" id="task-progress">
    <div class="md-content">
        <h3><strong>Task Progress</strong> Information</h3>
        <div>
            <p>CLEANING BUGS</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80&#37; Complete</span>
                </div>
            </div>
            <p>POSTING SOME STUFF</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                    <span class="sr-only">65&#37; Complete</span>
                </div>
            </div>
            <p>BACKUP DATA FROM SERVER</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                    <span class="sr-only">95&#37; Complete</span>
                </div>
            </div>
            <p>RE-DESIGNING WEB APPLICATION</p>
            <div class="progress progress-xs for-modal">
                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    <span class="sr-only">100&#37; Complete</span>
                </div>
            </div>
            <p class="text-center">
                <button class="btn btn-danger btn-sm md-close">Close</button>
            </p>
        </div>
    </div>
</div>

<!-- Modal Logout -->
<!--<div class="md-modal md-just-me" id="logout-modal">-->
<!--    <div class="md-content">-->
<!--        <h3><strong>Logout</strong> Confirmation</h3>-->
<!--        <div>-->
<!--            <p class="text-center">Are you sure want to logout from this awesome system?</p>-->
<!--            <p class="text-center">-->
<!--                <button class="btn btn-danger md-close">Nope!</button>-->
<!--                <a href="login.html" class="btn btn-success md-close">Yeah, I'm sure</a>-->
<!--            </p>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>        -->
<!-- Modal End -->
<div class="md-modal md-slide-stick-top" id="form-modal">
    <div class="md-content">
        <div class="md-close-btn"><a class="md-close"><i class="fa fa-times"></i></a></div>
        <h3><strong>Form</strong> Modal</h3>
        <div>
            <div class="row">
                <div class="col-sm-6">
                    <h4>Login</h4>
                    <form role="form">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
                <div class="col-sm-6">
                    <h4>Not a member?</h4>
                    <p>Create account <a href="#fakelink">here</a></p>
                    <p>OR</p>

                    <button type="button" class="btn btn-primary btn-sm btn-block btn-facebook"><i class="fa fa-facebook"></i> Login with Facebook</button>
                    <button type="button" class="btn btn-primary btn-sm btn-block btn-twitter"><i class="fa fa-twitter"></i> Login with Twitter</button>

                </div>
            </div>
        </div>
    </div>
</div><!-- End .md-modal -->
<!-- Begin page -->
<div id="wrapper">

<!-- Top Bar Start -->
<div class="topbar">
    @include('layouts.master.navbar')
</div>
<!-- Top Bar End -->
<!-- Left Sidebar Start -->
<div class="left side-menu">
    @include('layouts.master.sidebar')
</div>
<!-- Left Sidebar End -->		    <!-- Right Sidebar Start -->
<div class="right side-menu">
    @include('profilepage.rightsidemenu')
</div>
<!-- Right Sidebar End -->
<!-- Start right content -->
<div class="content-page">
<!-- ============================================================== -->
<!-- Start Content here -->
<!-- ============================================================== -->
<div class="content">
<!-- Page Heading Start -->
<div class="page-heading">
    <h1> E Campaign Delivery Report For -  {{ $data['company_name'] }}</h1>
</div>
<!-- Page Heading End-->

<!-- Your awesome content goes here -->
<div class="row custom-white-bg">
    <div class="col-md-12">
        <div id="chart-div"></div>
            {!! $lava->render('DonutChart', 'IMDB', 'chart-div') !!}
        </div>
    </div>

    <div class="row custom-white-bg">
        <hr>
        <div class="col-md-12">
            <div class="col-md-3">
                <label>Subject</label>
            </div>
            <div class="col-md-9">
                <label>{{ $data['subject'] }}</label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-3">
                <label>Sender</label>
            </div>
            <div class="col-md-9">
                <label>{{ $data['sender'] }}</label>
            </div>
        </div>

        <div class="col-md-12">
            <div class="col-md-3">
                <label>Total Active Subscribers</label>
            </div>
            <div class="col-md-9">
                <label>{{ $data['active_subscribers'] }}</label>
            </div>
        </div>

        <div class="col-md-12">
            <div class="col-md-3">
                <label>Total Opened Subscribers</label>
            </div>
            <div class="col-md-9">
                <label>{{ $data['open_subscribers'] }}</label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-3">
                <label>Total Un-opened Subscribers</label>
            </div>
            <div class="col-md-9">
                <label>{{ $data['un_open_subscribers'] }}</label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-3">
                <label>Un-subscribed Emails</label>
            </div>
            <div class="col-md-9">
                <label>{{ $data['un_subscribed_emails'] }}</label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-3">
                <label>Campaign Date</label>
            </div>
            <div class="col-md-9">
                <label>{{ $data['campaign_date'] }}</label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-3">
                <label>Report Downloaded Date</label>
            </div>
            <div class="col-md-9">
                <label>{{ $data['downloaded_date'] }}</label>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
            <a href="/print/email" >
                <button class="btn btn-default">Print</button>
            </a>
    </div>
</div>


<!-- Footer Start -->
@include('layouts.master.footer')
</body>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:50 GMT -->
</html>