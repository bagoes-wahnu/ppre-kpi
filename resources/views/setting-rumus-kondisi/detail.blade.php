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

        <p><span class="font-weight-bolder">Setting Rumus Kondisi</span> <span class="text-muted">| <a class="text-muted" href="{{ url('setting-rumus') }}" >Tahun</a>  - Setting Rumus Kondisi</span> </p>
        <h1 class="title" id="year-title"></h1>
    </div>
    <div id="kt_content_container" class="container-xxl">
        <div class="card card-flush mb-5 mb-xl-10" id="kt_profile_details_view">
            <div class="card-header">
                <div class="d-flex flex-column card-title m-0 py-5">
                    <h3 class="fw-bolder m-0">Setting Rumus Kondisi</h3>
                    <div class="text-gray-400 fw-bold fs-5 py-2 text-xs">
                        Pengaturan rumus kondisi pada aplikasi Key Performance Indicator  
                    </div>
                    <input type="hidden" id="id" value="{{$id}}">
                </div>
                <div class="d-flex flex-row m-0 " id="div-simpan">
                    
                    <a href="javascript:;" class="btn btn-darkblue align-self-center" onclick="simpan()">Simpan</a>
                </div>
                <div class="d-flex flex-row row col-12 p-0 m-0">
                    
                    <div id="list-rumus-kondisi" class="parameter row mx-0">

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



<script src="{{asset('assets/extends/js/page/setting-rumus-detail.js')}}"></script>

@endsection
