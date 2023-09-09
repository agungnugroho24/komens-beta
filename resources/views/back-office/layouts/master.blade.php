<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Back Office &mdash; @yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	
	@include('back-office.partials.header')
	@stack('app-styles')
</head>
 
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<x-logo-header-back-office/>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<x-navbar-back-office/>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<x-sidebar-back-office/>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<!-- Panel Header -->
				@yield('panel-header')
				<!-- End Panel Header -->
				@yield('content')
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<div class="copyright ml-auto text-primary">
						Copyright &copy; <?php echo date('Y'); ?> &mdash; Website CSIRT Kementerian PPN/Bappenas v.1.0
					</div>				
				</div>
			</footer>
		</div>

	@include('sweetalert::alert')
	</div>
	@include('back-office.partials.footer')
	

	@stack('app-script')
</body>
</html>