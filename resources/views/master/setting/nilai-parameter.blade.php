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
</style>

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card card-flush mb-5 mb-xl-10" id="kt_profile_details_view">
            <div class="card-header">
                <div class="d-flex flex-column card-title m-0 py-5">
                    <h3 class="fw-bolder m-0">Setting Nilai Parameter</h3>
                    <div class="text-gray-400 fw-bold fs-5 py-2 text-xs">
                        Master setting minimal dan maksimal parameter pada aplikasi Key Performance Indicator
                    </div>
                </div>
                <div class="d-flex flex-row m-0"></div>
            </div>
            <div class="card-body p-9">
                <div class="row">
                    <input type="hidden" id="input-1" value=""/>
                    <input type="hidden" id="input-2" value=""/>
                    <div class="col-md-3" style="padding:14px;">
                        <div class=" text-center setting-item" style="">
                            <h4 class="text-dark font-weight-bolder" id="title-1">Minimal Nilai Parameter</h4>
                            <span class="text-muted" style="font-size:12px">Batas bawah nilai parameter</span>
                            <h1 class=" font-weight-bolder mt-1" >
                                <span class="data-1 text-darkblue fw-boldest" style="font-size: 2rem"> -  </span> 
                                <a href="javascript:;" class="btn" onclick="editSetting('1')" data-toggle="m-tooltip" title="Edit " style="padding: 4px !important">
                                    <span class="">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="12" fill="#FCAD00"/>
                                        <g clip-path="url(#clip0)">
                                        <path d="M12.6783 8.82144L15.1787 11.3218L9.74917 16.7513L7.51987 16.9974C7.22143 17.0304 6.96929 16.7781 7.00249 16.4796L7.25054 14.2488L12.6783 8.82144ZM16.7251 8.44917L15.5511 7.27515C15.1849 6.90894 14.591 6.90894 14.2248 7.27515L13.1203 8.37964L15.6207 10.88L16.7251 9.77554C17.0914 9.40913 17.0914 8.81538 16.7251 8.44917Z" fill="white"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0">
                                        <rect width="10" height="10" fill="white" transform="translate(7 7)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                    </span>
                                </a>
                                
                            </h1>
                        </div>
                    </div>
                    <div class="col-md-3" style="padding:14px;">
                        <div class=" text-center setting-item" style="">
                            <h4 class="text-dark font-weight-bolder" id="title-2">Maksimal Nilai Parameter</h4>
                            <span class="text-muted" style="font-size:12px">Batas atas nilai parameter</span>
                            <h1 class=" font-weight-bolder mt-1" >
                                <span class="data-2 text-darkblue fw-boldest" style="font-size: 2rem"> -  </span> 
                                <a href="javascript:;" class="btn" onclick="editSetting('2')" data-toggle="m-tooltip" title="Edit " style="padding: 4px !important">
                                    <span class="">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="12" fill="#FCAD00"/>
                                        <g clip-path="url(#clip0)">
                                        <path d="M12.6783 8.82144L15.1787 11.3218L9.74917 16.7513L7.51987 16.9974C7.22143 17.0304 6.96929 16.7781 7.00249 16.4796L7.25054 14.2488L12.6783 8.82144ZM16.7251 8.44917L15.5511 7.27515C15.1849 6.90894 14.591 6.90894 14.2248 7.27515L13.1203 8.37964L15.6207 10.88L16.7251 9.77554C17.0914 9.40913 17.0914 8.81538 16.7251 8.44917Z" fill="white"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0">
                                        <rect width="10" height="10" fill="white" transform="translate(7 7)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                    </span>
                                </a>
                                
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="modal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Maksimal Izin Tanpa Keterangan</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>

            <div class="modal-body">
                <form id="form-input">
                    <input type="hidden" id="id" value=""/>
                    <label for="nama" class="form-label">Masukkan jumlah <span class="modal-desc">Maksimal Izin Tanpa Keterangan</span></label>
                    <input type="text" class="form-control " id="poin" placeholder="Cth: 3"/>
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


<script src="{{asset('assets/extends/js/page/setting-nilai-parameter.js')}}"></script>



@endsection
