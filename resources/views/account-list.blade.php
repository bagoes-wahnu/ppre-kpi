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
		</style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<div class="mb-5"></div>
		<div class="row mt-5">
			<div class="col-md-12 text-center">
                <img src="{{asset('assets/img/presisi-logo.png')}}" width="13%" />
            </div>

            <div class="col-md-12 text-center">
                <h1> PRESISI OPERATIONAL MONITORING SYSTEM </h1>
            </div>

            <div class="col-md-12 text-center mb-10">
                <h4> Evaluasi Keberhasilan Perfoma Kerja Pada PT. PP Presisi Tbk (PPRE)</h4>
            </div>

            <div class="col-md-12 text-center mt-10 mb-4">
            	<h5>Silahkan Pilih Akun</h5>
            </div>

            <div class="col-md-12  mt-5">
            	<div class="row" id="account-list">

            		<!-- <div class="col-md-4"></div>
            		<div class="col-md-4 account-item" style="padding-left: 50px; padding-right: 50px;">
						<div class="row pb-3 mb-2 mt-3 border border-left-0 border-right-0 border-top-0 border-dashed border-gray-300" style="cursor: pointer;">
							<div class="col-md-9 row account_item_click mb-1">
								<div class="col-md-3">
									<div class="symbol symbol-40px symbol-circle ">
										<div class="symbol symbol-35px symbol-lg-45px" style="width: 100%;">
											<span class="fs-2 symbol-label bg-primary text-inverse-primary initial_profile_${index_item}">-</span>
										</div>
									</div>
								</div>
								<div class="col-md-9">
									<span class="fw-bolder fs-6">Administrator</span> <br> <span class="fs-8 text-gray-400" >Username</span>
								</div>
							</div>
							<div class="col-md-3"></div>
						</div>
					</div>
					<div class="col-md-4"></div> -->

            	</div>
            </div>

		</div>


		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
		<script>
            baseUrl="{{url('/')}}/"
            urlApi="{{url('/api')}}/"
        </script>
		<!-- <script src="{{ asset('assets/js/menu/login.js')}}"></script> -->


		<script>
			
			$(document).ready(function() {
				accountList()
			});	


			function accountList() {
				let saved_credentials = JSON.parse(localStorage.getItem("ppre_credential"))

				$('#account-list').html('')

                if(saved_credentials.length>0){
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
                                // console.log(response)

                                if(data_user !== false) {
                                    var htmlSwitch = `onclick="switchAccount(${index_item})"`
                                    if (scred.status == 1) {
                                        htmlSwitch = `onclick="toDashboard()"`
                                    }
                                    
                                    $('#account-list').append(`
                                        <div class="col-md-4"></div>
                                            <div class="col-md-4 account-item" style="padding-left: 50px; padding-right: 50px;">
                                                <div class="row pb-3 mb-2 mt-3 border border-left-0 border-right-0 border-top-0 border-dashed border-gray-300" style="cursor: pointer;" ${htmlSwitch}>
                                                    <div class="col-md-9 row account_item_click mb-1">
                                                        <div class="col-md-3">
                                                            <div class="symbol symbol-40px symbol-circle ">
                                                                <div class="symbol symbol-35px symbol-lg-45px" style="width: 100%;">
                                                                    <span class="fs-2 symbol-label bg-primary text-inverse-primary initial_profile_${index_item}">-</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <span class="fw-bolder fs-6">  ${data_user.name} </span> <br> 
                                                            <span class="fs-8 text-gray-400" > ${data_user.username}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                    `)


                                    var splitName=data_user.name.split(" ")

                                    let initials =""
                                    if(splitName.length>1){
                                        initials = splitName.shift().charAt(0) + splitName.pop().charAt(0);
                                    }else{
                                        initials = splitName.shift().charAt(0)
                                    }
                                    $('.initial_profile_'+index_item).html(initials.toUpperCase())

                                }

                            },
                            error:function(response){
                                console.log(response.responseJSON)
                            }
                        });
                    }
                }else{
                    window.location.href=baseUrl+""
                }
				
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

			function toDashboard() {
				window.location.href = baseUrl+'dashboard';
			}

		</script>


	</body>
	<!--end::Body-->
</html>