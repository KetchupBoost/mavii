<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/img/favicon.ico') }}">
	<title>{{ config('app.name', 'Mavii') }} - Painel Administrador | {{ @$title }}</title>
	<!-- Scripts -->
  <script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!},
        currentUserId = {!! Auth::id() !!};
  </script>
	<!-- Custom CSS -->
	<link href="{{ asset('public/css/dashboard/styles.css') }}" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<header class="topbar" data-navbarbg="skin6">
			<nav class="navbar top-navbar navbar-expand-md">
				<div class="navbar-header" data-logobg="skin6">
					<!-- This is for the sidebar toggle which is visible on mobile only -->
					<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti ti-menu ti-close"></i></a>
					<!-- ============================================================== -->
					<!-- Logo -->
					<!-- ============================================================== -->
					<div class="navbar-brand">
						<!-- Logo icon -->
						<a href="{{ route('admin.home') }}" class="pt-4">
							<img src="{{ asset('public/img/brand.png') }}" alt="homepage" class="img-fluid">
						</a>
					</div>
					<!-- ============================================================== -->
					<!-- End Logo -->
					<!-- ============================================================== -->
					<!-- ============================================================== -->
					<!-- Toggle which is visible on mobile only -->
					<!-- ============================================================== -->
					<a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti ti-more"></i></a>
				</div>
				<!-- ============================================================== -->
				<!-- End Logo -->
				<!-- ============================================================== -->
				<div class="navbar-collapse collapse" id="navbarSupportedContent">
					<!-- ============================================================== -->
					<!-- toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav float-left mr-auto ml-3 pl-1">
						<!-- Notification -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)" id="bell" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span><i data-feather="bell" class="svg-icon"></i></span>
								<span class="badge badge-primary notify-no rounded-circle">0</span>
							</a>
							<div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
								<ul class="list-style-none">
									<li>
										<div class="message-center notifications position-relative">
											<!-- Message -->
											<a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
												<div class="btn btn-danger rounded-circle btn-circle"><i data-feather="airplay" class="text-white"></i></div>
												<div class="w-75 d-inline-block v-middle pl-2">
													<h6 class="message-title mb-0 mt-1">Luanch Admin</h6>
													<span class="font-12 text-nowrap d-block text-muted">Just see
														the my new
														admin!
													</span>
													<span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
												</div>
											</a>
										</div>
									</li>
									<li>
										<a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);">
											<strong>Check all notifications</strong>
											<i class="fa fa-angle-right"></i>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<!-- ============================================================== -->
						<!-- End Notification -->
						<!-- ============================================================== -->
					</ul>
					<!-- ============================================================== -->
					<!-- Right side toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav float-right">
						@if(Route::has('admin.'.request()->segment(2).'.index'))
							<!-- ============================================================== -->
							<!-- Search -->
							<!-- ============================================================== -->
							<li class="nav-item d-none d-md-block">
								<a class="nav-link" href="javascript:void(0)">
									<form action="{{ route('admin.'.request()->segment(2).'.index') }}" method="get">
										<div class="customize-input">
											<input class="form-control custom-shadow custom-radius border-0 bg-white" type="search" name="keyword" value="{{ request()->get('keyword') }}" placeholder="Search" aria-label="Search">
											<i class="form-control-icon" data-feather="search"></i>
										</div>
									</form>
								</a>
							</li>
						@endif
						<!-- ============================================================== -->
						<!-- User profile and search -->
						<!-- ============================================================== -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="{{ !Auth::user()->avatar ? 'https://ui-avatars.com/api/?name='.Auth::user()->name.'&background=555&color=fff' : Storage::url(Auth::user()->avatar) }}" alt="user" class="rounded-circle" width="40">
								<span class="ml-2 d-none d-lg-inline-block"><span>Olá,</span> <span class="text-dark">{{ Auth::user()->name }}</span> <i data-feather="chevron-down" class="svg-icon"></i></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
								<a class="dropdown-item" href="{{ route('admin.users.edit', Auth::id()) }}"><i data-feather="user" class="svg-icon mr-2 ml-1"></i> Editar Conta</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="javascript:void(0)"
									onclick="event.preventDefault();
	                         document.getElementById('logout-form').submit();">
	                         <i data-feather="power" class="svg-icon mr-2 ml-1"></i> Logout
	              </a>
	              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			            @csrf
			          </form>
							</div>
						</li>
						<!-- ============================================================== -->
						<!-- User profile and search -->
						<!-- ============================================================== -->
					</ul>
				</div>
			</nav>
		</header>
		<!-- ============================================================== -->
		<!-- End Topbar header -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<aside class="left-sidebar" data-sidebarbg="skin6">
			<!-- Sidebar scroll-->
			<div class="scroll-sidebar" data-sidebarbg="skin6">
				<!-- Sidebar navigation-->
				<nav class="sidebar-nav">
					<ul id="sidebarnav">
						@include('shared.sidebar_dashboard')
					</ul>
				</nav>
				<!-- End Sidebar navigation -->
			</div>
			<!-- End Sidebar scroll-->
		</aside>
		<!-- ============================================================== -->
		<!-- End Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper  -->
		<!-- ============================================================== -->
		<div class="page-wrapper">
			@yield('content')
			
			<!-- ============================================================== -->
			<!-- footer -->
			<!-- ============================================================== -->
			<footer class="footer text-center text-muted">
				Todos os direitos reservados por {{ config('app.name', 'Mavii') }}. Desenvolvido por 
				<a href="https://saikoosistemas.com.br">Saikoo Sistemas</a>.
			</footer>
			<!-- ============================================================== -->
			<!-- End footer -->
			<!-- ============================================================== -->
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->
	<!-- All Jquery -->
	<!-- ============================================================== -->
	<script src="{{ asset('public/js/dashboard/scripts.js') }}"></script>
	<!-- apps -->
	<!-- apps -->
	@include('shared.modal_dashboard')
</body>
</html>