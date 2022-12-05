jQuery(document).ready(function ($) {
    show();
    pageActive();

    $(document).on("change", "#hapus-tahun", function (e) {
        let ids = $(this).val();

        if ($(this).prop("checked")) {
            $(".props-warning").addClass("active");
        } else {
            $(".props-warning").removeClass("active");
        }
    });

    $("#tanggal").datepicker({
        // rtl: KTUtil.isRTL(),
        format: "yyyy",
        autoclose: true,
        todayHighlight: true,
        viewMode: "years",
        minViewMode: "years",
    });
});

function pageActive() {
    $("#nav-setting-rumus").addClass("active");
}

function show() {
    $(".datepicker-dropdown").css("display", "none");

    ewpLoadingShow();
    $.ajax({
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: urlApi + "setting-kpi/condition-formula-years",
        beforeSend: function (xhr) {
            xhr.setRequestHeader(
                "Authorization",
                "Bearer " + localStorage.getItem("ppre_token")
            );
        },
        success: function (response) {
            let res = response.data.condition_formula_years;
            // console.log(res)

            let showOnUnit = "";
            if (rl_now == rl_unit||rl_now==rl_direksi) {
                showOnUnit = "d-none";
            } else {
                showOnUnit = "";
            }

            let html =
                `
            <div id="btn-create" class="col-md-3 px-2 py-2` +
                showOnUnit +
                `" style="width:20%;cursor:pointer;" onclick="create()">
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
            `;

            for (i in res) {
                let checked = res[i].is_active ? "checked='checked'" : "";
                html +=
                    `
                <div class="col-md-3 px-2 py-2" style="width:20%;">
                <div class=" text-center setting-item border rounded p-4" style="background-color:#fff;height:100%;min-height:120px">
                    <p class="text-dark fw-bolder mb-0" id="title-1" style="font-size:3rem;cursor:pointer;" onclick="detail('` +
                    res[i].id +
                    `','` +
                    res[i].year +
                    `')">` +
                    res[i].year +
                    `</p>
                    <div class="row mx-0 ` +
                    showOnUnit +
                    `">
                        <div class="col-md-6 text-center py-3 px-6">
                            <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-20px w-30px" type="checkbox" value="" ` +
                    checked +
                    ` id="check-` +
                    res[i].id +
                    `" onclick="changeStatus('` +
                    res[i].id +
                    `')"/>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <button type="button" class="btn btn-light-warning btn-sm" onclick="editSetting('` +
                    res[i].id +
                    `','` +
                    res[i].year +
                    `')">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
                `;
            }
            $("#list-time").html(html);
            ewpLoadingHide()

            $("#modal").modal("hide");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#modal").modal("hide");
            ewpLoadingHide()
            handleErrorDetail(xhr);

        },
    });
}

function resetForm() {
    $("#modal #id").val("");
    $("#modal .hapus-time").addClass("d-none");
    $("#modal #hapus-tahun").prop("checked", false);
    $("#tanggal").val('')
}

function detail(id, year) {
    window.location.href = baseUrl + "setting-rumus/" + id + "?year=" + year;
}

function create() {
    resetForm();
    $("#modal").modal("show");
    // $('#btn-simpan')
}

function editSetting(param, year) {
    $("#tanggal").val("");
    $("#modal #hapus-tahun").prop("checked", false);
    $(".props-warning").removeClass("active");

    $("#modal #id").val(param);
    $("#modal #poin-maksimal").val($("#input-" + param).val());
    $("#modal .modal-title,#modal .modal-desc").html(
        $("#title-" + param).html()
    );

    $("#modal .hapus-time").removeClass("d-none");
    $("#modal #tanggal").val(year);

    $("#modal").modal("show");
}

function simpan() {
    ewpLoadingShow();

    let data = "year=" + $("#modal #tanggal").val();
    let link =
        $("#modal #id").val() == ""
            ? urlApi + "setting-kpi/condition-formula-years?" + data
            : urlApi +
              "setting-kpi/condition-formula-years/" +
              $("#modal #id").val() +
              "?" +
              data;

    let tipe = $("#modal #id").val() == "" ? "POST" : "PUT";

    if ($("#modal #hapus-tahun").prop("checked") == false) {
        $.ajax({
            type: tipe,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization: "Bearer " + localStorage.getItem("ppre_token"),
            },
            url: link,
            success: function (response) {
                ewpLoadingHide();
                let status =
                    $("#modal #id").val() == "" ? "disimpan" : "dirubah";

                Swal.fire({
                    title: "Berhasil!",
                    text: "Data berhasil " + status + ".",
                    icon: "success",
                }).then((result) => {
                    show();
                    $(".datepicker-dropdown").css("display", "none");
                    $("#modal").modal("hide");
                });
                $(".datepicker-dropdown").css("display", "none");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $(".datepicker-dropdown").css("display", "none");
                ewpLoadingHide();
                handleErrorDetail(xhr);
            },
        });
    } else {
        hapus($("#modal #id").val());
    }
}

function changeStatus(id) {
    let status = $("#check-" + id).prop("checked") ? 1 : 0;

    $.ajax({
        type: "PUT",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: "Bearer " + localStorage.getItem("ppre_token"),
        },
        url: urlApi + "setting-kpi/condition-formula-years/" + id + "?is_active=" + status,
        success: function (response) {
            toastr.optionsOverride = 'positionclass = "toast-bottom-right"';
            toastr.options.positionClass = "toast-bottom-right";
            toastr.success(response.status.message);
            // show();
        },
        error: function (response) {
            handleError(response);
        },
    });
}

function hapus(id) {
    $.ajax({
        type: "DELETE",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: "Bearer " + localStorage.getItem("ppre_token"),
        },
        url: urlApi + "setting-kpi/condition-formula-years/" + id,
        success: function (response) {
            Swal.fire({
                title: "Berhasil!",
                text: "Data berhasil dihapus.",
                icon: "success",
            }).then((result) => {
                show();
                $(".datepicker-dropdown").css("display", "none");
                $("#modal").modal("hide");
            });
            $(".datepicker-dropdown").css("display", "none");
            ewpLoadingHide()
        },
        error: function (response) {
            handleError(response);
        },
    });
}

toastr.options = {
    closeButton: false,
    debug: false,
    newestOnTop: false,
    progressBar: false,
    positionClass: "toast-bottom-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};
