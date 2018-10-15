<!-- Footer Start -->
<footer  class="non-printable">
    Buzz connect &copy; <script>document.write(new Date().getFullYear())</script>
            <div class="footer-links pull-right">
            </div>
</footer>

<!-- Footer End -->
</div>
<!-- ============================================================== -->
<!-- End content here -->
<!-- ============================================================== -->

<script>
    var resizefunc = [];
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-detectmobile/detect.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-animate-numbers/jquery.animateNumbers.js') }}"></script>
<script src="{{ URL::asset('assets/libs/ios7-switch/ios7.switch.js') }}"></script>
<script src="{{ URL::asset('assets/libs/fastclick/fastclick.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-blockui/jquery.blockUI.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-bootbox/bootbox.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-sparkline/jquery-sparkline.js') }}"></script>
<script src="{{ URL::asset('assets/libs/nifty-modal/js/classie.js') }}"></script>
<script src="{{ URL::asset('assets/libs/sortable/sortable.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-fileinput/bootstrap.file-input.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/pace/pace.min.js') }}"></script>
{{--<script src="{{ URL::asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>--}}
<script src="{{ URL::asset('assets/datepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-icheck/icheck.min.js') }}"></script>

<!-- Demo Specific JS Libraries -->
<script src="{{ URL::asset('assets/libs/prettify/prettify.js') }}"></script>

<script src="{{ URL::asset('assets/js/init.js') }}"></script>
<!-- Page Specific JS Libraries -->
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="{{ URL::asset('assets/libs/jquery-gmap3/gmap3.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/google-maps.js') }}"></script>

<script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap-inputmask/inputmask.js') }}"></script>
<script src="{{ URL::asset('assets/libs/summernote/summernote.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/forms.js') }}"></script>

<!--Add the notification update script-->
<script>
    $(document).ready(function(){

        //enable the tool tips
        /*$( function() {
            $( document ).tooltip({
                track: true
            });
        });*/

        //default left menu hide
        $(".button-menu-mobile").click();

        //add datepicker calender
        $( "#active_from" ).datepicker();
        $( "#active_to" ).datepicker();

        //add datepicker to settings price list pages
        $( "#valid_from" ).datepicker({
            dateFormat: "yy-mm-dd",
            timeFormat:  "hh:mm:ss"
        });
        $( "#valid_to" ).datepicker({
            dateFormat: "yy-mm-dd",
            timeFormat:  "hh:mm:ss"
        });

       
    });
</script>