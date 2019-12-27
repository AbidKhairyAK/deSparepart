<!-- Laravel Main JS -->
<script src="/js/app.js"></script>
<!-- JQuery -->
<!-- <script src="/sb-admin/vendor/jquery/jquery.min.js"></script> -->
<!-- Bootstrap core JavaScript-->
<!-- <script src="/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- JQuery Easing-->
<!-- <script src="/sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script> -->
<!-- datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
<!-- Chartjs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<!-- select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="/sb-admin/js/sb-admin-2.min.js"></script>
<script type="text/javascript">
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });

	function dropdown() {
		 // however much room you determine you need to prevent jumping
        var requireHeight = 600;
        var viewportBottom = $(window).scrollTop() + $(window).height();

        // figure out if we need to make changes
        if (viewportBottom < requireHeight) 
        {           
            // determine how much padding we should add (via marginBottom)
            var marginBottom = requireHeight - viewportBottom;

            // adding padding so we can scroll down
            $(".aLwrElmntOrCntntWrppr").css("marginBottom", marginBottom + "px");

            // animate to just above the select2, now with plenty of room below
            $('html, body').animate({
                scrollTop: $("#mySelect2").offset().top - 10
            }, 1000);
        }
	}
</script>
