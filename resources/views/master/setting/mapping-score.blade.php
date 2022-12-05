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
                    <h3 class="fw-bolder m-0">Setting Mapping Skor</h3>
                    <div class="text-gray-400 fw-bold fs-5 py-2 text-xs">
                        Master setting mapping pada aplikasi Key Performance Indicator
                    </div>
                </div>
                <div class="d-flex flex-row m-0"></div>
            </div>
            <div class="card-body p-9">
                <div class="row" id="list-mapping">
                    {{-- <input type="hidden" id="input-1" value=""/>
                    <input type="hidden" id="input-2" value=""/>
                    <input type="hidden" id="input-3" value=""/>
                    <input type="hidden" id="input-4" value=""/>
                    <input type="hidden" id="input-5" value=""/>
                    <div class="col-md-3 px-2" style="width:20%">
                        <div class="text-center setting-item border rounded p-4" style="">
                            <h4 class="text-dark font-weight-bolder" id="title-1">Mapping A</h4>
                            <span class="text-muted" style="font-size:12px">High</span>
                            <h1 class=" font-weight-bolder mt-1" >
                                <span class="data-1 text-darkblue"> -  </span> 
                                <a href="javascript:;" class="btn"  data-toggle="m-tooltip" title="Edit " style="padding: 4px !important">
                                    <span class="">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="12" fill="#50CD89"/>
                                        <g clip-path="url(#clip0)">
                                        <path d="M12.6783 8.82144L15.1787 11.3218L9.74917 16.7513L7.51987 16.9974C7.22143 17.0304 6.96929 16.7781 7.00249 16.4796L7.25054 14.2488L12.6783 8.82144ZM16.7251 8.44917L15.5511 7.27515C15.1849 6.90894 14.591 6.90894 14.2248 7.27515L13.1203 8.37964L15.6207 10.88L16.7251 9.77554C17.0914 9.40913 17.0914 8.81538 16.7251 8.44917Z" 
                                        fill="#50CD89"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0">
                                        <rect width="10" height="10" fill="white" transform="translate(7 7)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                    </span>
                                </a>
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
                    <div class="col-md-3 px-2" style="width:20%">
                        <div class=" text-center setting-item border rounded p-4" style="">
                            <h4 class="text-dark font-weight-bolder" id="title-1">Mapping B</h4>
                            <span class="text-muted" style="font-size:12px">High - Medium</span>
                            <h1 class=" font-weight-bolder mt-1" >
                                <span class="data-1 text-darkblue"> -  </span> 
                                <a href="javascript:;" class="btn"  data-toggle="m-tooltip" title="Edit " style="padding: 4px !important">
                                    <span class="">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="12" fill="#1BC5BD"/>
                                        <g clip-path="url(#clip0)">
                                        <path d="M12.6783 8.82144L15.1787 11.3218L9.74917 16.7513L7.51987 16.9974C7.22143 17.0304 6.96929 16.7781 7.00249 16.4796L7.25054 14.2488L12.6783 8.82144ZM16.7251 8.44917L15.5511 7.27515C15.1849 6.90894 14.591 6.90894 14.2248 7.27515L13.1203 8.37964L15.6207 10.88L16.7251 9.77554C17.0914 9.40913 17.0914 8.81538 16.7251 8.44917Z" 
                                        fill="#1BC5BD"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0">
                                        <rect width="10" height="10" fill="white" transform="translate(7 7)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                    </span>
                                </a>
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
                    <div class="col-md-3 px-2" style="width:20%">
                        <div class=" text-center setting-item border rounded p-4" style="">
                            <h4 class="text-dark font-weight-bolder" id="title-1">Mapping C</h4>
                            <span class="text-muted" style="font-size:12px">Medium</span>
                            <h1 class=" font-weight-bolder mt-1" >
                                <span class="data-1 text-darkblue"> -  </span> 
                                <a href="javascript:;" class="btn"  data-toggle="m-tooltip" title="Edit " style="padding: 4px !important">
                                    <span class="">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="12" fill="#FFA800"/>
                                        <g clip-path="url(#clip0)">
                                        <path d="M12.6783 8.82144L15.1787 11.3218L9.74917 16.7513L7.51987 16.9974C7.22143 17.0304 6.96929 16.7781 7.00249 16.4796L7.25054 14.2488L12.6783 8.82144ZM16.7251 8.44917L15.5511 7.27515C15.1849 6.90894 14.591 6.90894 14.2248 7.27515L13.1203 8.37964L15.6207 10.88L16.7251 9.77554C17.0914 9.40913 17.0914 8.81538 16.7251 8.44917Z" 
                                        fill="#FFA800"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0">
                                        <rect width="10" height="10" fill="white" transform="translate(7 7)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                    </span>
                                </a>
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
                    <div class="col-md-3 px-2" style="width:20%">
                        <div class=" text-center setting-item border rounded p-4" style="">
                            <h4 class="text-dark font-weight-bolder" id="title-1">Mapping D</h4>
                            <span class="text-muted" style="font-size:12px">Medium - Low</span>
                            <h1 class=" font-weight-bolder mt-1" >
                                <span class="data-1 text-darkblue"> -  </span> 
                                <a href="javascript:;" class="btn"  data-toggle="m-tooltip" title="Edit " style="padding: 4px !important">
                                    <span class="">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="12" fill="#FFC700"/>
                                        <g clip-path="url(#clip0)">
                                        <path d="M12.6783 8.82144L15.1787 11.3218L9.74917 16.7513L7.51987 16.9974C7.22143 17.0304 6.96929 16.7781 7.00249 16.4796L7.25054 14.2488L12.6783 8.82144ZM16.7251 8.44917L15.5511 7.27515C15.1849 6.90894 14.591 6.90894 14.2248 7.27515L13.1203 8.37964L15.6207 10.88L16.7251 9.77554C17.0914 9.40913 17.0914 8.81538 16.7251 8.44917Z" 
                                        fill="#FFC700"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0">
                                        <rect width="10" height="10" fill="white" transform="translate(7 7)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                    </span>
                                </a>
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
                    <div class="col-md-3 px-2" style="width:20%">
                        <div class=" text-center setting-item border rounded p-4" style="">
                            <h4 class="text-dark font-weight-bolder" id="title-1">Mapping E</h4>
                            <span class="text-muted" style="font-size:12px">Low</span>
                            <h1 class=" font-weight-bolder mt-1" >
                                <span class="data-1 text-darkblue"> -  </span> 
                                <a href="javascript:;" class="btn"  data-toggle="m-tooltip" title="Edit " style="padding: 4px !important">
                                    <span class="">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="12" fill="#F1416C"/>
                                        <g clip-path="url(#clip0)">
                                        <path d="M12.6783 8.82144L15.1787 11.3218L9.74917 16.7513L7.51987 16.9974C7.22143 17.0304 6.96929 16.7781 7.00249 16.4796L7.25054 14.2488L12.6783 8.82144ZM16.7251 8.44917L15.5511 7.27515C15.1849 6.90894 14.591 6.90894 14.2248 7.27515L13.1203 8.37964L15.6207 10.88L16.7251 9.77554C17.0914 9.40913 17.0914 8.81538 16.7251 8.44917Z" 
                                        fill="#F1416C"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0">
                                        <rect width="10" height="10" fill="white" transform="translate(7 7)"/>
                                        </clipPath>
                                        </defs>
                                        </svg>
                                    </span>
                                </a>
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
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="modal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mapping Score</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>

            <div class="modal-body">
                <form id="form-input">
                <input type="hidden" id="id" value=""/>
                <div class="mb-5">
                    <label for="nama" class="form-label">Nama Mapping</span></label>
                    <input type="text" class="form-control " id="name" placeholder="Cth: A"/>
                </div>
                <div class="mb-5">
                    <label for="nama" class="form-label">Keterangan Mapping</span></label>
                    <input type="text" class="form-control " id="desc" placeholder="Cth: High"/>
                </div>
                <div class="mb-5">
                    <label for="nama" class="form-label">Nilai</span></label>
                    <div class="row mx-0">
                        <div class="col-md-5 p-0">
                            <input type="text" class="form-control " id="mapping-start" placeholder="Cth: 35"/>
                        </div>
                        <div class="col-md-2 fw-bolder text-center py-4">-</div>
                        <div class="col-md-5 p-0">
                            <input type="text" class="form-control " id="mapping-end" placeholder="Cth: 40"/>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="nama" class="form-label">Warna</span></label>
                    <div class="row mx-0" id="list-color">
                        {{-- <div class="form-check form-check-custom form-check-solid pe-0" style="width:auto !important;">
                            <input class="form-check-input check-color" type="checkbox" value="1" style="background-color:#50CD89"/>
                            <label class="form-check-label" for="flexCheckDefault"></label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid pe-0" style="width:auto !important;">
                            <input class="form-check-input check-color" type="checkbox" value="2" style="background-color:#1BC5BD"/>
                            <label class="form-check-label" for="flexCheckDefault"></label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid pe-0" style="width:auto !important;">
                            <input class="form-check-input check-color" type="checkbox" value="3" style="background-color:#FFA800"/>
                            <label class="form-check-label" for="flexCheckDefault"></label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid pe-0" style="width:auto !important;">
                            <input class="form-check-input check-color" type="checkbox" value="4" style="background-color:#FFC700"/>
                            <label class="form-check-label" for="flexCheckDefault"></label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid pe-0" style="width:auto !important;">
                            <input class="form-check-input check-color" type="checkbox" value="5" style="background-color:#F1416C"/>
                            <label class="form-check-label" for="flexCheckDefault"></label>
                        </div> --}}
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

<script src="{{asset('assets/extends/js/page/setting-mapping-score.js')}}"></script>


@endsection
