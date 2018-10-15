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
    <h1><i class='fa fa-check'></i> Generate email report</h1>
</div>
<!-- Page Heading End-->

<!-- Your awesome content goes here -->
<div class="row">
    <div class="col-md-12">

        <?php if (!empty($reportError)) { ?>
            <div class="alert alert-warning">
                {{$reportError}}
            </div>
        <?php } ?>

        <div class="widget">
            <div class="widget-header transparent">
                <h2><strong>Please fill the below inputs : </strong></h2>
            </div>
            <div class="widget-content">
                <div class="data-table-toolbar">
                    <form class="report-form" method="POST" action="{{ url('/generate/email') }}"
                          id="report-form"
                          role="form" enctype="multipart/form-data">

                        <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Company Name</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" cus-name="Company Name" name="name" id="report-name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Subject </label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" cus-name="Subject" name="subject" id="report-subject" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Sender</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" cus-name="Sender" name="sender" id="report-sender" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Total Active Subscribers</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="total_active_sub" cus-name="Total Active Subscribers"
                                           value="{{$active}}"
                                           id="report-total_active_sub"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Total Opened Subscribers </label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="total_open_sub" id="report-total_open_sub"
                                           value="{{$open}}" cus-name="Total Open Subscribers"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Total Un-opened Subscribers</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="total_un_open_sub" id="report-total_un_open_sub"
                                           value="{{$unOpen}}"  cus-name="Total Un-open Subscribers"
                                           class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label> Unsubscribed</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="total_un_sub" id="report-total_un_sub"
                                           value="{{$unSubscribers}}" cus-name="Un-subscribers"
                                           class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Campaign Date</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="campaign_date"
                                           autocomplete="off" cus-name="Campaign Date"
                                           class="form-control" id="report-campaign_date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Report Downloaded Date</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="text" name="download_date"
                                           autocomplete="off"
                                           class="form-control" cus-name="Report Downloaded Date"
                                           id="report-download_date">
                                    <input type="hidden" name="_token" id="hidden-token" value="{{ csrf_token() }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">

                                <div class="col-md-6">
                                    <div class="form-group">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-plus-circle" aria-hidden="true"> Generate Report</i>
                                            </button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>


<!-- Footer Start -->
@include('layouts.master.footer')

    <script type="text/javascript">
        $("#report-form").submit(function( event ) {

            var formData=$("#report-form").serializeArray();
            var errorFree = true;
            var errorMessage = '';
            for (var input in formData){

                var element=$("#report-"+formData[input]['name']);

                if (!element.val() && formData[input]['name'] !== '_token') {
                    errorFree = false;
                    errorMessage = errorMessage + element.attr('cus-name') + ' cannot be empty.\n';
                }

            }
            if (!errorFree){
                alert(errorMessage);
                event.preventDefault();
            }
        });

        $(function() {
            $("#report-campaign_date").datepicker();
            $("#report-download_date").datepicker();
        });

    </script>
</body>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:50 GMT -->
</html>