<!-- begin::User Panel-->
		<?php include("user_panel.php"); ?>
		<!-- end::User Panel-->


		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                Hello <strong><?php echo ucwords($name).' </strong>'. $signOutQuip; ?>
            </div>
            <div class="modal-footer">
            	<a href="logout" class="btn btn-light-danger btn-small btn-icon-alt font-weight-bold"><?php echo $signOutBtn; ?>  <i class="fas fa-sign-out-alt"></i></a>
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal"><?php echo $cancelBtn; ?></button>
                
            </div>
        </div>
    </div>
</div>



		
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="../assets/plugins.bundle.js?v=7.2.8"></script>
		<script src="../assets/prismjs/prismjs.bundle.js?v=7.2.8"></script>
		<script src="../assets/js/scripts.bundle.js?v=7.2.8"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="../assets/plugins/fullcalendar.bundle.js?v=7.2.8"></script>
		<!--<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM"></script>-->
		<script src="../assets/js/datatables.bundle.js?v=7.2.8"></script>
		<!--<script src="../assets/js/basic.js?v=7.2.8"></script>-->
		<script src="../assets/js/gmaps.js?v=7.2.8"></script>
		<!--end::Page Vendors-->
		<script src="../assets/js/summernote.js"></script>
		<script src="../assets/js/image-input.js"></script>
		<!--begin::Page Scripts(used by this page)-->
		<script src="../assets/js/widgets.js?v=7.2.8"></script>
		<script src="../assets/js/addAdmin.js"></script>
		<!--end::Page Scripts-->
		<script src="../assets/js/script.js"></script>
		<script type="text/javascript" src="../assets/js/custom.js"></script> 
		<script>

$(document).ready( function () {
    $('.table').DataTable({
      lengthMenu: [20, 30, 40, 50, 100],
			pageLength: 20,
			"scrollY": 440,
            "scrollX": true

    });
} );

</script>
	</body>
	<!--end::Body-->
</html>