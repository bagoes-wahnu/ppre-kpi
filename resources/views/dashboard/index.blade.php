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

    .table-verifikasi tr td,.table-verifikasi tr th{
        vertical-align:middle;
        text-align:center;
    }

    .table-mapping tr td,.table-mapping tr th{
        vertical-align:middle;
        text-align:center;
        padding: 5px !important;
        font-size: 12px;
    }

    .table-keterangan tr td,.table-keterangan tr th{
        vertical-align:middle;
        text-align:center;
        padding: 5px !important;
    }

    .table-keterangan tr td{
        color:#aaa;
    }

</style>

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card card-flush mb-5 mb-xl-10" id="kt_profile_details_view">
            <div class="card-header">
                <div class="d-flex flex-column card-title m-0 py-5">
                    <h3 class="fw-bolder m-0">Status Verifikasi</h3>
                    <div class="text-gray-400 fw-bold fs-5 py-2 text-xs">
                        Status pada tahun 2021 pada semua unit / divisi
                    </div>
                </div>
                <div class="d-flex flex-row m-0"></div>
            </div>
            <div class="card-body pb-9 px-9 pt-0">
                <div class="col-12 px-0 row mx-0">
                    <div class="col-10 pe-0">
                        <span class="badge badge-light-success me-4">Disetujui</span>
                        <span class="badge badge-light-warning">Menunggu</span>
                    </div>
                    <div class="col-2 text-right">
                        <select class="form-select" aria-label="Select example">
                            <option value="1">2021</option>
                            <option value="2">2020</option>
                            <option value="3">2019</option>
                        </select>
                    </div>
                </div>
                <div class="my-0">
                    <table class="table gy-5 gs-7 table-row-bordered border rounded table-verifikasi">
                        <thead>
                            <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                <th>No</th>
                                <th>Nama Unit</th>
                                <th>Status Verifikasi Target</th>
                                <th>Status Verifikasi TW 1</th>
                                <th>Status Verifikasi TW 2</th>
                                <th>Status Verifikasi TW 3</th>
                                <th>Status Verifikasi TW 4</th>
                                <th>Status Verifikasi Akhir Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>KPI Korporat</td>
                                <td class="bg-light-success fw-bolder text-success">Disetujui</td>
                                <td class="bg-light-warning fw-bolder text-warning">Menunggu</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card card-flush mb-5 mb-xl-10" id="kt_profile_details_view">
            <div class="card-header">
                <div class="d-flex flex-column card-title m-0 py-5">
                    <h3 class="fw-bolder m-0">Grafik Realisasi KPI Korporat dan Unit</h3>
                    <div class="text-gray-400 fw-bold fs-5 py-2 text-xs">
                        Realisasi (Triwulan Saat Ini: 4) untuk satuan Rp Mohon diinput dalam juta (1000 = 1 M)
                    </div>
                </div>
                <div class="d-flex flex-row m-0"></div>
            </div>
            <div class="card-body pb-9 px-9 pt-0">
                <div class="col-12 px-0 mb-6 row mx-0">
                    <div class="col-1 ps-0 py-3">Unit</div>
                    <div class="col-md-3 pe-2">
                        <select class="form-select" data-control="select2" data-placeholder="Pilih korporat/unit">
                            <option></option>
                            <option value="1">Option 1</option>
                            <option value="2">Option 2</option>
                        </select>
                    </div>
                    <div class="col-md-2 pe-0">
                        <input id="tanggal" type="text" class="form-control" readonly="readonly" placeholder="Pilih Tahun" readonly/>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-warning">Tampilkan</button>
                    </div>
                </div>
                <div class="my-0">
                    <div id="chart" style="height: 500px"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card card-flush mb-5 mb-xl-10" id="kt_profile_details_view">
            <div class="card-header">
                <div class="d-flex flex-column card-title m-0 py-5">
                    <h3 class="fw-bolder m-0">Mapping Skor KPI</h3>
                    <div class="text-gray-400 fw-bold fs-5 py-2 text-xs">
                        Realisasi (Triwulan Saat ini: 4) untuk satuan Rp Mohon diinput dalam juta (1000 = 1M)
                    </div>
                </div>
                <div class="d-flex flex-row m-0">
                    <button type="button" class="btn btn-light-info align-self-center" onclick="openKeterangan()"><i class="bi bi-book-half me-4"></i> Keterangan Skor</button>
                </div>
            </div>
            <div class="card-body pb-9 px-9 pt-0">
                <div class="my-0">
                    <table class="table gy-5 gs-7 table-row-bordered border rounded table-mapping">
                        <thead>
                            <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Unit</th>
                                <th colspan="3">Q1</th>
                                <th colspan="3">Q2</th>
                                <th colspan="3">Q3</th>
                                <th colspan="3">Q4</th>
                                <th colspan="3">Final</th>
                            </tr>
                            <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                <th>Skor</th>
                                <th>Mapping</th>
                                <th>Rank</th>
                                <th>Skor</th>
                                <th>Mapping</th>
                                <th>Rank</th>
                                <th>Skor</th>
                                <th>Mapping</th>
                                <th>Rank</th>
                                <th>Skor</th>
                                <th>Mapping</th>
                                <th>Rank</th>
                                <th>Skor</th>
                                <th>Mapping</th>
                                <th>Rank</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>KPI Korporat</td>
                                <td class="bg-success fw-bolder text-light">35</td>
                                <td class="bg-success fw-bolder text-light">A</td>
                                <td class="fw-bolder">-</td>
                                <td class="bg-success fw-bolder text-light">35</td>
                                <td class="bg-success fw-bolder text-light">A</td>
                                <td class="fw-bolder">-</td>
                                <td class="bg-success fw-bolder text-light">35</td>
                                <td class="bg-success fw-bolder text-light">A</td>
                                <td class="fw-bolder">-</td>
                                <td class="bg-success fw-bolder text-light">35</td>
                                <td class="bg-success fw-bolder text-light">A</td>
                                <td class="fw-bolder">-</td>
                                <td class="bg-success fw-bolder text-light">35</td>
                                <td class="bg-success fw-bolder text-light">A</td>
                                <td class="fw-bolder">-</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Departemen Manajemen Risiko</td>
                                <td class="bg-warning fw-bolder text-light">35</td>
                                <td class="bg-warning fw-bolder text-light">A</td>
                                <td class="fw-bolder">-</td>
                                <td class="bg-warning fw-bolder text-light">35</td>
                                <td class="bg-warning fw-bolder text-light">A</td>
                                <td class="fw-bolder">-</td>
                                <td class="bg-warning fw-bolder text-light">35</td>
                                <td class="bg-warning fw-bolder text-light">A</td>
                                <td class="fw-bolder">-</td>
                                <td class="bg-warning fw-bolder text-light">35</td>
                                <td class="bg-warning fw-bolder text-light">A</td>
                                <td class="fw-bolder">-</td>
                                <td class="bg-warning fw-bolder text-light">35</td>
                                <td class="bg-warning fw-bolder text-light">A</td>
                                <td class="fw-bolder">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Keterangan Skor KPI</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>

            <div class="modal-body">
                <table class="table gy-5 gs-7 table-row-bordered border rounded table-keterangan">
                    <thead>
                        <tr class="fw-bolder fs-6 bg-secondary text-gray-800 px-7">
                            <th>MAPPING</th>
                            <th>SCORE</th>
                            <th>KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-light" style="background-color: #50CD89">A</td>
                            <td>35 - 40</td>
                            <td>High</td>
                        </tr>
                        <tr>
                            <td class="text-light" style="background-color: #1BC5BD">B</td>
                            <td>29 - 34</td>
                            <td>Medium High</td>
                        </tr>
                        <tr>
                            <td class="text-light" style="background-color: #FFA800">C</td>
                            <td>23 - 28</td>
                            <td>Medium</td>
                        </tr>
                        <tr>
                            <td class="text-light" style="background-color: #FFC700">D</td>
                            <td>17 - 22</td>
                            <td>Low - Medium</td>
                        </tr>
                        <tr>
                            <td class="text-light" style="background-color: #F1416C">E</td>
                            <td>10 - 16</td>
                            <td>Low</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer flex-right">
                <button type="reset" onclick="closeKeterangan()" class="btn btn-light me-3">Tutup</button>
            </div>
        </div>
    </div>
</div> 

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    //color green,teal,orange,yellow,red
    let colorStatus=['#50CD89',"#1BC5BD","#FFA800","#FFC700","#F1416C"]

    function openKeterangan(){
        $('#modal').modal('show')
    }

    function closeKeterangan(){
        $('#modal').modal('hide')
    }

    $(document).on("change", '#hapus-tahun', function (e) {
        let ids=$(this).val()
        console.log($(this).prop('checked'))
        if($(this).prop('checked')){
            $('.props-warning').addClass('active')
        }else{
            $('.props-warning').removeClass('active')
        }
    });

    $('#tanggal').datepicker({
        rtl: KTUtil.isRTL(),
        format: "yyyy",
        autoclose:true,
        todayHighlight: true,
        viewMode: "years",
        minViewMode: "years"
    });

    //chart
    // GOOGLE CHARTS INIT
    google.load('visualization', '1', {
        packages: ['corechart', 'bar', 'line']
    });

    google.setOnLoadCallback(function () {
        // LINE CHART
        var data = new google.visualization.DataTable();
        data.addColumn('string', '');
        data.addColumn('number', 'Departemen Pemasaran Korporat');
        data.addColumn('number', 'Departemen Operasional');
        data.addColumn('number', 'Divisi Operasi 1');
        data.addColumn('number', 'Divisi Operasi 2');
        data.addColumn('number', 'Divisi Operasi 3');
        data.addColumn('number', 'Divisi Operasi 4');
        data.addColumn('number', 'Divisi Operasi 5');

        data.addRows([
            ['Triwulan 1 (C)',18, 6, 14, 18, 6, 4, 18],
            ['Triwulan 2 (B)',2, 21, 4, 7, 2, 9, 9],
            ['Triwulan 3 (B)',10, 14, 15, 13, 13, 2, 17],
            ['Triwulan 4 (C)',18, 17, 4, 13, 15, 23, 14],
            ['Akhir Thn ()',6, 23, 12, 20, 3, 6, 3]
        ]);

        var options = {
            curveType: 'function',
            legend: { position: 'bottom' },
            chart: {
                // title: 'Box Office Earnings in First Two Weeks of Opening',
                // subtitle: 'in millions of dollars (USD)'
               
            },
            colors: ['#F1416C','#50CD89','#8950FC','#009EF7','#F64E60','#FFC700','#7239EA'],
            chartArea:{left:40,top:20,bottom:100,width:'100%'},
            hAxis: { ticks: [0,5,10,15,20,25],titleTextStyle:{color: '#aaa'} },
            tooltip: {isHtml: true},
            //focusTarget:'category'
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart'));
        chart.draw(data, options);
    });

</script>



@endsection
