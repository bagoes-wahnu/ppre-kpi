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

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card card-flush mb-5 mb-xl-10" id="kt_profile_details_view">
            <div class="card-header">
                <div class="d-flex flex-column card-title m-0 py-5">
                    <h3 class="fw-bolder m-0">Setting Rumus Kondisi</h3>
                    <div class="text-gray-400 fw-bold fs-5 py-2 text-xs">
                        Pengaturan rumus kondisi pada aplikasi Key Performance Indicator  
                    </div>
                </div>
                <div class="d-flex flex-row m-0"></div>
            </div>
        </div>
        <input type="hidden" id="input-1" value=""/>
        <input type="hidden" id="input-2" value=""/>
        <div class="row" id="list-time">
            {{--<div class="col-md-3 px-2" style="width:20%">
                <div class="text-center setting-item rounded p-4 text-darkblue" style="background-color:rgba(76, 140, 205, 0.24);border:1px dashed #4C8CCD">
                    <span class="svg-icon svg-icon-primary svg-icon-4x">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#2664A2" opacity="0.3" cx="12" cy="12" r="10"/>
                            <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#2664A2"/>
                        </g>
                        </svg>
                    </span>
                    <h5 class="mb-0 mt-4">Tambah Data</h5>
                    <span style="font-size:.7rem">Klik untuk menambah tahun baru</span>
                </div>
            </div>
            <div class="col-md-3 px-2" style="width:20%;">
                <div class=" text-center setting-item border rounded p-4" style="background-color:#fff;height:100%">
                    <p class="text-dark fw-bolder mb-0" id="title-1" style="font-size:3rem;">2021</p>
                    <div class="row mx-0">
                        <div class="col-md-6 text-center py-3 px-6">
                            <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-20px w-30px" type="checkbox" value="" id="flexSwitch20x30"/>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <button type="button" class="btn btn-light-warning btn-sm" onclick="editSetting('2')">Edit</a>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
</div>


<div class="modal fade" id="modal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tahun RAKP Unit</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>

            <div class="modal-body">
                <form id="form-input">
                <input type="hidden" id="id" value=""/>
                <div class="mb-5">
                    <label for="nama" class="form-label">Pilih Tahun</label>
                    <input id="tanggal" type="text" class="form-control" readonly="readonly" placeholder="Pilih tanggal" readonly/>
                </div>
                <div class="hapus-time">
                    <label for="nama" class="form-label text-danger fw-bolder">Hapus Tahun</label>
                </div>
                <div class="mb-5 border-dashed rounded row mx-0 p-4 props-warning hapus-time">
                   <div class="col-md-2" style="padding: 1.7rem;">
                        <div class="form-check form-check-custom form-check-solid form-check-danger">
                            <input class="form-check-input" type="checkbox" value="" id="hapus-tahun"/>
                        </div>
                   </div>
                   <div class="col-md-10">
                       <h5 class="">Hapus Tahun</h5>
                       <p class="text-muted mb-0">Perhatikan baik-baik, karena memilih ini akan menghapus seluruh data didalamnya.</p>
                   </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="btn-simpan" class="btn btn-sm btn-darkblue" onclick="simpan()">
                    <span class="indicator-label">Simpan</span>
                    <span class="indicator-progress">Proses menyimpan...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div> 

<script src="{{asset('assets/extends/js/page/setting-rumus.js')}}"></script>

@endsection
