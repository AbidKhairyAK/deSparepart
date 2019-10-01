<!-- JQuery -->
<script src="/sb-admin/vendor/jquery/jquery.min.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- JQuery Easing-->
<script src="/sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
<!-- Chartjs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
<!-- Custom scripts for all pages-->
<script src="/sb-admin/js/sb-admin-2.min.js"></script>
<script type="text/javascript">
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
