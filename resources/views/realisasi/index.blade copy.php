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

    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }

</style>
<link href="https://cdn.datatables.net/fixedcolumns/4.0.1/css/fixedColumns.dataTables.min.css" rel="stylesheet"type="text/css" />
<link href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.dataTables.min.css" rel="stylesheet"type="text/css" />

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
                    <button class="btn btn-sm btn-light-success align-self-center me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
                    <div class="col-md-4 pe-2 ps-0">
                        <select class="form-select select_unit" id="select_unit" data-control="select2" data-placeholder="Pilih korporat/unit">
                        </select>
                    </div>
                    <div class="col-md-2 pe-0">
                        <input id="tanggal" type="text" class="form-control" readonly="readonly" placeholder="Pilih Tahun" readonly/>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-warning" onclick="filter()">Tampilkan</button>
                    </div>
                    <div class="col-12 row mx-0 my-6 px-0">
                        {{-- <div class="col-md-12">

                        </div>
                        <div class="col-md-5">
                            <table class="table table-bordered table-row-gray-300 gy-3 table-fixed" id="dttb-table-freeze">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                </label>
                                            </div>
                                        </th>
                                        <th>Perspective</th>
                                        <th>Sasaran Strategis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-7 div-table" id="dttb-realisasi"> --}}
                            <table class="table table-bordered table-row-gray-300 gy-3 table-fixed" id="dttb-table-realisasi">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <div class="form-check form-check-custom form-check-solid form-check-sm">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                </label>
                                            </div>
                                        </th>
                                        <th>Perspective</th>
                                        <th>Sasaran Strategis</th>
                                        <th>Parameter</th>
                                        <th>Formula</th>
                                        <th>Sumber</th>
                                        <th>Tipe Evidence</th>
                                        <th>Satuan</th>
                                        <th>Kondisi</th>
                                        <th>Target</th>
                                        <th>Bobot Q1 (%)</th>
                                        <th>Real Q1</th>
                                        <th>Skor Q1</th>
                                        <th>Skor x Bobot Q1</th>
                                        <th>Tipe YTD</th>
                                        <th>PIC</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   {{-- <tr>
                                        <td>1</td>
                                        <td>
                                            <span class="label label-inline label-light-success">Tender</span>
                                        </td>
                                        <td>2020/2/01/002</td>
                                        <td>DIV GED I (TT)</td>
                                        <td>
                                            419005 - Louvin student apartment<br/>
                                            <span class="text-warning font-weight-bold">NK-PPN : 7,40%</span>
                                        </td>
                                        <td>10-12-2020</td>
                                        <td>
                                        <span class="dtr-data"><span class="label label-success label-dot mr-2"></span><span class="font-weight-bold text-success">Menang</span></span>
                                        </td>
                                        <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>
                                            <div class="dropdown-menu" style="width:15vw">
                                                <a class="dropdown-item" onclick="detail()" href="javascript:;"><i class="fas fa-eye text-dark mr-2"></i><span>Detail</span></a>
                                                <a class="dropdown-item" href="{{url('tender/rencana-realisasi')}}"><i class="fas fa-bug text-dark mr-2"></i><span>Risiko, Mitigasi <br>Rencana & Residual</span></a>
                                                <a class="dropdown-item" href="{{url('tender/risiko-aktual')}}"><i class="fas fa-cube text-dark mr-2"></i><span>Mitigasi Realisasi & <br>Nilai Realisasi Aktual</span></a>
                                                <a class="dropdown-item" onclick="lanjutOperasi()" href="javascript:;"><i class="fas fa-folder-open text-dark mr-2"></i><span>Lanjutkan ke Operasi</span></a>
                                                <a class="dropdown-item" onclick="tenderKalah()" href="javascript:;"><i class="fas fa-shield-virus text-dark mr-2"></i><span>Set Tender Kalah</span></a>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>--}}
                                </tbody>
                            </table>
                        {{-- </div> --}}
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

<script src="{{asset('assets/extends/js/page/realisasi-kpi.js')}}"></script>
<script>
   
</script>
@endsection
