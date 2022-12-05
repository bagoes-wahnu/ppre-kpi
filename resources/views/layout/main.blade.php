<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../">
		<title>PPRE - KPI</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		{{-- <link rel="shortcut icon" href="assets/media/logos/favicon.ico" /> --}}
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		{{--<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->--}}
        @include('layout.css')
        <script>
            var baseUrl = "{{url('/')}}/";
            var urlApi = "{{url('/api')}}/";
        </script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				<div id="kt_aside" class="aside aside-light aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
					<!--begin::Brand-->
					<div class="aside-logo flex-column-auto" id="kt_aside_logo">
						<!--begin::Logo-->
						<a href="../../demo1/dist/index.html">
							<img alt="Logo" src="{{asset('assets/media/logos/Group-4-1.png')}}" class="h-45px logo" />
						</a>
						<!--end::Logo-->
						<!--begin::Aside toggler-->
						<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
							<span class="svg-icon svg-icon-1 rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
									<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Aside toggler-->
					</div>
					<!--end::Brand-->
					<!--begin::Aside menu-->
					<div class="aside-menu flex-column-fluid">
						<!--begin::Aside Menu-->
						<div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
							<!--begin::Menu-->
							<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
								<div class="menu-item">
									<a class="menu-link" href="{{url('dashboard')}}">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path opacity="0.3" d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z" fill="#B5B5C3"/>
												<path d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="#B5B5C3"/>
												</svg>

											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Dashboard</span>
									</a>
								</div>
								<div class="menu-item">
									<a id="nav-realisasi" class="menu-link" href="{{url('realisasi-kpi')}}">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2.56068 10.6818L4.682 8.56043C5.26778 7.97465 6.21753 7.97465 6.80332 8.56043L8.92464 10.6818C9.51043 11.2675 9.51043 12.2173 8.92464 12.8031L6.80332 14.9244C6.21753 15.5102 5.26778 15.5102 4.682 14.9244L2.56068 12.8031C1.97489 12.2173 1.97489 11.2675 2.56068 10.6818ZM14.5607 10.6818L16.682 8.56043C17.2678 7.97465 18.2175 7.97465 18.8033 8.56043L20.9246 10.6818C21.5104 11.2675 21.5104 12.2173 20.9246 12.8031L18.8033 14.9244C18.2175 15.5102 17.2678 15.5102 16.682 14.9244L14.5607 12.8031C13.9749 12.2173 13.9749 11.2675 14.5607 10.6818Z" fill="#B5B5C3"/>
												<path fill-rule="evenodd" clip-rule="evenodd" d="M8.56068 16.6818L10.682 14.5604C11.2678 13.9746 12.2175 13.9746 12.8033 14.5604L14.9246 16.6818C15.5104 17.2675 15.5104 18.2173 14.9246 18.8031L12.8033 20.9244C12.2175 21.5102 11.2678 21.5102 10.682 20.9244L8.56068 18.8031C7.97489 18.2173 7.97489 17.2675 8.56068 16.6818ZM8.56068 4.68175L10.682 2.56043C11.2678 1.97465 12.2175 1.97465 12.8033 2.56043L14.9246 4.68175C15.5104 5.26754 15.5104 6.21729 14.9246 6.80307L12.8033 8.9244C12.2175 9.51018 11.2678 9.51018 10.682 8.9244L8.56068 6.80307C7.97489 6.21729 7.97489 5.26754 8.56068 4.68175Z" fill="#B5B5C3"/>
												</svg>

											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Realisasi KPI</span>
									</a>
								</div>
								<div class="menu-item">
									<div class="menu-content pb-2">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Master</span>
									</div>
								</div>
								<div class="menu-item">
									<a id="nav-master-data" class="menu-link" href="{{url('master/data')}}">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black" />
													<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Master Data</span>
									</a>
								</div>
								<div class="menu-item">
									<a class="menu-link" href="{{url('master/user')}}">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path opacity="0.3" d="M12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7C16 9.20914 14.2091 11 12 11Z" fill="#2664A2"/>
												<path d="M3.00065 20.1992C3.38826 15.4265 7.26191 13 11.9833 13C16.7712 13 20.7049 15.2932 20.9979 20.2C21.0096 20.3955 20.9979 21 20.2467 21C16.5411 21 11.0347 21 3.7275 21C3.47671 21 2.97954 20.4592 3.00065 20.1992Z" fill="#2664A2"/>
												</svg>

											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">User</span>
									</a>
								</div>
								<div class="menu-item">
									<a id="nav-setting-nilai" class="menu-link" href="{{url('master/setting-nilai-parameter')}}">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path opacity="0.3" d="M18.6225 9.75H18.75C19.9926 9.75 21 10.7574 21 12C21 13.2426 19.9926 14.25 18.75 14.25L18.6855 14.25C18.4912 14.2508 18.3159 14.3669 18.2394 14.5454C18.1557 14.7351 18.1943 14.9481 18.3278 15.0847L18.3725 15.1294C18.795 15.5514 19.0324 16.1241 19.0324 16.7213C19.0324 17.3184 18.795 17.8911 18.3731 18.3125C17.9511 18.735 17.3784 18.9724 16.7812 18.9724C16.1841 18.9724 15.6114 18.735 15.1897 18.3128L15.1506 18.2736C15.0081 18.1343 14.7951 18.0957 14.6054 18.1794C14.4269 18.2559 14.3108 18.4312 14.31 18.6225V18.75C14.31 19.9926 13.3026 21 12.06 21C10.8174 21 9.81 19.9926 9.81 18.75C9.80552 18.4999 9.67899 18.323 9.44718 18.2361C9.26485 18.1557 9.05191 18.1943 8.91533 18.3278L8.87062 18.3725C8.4486 18.795 7.87592 19.0324 7.27875 19.0324C6.68158 19.0324 6.1089 18.795 5.68747 18.3731C5.26497 17.9511 5.02757 17.3784 5.02757 16.7812C5.02757 16.1841 5.26497 15.6114 5.68717 15.1897L5.72635 15.1506C5.86571 15.0081 5.90432 14.7951 5.82065 14.6054C5.7441 14.4269 5.56881 14.3108 5.3775 14.31H5.25C4.00736 14.31 3 13.3026 3 12.06C3 10.8174 4.00736 9.81 5.25 9.81C5.50008 9.80552 5.677 9.67899 5.76385 9.44718C5.84432 9.26485 5.80571 9.05191 5.67217 8.91533L5.62746 8.87062C5.20497 8.4486 4.96757 7.87592 4.96757 7.27875C4.96757 6.68158 5.20497 6.1089 5.62687 5.68747C6.0489 5.26497 6.62158 5.02757 7.21875 5.02757C7.81592 5.02757 8.3886 5.26497 8.81033 5.68717L8.84945 5.72635C8.99191 5.86571 9.20485 5.90432 9.38718 5.82385L9.49485 5.80115C9.65041 5.71689 9.74929 5.55401 9.75 5.3775V5.25C9.75 4.00736 10.7574 3 12 3C13.2426 3 14.25 4.00736 14.25 5.25L14.25 5.31451C14.2508 5.50881 14.3669 5.6841 14.5528 5.76385C14.7351 5.84432 14.9481 5.80571 15.0847 5.67217L15.1294 5.62746C15.5514 5.20497 16.1241 4.96757 16.7213 4.96757C17.3184 4.96757 17.8911 5.20497 18.3125 5.62687C18.735 6.0489 18.9724 6.62158 18.9724 7.21875C18.9724 7.81592 18.735 8.3886 18.3128 8.81033L18.2736 8.84945C18.1343 8.99191 18.0957 9.20485 18.1761 9.38718L18.1989 9.49485C18.2831 9.65041 18.446 9.74929 18.6225 9.75Z" fill="#B5B5C3"/>
												<path fill-rule="evenodd" clip-rule="evenodd" d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" fill="#B5B5C3"/>
												</svg>

											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Setting Nilai Parameter</span>
									</a>
								</div>
								<div class="menu-item">
									<a id="nav-setting-mapping" class="menu-link" href="{{url('master/setting-mapping-score')}}">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M12 4.25977C12.1489 4.25965 12.3 4.29291 12.4426 4.36325C12.6398 4.46058 12.7994 4.62021 12.8967 4.81742L14.9389 8.95535L19.5054 9.6189C20.0519 9.69832 20.4306 10.2058 20.3512 10.7523C20.3196 10.9699 20.2171 11.1711 20.0596 11.3246L16.7553 14.5455L17.5353 19.0935C17.6287 19.6379 17.2631 20.1548 16.7188 20.2482C16.502 20.2854 16.279 20.2501 16.0844 20.1477L12 18.0004V4.25977Z" fill="#B5B5C3"/>
												<path fill-rule="evenodd" clip-rule="evenodd" d="M12 4.25977V18.0004L7.91565 20.1477C7.42681 20.4047 6.82218 20.2168 6.56518 19.7279C6.46284 19.5333 6.42753 19.3103 6.4647 19.0935L7.24475 14.5455L3.94042 11.3246C3.54493 10.9391 3.53684 10.306 3.92234 9.91049C4.07585 9.75301 4.27699 9.65052 4.49463 9.6189L9.06111 8.95535L11.1033 4.81742C11.2774 4.4647 11.6316 4.26004 12 4.25977Z" fill="#B5B5C3"/>
												</svg>


											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Setting Mapping Skor</span>
									</a>
								</div>
								<div class="menu-item">
									<div class="menu-content pt-8 pb-0">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Setting</span>
									</div>
								</div>
								<div class="menu-item">
									<a id="nav-setting-kpi" class="menu-link" href="{{url('setting-kpi')}}">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M15.9497 3.80795L13.0246 6.73309C12.2436 7.51414 12.2436 8.78047 13.0246 9.56151L14.4388 10.9757C15.2199 11.7568 16.4862 11.7568 17.2672 10.9757L20.1924 8.05059C20.7341 10.0451 20.2296 12.256 18.6746 13.8111C16.8453 15.6403 14.1086 16.0159 11.884 14.9448L6.75735 20.0714C5.9763 20.8525 4.70997 20.8525 3.92893 20.0714C3.14788 19.2904 3.14788 18.024 3.92893 17.243L9.05556 12.1163C7.98446 9.89178 8.36004 7.15501 10.1893 5.32578C11.7443 3.77075 13.9552 3.26623 15.9497 3.80795Z" fill="#B5B5C3"/>
												<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M16.6569 5.92961L18.0711 7.34383C18.4616 7.73435 18.4616 8.36751 18.0711 8.75804L16.6914 10.1377C16.3009 10.5282 15.6677 10.5282 15.2772 10.1377L13.863 8.7235C13.4724 8.33298 13.4724 7.69981 13.863 7.30929L15.2426 5.92961C15.6332 5.53909 16.2663 5.53909 16.6569 5.92961Z" fill="black"/>
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Setting KPI <span id="alert-approve" class="badge badge-warning d-none ms-3"> - Approval</span></span>
									</a>
								</div>
								<div class="menu-item">
									<a id="nav-setting-rumus" class="menu-link" href="{{url('setting-rumus')}}">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M15.9497 3.80795L13.0246 6.73309C12.2436 7.51414 12.2436 8.78047 13.0246 9.56151L14.4388 10.9757C15.2199 11.7568 16.4862 11.7568 17.2672 10.9757L20.1924 8.05059C20.7341 10.0451 20.2296 12.256 18.6746 13.8111C16.8453 15.6403 14.1086 16.0159 11.884 14.9448L6.75735 20.0714C5.9763 20.8525 4.70997 20.8525 3.92893 20.0714C3.14788 19.2904 3.14788 18.024 3.92893 17.243L9.05556 12.1163C7.98446 9.89178 8.36004 7.15501 10.1893 5.32578C11.7443 3.77075 13.9552 3.26623 15.9497 3.80795Z" fill="#B5B5C3"/>
												<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M16.6569 5.92961L18.0711 7.34383C18.4616 7.73435 18.4616 8.36751 18.0711 8.75804L16.6914 10.1377C16.3009 10.5282 15.6677 10.5282 15.2772 10.1377L13.863 8.7235C13.4724 8.33298 13.4724 7.69981 13.863 7.30929L15.2426 5.92961C15.6332 5.53909 16.2663 5.53909 16.6569 5.92961Z" fill="black"/>
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Setting Rumus Kondisi</span>
									</a>
								</div>
								<div class="menu-item">
									<div class="menu-content pt-8 pb-0">
										<span class="menu-section text-muted text-uppercase fs-8 ls-1">Organisasi</span>
									</div>
								</div>
								<div class="menu-item">
									<a id="nav-struktur-organisasi" class="menu-link" href="{{url('struktur-organisasi')}}">
										<span class="menu-icon">
											<!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
											<span class="svg-icon svg-icon-2">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M6 7C7.10457 7 8 6.10457 8 5C8 3.89543 7.10457 3 6 3C4.89543 3 4 3.89543 4 5C4 6.10457 4.89543 7 6 7ZM6 9C3.79086 9 2 7.20914 2 5C2 2.79086 3.79086 1 6 1C8.20914 1 10 2.79086 10 5C10 7.20914 8.20914 9 6 9Z" fill="#B5B5C3"/>
												<path opacity="0.3" d="M7 11.4649V17C7 18.1046 7.89543 19 9 19H15V21H9C6.79086 21 5 19.2091 5 17V8V7H7V8C7 9.10457 7.89543 10 9 10H15V12H9C8.27143 12 7.58835 11.8052 7 11.4649Z" fill="#B5B5C3"/>
												<path d="M18 22C19.1046 22 20 21.1046 20 20C20 18.8954 19.1046 18 18 18C16.8954 18 16 18.8954 16 20C16 21.1046 16.8954 22 18 22ZM18 24C15.7909 24 14 22.2091 14 20C14 17.7909 15.7909 16 18 16C20.2091 16 22 17.7909 22 20C22 22.2091 20.2091 24 18 24Z" fill="#B5B5C3"/>
												<path d="M18 13C19.1046 13 20 12.1046 20 11C20 9.89543 19.1046 9 18 9C16.8954 9 16 9.89543 16 11C16 12.1046 16.8954 13 18 13ZM18 15C15.7909 15 14 13.2091 14 11C14 8.79086 15.7909 7 18 7C20.2091 7 22 8.79086 22 11C22 13.2091 20.2091 15 18 15Z" fill="#B5B5C3"/>
												</svg>
											</span>
											<!--end::Svg Icon-->
										</span>
										<span class="menu-title">Struktur Organisasi</span>
									</a>
								</div>
							</div>
							<!--end::Menu-->
						</div>
						<!--end::Aside Menu-->
					</div>
					<!--end::Aside menu-->
				</div>
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" style="" class="header align-items-stretch">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Aside mobile toggle-->
							<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
								<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
									<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
									<span class="svg-icon svg-icon-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</div>
							</div>
							<!--end::Aside mobile toggle-->
							<!--begin::Mobile logo-->
							<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
								<a href="../../demo1/dist/index.html" class="d-lg-none">
									{{-- <img alt="Logo" src="assets/media/logos/logo-2.svg" class="h-30px" /> --}}
								</a>
							</div>
							<!--end::Mobile logo-->
							<!--begin::Wrapper-->
							<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
								@include('layout.menu')
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->
                    @include('layout.js')
					@yield('content')
                    
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
				</svg>
			</span>
		</div>



		<div class="modal fade" id="kt_modal_new_address" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered mw-650px">
				<div class="modal-content">
					<form class="form" id="kt_modal_new_address_form">
						<div class="modal-header" id="kt_modal_new_address_header">
							<h2>Tambah Master Parameter</h2>
							<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
								<span class="svg-icon svg-icon-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
										<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
									</svg>
								</span>
							</div>
						</div>
						<div class="modal-body py-0">
							<div class="card card-xxl-stretch mb-5 mb-xl-8">
								<div class="card-body py-3">
									<p class="fs-2 fw-bolder py-7 text-center">Ubah Password
									<br /> <span class="text-gray-400 fs-5"> pastikan untuk selalu mengingat password terbaru anda</span>
									<br /> <span class="text-gray-400 fs-5"> terbaru anda</span></p>
									<div class="tab-content">
										<div class="col-md-12 fv-row">
											<label class="fs-5 fw-bold mt-5">Password saat ini</label>
											<input type="password" id="inp-eye1" class="form-control mb-10" name="row-name" placeholder="Masukkan password" value="" />
										</div>
										<div class="separator my-2"></div>
										<div class="col-md-12 fv-row">
											<label class="fs-5 fw-bold mt-5">Password Baru</label>
											<input type="password" id="inp-eye2" class="form-control" name="row-name" placeholder="Masukkan password baru" value="" />
										</div>
										<div class="col-md-12 fv-row">
											<label class="fs-5 fw-bold mt-5">Ulangi Password Baru</label>
											<input type="password" id="inp-eye3" class="form-control" name="row-name" placeholder="Ketik Ulang password baru" value="" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer flex-right">
							<button type="reset" id="kt_modal_new_address_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
							<button type="submit" id="kt_docs_sweetalert_add" class="btn btn-primary" onclick="simpanPass()">
								<span class="indicator-label">Simpan</span>
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>


		<div class="modal fade" id="modal_account" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered mw-450px">
				<div class="modal-content">
					<form class="form" id="kt_modal_new_address_form">
						
						<div class="modal-body py-0">
							<div class="card card-xxl-stretch mb-5 mb-xl-8">
								<div class="card-body py-3">
									<p class="fs-2 fw-bolder py-7 text-center">
										<span> Akun </span>
									<br /> <span class="text-gray-400 fs-5">Silahkan pilih akun dibawah ini</span>
									</p>
									<div class="tab-content">
										<div class="row" id="account-list">

											{{-- <div class="col-md-12 account-item pb-4 mb-3 mt-4 border border-left-0 border-right-0 border-top-0 border-dashed border-gray-300">
												<div class="row">
													<div class="col-md-9 row account_item_click mb-1" style="cursor: pointer;">
														<div class="col-md-4">
															<div class="symbol symbol-55px symbol-circle ">
																
																<div class="symbol symbol-40px symbol-lg-50px" style="width: 100%;">
																	<span class="fs-1 symbol-label font-weight-boldest bg-primary text-inverse-primary _initial_profile">-</span>
																</div>
															</div>
														</div>
														<div class="col-md-8">
															<span class="fw-bolder fs-6">Administrator</span> <br> <span class="fs-8 text-gray-400" >Username</span>
														</div>
													</div>
													
													<div class="col-md-3 text-center">
														<span class="badge badge-light-success me-auto mb-2">Aktif</span> <br> 
														<a href="javascript:;"><span class="fs-8 text-gray-400" >Keluar</span></a>
													</div>
												</div>
											</div>
 --}}

										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer flex-center">

							
							<button type="button" id="btn-add-account" class="btn btn-light-primary btn-sm" onclick="addAccount()">
								<span class="svg-icon svg-icon-primary svg-icon-1">
			                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
			                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"></path>
			                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"></rect>
			                    </svg>
			                </span>Tambah Akun Lainnya
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>



		<script>var hostUrl = "assets/";</script>
		<script>
            const rl_now=localStorage.getItem("ppre_roleID").toString();
            let rl_admin=({{env('ROLE_ADMIN')}}).toString();
            let rl_direksi=({{env('ROLE_DIREKSI')}}).toString();
            let rl_korporat=({{env('ROLE_KORPORAT')}}).toString();
            let rl_unit=({{env('ROLE_UNIT')}}).toString();

            if(rl_now==rl_direksi){
                $('#alert-approve').removeClass('d-none')         
            }

            if(rl_now==rl_korporat){
                $('#nav-setting-kpi').attr('href',baseUrl+'setting-kpi/korporat')
            }
			
            function simpanPass() {
                ewpLoadingShow();
                var data = {
                    current_password: $("#inp-eye1").val(),
                    new_password: $("#inp-eye2").val(),
                    new_password_confirmation: $("#inp-eye3").val(),
                };
                var tipe = "POST"
                var link = urlApi + "change-pass"
                $.ajax({
                    type: tipe,
                    dataType: "json",
                    data: data,
                    url: link,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Authorization":"Bearer " + localStorage.getItem("ppre_token")
                    },
                    success: function (response) {
                    ewpLoadingHide();
                    Swal.fire({
                        title: "Success!",
                        icon: "success",
                        text: "Password berhasil di ganti,silahkan login kembali.",
                        showCancelButton: false,
                        //confirmButtonColor: "#3085d6",
                        confirmButtonText: "Lanjutkan",

                    }).then((result) => {
                        if (result.value) {
                            logout()
                            window.location.href = baseUrl + "/";
                        }
                    });
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        ewpLoadingHide();
                        handleErrorDashboard(xhr);
                        
                    },
                });
            }

			function logout() {

				$.ajax({
					url:urlApi+'logout',
					type:'POST',
					beforeSend: function (xhr) {
						xhr.setRequestHeader("Authorization","Bearer " + localStorage.getItem("ppre_token"));
					},
					success:function(response){

						let saved_credentials = JSON.parse(localStorage.getItem("ppre_credential"))
						let id_user_logout = localStorage.getItem("ppre_userID")
						let new_credentials = []

						for(let scr in saved_credentials) {
							
							let s_cred = saved_credentials[scr]

							if (s_cred.ppre_userID != id_user_logout) {
								new_credentials.push(s_cred)
							}
						}

						const credentialSTRING = JSON.stringify(new_credentials);
        				localStorage.setItem("ppre_credential", credentialSTRING);

        				localStorage.setItem("ppre_token", "");
            			localStorage.setItem("ppre_userID", "");
            			localStorage.setItem("ppre_userName", "");
            			localStorage.setItem("ppre_roleID", "");
            			localStorage.setItem("ppre_roleName", "");

						window.location.href = baseUrl+'account-list';
					},
					error:function(msg, status, error){
                        let code= msg.responseJSON.status.code
                        if(code==401){
                            window.location.href=baseUrl+"/"
                        }
					}
				}); 
			}

			function logout_account(user_id) {

				Swal.fire({
			        title: 'Yakin untuk keluar akun ini?',
			        text: "",
			        icon: 'question',
			        showCancelButton: true,
			        confirmButtonColor: '#d14529',
			        confirmButtonText: 'Ya, Keluar',
			        cancelButtonText: 'Batal',
			    }).then((result) => {

			        if (result.isConfirmed) {  

			        	let credentials_list = JSON.parse(localStorage.getItem("ppre_credential"))

			        	for(let cl in credentials_list) {
							let cred = credentials_list[cl]
							if (cred.ppre_userID == user_id) {
								var token_to_logout = cred.ppre_token
							}
						}

			        	$.ajax({
							url:urlApi+'logout',
							type:'POST',
							beforeSend: function (xhr) {
								xhr.setRequestHeader("Authorization","Bearer " + token_to_logout);
							},
							success:function(response){

								let saved_credentials = JSON.parse(localStorage.getItem("ppre_credential"))
								let new_credentials = []

								for(let scr in saved_credentials) {
									let s_cred = saved_credentials[scr]
									if (s_cred.ppre_userID != user_id) {
										new_credentials.push(s_cred)
									}
								}

								const credentialSTRING = JSON.stringify(new_credentials);
		        				localStorage.setItem("ppre_credential", credentialSTRING);

		        				accountList()
							},
							error:function(msg, status, error){
								console.log(msg)
							}
						}); 
			        }
			    })
			}

			function addAccount() {
				window.location.href = baseUrl + "login" ;
			}

			function accountList() {
				let saved_credentials = JSON.parse(localStorage.getItem("ppre_credential"))

				$('#account-list').html('')

				for (sc in saved_credentials) {
					let scred = saved_credentials[sc]
					let index_item = sc

					$.ajax({
						url:urlApi+'check_token',
						type:'POST',
						beforeSend: function (xhr) {
							xhr.setRequestHeader("Authorization","Bearer " + scred.ppre_token);
						},
						success:function(response){
							var data_user = response.data.user

							if(data_user !== false) {

								var htmlStatus = `&nbsp; <br> <a href="javascript:;" onclick="logout_account(${data_user.id})"><span class="fs-8 text-gray-400" >Keluar</span></a>`
								var htmlSwitch = `onclick="switchAccount(${index_item})"`
								var cssItem = `style="cursor: pointer;"`
								if (scred.status == 1) {
									htmlStatus = `&nbsp; <br> <span class="badge badge-light-success me-auto mb-2">Aktif</span> <br>`
									htmlSwitch = ``
									cssItem = ``
								}
								
								$('#account-list').append(`
									<div class="col-md-12  account-item pb-3 mb-2 mt-3 border border-left-0 border-right-0 border-top-0 border-dashed border-gray-300">
												<div class="row">
													<div class="col-md-9 row account_item_click mb-1" ${htmlSwitch} ${cssItem}>
														<div class="col-md-4">
															<div class="symbol symbol-55px symbol-circle ">
																<div class="symbol symbol-40px symbol-lg-50px" style="width: 100%;">
																	<span class="fs-2 symbol-label bg-primary text-inverse-primary initial_profile_${index_item}">-</span>
																</div>
															</div>
														</div>
														<div class="col-md-8">
															<span class="fw-bolder fs-6">${data_user.name}</span> <br> <span class="fs-8 text-gray-400" >${data_user.username}</span>
														</div>
													</div>
													
													<div class="col-md-3 text-center">
														 ${htmlStatus}
													</div>
												</div>
											</div>
											`)

								// generate initial profile
								var splitName=data_user.name.split(" ")
					            let initials =""
					            if(splitName.length>1){
					                initials = splitName.shift().charAt(0) + splitName.pop().charAt(0);
					            }else{
					                initials = splitName.shift().charAt(0)
					            }
								$('.initial_profile_'+index_item).html(initials.toUpperCase())

							}

							// update jumlah akun
							let saved_credentials = JSON.parse(localStorage.getItem("ppre_credential"))
							if (saved_credentials !== null) {
								$('#jumlah-akun').html(saved_credentials.length)	
							} else{
								$('#jumlah-akun').html('0 ')
							}

						},
						error:function(response){
							console.log(response.responseJSON)
						}
					});
				}

				$('#profil-nama').html(localStorage.getItem("ppre_userName"))
				$('#profil-role').html(localStorage.getItem("ppre_roleName"))
			}

			function switchAccount(param) {

				let saved_credentials = JSON.parse(localStorage.getItem("ppre_credential"))

            	var newCredentialJSON = []

                for (c in saved_credentials) {

                    let cred = saved_credentials[c]

                    if (cred.status == 1) {
                        var new_cred = {
                            "ppre_token" : cred.ppre_token,
                            "ppre_userID" :  cred.ppre_userID,
                            "ppre_userName" : cred.ppre_userName,
                            "ppre_roleID" : cred.ppre_roleID,
                            "ppre_roleName" : cred.ppre_roleName,
                            "status" : 0
                        }
                    }
                    else{

                    	if (c == param) {
	                    	var new_cred = {
	                            "ppre_token" : cred.ppre_token,
	                            "ppre_userID" :  cred.ppre_userID,
	                            "ppre_userName" : cred.ppre_userName,
	                            "ppre_roleID" : cred.ppre_roleID,
	                            "ppre_roleName" : cred.ppre_roleName,
	                            "status" : 1
	                        }
	                    } 
	                    else{
	                    	var new_cred = cred
	                    }
                    }

                    newCredentialJSON.push(new_cred)
                }

                const credentialSTRING = JSON.stringify(newCredentialJSON);
            	localStorage.setItem("ppre_credential", credentialSTRING);

                localStorage.setItem("ppre_token", saved_credentials[param].ppre_token);
            	localStorage.setItem("ppre_userID", saved_credentials[param].ppre_userID);
            	localStorage.setItem("ppre_userName", saved_credentials[param].ppre_userName);
            	localStorage.setItem("ppre_roleID", saved_credentials[param].ppre_roleID);
            	localStorage.setItem("ppre_roleName", saved_credentials[param].ppre_roleName);

            	window.location.href = baseUrl+'dashboard';
			}

            function approvalCheck(){
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        Authorization: "Bearer " + localStorage.getItem("ppre_token"),
                    },
                    url: urlApi + "navigation-drawer",
                    success: function (response) {
                        let res=response.data.navigation_drawer
                        if(res.setting_kpi!==null){
                            $('#alert-approve').html(noNull(res.setting_kpi)+' Approval')
                        }else{
                            $('#alert-approve').addClass('d-none')
                        }
                        
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        ewpLoadingHide();
                        handleErrorDetail(xhr);
                    },
                });
            }

			$(document).ready(function() {

				accountList()
                approvalCheck()
				let saved_credentials = JSON.parse(localStorage.getItem("ppre_credential"))

				if (saved_credentials !== null) {
					$('#jumlah-akun').html(saved_credentials.length)	
				} else{
					$('#jumlah-akun').html('0 ')
				}

			});





		</script>
		{{--<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
		<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
		<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{asset('assets/js/custom/modals/upgrade-plan.js')}}"></script>
		<script src="{{asset('assets/js/custom/modals/create-app.js')}}"></script>
		<script src="{{asset('assets/js/custom/modals/users-search.js')}}"></script>
		<!--end::Page Custom Javascript-->

		<script src="{{asset('assets/js/custom/documentation/general/datatables/advanced.js')}}"></script>

		<!--end::Javascript-->--}}
		{{-- @yield('js') --}}
	</body>
	<!--end::Body-->
</html>