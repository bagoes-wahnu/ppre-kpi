@extends('layout.main')
@section('content')
<style>
    .btn-dttb-type{width: 150px; padding:10px !important;}
</style>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card card-flush mb-5 mb-xl-10" id="kt_profile_details_view">
                <div class="card-header">
                    <div class="d-flex flex-column card-title m-0 py-5">
                        <h3 class="fw-bolder m-0">Master Data</h3>
                        <div class="text-gray-400 fw-bold fs-5 py-5">
                            Master data pada aplikasi Key Performance Indicator
                        </div>
                    </div>
                    <div class="d-flex flex-row m-0">
                        <a href="javascript:;" class="btn btn-primary align-self-center" onclick="create()">Tambah</a>
                    </div>
                </div>
                <div class="card-body px-9 pb-9 pt-0">
                    <div class="my-0">
                        <div class="row mx-0">
                            <button class="btn btn-sm btn-outline btn-outline-solid btn-outline-warning btn-active-light-warning btn-dttb-type me-3" id="btn-dttb-1" onclick="dttbType('1')">Perspektif</button>
                            <button class="btn btn-sm btn-outline btn-outline-solid btn-outline-warning btn-active-light-warning btn-dttb-type me-3" id="btn-dttb-2" onclick="dttbType('2')">Sasaran Strategis</button>
                            <button class="btn btn-sm btn-outline btn-outline-solid btn-outline-warning btn-active-light-warning btn-dttb-type me-3" id="btn-dttb-3" onclick="dttbType('3')">Parameter</button>
                        </div>
                        <div id="table-1" class="d-none dttb"></div>
                        <div id="table-2" class="d-none dttb"></div>
                        <div id="table-3" class="d-none dttb"></div>
                        {{-- <table id="kt_datatable_example_5" class="table gy-5 gs-7 table-row-bordered border rounded" id="dttb-master-data">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                    <th>No</th>
                                    <th>Parameter</th>
                                    <th>Sumber</th>
                                    <th>Satuan</th>
                                    <th>Kondisi</th>
                                    <th>Tipe YYD</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ROIC - WACC (Konsolodasi)</td>
                                    <td>RKAP</td>
                                    <td>%</td>
                                    <td>></td>
                                    <td>Accumulated</td>
                                    <td>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="" id="flexSwitchDefault"/>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-icon me-1" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_location">
                                            <span class="svg-icon svg-icon-2x svg-icon-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black" />
                                                    <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black" />
                                                    <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black" />
                                                </svg>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Customer Satisfaction Index (eksternal) (standalone)</td>
                                    <td>KPI Korporat</td>
                                    <td>RP</td>
                                    <td><</td>
                                    <td>Average</td>
                                    <td>
                                        <div class="form-check form-check-solid form-switch fv-row">
                                            <input class="form-check-input w-65px h-25px" type="checkbox" id="allowmarketing" checked="checked" />
                                            <label class="form-check-label" for="allowmarketing"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-icon me-1" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_location">
                                            <span class="svg-icon svg-icon-2x svg-icon-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black" />
                                                    <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black" />
                                                    <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black" />
                                                </svg>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>On Time On Budget (standalone)</td>
                                    <td>Spesifik</td>
                                    <td>Jumlah</td>
                                    <td>Optimal</td>
                                    <td>Last Value</td>
                                    <td>
                                        <div class="form-check form-check-solid form-switch fv-row">
                                            <input class="form-check-input w-65px h-25px" type="checkbox" id="allowmarketing" checked="checked" />
                                            <label class="form-check-label" for="allowmarketing"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-icon me-1" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_location">
                                            <span class="svg-icon svg-icon-2x svg-icon-warning">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black" />
                                                    <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black" />
                                                    <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black" />
                                                </svg>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-add" data-toggle="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <div class="modal-content">
                <form class="form" id="kt_modal_new_form">
                    <div class="modal-header" id="kt_modal_new_header">
                        <h2 id="modal-title">Tambah Master Parameter</h2>
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
						<div class="card card-xxl-stretch mb-5 mb-xl-8">
							<div class="card-header border-0 pt-5">
								<div class="card-toolbar">
									<ul class="nav">
										<div class="row" data-kt-buttons="true" data-kt-buttons-target="[data1-kt-button='true']">
											<div class="col-4 w-275px">
												<label class="mt-2 btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 ms-0 me-2 menu-form menu-1" data-bs-toggle="tab" href="#kt_widget_tab_1" data1-kt-button="true">
													<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
														<input class="form-check-input menu-1" type="radio" name="finance_usage" value="1"/>
													</span>
													<span class="ms-5 mt-2">
														<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">Perspektif</span>
													</span>
												</label>
											</div>
											<div class="col-4 w-300px">
												<label class="mt-2 btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 me-2 menu-form menu-2" data-bs-toggle="tab" href="#kt_widget_tab_2" data1-kt-button="true">
													<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
														<input class="form-check-input menu-2" type="radio" name="finance_usage" value="2"/>
													</span>
													<span class="ms-5 mt-2">
														<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">Sasaran Strategis</span>
													</span>
												</label>
											</div>
											<div class="col-4 w-275px">
												<label class="mt-2 btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 me-2 menu-form menu-3" data-bs-toggle="tab" href="#kt_widget_tab_3" data1-kt-button="true">
													<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
														<input class="form-check-input menu-3" type="radio" name="finance_usage" value="3"/>
													</span>
													<span class="ms-5 mt-2">
														<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">Parameter</span>
													</span>
												</label>
											</div>
										</div>
									</ul>
								</div>
							</div>
							<div class="card-body py-3">
								<div class="tab-content">
									<div class="tab-pane fade show active menu-form-pilih">
										<div class="card">
											<div class="card-body">
												<div class="text-center px-5">
													<img src="{{asset('assets/media/illustrations/search.png')}}" alt="" class="mw-100 h-200px h-sm-325px" />
													<p class="text-gray-400 fs-4 fw-bold py-7">Silahkan pilih menu diatas untuk membuat
													<br />data master parameter</p>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade menu-form" id="kt_widget_tab_1">
                                        <input type="hidden" id="id" value="">
										<div class="col-md-12 fv-row">
											<label class="fs-5 fw-bold mt-5 mb-2">Perspektif</label>
											<input id="nama-1" type="text" class="form-control" name="row-name" placeholder="Masukkan Perspektif" value="" />
										</div>
									</div>
									<div class="tab-pane fade menu-form" id="kt_widget_tab_2">
                                        <input type="hidden" id="id" value="">
										<div class="d-flex flex-column fv-row">
											<label class="fs-5 fw-bold mb-2">Perspektif</label>
											<select class="form-select select-perspektif" data-control="select2" data-dropdown-parent="#modal-add" id="select-perspektif-sasaran" name="param" style="width:100%">
											</select>
											{{-- <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Perspektif" name="perspektif">
												<option value="">Pilih Perspektif...</option>
												<option value="1">Customer</option>
												<option value="2">Financial</option>
												<option value="3">Internal Process Bussiness</option>
												<option value="4">Internal Bussiness Process</option>
												<option value="5">Learning & growth</option>
											</select> --}}
										</div>
										<div class="col-md-12 fv-row">
											<label class="fs-5 fw-bold mt-5 mb-2">Sasaran Strategis</label>
											<input type="text" class="form-control" id="sasaran-name" name="sasaran-name" placeholder="Masukkan Sasaran Strategis" value="" />
										</div>
									</div>
									<div class="tab-pane fade menu-form" id="kt_widget_tab_3">
                                        <input type="hidden" id="id" value="">
										<div class="d-flex flex-column mb-5 fv-row">
											<label class="fs-5 fw-bold mb-2">Perspektif</label>
											<select class="form-select select-perspektif" data-control="select2" data-dropdown-parent="#modal-add" id="select-perspektif-parameter" name="param" style="width:100%">
											</select>
											{{-- <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Perspektif" name="perspektif">
												<option value="">Pilih Perspektif...</option>
												<option value="1">Customer</option>
												<option value="2">Financial</option>
												<option value="3">Internal Process Bussiness</option>
												<option value="4">Internal Bussiness Process</option>
												<option value="5">Learning & growth</option>
											</select> --}}
										</div>
										<div class="d-flex flex-column mb-5 fv-row">
											<label class="fs-5 fw-bold mb-2">Sasaran Strategis</label>
											<select class="form-select" data-control="select2" data-hide-search="true" id="select-sasaran" name="sasaran_strategis">
												{{-- <option value="">Pilih Sasaran Strategis...</option>
												<option value="1">Increase Profitability</option>
												<option value="2">Increase Stakeholders Satisfaction</option>
												<option value="3">Improve construction operational process</option>
												<option value="4">Improve Financial capacity</option>
												<option value="5">Improve construction operational process</option> --}}
											</select>
										</div>
										<div class="d-flex flex-column mb-5 fv-row">
											<label class="fs-5 fw-bold mb-2">Parameter</label>
											<input type="text" class="form-control" placeholder="Tulis Parameter" id="parameter" name="parameter" />
										</div>
										<div class="d-flex flex-column mb-5 fv-row">
											<label class="fs-5 fw-bold mb-2">Formula</label>
											<input type="text" class="form-control" placeholder="Tulis Formula" id="formula" name="formula" />
										</div>
										<div class="row">
											<div class="col-md-4 fv-row">
												<label class="fs-5 fw-bold mb-2">Satuan</label>
												<input type="text" class="form-control" placeholder="Tulis Satuan" id="satuan" name="satuan" />
											</div>
											<div class="col-md-4 d-flex flex-column mb-5 fv-row">
												<label class="fs-5 fw-bold mb-2">Kondisi</label>
												<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Kondisi" id="select-kondisi" name="kondisi">
												</select>
											</div>
											<div class="col-md-4 d-flex flex-column mb-5 fv-row">
												<label class="fs-5 fw-bold mb-2">Tipe YTD</label>
												<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Tipe YTD" id="select-tipe-ytd" name="tipe_ytd">
												</select>
											</div>
										</div>
										<div class="row">
											<label class="fs-5 fw-bold mb-2">Sumber</label>
											<label class="d-flex text-start ms-0 me-2 w-175px">
												<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
													<input class="form-check-input radio-1" type="radio" name="sumber" value="1"/>
												</span>
												<span class="ms-5 mt-2">
													<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">KPI Korporat</span>
												</span>
											</label>
											<label class="d-flex text-start ms-0 me-2 w-175px">
												<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
													<input class="form-check-input radio-2" type="radio" name="sumber" value="2"/>
												</span>
												<span class="ms-5 mt-2">
													<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">Spesifik</span>
												</span>
											</label>
											<label class="d-flex text-start ms-0 me-2 w-175px">
												<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
													<input class="form-check-input radio-3" type="radio" name="sumber" value="3"/>
												</span>
												<span class="ms-5 mt-2">
													<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">RKAP</span>
												</span>
											</label>
										</div>
										<div class="col-md-12 fv-row">
											<label class="fs-5 fw-bold mb-2 mt-5">Keterangan</label>
											<textarea class="form-control" rows="4" id="keterangan" name="keterangan" placeholder="Keterangan tambahan"></textarea>
										</div>
										<div class="col-md-12 fv-row" id="evidence-list">
                                            <div class="row mx-0">
                                                <div class="col-12 p-0">
                                                    <label class="fs-5 fw-bold mt-2">Keterangan Tipe Evidence</label>
                                                </div>
                                                <div class="col-12 p-0">
                                                    <input type="text" class="form-control" name="evidence-name" placeholder="Masukkan keterangan tipe evidence" value="" />
                                                </div>
                                            </div>										
										</div>
										<div class="my-0">
											<div class="table-responsive">
												<table id="kt_create_new_custom_fields" class="table align-middle fw-bold fs-6 gy-2">
													<thead>
														<tr class="">
															<th class="pt-0"></th>
															<th class="pt-0"></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="col-12" style="display:none">
																<input type="text" class="form-control" name="row-name" placeholder="Masukkan keterangan tipe evidence" value="" />
															</td>
															<td style="display:none">
																<button type="button" class="btn btn-light-danger btn-flex btn-active-light-danger me-3" data-kt-action="field_remove">
																	<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
																	<span class="svg-icon svg-icon-2x">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
																			<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
																			<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
																		</svg>
																	</span>
																	DELETE
																</button>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<button type="button" class="btn btn-primary me-auto" id="btn-add-evidence" onclick="tambahEvidence()">Tambah Evidence</button>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="modal-footer flex-right">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Batal</button>
                        <button type="button" id="btn-tambah" onclick="simpan()" class="btn btn-primary d-none">
                            <span class="indicator-label">Simpan</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- <div class="modal fade" id="modal-edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <div class="modal-content">
                <form class="form" id="kt_modal_new_address_form">
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <h2>Tambah Master Parameter</h2>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body py-0">
                        <div class="card card-xxl-stretch mb-5 mb-xl-8">
							<div class="card-header border-0 pt-5">
								<div class="card-toolbar">
									<ul class="nav">
										<div class="row" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
											<div class="col-4 w-275px">
												<label class="mt-2 btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 ms-0 me-2 menu-form" data-bs-toggle="tab" href="#kt_table_widget_5_tab_1" data-kt-button="true">
													<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
														<input class="form-check-input" type="radio" name="finance_usage" value="4"/>
													</span>
													<span class="ms-5 mt-2">
														<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">Perspektif</span>
													</span>
												</label>
											</div>
											<div class="col-4 w-300px">
												<label class="mt-2 btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 me-2 menu-form" data-bs-toggle="tab" href="#kt_table_widget_5_tab_2" data-kt-button="true">
													<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
														<input class="form-check-input" type="radio" name="finance_usage" value="5"/>
													</span>
													<span class="ms-5 mt-2">
														<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">Sasaran Strategis</span>
													</span>
												</label>
											</div>
											<div class="col-4 w-275px">
												<label class="mt-2 btn btn-outline btn-outline-dashed btn-outline-default active d-flex text-start p-6 me-2 menu-form" data-bs-toggle="tab" href="#kt_table_widget_5_tab_3" data-kt-button="true">
													<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
														<input class="form-check-input" type="radio" name="finance_usage" value="6" checked="checked"/>
													</span>
													<span class="ms-5 mt-2">
														<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">Parameter</span>
													</span>
												</label>
											</div>
										</div>
									</ul>
								</div>
							</div>
							<div class="card-body py-3">
								<div class="tab-content">
									<div class="tab-pane fade menu-form" id="kt_table_widget_5_tab_1">
										<div class="col-md-12 fv-row">
											<label class="fs-5 fw-bold mt-5 mb-2">Perspektif</label>
											<input type="text" class="form-control" name="row-name" placeholder="Masukkan Perspektif" value="" />
										</div>
									</div>
									<div class="tab-pane fade menu-form" id="kt_table_widget_5_tab_2">
										<div class="d-flex flex-column fv-row">
											<label class="fs-5 fw-bold mb-2">Perspektif</label>
											<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Perspektif" name="perspektif">
												<option value="">Pilih Perspektif...</option>
												<option value="1">Customer</option>
												<option value="2">Financial</option>
												<option value="3">Internal Process Bussiness</option>
												<option value="4">Internal Bussiness Process</option>
												<option value="5">Learning & growth</option>
											</select>
										</div>
										<div class="col-md-12 fv-row">
											<label class="fs-5 fw-bold mt-5 mb-2">Sasaran Strategis</label>
											<input type="text" class="form-control" name="row-name" placeholder="Masukkan Sasaran Strategis" value="" />
										</div>
									</div>
									<div class="tab-pane fade menu-form" id="kt_table_widget_5_tab_3">
										<div class="d-flex flex-column mb-5 fv-row">
											<label class="fs-5 fw-bold mb-2">Perspektif</label>
											<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Perspektif" name="perspektif">
												<option value="">Pilih Perspektif...</option>
												<option value="1">Customer</option>
												<option value="2">Financial</option>
												<option value="3">Internal Process Bussiness</option>
												<option value="4">Internal Bussiness Process</option>
												<option value="5">Learning & growth</option>
											</select>
										</div>
										<div class="d-flex flex-column mb-5 fv-row">
											<label class="fs-5 fw-bold mb-2">Sasaran Strategis</label>
											<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Sasaran Strategis" name="sasaran_strategis">
												<option value="">Pilih Sasaran Strategis...</option>
												<option value="1">Increase Profitability</option>
												<option value="2">Increase Stakeholders Satisfaction</option>
												<option value="3">Improve construction operational process</option>
												<option value="4">Improve Financial capacity</option>
												<option value="5">Improve construction operational process</option>
											</select>
										</div>
										<div class="d-flex flex-column mb-5 fv-row">
											<label class="fs-5 fw-bold mb-2">Parameter</label>
											<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Parameter" name="parameter">
												<option value="">Pilih Parameter...</option>
												<option value="1">Increase Profitability</option>
												<option value="2">Increase Stakeholders Satisfaction</option>
												<option value="3">Improve construction operational process</option>
												<option value="4">Improve Financial capacity</option>
												<option value="5">Improve construction operational process</option>
											</select>
										</div>
										<div class="d-flex flex-column mb-5 fv-row">
											<label class="fs-5 fw-bold mb-2">Formula</label>
											<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Formula" name="formula">
												<option value="">Pilih Formula...</option>
												<option value="1">Increase Profitability</option>
												<option value="2">Increase Stakeholders Satisfaction</option>
												<option value="3">Improve construction operational process</option>
												<option value="4">Improve Financial capacity</option>
												<option value="5">Improve construction operational process</option>
											</select>
										</div>
										<div class="row">
											<div class="col-md-4 fv-row">
												<label class="fs-5 fw-bold mb-2">Satuan</label>
												<input type="text" class="form-control" placeholder="Satuan" name="satuan" />
											</div>
											<div class="col-md-4 d-flex flex-column mb-5 fv-row">
												<label class="fs-5 fw-bold mb-2">Kondisi</label>
												<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Kondisi" name="kondisi">
													<option value="">Pilih Kondisi...</option>
													<option value="1">></option>
													<option value="2">=</option>
													<option value="3"><</option>
													<option value="4">>=</option>
													<option value="5">Optimal</option>
												</select>
											</div>
											<div class="col-md-4 d-flex flex-column mb-5 fv-row">
												<label class="fs-5 fw-bold mb-2">Tipe YYD</label>
												<select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Tipe YYD" name="tipe_yyd">
													<option value="">Tipe YYD...</option>
													<option value="1">Accumulated</option>
													<option value="2">Average</option>
													<option value="3">Last Value</option>
													<option value="4">Min</option>
													<option value="5">Max</option>
												</select>
											</div>
										</div>
										<div class="row">
											<label class="fs-5 fw-bold mb-2">Sumber</label>
											<label class="d-flex text-start ms-0 me-2 w-175px">
												<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
													<input class="form-check-input" type="radio" name="finance_usage" value="kpi_korporat"/>
												</span>
												<span class="ms-5 mt-2">
													<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">KPI Korporat</span>
												</span>
											</label>
											<label class="d-flex text-start ms-0 me-2 w-175px">
												<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
													<input class="form-check-input" type="radio" name="finance_usage" value="spesifik"/>
												</span>
												<span class="ms-5 mt-2">
													<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">Spesifik</span>
												</span>
											</label>
											<label class="d-flex text-start ms-0 me-2 w-175px">
												<span class="form-check form-check-custom form-check-solid form-check-sm align-items-middle mt-1">
													<input class="form-check-input" type="radio" name="finance_usage" value="rkap"/>
												</span>
												<span class="ms-5 mt-2">
													<span class="fs-4 fw-bolder text-gray-800 mb-2 d-block">RKAP</span>
												</span>
											</label>
										</div>
										<div class="col-md-12 fv-row">
											<label class="fs-5 fw-bold mb-2 mt-5">Keterangan</label>
											<textarea class="form-control" rows="4" name="keterangan" placeholder="Keterangan tambahan"></textarea>
										</div>
										<div class="col-md-12 fv-row" id="evidence-list">
                                            <div class="row mx-0">
                                                <div class="col-12 p-0">
                                                    <label class="fs-5 fw-bold mt-5">Keterangan Tipe Evidence</label>
                                                </div>
                                                <div class="col-12 p-0">
                                                    <input type="text" class="form-control" name="row-name" placeholder="Masukkan keterangan tipe evidence" value="" />
                                                </div>
                                            </div>										
										</div>
										<div class="my-0">
											<div class="table-responsive">
												<table id="kt_create_new_custom_fields" class="table align-middle fw-bold fs-6 gy-2">
													<thead>
														<tr class="">
															<th class="pt-0"></th>
															<th class="pt-0"></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="col-12" style="display:none">
																<input type="text" class="form-control" name="row-name" placeholder="Masukkan keterangan tipe evidence" value="" />
															</td>
															<td style="display:none">
																<button type="button" class="btn btn-light-danger btn-flex btn-active-light-danger me-3" data-kt-action="field_remove">
																	<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
																	<span class="svg-icon svg-icon-2x">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																			<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
																			<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
																			<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
																		</svg>
																	</span>
																	DELETE
																</button>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<button type="button" class="btn btn-primary me-auto" id="kt_create_new_custom_fields_add">Tambah Evidence</button>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="modal-footer flex-right">
                        <button type="submit" id="kt_docs_sweetalert_edit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <script src="{{asset('assets/extends/js/page/master-data.js')}}"></script>
@endsection
{{-- <script src="//maps.google.com/maps/api/js?libraries=places&libraries=drawing&callback=renderMap&key={{ env('GMAPS_KEY') }}" async defer></script> --}}
{{-- <script src="{{asset('assets/js/pages/dashboard.js')}}"></script> --}}
{{-- <script src="{{asset('assets/js/custom/documentation/general/datatables/advanced.js')}}"></script>
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/subscriptions/add/advanced.js')}}"></script> --}}


