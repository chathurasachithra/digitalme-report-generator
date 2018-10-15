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
    <style media="print">
        @page {
            /*size: auto;
            margin: 0;*/
        }

        @media print {
            @page { margin: 0; }
            body { margin: 2cm; }
        }

        @media screen {
            div.div-footer {
                display: none;
            }
        }
        @media print {
            div.div-footer {
                position: fixed;
                bottom: 0;
            }
        }

    </style>
    <style type="text/css">

        .printable { display: none; }

        @media print
        {
            .non-printable { display: none; }
            .printable { display: block; }

            label {
                font-size:13pt;
            }

            body {-webkit-print-color-adjust: exact;}

        }

        .custom-height {
            min-height: 29px;
            line-height: 14px;
            background-color: #eeeeee;
            margin: 15px;
            margin-top: 0px;
            padding-top: 7px;
            -webkit-print-color-adjust: exact;
        }

    </style>
</head>
<body class="fixed-left">

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
<div class="content-page" id="printableArea">
<!-- ============================================================== -->
<!-- Start Content here -->
<!-- ============================================================== -->
<div class="content" >
<!-- Page Heading Start -->
<div class="page-heading">
    <h1> WHATSAPP CAMPAIGN REPORT -  {{ $data['company_name'] }}</h1>
</div>
<!-- Page Heading End-->

<!-- Your awesome content goes here -->
<div class="row custom-white-bg" >
    <div class="col-md-12">
        <div id="chart-div"></div>
            {!! $lava->render('PieChart', 'IMDB', 'chart-div') !!}
        </div>
    </div>

    <div class="row custom-white-bg non-printable">
        <hr>
        <div class="col-md-10">

            <div class="col-md-12 custom-height">
                <div class="col-md-12">
                    <label><b>Report Summary</b></label>
                </div>
            </div>


            <div class="col-md-12 custom-height">
                <div class="col-md-4">
                    <label>Company</label>
                </div>
                <div class="col-md-8">
                    <i class="fa fa-caret-right"></i> <label>{{ $data['company_name'] }}</label>
                </div>
            </div>
            <div class="col-md-12 custom-height" >
                <div class="col-md-4">
                    <label>Sender</label>
                </div>
                <div class="col-md-8">
                    <i class="fa fa-caret-right"></i> <label>{{ $data['sender'] }}</label>
                </div>
            </div>
            <div class="col-md-12 custom-height">
                <div class="col-md-4">
                    <label>Data Type</label>
                </div>
                <div class="col-md-8">
                    <i class="fa fa-caret-right"></i> <label>{{ $data['db_type'] }}</label>
                </div>
            </div>

            <div class="col-md-12 custom-height">
                <div class="col-md-4">
                    <label>Total Message Count</label>
                </div>
                <div class="col-md-8">
                    <i class="fa fa-caret-right"></i> <label>{{ $data['sent_message_count'] }}</label>
                </div>
            </div>

            <div class="col-md-12 custom-height">
                <div class="col-md-4">
                    <label>Total Opened Messages</label>
                </div>
                <div class="col-md-8">
                    <i class="fa fa-caret-right"></i> <label>{{ $data['open_subscribers'] }}</label>
                </div>
            </div>
            <div class="col-md-12 custom-height">
                <div class="col-md-4">
                    <label>Total Un-opened Messages</label>
                </div>
                <div class="col-md-8">
                    <i class="fa fa-caret-right"></i> <label>{{ $data['un_open_subscribers'] }}</label>
                </div>
            </div>


            <div class="col-md-12 custom-height">
                <div class="col-md-4">
                    <label>Campaign Date</label>
                </div>
                <div class="col-md-8">
                    <i class="fa fa-caret-right"></i> <label>{{ $data['campaign_date'] }}</label>
                </div>
            </div>
            <div class="col-md-12 custom-height">
                <div class="col-md-4">
                    <label>Report Downloaded Date</label>
                </div>
                <div class="col-md-8">
                    <i class="fa fa-caret-right"></i> <label>{{ $data['downloaded_date'] }}</label>
                </div>
            </div>
            <div class="col-md-12 custom-height">
                <div class="col-md-4">
                    <label>Description</label>
                </div>
                <div class="col-md-8">
                    <i class="fa fa-caret-right"></i> <label>{{ $data['description'] }}</label>
                </div>
            </div>
        </div>
    </div>



    <div class="row custom-white-bg printable" style="font-size:15pt">
        <hr>
        <div class="col-md-10">
            <table width="100%" style="padding: 25mm;">
                <tr class="custom-height" style=" min-height:50px;line-height:44px;">
                    <td width="40%" valign="top">
                        <b>Report summary</b></label>
                    </td>
                    <td width="60%" style="padding-left: 20px">
                    </td>
                </tr>


                <tr class="custom-height"
                    style="min-height:50px;line-height:34px;">
                    <td width="40%" valign="top">
                        <label>Company</label>
                    </td>
                    <td width="60%" style="padding-left: 20px">
                        <i class="fa fa-caret-right"></i> <label>{{ $data['company_name'] }}</label>
                    </td>
                </tr>

                <tr class="custom-height" style=" min-height:50px;line-height:34px;">
                    <td width="40%" valign="top">
                        <label>Sender</label>
                    </td>
                    <td width="60%" style="padding-left: 20px">
                        <i class="fa fa-caret-right"></i> <label>{{ $data['sender'] }}</label>
                    </td>
                </tr>

                <tr class="custom-height" style=" min-height:50px;line-height:34px;">
                    <td width="40%" valign="top">
                        <label>Data Type</label>
                    </td>
                    <td width="60%" style="padding-left: 20px">
                        <i class="fa fa-caret-right"></i> <label>{{ $data['db_type'] }}</label>
                    </td>
                </tr>
                <tr class="custom-height" style=" min-height:50px;line-height:34px;">
                    <td width="40%" valign="top">
                        <label>Total Message Count</label>
                    </td>
                    <td width="60%" style="padding-left: 20px">
                        <i class="fa fa-caret-right"></i> <label>{{ $data['sent_message_count'] }}</label>
                    </td>
                </tr>

                <tr class="custom-height" style=" min-height:50px;line-height:34px;">
                    <td width="40%" valign="top">
                        <label>Total Opened Messages</label>
                    </td>
                    <td width="60%" style="padding-left: 20px">
                        <i class="fa fa-caret-right"></i> <label>{{ $data['open_subscribers'] }}</label>
                    </td>
                </tr>
                <tr class="custom-height" style=" min-height:50px;line-height:34px;">
                    <td width="40%" valign="top">
                        <label>Total Un-opened Messages</label>
                    </td>
                    <td width="60%" style="padding-left: 20px">
                        <i class="fa fa-caret-right"></i> <label>{{ $data['un_open_subscribers'] }}</label>
                    </td>
                </tr>
                <tr class="custom-height" style=" min-height:50px;line-height:34px;">
                    <td width="40%" valign="top">
                        <label>Campaign Date</label>
                    </td>
                    <td width="60%" style="padding-left: 20px">
                        <i class="fa fa-caret-right"></i> <label>{{ $data['campaign_date'] }}</label>
                    </td>
                </tr>
                <tr class="custom-height" style=" min-height:50px;line-height:34px;">
                    <td width="40%" valign="top">
                        <label>Report Downloaded Date</label>
                    </td>
                    <td width="60%" style="padding-left: 20px">
                        <i class="fa fa-caret-right"></i> <label>{{ $data['downloaded_date'] }}</label>
                    </td>
                </tr>
                <tr class="custom-height" style=" min-height:50px;line-height:34px;">
                    <td width="40%" valign="top">
                        <label>Description</label>
                    </td>
                    <td width="60%" style="padding-left: 20px">
                        <i class="fa fa-caret-right"></i> <label>{{ $data['description'] }}</label>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <div class="row non-printable" style="margin-top: 10px">
            {{--<a href="/print/email" >--}}
                <button class="btn btn-default" onclick="printDiv('printableArea')">Print</button>
            {{--</a>--}}
    </div>
</div>

    <div class="div-footer printable" style="margin:20px;margin-left: 0px;">
        <hr>

        <table width="100%">
            <tr>
                <td width="80%">
                    Buzz connect &copy; <script>document.write(new Date().getFullYear())</script>
                </td>
                <td width="20%" style="padding-left: 20px" align="right">
                    <img src="/assets/img/buzz-logo-footer.jpg">
                </td>
            </tr>
        </table>

    </div>
<!-- Footer Start -->
@include('layouts.master.footer')
</body>
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        //document.getElementById('header').style.display = 'none';
        //document.getElementById('footer').style.display = 'none';
        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

<!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Jun 2016 20:04:50 GMT -->
</html>