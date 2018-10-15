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
    <h1><i class='fa fa-check'></i> Generate whats-app report</h1>
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
                    <form class="report-form" method="POST" action="{{ url('/generate/whatsapp') }}"
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
                                    <label>Database Type</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <select cus-name="Database type" name="db-type" id="report-db-type"
                                                class="form-control">
                                            <option value="">Select</option>
                                            <option value="Corporate">Corporate</option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                            <option value="Geographic">Geographic</option>
                                            <option value="VIP">VIP</option>
                                            <option value="custom">Custom >></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" id="custom-db-type-container" style="display:none;">
                                <div class="col-md-3">
                                    <label>Custom Database Type</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" cus-name="Custom database type" name="db-type-custom"
                                               id="report-db-type-custom"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Sent Message Count</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <select cus-name="Sent Message Count" name="sent-message-count"
                                                id="report-sent-message-count"
                                                class="form-control">
                                            <option value="0">Select</option>
                                            <option value="5000">5000</option>
                                            <option value="10000">10000</option>
                                            <option value="20000">20000</option>
                                            <option value="30000">30000</option>
                                            <option value="25000">25000</option>
                                            <option value="50000">50000</option>
                                            <option value="100000">100000</option>
                                            <option value="200000">200000</option>
                                            <option value="custom">custom >></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" id="custom-sent-message-count-container" style="display:none;">
                                <div class="col-md-3">
                                    <label>Custom Sent Message Count</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" cus-name="Custom Sent Message Count" name="sent-message-count-custom"
                                               id="report-sent-message-count-custom"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Opened Message Count </label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="open-message" id="report-open-message"
                                               value="0" cus-name="Open Message Count"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <label>Un-Opened Message Count </label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="un-open-message" id="report-un-open-message"
                                               value="0" cus-name="Un-open Message Count"
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
                                <div class="col-md-3">
                                    <label>Message Description </label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                <textarea  cus-name="Message Description" name="description" id="report-description"
                                           class="form-control"></textarea>
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
                if (!element.val() && formData[input]['name'] !== '_token' && formData[input]['name'] !== 'db-type-custom'
                    &&  formData[input]['name'] !== 'sent-message-count-custom') {
                    errorFree = false;
                    errorMessage = errorMessage + element.attr('cus-name') + ' cannot be empty.\n';
                }
            }
            if ($('#report-sent-message-count').val() !== 'custom' && parseInt($('#report-sent-message-count').val()) === 0) {
                errorFree = false;
                errorMessage = errorMessage + 'Sent Message Count need to be selected.\n';
            }

            if ($('#report-sent-message-count').val() == 'custom' && $('#report-sent-message-count-custom').val() == '' ) {
                errorFree = false;
                errorMessage = errorMessage + 'Please enter custom sent message count.\n';
            }

            if (parseInt($('#report-open-message').val()) < 1) {
                errorFree = false;
                errorMessage = errorMessage + 'Open Message Count need to be more than 0.\n';
            }
            if (parseInt($('#report-un-open-message').val()) < 1) {
                errorFree = false;
                errorMessage = errorMessage + 'Un-open Message Count need to be more than 0.\n';
            }

            if ($('#report-db-type').val() == 'custom' && $('#report-db-type-custom').val() == '' ) {
                errorFree = false;
                errorMessage = errorMessage + 'Please enter custom database type.\n';

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

        $("#report-open-message").change(function(){
            var count = parseInt($('#report-sent-message-count').val());
            var open = parseInt($('#report-open-message').val());
            if (count > 0 && open > 0) {
                $('#report-un-open-message').val(count - open);
            }
        });

        $("#report-db-type").change(function() {

            if ($('#report-db-type').val() == 'custom') {
                $('#custom-db-type-container').show();
            } else {
                $('#custom-db-type-container').hide();
            }
        });


        $("#report-sent-message-count-custom").change(function(){
            $('#report-open-message').val(0);
            $('#report-un-open-message').val(0);
        });

        $("#report-sent-message-count").change(function(){


            if ($('#report-sent-message-count').val() == 'custom') {
                $('#custom-sent-message-count-container').show();
                $('#report-open-message').val(0);
                $('#report-un-open-message').val(0);
            } else {
                $('#custom-sent-message-count-container').hide();
                var count = parseInt($('#report-sent-message-count').val());
                var open = 0;
                if (count > 0) {
                    switch (count) {
                        case 5000:
                            open = Math.floor(Math.random() * (4800 - 3500 + 1)) + 3500;
                            break;
                        case 10000:
                            open = Math.floor(Math.random() * (9800 - 6500 + 1)) + 6500;
                            break;
                        case 20000:
                            open = Math.floor(Math.random() * (19850 - 16300 + 1)) + 16300;
                            break;
                        case 25000:
                            open = Math.floor(Math.random() * (24875 - 17500 + 1)) + 17500;
                            break;
                        case 30000:
                            open = Math.floor(Math.random() * (29895 - 24000 + 1)) + 24000;
                            break;
                        case 50000:
                            open = Math.floor(Math.random() * (49837 - 38000 + 1)) + 38000;
                            break;
                        case 100000:
                            open = Math.floor(Math.random() * (98736 - 69735 + 1)) + 69735;
                            break;
                        case 200000:
                            open = Math.floor(Math.random() * (185489 - 165385 + 1)) + 165385;
                            break;
                    }
                }
                $('#report-open-message').val(open);
                $('#report-un-open-message').val(count - open);
            }
        });

    </script>
</body>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:50 GMT -->
</html>