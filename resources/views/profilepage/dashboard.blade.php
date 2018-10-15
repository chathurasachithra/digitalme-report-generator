<!-- ============================================================== -->
<!-- Start Content here -->
<!-- ============================================================== -->
<div class="content">
<!-- Start info box -->
<div class="row top-summary">

    <div class="col-lg-3 col-md-6">

        <div class="widget blue-1 animated fadeInDown">
            <div class="widget-content padding">
                <div class="widget-icon">
                    <i class="fa fa-database"></i>
                </div>
                <div class="text-box">
                    <p class="maindata"><b>EMAIL  </b> CAMPAIGN</p>
                    <h2><a class="search-personlist" href="{{ url('report/email') }}">
                            <span>generate report</span> <span class="pull-right"></span>
                        </a></h2>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">

        <div class="widget red-1 animated fadeInDown">
            <div class="widget-content padding">
                <div class="widget-icon">
                    <i class="fa fa-database"></i>
                </div>
                <div class="text-box">
                    <p class="maindata"><b>SMS  </b> CAMPAIGN</p>
                    <h2><a class="search-personlist" href="{{ url('report/sms') }}">
                            <span>generate report</span> <span class="pull-right"></span>
                        </a></h2>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="widget green-1 animated fadeInDown">
            <div class="widget-content padding">
                <div class="widget-icon">
                    <i class="fa fa-database"></i>
                </div>
                <div class="text-box">
                    <p class="maindata"><b>WHATSAPP  </b> CAMPAIGN</p>
                    <h2><a class="search-personlist" href="{{ url('report/whatsapp') }}">
                            <span>generate report</span> <span class="pull-right"></span>
                        </a></h2>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-lg-3 col-md-6">
        <div class="widget green-1 animated fadeInDown">

<!--            <div class="widget-footer">-->
<!--                <div class="row">-->
<!--                    <div class="col-sm-12">-->
<!--                        <i class="fa fa-caret-up rel-change"></i> <b>39%</b> increase in traffic-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="clearfix"></div>-->
<!--            </div>-->
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="widget darkblue-2 animated fadeInDown">

<!--            <div class="widget-footer">-->
<!--                <div class="row">-->
<!--                    <div class="col-sm-12">-->
<!--                        <i class="fa fa-caret-down rel-change"></i> <b>11%</b> decrease in sales-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="clearfix"></div>-->
<!--            </div>-->
        </div>
    </div>
    <input type="hidden" name="_token" id="tokenkey" value="{{ csrf_token() }}">

</div>
<!-- End of info box -->


<!-- Footer Start -->
