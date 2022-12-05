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

    .props-warning.active{
        border:1px dashed #D9214E;
        background-color: #fff5f8;
    }

    .props-warning.active p{
        color:#D9214E !important;
    }

    .table-skor td, .table-skor th{
        text-align: center;
    }

    th, td {
        white-space: nowrap;
        vertical-align: middle;
        min-width: 80px;
        background-color: #fff !important;
    }

    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }

    .table th{color:#828282;max-width: 300px;}
    .table td{color:#5E6278;word-wrap: break-word;}

    .btn-darkblue{
        background-color:#2664A2;
        color:#fff;
    }

</style>
<link href="https://cdn.datatables.net/fixedcolumns/4.0.1/css/fixedColumns.dataTables.min.css" rel="stylesheet"type="text/css" />
{{-- <link href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.dataTables.min.css" rel="stylesheet"type="text/css" /> --}}

<div class="post d-flex flex-column-fluid" id="kt_post" style="flex-direction: column;">
    <div id="kt_content_container" class="container-xxl">
        <div class="card card-flush mb-5 mb-xl-10" id="kt_profile_details_view">
            <div class="card-header">
                <div class="d-flex flex-column card-title m-0 py-5">
                    <h3 class="fw-bolder m-0">Realisasi KPI</h3>
                    <div class="text-gray-400 fw-bold fs-5 py-2 text-xs">
                        Silahkan mengisi form berikut untuk Realisasi KPI
                    </div>
                </div>
                <div class="d-flex flex-row m-0">
                    <button class="btn btn-sm btn-light-success align-self-center me-3 d-none" id="btn-export" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        Export <i class="bi bi-chevron-down ms-3"></i>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-100px py-3" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">PDF</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">EXCEL</a>
                        </div>
                    </div>
                    <a href="javascript:;" class="btn btn-light-info align-self-center" onclick="openKeterangan()"><i class="bi bi-book-half me-3"></i>Keterangan Skor</a>
                </div>
                <div class="d-flex flex-row row col-12 p-0 m-0">
                    <div class="col-md-4 pe-2 ps-0 div-unit d-none">
                        <select class="form-select select_unit" id="select_unit" data-control="select2" data-placeholder="Pilih korporat/unit">
                        </select>
                    </div>
                    <div class="col-md-2 pe-0">
                        {{-- <input id="tanggal" type="text" class="form-control" readonly="readonly" placeholder="Pilih Tahun" readonly/> --}}
                        <select class="form-select select_year" id="select_year" data-control="select2" data-placeholder="Tahun">
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-warning" onclick="filter()">Tampilkan</button>
                    </div>
                    <div class="col-md-4 ps-0 div-option mt-4 d-none">
                        <select class="form-select select_quarter" id="select_quarter" data-control="select2" data-placeholder="Pilih quarter">
                            <option value="1">Kuartal 1</option>
                            <option value="2">Kuartal 2</option>
                            <option value="3">Kuartal 3</option>
                            <option value="4">Kuartal 4</option>
                        </select>
                    </div>
                    <div class="col-md-8 pt-3 div-option mt-4 d-none">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="" id="is-nilai-final"/>
                            <label class="form-check-label" for="is-nilai-final">
                                Nilai Final
                            </label>
                        </div>
                    </div>
                    <div class="col-12 row mx-0 div-kolektif d-none mt-4">
                        <span class="badge badge-secondary me-3 text-darkblue" style="width: fit-content;">Kunci Kolektif</span>
                        <span class="badge badge-secondary text-darkblue" style="width: fit-content;">Approve Kolektif</span>
                    </div>
                    <div class="col-12 p-0">
                        <div id="table-wrapper"></div>
                    </div>
                    <div class="col-md-12 my-6 div-btn d-none">
                        <button id="btn-simpan" class="btn d-none btn-darkblue me-3" onclick="simpan()"> Simpan</button>
                        <button id="btn-approve" class="btn d-none btn-warning me-3" onclick="approve()"> <i class="bi bi-check me-3"></i>Approve Nilai</button>
                        <button id="btn-lock" class="btn d-none btn-warning me-3" onclick="lock()"> <i class="bi bi-lock me-3"></i>Submit</button>
                        <button class="btn d-none btn-darkblue me-3" onclick="openPica()"> cek pica</button>
                    </div>
                </div>
                <div class="d-flex flex-column col-12 px-0 py-10 m-0 d-none" style="align-items: center;" id="empty-handler">
                    <!--IF EMPTY-->
                    <img src="{{asset('assets/extends/img/there-is-nothing-here.svg')}}" alt="Belum ada data" style="max-width:300px">
                    <div class="text-center" style="max-width:400px">
                        <p id="text-empty" class="text-muted mb-8 d-none">Belum ada data, silahkan tekan tombol <br/> dibawah untuk menambah data baru</p>
                        <p id="text-null" class="text-muted mb-8">Belum ada data, silahkan pilih unit terlebih dahulu</p>
                        <button id="btn-empty" class="btn btn-darkblue d-none" onclick="tambahParameter()"> <i class="bi bi-plus-lg me-3"></i>Tambah Parameter</button>
                    </div>
                </div>
                <div class="d-flex flex-column col-12 px-0 py-15 mt-10 m-0" style="align-items: center;" id="empty-search">
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

<div class="modal fade" tabindex="-1" id="modal-keterangan">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mapping Score</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>

            <div class="modal-body">
                <table class="table table-bordered table-row-gray-300 gy-2 table-skor">
                    <thead>
                        <tr>
                            <td>MAPPING</td>
                            <td>SKOR</td>
                            <td>KETERANGAN</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="background-color:#50CD89">A</td>
                            <td>35 - 40</td>
                            <td>High</td>
                        </tr>
                        <tr>
                            <td style="background-color:#1BC5BD">B</td>
                            <td>29 - 34</td>
                            <td>Medium - High</td>
                        </tr>
                        <tr>
                            <td style="background-color:#FFA800">C</td>
                            <td>23 - 28</td>
                            <td>Medium</td>
                        </tr>
                        <tr>
                            <td style="background-color:#FFC700">D</td>
                            <td>17 - 22</td>
                            <td>Low - Medium</td>
                        </tr>
                        <tr>
                            <td style="background-color:#F1416C">E</td>
                            <td>10 - 16</td>
                            <td>Low</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-evidence" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-450px">
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
                <input type="hidden" id="id"/>
                <input type="hidden" id="real"/>
                <div class="text-center mb-13">
                    <h1 class="mb-3">Upload Evidence</h1>
                    <div class="text-muted fw-bold fs-5">Silahkan upload gambar/pdf untuk keperluan evidence.</div>
                </div>
                <div class="col-md-12 border-dashed p-2 rounded">
                    <label class="text-muted" for="">Keterangan</label>
                    <p  id="keterangan">-</p>
                </div>
                <div class="col-md-12 mt-6">
                    <form class="form" action="#" method="post">
                        <div class="fv-row">
                            <div class="dropzone" id="dz-upload-ev">
                                <div class="dz-message needsclick">
                                    <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                    <div class="ms-4">
                                        <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                        <span class="fs-8 fw-bold text-primary text-sm">Only allowed to upload one file with the format .jpg/.jpeg/.pdf</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer flex-right px-0 mt-10">
                    <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="btn-tambah" onclick="ajaxEvidence()" class="btn btn-darkblue">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-upload-gambar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-450px">
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
                <input type="hidden" id="id"/>
                <div class="text-center mb-13">
                    <input type="hidden" id="id" value="" />
                    <h1 class="mb-3">Upload Gambar</h1>
                    <div class="text-muted fw-bold fs-5">Silahkan upload gambar/screenshot table nilai sebelumnya yang ingin dirubah.</div>
                </div>
                <div class="col-md-12 mt-6">
                    <form class="form" action="#" method="post">
                        <div class="fv-row">
                            <div class="dropzone" id="dz-change-ev">
                                <div class="dz-message needsclick">
                                    <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                    <div class="ms-4">
                                        <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                        <span class="fs-8 fw-bold text-primary text-sm">Only allowed to upload one file with the format .jpg/.jpeg/.pdf</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer flex-right px-0 mt-10">
                    <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="btn-tambah" onclick="ajaxChangeEvidence()" class="btn btn-darkblue">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-evidence" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-450px">
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
                    <h1 class="mb-3">Detail Evidencer</h1>
                </div>
                <div class="col-md-12 mt-6 text-center">
                   <img src="" style="max-width:100%;max-height:250px;"/>
                </div>
                <div class="col-md-12 border-dashed p-2 rounded">
                    <label class="text-muted" for="">Keterangan</label>
                    <p id="keterangan">-</p>
                </div>
                <div class="col-md-12 p-0 row mx-0 my-4">
                    <div class="col-3"></div>
                    <div class="col-md-6 p-0 row mx-0">
                        <div class="border-dashed p-2 rounded me-2" style="width:48%">
                            <label class="font-weight-bolder" for="" id="status">-</label>
                            <p class="text-muted mb-0">Status</p>
                        </div>
                        <div class="border-dashed p-2 rounded" style="width:48%">
                            <label class="font-weight-bolder" for="" id="date">-</label>
                            <p class="text-muted mb-0">Tanggal</p>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
                <div class="modal-footer flex-right px-0 mt-10">
                    <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
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

<div class="modal fade" id="modal-skema" data-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form class="form" id="kt_modal_new_form">
                <div class="modal-header" id="kt_modal_new_header">
                    <h2 id="modal-title">Pilih Skema</h2>
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
                    <div class="row mx-0 p-0 col-12">
                        <div class="col-6 mb-4">
                            <div class="col-12 border-dashed rounded p-4">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" name="radio-skema" value="1" id="skema-1"/>
                                    <label class="form-check-label" for="skema-1">
                                        Semua sudah evidence
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="col-12 border-dashed rounded p-4">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" name="radio-skema" value="2" id="skema-2"/>
                                    <label class="form-check-label" for="skema-2">
                                        Ada yang belum evidence
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="col-12 border-dashed rounded p-4">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" name="radio-skema" value="3" id="skema-3"/>
                                    <label class="form-check-label" for="skema-3">
                                        Ada parameter tidak sesuai target
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-right">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-pica" tabindex="-1" aria-hidden="true">
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
            <input type="hidden" id="id" />
            <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-10">
                <input type="hidden" id="id_target"/>
                <div class="text-center mb-13">
                    <h1 class="mb-3">Upload Pica</h1>
                    <div class="text-muted fw-bold fs-5">Detail penyebab dan bukti</div>
                </div>
                <div>
                    <div class="stepper stepper-links d-flex flex-column" id="kt_modal_offer_a_deal_stepper">
                        <div class="stepper-nav justify-content-center py-2">
                            <div class="stepper-item me-5 me-md-15 current st-nav" id="stepper-nav-1" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">Problem Identification</h3>
                            </div>
                            <div class="stepper-item me-5 me-md-15 st-nav" data-kt-stepper-element="nav"  id="stepper-nav-2">
                                <h3 class="stepper-title">Evidence</h3>
                            </div>
                        </div>
                        <form class="mx-auto mw-500px w-100 pt-5 pb-10" novalidate="novalidate" id="kt_modal_offer_a_deal_form">
                            <div class="current st-nav" id="stepper-div-1" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="mb-8">
                                        <h2 class="mb-3">Problem Identification</h2>
                                        <div class="text-muted fw-bold fs-5">Masukkan keterangan problem identification parameter tidak sesuai.</div>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="">Problem Identification</label>
                                        <input type="text" class="form-control" id="problem-identification" placeholder="Masukkan problem identification"/>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="">Corrective Action</label>
                                        <input type="text" class="form-control" id="corrective-action" placeholder="Masukkan corrective action"/>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label for="">PIC</label>
                                        <input type="text" class="form-control" id="pic" placeholder="Masukkan PIC"/>
                                    </div>
                                    <div class="col-md-12 mb-8">
                                        <label for="">Due Date</label>
                                        <input id="due-date" type="text" class="form-control" readonly="readonly" placeholder="MAsukkan Tanggal" readonly/>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-lg btn-light-primary btn-sm" data-kt-element="type-next" onclick="picaNav('next')">
                                            <span class="indicator-label">Berikutnya</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-stepper-element="content" class="st-nav" id="stepper-div-2">
                                <div class="w-100">
                                    <div class="mb-13">
                                        <h2 class="mb-3">Evidence</h2>
                                        <div class="text-muted fw-bold fs-5">Masukkan bukti atau bukti parameter tidak sesuai.</div>
                                    </div>
                                    <div class="row mx-0 p-0 mb-8">
                                        <div class="col-md-6">
                                            <label for="" class="mb-3">Keterangan Bukti Awal</label>
                                            <div class="dropzone" id="dz-bukti-awal">
                                                <div class="dz-message needsclick">
                                                    <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                    <div class="ms-4">
                                                        <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                        <span class="fs-8 fw-bold text-primary text-sm">Only allowed to upload one file with the format .jpg/.pdf</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="mb-3">Keterangan Pembetulan</label>
                                            <div class="dropzone" id="dz-keterangan-pembetulan">
                                                <div class="dz-message needsclick">
                                                    <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                                    <div class="ms-4">
                                                        <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                                        <span class="fs-8 fw-bold text-primary text-sm">Only allowed to upload one file with the format .jpg/.pdf</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-stack">
                                        <button type="button" class="btn btn-lg btn-light me-3 btn-sm" data-kt-element="details-previous" onclick="picaNav('prev')">Sebelumnya</button>
                                        <button type="button" class="btn btn-lg btn-darkblue btn-sm" data-kt-element="details-next">
                                            <span class="indicator-label">Simpan</span>
                                            <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/extends/js/page/realisasi-kpi.js')}}"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.0.2/js/dataTables.fixedColumns.min.js"></script>
<script>

</script>
@endsection
