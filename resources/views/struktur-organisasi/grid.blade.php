@extends('layout.main')
@section('content')
<link href="{{asset('assets/plugins/custom/jstree/jstree.bundle.css')}}" rel="stylesheet" type="text/css" />
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
                    <h3 class="fw-bolder m-0">Struktur Organisasi</h3>
                    <div class="text-gray-400 fw-bold fs-5 py-2 text-xs">
                        Struktur organisasi yang ada di PPRE
                    </div>
                </div>
                <div class="d-flex flex-row m-0"></div>
            </div>
            <div class="card-body p-9">
                <div class="row" id="list-struktur">
                    {{--<ul>
                        <li>
                            Root node 1
                            <ul>
                                <li data-jstree='{ "selected" : true }'>
                                    <a href="javascript:;">
                                        Initially selected </a>
                                </li>
                                <li data-jstree='{ "icon" : "flaticon2-gear text-success " }'>
                                    custom icon URL
                                </li>
                                <li data-jstree='{ "opened" : true }'>
                                    initially open
                                    <ul>
                                        <li data-jstree='{ "disabled" : true }'>
                                            Disabled Node
                                        </li>
                                        <li data-jstree='{ "type" : "file" }'>
                                            Another node
                                        </li>
                                    </ul>
                                </li>
                                <li data-jstree='{ "icon" : "flaticon2-rectangular text-danger" }'>
                                    Custom icon class (bootstrap)
                                </li>
                            </ul>
                        </li>
                    </ul>--}}
                </div>
                <div class="d-flex flex-column col-12 px-0 py-10 m-0 d-none" style="align-items: center;" id="div-empty">
                    <img src="{{asset('assets/extends/img/there-is-nothing-here.svg')}}" alt="Belum ada data" style="max-width:300px">
                    <div class="text-center" style="max-width:400px">
                        <p id="text-empty" class="text-muted mb-8">Belum ada data, silahkan isi master data <br/> untuk menambah data baru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/plugins/custom/jstree/jstree.bundle.js')}}"></script>
<script src="{{asset('assets/extends/js/page/struktur-organisasi.js')}}"></script>

<script>

</script>

@endsection
