<?php
/**
 * Created by PhpStorm.
 * User: dasitha
 * Date: 7/11/16
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
<?php 
//cover profile pics
 $coverpic = URL::asset('/images/stock/1epgUO0.jpg');

?>
<div class="profile-banner" style="background-image: url({{ $coverpic}});">
    <div class="col-sm-3 avatar-container">
        <img src="<?php echo (Auth::user()->profileimage != '')?Auth::user()->profileimage:'/media/profile/default_profile.jpg'; ?>" class="img-circle profile-avatar" alt="User avatar">
    </div>
<!--    <div class="col-sm-12 profile-actions text-right">-->
<!--        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Friends</button>-->
<!--        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-envelope"></i> Send Message</button>-->
<!--        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-ellipsis-v"></i></button>-->
<!--    </div>-->
</div>
<div class="content">

<div class="row">
<div class="col-sm-3">
    <!-- Begin user profile -->
    <div class="text-center user-profile-2">
        <h4>Hello, <b>{{ Auth::user()->name }}</b></h4>

        <!-- End div .user-button -->
    </div><!-- End div .box-info -->
    <!-- Begin user profile -->

    <div style="clear:both">&nbsp;</div>
</div>

<div class="col-sm-9">

<!-- Start info box -->
<div class="row top-summary">

    <input type="hidden" name="_token" id="tokenkey" value="{{ csrf_token() }}">

</div>
<!-- End of info box -->

</div>

</div>

<!-- Footer Start -->
@include('layouts.master.footer')



</body>

</html>
