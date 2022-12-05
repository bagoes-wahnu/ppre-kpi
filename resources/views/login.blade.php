<!DOCTYPE html>
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
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->

		<style>
			.btn-primary{
				background-color: #2664A2 !important;
			}
            @media only screen and (max-width: 1000px) {
                .img-left {
                    display: none;
                }
            }
            @media only screen and (max-width: 700px) {
                .login-wrapper {
                    width: 80vw;
                    padding: 0.5rem;
                }
                .form-wrapper{
                    margin-top: 4rem;
                }
            }
            
		</style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-lg-row-auto w-xl-550px positon-xl-relative">

					<div class="d-flex flex-column flex-lg-row-auto w-xl-550px">
						<img class="img-left" src="{{asset('assets/img/login-left.png')}}" alt="" style="max-height: 100vh;">
					</div>
					
					{{-- <!--begin::Wrapper-->
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-800px">
						<!--begin::Content-->
						<div class="d-flex flex-row-fluid flex-column p-10 pt-lg-5" style="padding-left: 9em !important; padding-right: 0em !important;">
							<!--begin::Logo-->
                            <div class="row">
                                <div class="col-md-12 mt-16 mb-6">
	                                <a href="javascript:;"  class="py-9 mb-1">
	                                    <img alt="Logo" src="{{asset('assets/img/kpi-logo.svg')}}"   class="h-50px" />
	                                </a>
	                                <a href="javascript:;"  class="py-9 mb-1 mx-9">
	                                    <img alt="Logo" src="{{asset('assets/img/presisi-logo.svg')}}"  class="h-50px" />
	                                </a>
	                            </div>
                            </div>
							<!--end::Logo-->

							<!--begin::Description-->
                            <div class="row">
                                <div class="col-md-12 mb-10">
                                    <span class="d-block" style="font-weight: 700 !important; font-size: 24px;">PT. PP Presisisi Tbk - Key Performance Indicator</span>
                                    <span class="text-muted" style="font-weight: 400 !important; font-size: 16px;">Evaluasi keberhasilan perfoma kerja pada PT. PP Presisi Tbk (PPRE)</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <img src="{{asset('assets/img/kpi-login.svg')}}" width="50%"/>
                                </div>
                            </div>
							<!--end::Description-->
						</div>
						<!--end::Content-->
						<!--begin::Illustration-->
						<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(assets/media/illustrations/sketchy-1/13.png"></div>
						<!--end::Illustration-->
					</div>
					<!--end::Wrapper--> --}}


				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid ">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid form-wrapper">

						<div class="row mb-4">
                                <div class="col-md-12 text-center">
                                    <img src="{{asset('assets/img/ppre-logo.png')}}" width="30%"/>
                                </div>
                            </div>

						<!--begin::Wrapper-->
						<div class="w-lg-450px px-lg-15 py-lg-5 w-md-550px p-md-6 w-sm-550px p-sm-4 rounded shadow-sm mx-auto login-wrapper">
							<!--begin::Form-->
							<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#">
								<!--begin::Heading-->
								<div class="text-center mb-4">
									<!--begin::Title-->
									<h1 class="text-dark mb-3 fw-bolder">Silahkan Masuk</h1>
									<!--end::Title-->
									<!--begin::Link-->
									<div class="text-gray-400 fw-bold fs-4">PT. PP Presisi Tbk (PPRE)</div>
									<!--end::Link-->
								</div>
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="fv-row mb-5">
									<!--begin::Label-->
									<label class="form-label fs-6 fw-bolder text-dark">Username</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid input-login" type="text" name="email" id="xa-username" autocomplete="off" placeholder="Masukkan username"/>
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-5">
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack mb-2">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6 mb-0" >Password</label>
										<!--end::Label-->
										<!--begin::Link-->
										<!-- <a href="../../demo5/dist/authentication/flows/aside/password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a> -->
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid input-login" type="password" name="password" id="xa-password" autocomplete="off" placeholder="Masukkan password"/>
									<!--end::Input-->
								</div>

								<div class="fv-row mb-10 fv-plugins-icon-container">
									<label class="form-check form-check-custom form-check-solid mb-5">
										<input onchange="showPassword()" class="form-check-input" type="checkbox" name="toc" value="">
										<span class="form-check-label fw-bold text-primary">Tampilkan Password</span>
									</label>
								<div class="fv-plugins-message-container"></div></div>

								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center d-grid gap-2">
									<!--begin::Submit button-->
									<button type="button" id="btn-simpan" class="btn  btn-lg btn-primary mb-5 " onclick="login()">
										<span class="indicator-label">Masuk</span>
										<span class="indicator-progress">Mohon tunggu...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
									<!--end::Submit button-->
								</div>
								<!--end::Actions-->

							</form>
							<!--end::Form-->
						</div> 
						<!--end::Wrapper-->

						{{-- <button class="btn btn-success btn-sm" onclick="test()" >test</button> --}}
					</div>
					<!--end::Content-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Main-->


		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
		<script>
            baseUrl="{{url('/')}}/"
            urlApi="{{url('/api')}}/"
        </script>
		<script src="{{ asset('assets/js/menu/login.js')}}"></script>
	</body>
	<!--end::Body-->
</html>