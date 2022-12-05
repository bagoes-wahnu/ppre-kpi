@extends('layout.main')
@section('content')

<style>
    ::-webkit-input-placeholder { /* Edge */
    font-weight: 400 !important;
    }

    :-ms-input-placeholder { /* Internet Explorer 10-11 */
      font-weight: 400 !important;
    }

    ::placeholder {
      font-weight: 400 !important;
    }

    .btn-darkblue{
        background-color:#2664A2;
        color:#fff;
    }

    .text-darkblue{
        color:#2664A2;
    }

    .props-warning.active{
        border:1px dashed #D9214E;
        background-color: #fff5f8;
    }

    .props-warning.active p{
        color:#D9214E !important;
    }
</style>

<div class="post d-flex flex-column-fluid" id="kt_post" style="flex-direction: column;">
    <div class="col-12 px-10 mb-6" style="margin-top: -2rem;" id="div-title">
        <p><span class="font-weight-bolder">Setting <span class='year'>2022</span></span> <span class="text-muted">| Tahun - Setting</span> </p>
        <h1 class="title">-</h1>
    </div>
    <div id="kt_content_container" class="container-xxl">
        <div class="card card-flush mb-5 mb-xl-10" id="kt_profile_details_view">
            <div class="card-header">
                <div class="d-flex flex-column card-title m-0 py-5">
                    <h3 class="fw-bolder m-0">Setting KPI</h3>
                    <div class="text-gray-400 fw-bold fs-5 py-2 text-xs">
                        Pengaturan KPI pada aplikasi Key Performance Indicator  
                    </div>
                    <input type="hidden" id="id" value="{{$id}}">
                </div>
                <div class="d-flex flex-row m-0 d-none" id="div-simpan">
                    <a href="javascript:;" id="btn-simpan-draft" class="btn btn-light-primary text-darkblue align-self-center me-3" onclick="simpan(0)">Simpan Draft</a>
                    <a href="javascript:;" class="btn btn-darkblue align-self-center" onclick="simpan(1)">Simpan</a>
                </div>
                <div class="d-flex flex-row row col-12 p-0 m-0">
                    <div class="col-md-4 pe-2 ps-0 div-filter">
                        <select class="form-select select_unit" id="select_unit" data-control="select2" data-placeholder="Pilih korporat/unit">
                        </select>
                    </div>
                    <div class="col-md-2 pe-0 d-none div-filter" id="div-tanggal">
                        <input id="tanggal" type="text" class="form-control" readonly="readonly" placeholder="Pilih Tahun" readonly/>
                    </div>
                    <div class="col-md-2 pe-0 d-none div-year">
                        <select class="form-select select_year" id="select_year" data-control="select2" data-placeholder="Tahun">
                        </select>
                    </div>
                    <div class="col-md-2 div-filter">
                        <button type="button" class="btn btn-warning" onclick="filter()">Tampilkan</button>
                    </div>
                    <div id="list-parameter" class="d-none parameter row mx-0">
                        <!-- Looping -->
                        {{--<div class="col-1 my-8 d-none" style="vertical-align: middle; display: flex;">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                            </div>
                        </div>
                        <div class="col-12 row mx-0 p-4 my-8 border-dashed rounded div-parameter" id="parent-1">
                            <div class="col-3 mb-10 ps-0">
                                <label class="text-gray-600">Parameter</label>
                                <select class="form-select" data-control="select2" data-placeholder="Pilih parameter">
                                    <option></option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                </select>
                                <h5 class="text-darkblue d-none">% Revenue (standalone)</h5>
                            </div>
                            <div class="col-3 mb-10">
                                <label class="text-gray-600">PIC KPI Korporat</label>
                                <input type="text" class="form-control " id="poin-maksimal" placeholder="Masukkan nama PIC"/>
                            </div>
                            <div class="col-3 mb-10">
                                <label class="text-gray-600">Target</label>
                                <input type="text" class="form-control " id="poin-maksimal" placeholder="Masukan target"/>
                            </div>
                            <div class="col-2 mb-10">
                                <label class="text-gray-600">Bobot</label>
                                <input type="text" class="form-control " id="poin-maksimal" placeholder="Bobot"/>
                            </div>
                            <div class="col-1 mb-10 py-2">
                                <button class="btn btn-danger btn-icon" onclick="deleteParameter('1')"><i class="bi bi-dash-lg"></i></button>
                            </div>
                            <!---->
                            <div class="col-3 mb-2 ps-0">
                                <label class="text-gray-600">Perspective</label>
                                <h5 class="">Financial</h5>
                            </div>
                            <div class="col-3 mb-2">
                                <label class="text-gray-600">Formula</label>
                                <h5>Laba Operasi (standalone)</h5>
                            </div>
                            <div class="col-3 mb-2">
                                <label class="text-gray-600">Sasaran Strategis</label>
                                <h5>Increase Profitability</h5>
                            </div>
                            <div class="col-3 text-center py-4">
                                <button class="btn btn-secondary btn-icon btn-xs" id="btn-1" onclick="openDetail('1')"><i class="bi bi-chevron-right"></i></button>
                            </div>
                            <!---->
                            <div id="detail-1" class="row mx-0 p-0" style="display: none">
                                <div class="mb-2 col-3 ps-0">
                                    <label class="text-gray-600">Sumber</label>
                                    <h5>KPI Korporat</h5>
                                </div>
                                <div class="mb-2 col-1n5">
                                    <label class="text-gray-600">Satuan</label>
                                    <h5>Rp</h5>
                                </div>
                                <div class="mb-2 col-1n5">
                                    <label class="text-gray-600">Kondisi</label>
                                    <h5>></h5>
                                </div>
                                <div class="mb-2 col-3">
                                    <label class="text-gray-600">Tipe TYD</label>
                                    <h5>Accumulated</h5>
                                </div>
                                <div class="mb-2 col-2">
                                    <label class="text-gray-600">Evidence</label>
                                    <h5>Laporan X</h5>
                                </div>
                            </div>
                            <!---->
                            <div class="col-12 row mx-0 px-0 mt-6">
                                <div class="col-3 ps-0 py-3">
                                    <p class="text-muted">Unit dengan parameter sama</p>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-light-warning btn-sm" onclick="openModal()">Lihat Unit</button>
                                </div>
                            </div>
                        </div>--}}
                        <!-- Looping -->
                    </div>

                    <div class="row mx-0 my-10 parameter d-none">
                        <div class="col-12 p-0 my-8 d-none">
                            <button class="btn btn-light-success w-100" onclick="tambahParameter()"> <i class="bi bi-plus-circle-fill me-3"></i>Tambah Parameter</button>
                        </div>
                        <div class="col-4 ps-0 btn-add text-right pe-0">
                            <button class="btn btn-darkblue" onclick="tambahParameter()"> <i class="bi bi-plus-lg me-3"></i>Tambah Parameter</button>
                            <button class="btn btn-darkblue d-none">Simpan Setting</button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-darkblue d-none btn-approve me-2" onclick="accept()">Approve</button>
                            <button class="btn btn-warning d-none btn-rollback" onclick="rollback()">Rollback</button>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-3">
                            <label class="text-gray-600">Total Bobot</label>
                            <h5 id="total-bobot">-</h5>
                        </div>
                    </div>   
                </div>
                <div class="d-flex flex-column col-12 px-0 py-10 m-0 d-none" style="align-items: center;" id="empty-handler">
                    <!--IF EMPTY-->
                    <img src="{{asset('assets/extends/img/there-is-nothing-here.svg')}}" alt="Belum ada data" style="max-width:300px">
                    <div class="text-center" style="max-width:400px">
                        <p id="text-empty" class="text-muted mb-8 d-none">Belum ada data, silahkan tekan tombol <br/> dibawah untuk menambah data baru</p>
                        <p id="text-null" class="text-muted mb-8">Belum ada data, silahkan pilih unit terlebih dahulu</p>
                        <p id="text-direksi" class="text-muted mb-8 d-none">Belum ada data</p>
                        <button id="btn-empty" class="btn btn-darkblue d-none" onclick="tambahParameter()"> <i class="bi bi-plus-lg me-3"></i>Tambah Parameter</button>
                    </div>
                </div>
                <div class="d-flex flex-column col-12 px-0 py-10 m-0 d-none" style="align-items: center;" id="empty-search">
                    <!--IF EMPTY2-->
                    <img src="{{asset('assets/extends/img/empty-search.svg')}}" alt="Belum ada data" style="max-width:300px">
                    <div class="text-center mt-6" style="max-width:400px">
                        <p class="text-muted mb-8">Belum ada data yang dapat ditampilkan <br/> Silahkan pilih unit,tahun dan kuartal terlebih dahulu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="list-modal">
    
</div>

<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-10">
                <input type="hidden" id="id_target"/>
                <!--begin::Content-->
                <div class="text-center mb-13">
                    <h1 class="mb-3">Daftar Unit</h1>
                    <div class="text-muted fw-bold fs-5">Terapkan bobot pada unit</div>
                </div>
                <!--end::Content-->
                <!--begin::Search-->
                <div id="kt_modal_users_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="inline">
                    <!--begin::Form-->
                    <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">
                        <!--begin::Hidden input(Added to disable form autocomplete)-->
                        <input type="hidden" />
                        <!--end::Hidden input-->
                        <!--begin::Icon-->
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <!--end::Icon-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-lg form-control-solid px-15" name="search" value="" placeholder="Search ..." data-kt-search-element="input" />
                        <!--end::Input-->
                        <!--begin::Spinner-->
                        <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                            <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                        </span>
                        <!--end::Spinner-->
                        <!--begin::Reset-->
                        <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="clear">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <!--end::Reset-->
                    </form>
                    <!--end::Form-->
                    <!--begin::Wrapper-->
                    <div class="py-5">
                        <!--begin::Results(add d-none to below element to hide the users list by default)-->
                        <div data-kt-search-element="results">
                            <!--begin::Users-->
                            <div class="mh-375px scroll-y me-n7 pe-7" id="list-unit">
                                {{--<div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="0">
                                    <div class="d-flex align-items-center">
                                        <label class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input chk-bobot" type="checkbox" name="users" data-kt-check="true" data-kt-check-target="[data-user-id='0']" value="1" />
                                        </label>
                                        <div class="symbol symbol-35px symbol-circle">
                                            <span class="symbol-label bg-light-warning text-danger fw-bold">ES</span>
                                        </div>
                                        <div class="ms-5">
                                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Emma Smith</a>
                                        </div>
                                    </div>
                                </div>--}}
                                <!--end::User-->
                                <div id="bobot-detail-1" class="col-12 row mx-0 d-none" style="padding:0 1rem 1rem 4rem">
                                    <div class="col-6 ps-0">
                                        <label class="text-gray-600 mb-2">Target</label>
                                        <input type="text" class="form-control " id="poin-maksimal" placeholder="Target"/>
                                    </div>
                                    <div class="col-6 ps-0">
                                        <label class="text-gray-600 mb-2">Bobot</label>
                                        <input type="text" class="form-control " id="poin-maksimal" placeholder="Bobot"/>
                                    </div>
                                </div>
                                <!--begin::Separator-->
                                <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                <!--end::Separator-->
                            </div>
                            <!--end::Users-->
                            <!--begin::Actions-->
                            <div class="d-flex mt-15">
                               <div class="col-3">
                                <label class="text-gray-600">Sisa Target</label>
                                <h2>1000</h2>
                               </div>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Results-->
                        <!--begin::Empty-->
                        <div data-kt-search-element="empty" class="text-center d-none">
                            <!--begin::Message-->
                            <div class="fw-bold py-10">
                                <div class="text-gray-600 fs-3 mb-2">Pencarian '[Search]'</div>
                                <div class="text-muted fs-6">Belum ada data yang dapat ditampilkan.</div>
                            </div>
                            <!--end::Message-->
                            <!--begin::Illustration-->
                            {{--<div class="text-center px-5">
                                <img src="assets/media/illustrations/sketchy-1/1.png" alt="" class="w-100 h-200px h-sm-325px" />
                            </div>--}}
                            <!--end::Illustration-->
                        </div>
                        <!--end::Empty-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Search-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

<div class="modal fade" id="modal-rollback" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-10">
                <input type="hidden" id="id_target"/>
                <div class="text-center mb-13">
                    <h1 class="mb-3">Rollback KPI</h1>
                    <div class="text-muted fw-bold fs-5">Silahkan ketik alasan mengapa pengajuan dirollback</div>
                </div>
                <div>
                    <label for="note-rollback">Keterangan Rollback</label>
                    <textarea class="form-control" id="note-rollback" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="btn-simpan" class="btn btn-sm btn-darkblue" onclick="ajaxRollback()">
                    <span class="indicator-label">Simpan</span>
                    <span class="indicator-progress">Proses menyimpan...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/extends/js/page/setting-kpi-detail.js')}}"></script>

@endsection
