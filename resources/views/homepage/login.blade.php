<!--begin col-md-4 -->
<section class="section-white" id="login">

    <style type="text/css">
        @media screen and (max-height: 575px){ #rc-imageselect, .g-recaptcha { transform:scale(0.77); -webkit-transform:scale(0.77); transform-origin:0 0; -webkit-transform-origin:0 0; }
    </style>
    <!--begin container-->
    <div class="container">

     <!--begin row-->
            <div class="row login-content">

                <form id="homeLoginForm" class="login" action="<?php echo action('UserController@postLogin'); ?>" method="post">

                    <!--begin col-md-4 -->
                    <div class="col-md-6 login-box col-md-offset-3">

                        <!--begin login-box -->
                        <div class="login-box-green">

                            <!--begin login-top -->
                            <div class="login-top">

                                <h3>Login</h3>

                            </div>
                            <!--end login-top -->

                            <!--begin login-bottom -->
                            <div class="login-bottom">
                                <input class="login-input" required="" name="email" placeholder="Email*" type="email">
                                <input class="login-input" required="" name="password" placeholder="Password*" type="password">
                                {{ csrf_field() }}
                                <!--<div class="blank"></div>-->
                            </div>
                            <!--end login-bottom -->

                            <div class="login-footer col-md-12">
                                <input type="submit" name="homeLogin" class="btn-square btn btn-md btn-block btn-login-green" value="LOGIN" >
                            </div>
                        </div>
                        <!--end login-box -->

                    </div>

                </form>
                
            </div>
            <!--end row-->

    </div>
    <!--end container-->

</section>
<!--end section-white