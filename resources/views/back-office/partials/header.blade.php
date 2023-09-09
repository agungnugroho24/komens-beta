	<link rel="icon" href="{{CSIRTHelper::csirt_asset('img/logo_bappenas.png')}}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{CSIRTHelper::csirt_asset('assets/back-office/assets/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{CSIRTHelper::csirt_asset("assets/back-office/assets/css/fonts.min.css")}}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{CSIRTHelper::csirt_asset('assets/back-office/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{CSIRTHelper::csirt_asset('assets/back-office/assets/css/atlantis.min.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{CSIRTHelper::csirt_asset('assets/back-office/assets/css/demo.css')}}">

	<!-- Datepicker Css -->
	<link href="{{CSIRTHelper::csirt_asset('assets/general/bootstrap-datepicker/css/bootstrap-datepicker3.standalone.min.css')}}" rel="stylesheet">

	<!-- Datatables Css -->
	<link href="{{CSIRTHelper::csirt_asset('assets/general/datatables/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">