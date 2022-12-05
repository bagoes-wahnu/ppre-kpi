<!--begin::Navbar-->
<div class="d-flex align-items-stretch" id="kt_header_nav">
    <!--begin::Menu wrapper-->
    <div class="header-menu align-items-stretch bg-primary" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
        <!--begin::Menu-->
        <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
            <div class="menu-item p-2 me-10">
                <img src="{{asset('assets/extends/img/logo.png')}}"/>
            </div>
            <div class="menu-item me-lg-1">
                <a class="menu-link py-3" href="{{url('/user')}}">
                    <span class="menu-title text-white">Dashboard-user</span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                <a href="{{route('user.ticket.index')}}">
                    <span class="menu-link py-3">
                        <span class="menu-title text-white">Ticket</span>
                    </span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                <a href="{{route('user.invoice.index')}}">
                    <span class="menu-link py-3">
                        <span class="menu-title text-white">Invoice</span>
                    </span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                <a href="{{route('user.news.index')}}">
                    <span class="menu-link py-3">
                        <span class="menu-title text-white">News</span>
                    </span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                <a href="{{route('user.promo.index')}}">
                    <span class="menu-link py-3">
                        <span class="menu-title text-white">Promo</span>
                    </span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                <a href="{{route('user.contact.index')}}">
                    <span class="menu-link py-3">
                        <span class="menu-title text-white">Contact</span>
                    </span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                <a href="{{route('user.critics.index')}}">
                    <span class="menu-link py-3">
                        <span class="menu-title text-white">Criticism and Suggestions</span>
                    </span>
                </a>
            </div>
            <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion me-lg-1">
                <a href="{{route('user.survey.index')}}">
                    <span class="menu-link py-3">
                        <span class="menu-title text-white">Survey</span>
                    </span>
                </a>
            </div>
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::Navbar-->
<!--begin::Topbar-->
<div class="d-flex align-items-stretch flex-shrink-0">
    <!--begin::Toolbar wrapper-->
    <div class="d-flex align-items-stretch flex-shrink-0">
        <!--begin::Notifications-->
        <div class="d-flex align-items-center ms-1 ms-lg-3">
            <div class="w-30px h-30px w-md-40px h-md-40px pt-4 me-3" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" style="cursor:pointer">
                <div class="d-flex align-items-center ms-1 ms-lg-3">
                    <span class="bullet bullet-dot bg-danger h-6px w-6px position-relative translate-middle animation-blink" style="top:-15px;left: 64%;"></span>
                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                    <span class="svg-icon svg-icon-light svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <path d="M17,12 L18.5,12 C19.3284271,12 20,12.6715729 20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 C4,12.6715729 4.67157288,12 5.5,12 L7,12 L7.5582739,6.97553494 C7.80974924,4.71225688 9.72279394,3 12,3 C14.2772061,3 16.1902508,4.71225688 16.4417261,6.97553494 L17,12 Z" fill="#000000"/>
                                <rect fill="#000000" opacity="0.3" x="10" y="16" width="4" height="4" rx="2"/>
                            </g>
                        </svg><!--end::Svg Icon-->
                    </span>
                </div>
            </div>
            <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
                <!--begin::Heading-->
                <div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url('{{asset('assets/media/misc/pattern-1.jpg')}}')">
                    <!--begin::Title-->
                    <h3 class="text-white fw-bold px-9 mt-10 mb-6">Notifikasi
                    <span class="fs-8 opacity-75 ps-3">5 notifikasi baru</span></h3>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab panel-->
                    <div class="tab-pane fade show active" id="kt_topbar_notifications_1" role="tabpanel">
                        <!--begin::Items-->
                        <div class="scroll-y mh-325px my-5 px-8">
                            <!--begin::Item-->
                            <div class="d-flex flex-stack py-4">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-35px me-4">
                                        <span class="symbol-label bg-light-warning">
                                            <!--begin::Icon-->
                                            <span class="svg-icon svg-icon-warning">
                                                <i class="bi bi-chat-square-text-fill text-primary fs-1 text-warning"></i>
                                            </span>
                                            <!--end::Icon-->
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div class="mb-0 me-2">
                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">Pembayaran untuk tagihan Tenant yang sudah jatuh tempo</a>
                                        <div class="text-gray-400 fs-7">
                                        <span class="bullet bullet-dot bg-warning h-8px w-8px me-1"></span>
                                            27 April 2021 9.41 WIB
                                        </div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack py-4">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-35px me-4">
                                        <span class="symbol-label bg-light-warning">
                                            <!--begin::Icon-->
                                            <span class="svg-icon svg-icon-warning">
                                                <i class="bi bi-chat-square-text-fill text-primary fs-1 text-warning"></i>
                                            </span>
                                            <!--end::Icon-->
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div class="mb-0 me-2">
                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">Administrator membalas keluhan ticket ID 976786944</a>
                                        <div class="text-gray-400 fs-7">
                                        <span class="bullet bullet-dot bg-warning h-8px w-8px me-1"></span>
                                            27 April 2021 9.41 WIB
                                        </div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack py-4">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-35px me-4">
                                        <span class="symbol-label bg-light-warning">
                                            <!--begin::Icon-->
                                            <span class="svg-icon svg-icon-warning">
                                                <i class="bi bi-chat-square-text-fill text-primary fs-1 text-warning"></i>
                                            </span>
                                            <!--end::Icon-->
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div class="mb-0 me-2">
                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">Administrator membalas keluhan ticket ID 976786944</a>
                                        <div class="text-gray-400 fs-7">
                                        <span class="bullet bullet-dot bg-warning h-8px w-8px me-1"></span>
                                            27 April 2021 9.41 WIB
                                        </div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack py-4">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-35px me-4">
                                        <span class="symbol-label bg-light-warning">
                                            <!--begin::Icon-->
                                            <span class="svg-icon svg-icon-warning">
                                                <i class="bi bi-chat-square-text-fill text-primary fs-1 text-warning"></i>
                                            </span>
                                            <!--end::Icon-->
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div class="mb-0 me-2">
                                        <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">Administrator membalas keluhan ticket ID 976786944</a>
                                        <div class="text-gray-400 fs-7">
                                        <span class="bullet bullet-dot bg-warning h-8px w-8px me-1"></span>
                                            27 April 2021 9.41 WIB
                                        </div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->
                        <!--begin::View more-->
                        <div class="py-3 text-center border-top">
                            <a href="../../demo1/dist/pages/profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                            <span class="svg-icon svg-icon-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon--></a>
                        </div>
                        <!--end::View more-->
                    </div>
                    <!--end::Tab panel-->
                </div>
                <!--end::Tab content-->
            </div>
        </div>
        <!--end::Notifications-->
        <!--begin::User-->
        <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
            <!--begin::Menu wrapper-->
            <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                <img src="{{asset('assets/media/avatars/150-13.jpg')}}" alt="user" />
            </div>
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-50px me-5">
                            <img alt="Logo" src="{{asset('assets/media/avatars/150-13.jpg')}}" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Username-->
                        <div class="d-flex flex-column">
                            <div class="fw-bolder d-flex align-items-center fs-5">Charles Nilson</div>
                            <a href="#" class="fw-bold text-muted text-hover-primary fs-7">User</a>
                        </div>
                        <!--end::Username-->
                    </div>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="{{url('profile')}}" class="menu-link px-5">My Profile</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5 my-1">
                    <a href="#" class="menu-link px-5" data-bs-toggle="modal" data-bs-target="#kt_modal_new_address">Change Password</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <a href="#" class="menu-link px-5 text-danger">Sign Out</a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu separator-->
                <div class="separator my-2"></div>
                <!--end::Menu separator-->
                <!--begin::Menu item-->
                <div class="menu-item px-5">
                    <div class="menu-content px-5">
                        <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">
                            <span class="form-check-label text-gray-600 fs-7">Versi 1.0.1</span>
                        </label>
                    </div>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
            <!--end::Menu wrapper-->
        </div>
        <!--end::User -->
        <!--begin::Heaeder menu toggle-->
        <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
                <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="black" />
                        <path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!--end::Heaeder menu toggle-->
    </div>
    <!--end::Toolbar wrapper-->
</div>
<!--end::Topbar-->