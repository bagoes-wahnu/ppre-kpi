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
</style>

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card card-flush mb-5 mb-xl-10" id="kt_profile_details_view">
                <div class="card-header">
                    <div class="d-flex flex-column card-title m-0 py-5">
                        <h3 class="fw-bolder m-0">Master User</h3>
                        <div class="text-gray-400 fw-bold fs-5 py-2">
                            Master User pada aplikasi Key Performance Indicator
                        </div>
                    </div>
                    <div class="d-flex flex-row m-0">
                        <a href="javascript:;" class="btn btn-primary align-self-center" onclick="create()">Tambah</a>
                    </div>
                </div>
                <div class="card-body p-9">
                    <div class="my-0">
                        <div id="table-wrapper">
                            {{-- <table id="kt_datatable_example_5" class="table gy-5 gs-7 table-row-bordered border rounded"> --}}
                                {{-- <thead>
                                    <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Ganang Santoso</td>
                                        <td>Non-Korporat</td>
                                        <td>
                                            <div class="form-check form-check-solid form-switch fv-row">
                                                <input class="form-check-input w-46px h-25px" type="checkbox" id="allowmarketing" checked="checked" />
                                                <label class="form-check-label" for="allowmarketing"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:;"> 
                                                <span>
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 5C0 2.23858 2.23858 0 5 0H27C29.7614 0 32 2.23858 32 5V27C32 29.7614 29.7614 32 27 32H5C2.23858 32 0 29.7614 0 27V5Z" fill="white"/>
                                                    <path d="M21.669 14.9489L15.2958 21.6868C15.1069 21.8865 14.8442 21.9997 14.5693 21.9997L11.6666 21.9997C11.1143 21.9997 10.6666 21.5519 10.6666 20.9997L10.6666 18.0713C10.6666 17.8116 10.7676 17.562 10.9484 17.3755L17.3877 10.7293C17.772 10.3326 18.4051 10.3226 18.8018 10.7069C18.8055 10.7106 18.8093 10.7143 18.813 10.718L21.6496 13.5546C22.0324 13.9375 22.041 14.5555 21.669 14.9489Z" fill="#FCAD00"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Ganang Santoso</td>
                                        <td>Korporat</td>
                                        <td>
                                            <div class="form-check form-check-solid form-switch fv-row">
                                                <input class="form-check-input w-46px h-25px" type="checkbox" id="allowmarketing" checked="checked" />
                                                <label class="form-check-label" for="allowmarketing"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:;"> 
                                                <span>
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 5C0 2.23858 2.23858 0 5 0H27C29.7614 0 32 2.23858 32 5V27C32 29.7614 29.7614 32 27 32H5C2.23858 32 0 29.7614 0 27V5Z" fill="white"/>
                                                    <path d="M21.669 14.9489L15.2958 21.6868C15.1069 21.8865 14.8442 21.9997 14.5693 21.9997L11.6666 21.9997C11.1143 21.9997 10.6666 21.5519 10.6666 20.9997L10.6666 18.0713C10.6666 17.8116 10.7676 17.562 10.9484 17.3755L17.3877 10.7293C17.772 10.3326 18.4051 10.3226 18.8018 10.7069C18.8055 10.7106 18.8093 10.7143 18.813 10.718L21.6496 13.5546C22.0324 13.9375 22.041 14.5555 21.669 14.9489Z" fill="#FCAD00"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody> --}}
                            {{-- </table> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="kt_modal_add" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-600px" >
            <div class="modal-content">
                <form class="form" id="kt_modal_new_address_form">
                    <input type="hidden" id="id" value="">
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h4>Tambah Master User</h4>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body pb-6 px-lg-8">

                        <div class="row ">
                            <div class="col-md-12 mb-2 p-0">
                                {{-- <ul class="nav"> --}}
                                    <div class="row mx-0 p-0" id="type" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                        <div class="col-md-4">
                                            <label class="mt-2 btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 ms-0 " data-bs-toggle="tab" href="#kt_table_widget_5_tab_1" data-kt-button="true">
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
                                                    <input class="form-check-input type-1" type="radio" name="type" value="1"/>
                                                </span>
                                                <span class="ms-5 mt-2">
                                                    <span class="fs-6 fw-bolder text-gray-800 mb-2 d-block">Korporat</span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="mt-2 btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 " data-bs-toggle="tab" href="#kt_table_widget_5_tab_2" data-kt-button="true">
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
                                                    <input class="form-check-input type-2" type="radio" name="type" value="2"/>
                                                </span>
                                                <span class="ms-5 mt-2">
                                                    <span class="fs-6 fw-bolder text-gray-800 mb-2 d-block">Unit</span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="mt-2 btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 " data-bs-toggle="tab" href="#kt_table_widget_5_tab_2" data-kt-button="true">
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
                                                    <input class="form-check-input type-2" type="radio" name="type" value="2"/>
                                                </span>
                                                <span class="ms-5 mt-2">
                                                    <span class="fs-6 fw-bolder text-gray-800 mb-2 d-block">Approver</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                {{-- </ul> --}}
                            </div>
                        </div>

                        <div class="row mt-4 mb-2">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Nama</label>
                                <input class="form-control" placeholder="Masukkan Nama" id="field-nama" name="" />
                            </div>
                        </div>

                        <div class="row mt-4 mb-2" id="field-atasan">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Ada atasan?</label> <br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input radio-1" onclick="is_atasan('1')" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    Ya, ada
                                  </label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input radio-0" onclick="is_atasan('0')" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Tidak
                                  </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4" id="field-pimpinan">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Pimipinan</label>
                                <select class="form-control select2" data-control="select2" data-dropdown-parent="kt_#modal_add" id="select-pimpinan" name="param" style="width:100%">
                                </select>
                                {{-- <select class="form-select" aria-label="Select example" id="pimpinan">
                                    <option>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select> --}}
                            </div>
                        </div>

                        <div class="row mt-4" id="field-unit">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Nama Unit</label>
                                <input class="form-control" placeholder="Masukkan  Unit" name="" id="nama-unit" />
                            </div>
                        </div>
                        {{-- <div class="row mt-4" id="field-direksi">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Nama Direksi</label>
                                <input class="form-control" placeholder="Masukkan  Direksi" name="" id="nama-direksi" />
                            </div>
                        </div> --}}

                        <div id="field-account-pic">
                            <div class="row mt-4">
                                <div class="col-md-6" id="field-username">
                                    <label class="fs-5 fw-bold mb-2">Username</label>
                                    <input class="form-control" placeholder="Masukkan Username" id="username" name="" />
                                </div>
                                <div class="col-md-6" id="field-password">
                                    <label class="fs-5 fw-bold mb-2">Password</label>
                                    <input class="form-control" type="password" placeholder="Masukkan Password" id="password" name="" />
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label class="fs-5 fw-bold mb-2">PIC</label>
                                    <input class="form-control" placeholder="Masukkan Nama PIC" id="pic" name="" />
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 d-none" id="field-jenis">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Jenis</label> <br>
                                <a type="radio" href="javascript:;" class="btn btn-light-primary btn-jenis btn-jenis-direksi jenis-1" name="jenis">Direksi</a>
                                <a type="radio" href="javascript:;" class="btn btn-light-primary btn-jenis btn-jenis-unit jenis-2" name="jenis">Unit</a>
                            </div>
                        </div>
                        

                    </div>

                    <div class="modal-footer flex-right">
                        <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" id="kt_docs_sweetalert_add" class="btn btn-primary" onclick="simpan()">
                            <span class="indicator-label">Save</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="kt_modal_edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-600px" >
            <div class="modal-content">
                <form class="form" id="kt_modal_new_address_form">
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h4>Edit Master User</h4>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <input type="hidden" id="id_user"/>
                        <div class="row ">
                            <div class="col-md-12 mb-2">
                                <ul class="nav">
                                    <div class="row" id="type" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                        <div class="col-md-6 w-250px">
                                            <label class="mt-2 btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 ms-0 " data-bs-toggle="tab" href="#kt_table_widget_5_tab_1" data-kt-button="true">
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
                                                    <input class="form-check-input" type="radio" name="finance_usage" value="1"/>
                                                </span>
                                                <span class="ms-5 mt-2">
                                                    <span class="fs-6 fw-bolder text-gray-800 mb-2 d-block">Korporat</span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-md-6 w-250px">
                                            <label class="mt-2 btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 " data-bs-toggle="tab" href="#kt_table_widget_5_tab_2" data-kt-button="true">
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
                                                    <input class="form-check-input" type="radio" name="finance_usage" value="2"/>
                                                </span>
                                                <span class="ms-5 mt-2">
                                                    <span class="fs-6 fw-bolder text-gray-800 mb-2 d-block">Unit</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>

                        <div class="row mt-4 mb-2">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Nama</label>
                                <input class="form-control" placeholder="Masukkan Nama" name="" id="field-nama" />
                            </div>
                        </div>

                        <div class="row mt-4 mb-2" id="field-atasan">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Ada atasan?</label> <br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input " type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    Ya, ada
                                  </label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input " type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Tidak
                                  </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4" id="field-pimpinan">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Pimipinan</label>
                                <select class="form-select" aria-label="Select example" id="pimpinan">
                                    <option>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-4" id="field-unit">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Nama Unit</label>
                                <input class="form-control" placeholder="Masukkan  Unit" name="" id="nama-unit" />
                            </div>
                        </div>
                        <div class="row mt-4" id="field-direksi">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Nama Direksi</label>
                                <input class="form-control" placeholder="Masukkan  Direksi" name="" id="nama-direksi" />
                            </div>
                        </div>

                        <div id="field-account-pic">
                            <div class="row mt-4">
                                <div class="col-md-6" id="field-username">
                                    <label class="fs-5 fw-bold mb-2">Username</label>
                                    <input class="form-control" placeholder="Masukkan Username" id="username" name="" />
                                </div>
                                <div class="col-md-6" id="field-password">
                                    <label class="fs-5 fw-bold mb-2">Password</label>
                                    <input class="form-control" type="password" placeholder="Masukkan Password" id="password" name="" />
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label class="fs-5 fw-bold mb-2">PIC</label>
                                    <input class="form-control" placeholder="Masukkan Nama PIC" id="pic" name="" />
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4" id="field-jenis">
                            <div class="col-md-12">
                                <label class="fs-5 fw-bold mb-2">Jenis</label> <br>
                                <a href="javascript:;" class="btn btn-light-primary btn-jenis btn-jenis-direksi" >Direksi</a>
                                <a href="javascript:;" class="btn btn-light-primary btn-jenis btn-jenis-unit" >Unit</a>
                            </div>
                        </div>
                        

                    </div>

                    <div class="modal-footer flex-right">
                        <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" id="kt_docs_sweetalert_add" class="btn btn-primary" onclick="update(id)">
                            <span class="indicator-label">Save</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <script src=" {{ asset('assets/js/menu/data-user.js') }}"></script>


    <script>
        
        $('.btn-jenis-direksi').on('click', function(e) {
            e.preventDefault()
            $('.btn-jenis').removeClass('btn-primary')
            $('.btn-jenis-unit').addClass('btn-light-primary')
            $('.btn-jenis-direksi').addClass('btn-primary')
        })
        
        $('.btn-jenis-unit').on('click', function(e) {
            e.preventDefault()
            $('.btn-jenis').removeClass('btn-primary')
            $('.btn-jenis-direksi').addClass('btn-light-primary')
            $('.btn-jenis-unit').addClass('btn-primary')
        })

    </script>



@endsection
