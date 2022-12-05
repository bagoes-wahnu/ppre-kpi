let statusForm = "";
let objEvidence = [];
let dttbTypeData=""

$(document).ready(function () {
    dttbType('3')
    table();
    tablePerspective();
    tableSasaran();

    pageActive();

    $(document).on("click", '[name="finance_usage"]', function (e) {
        let ids = $(this).val();
        statusForm = ids;
        let fu=$('[name="finance_usage"]').serializeArray()
        if(fu.length>0){
            $('#btn-tambah').removeClass('d-none')
        }
    });

    $(document).on("change", ".select-perspektif", function (e) {
        let ids = $(this).val();
        sSasaran(ids);
        $("#select-sasaran").prop("disabled", false);
    });
});

function pageActive() {
    $("#nav-master-data").addClass("active");
}

function dttbType(param){
    dttbTypeData=param
    $('.dttb').addClass('d-none')
    $('#table-'+param).removeClass('d-none')
    $('.btn-dttb-type').removeClass('btn-warning').addClass('btn-outline-warning')
    $('#btn-dttb-'+param).addClass('btn-warning').removeClass('btn-outline-warning')
}

function table() {
    document.getElementById("table-3").innerHTML = ewpTable({
        targetId: "dttb-master-data",
        class: "table gy-5 gs-7 table-row-bordered border rounded",
        column: [
            { name: "No", width: "10" },
            { name: "Parameter", width: "20" },
            { name: "Sumber", width: "20" },
            { name: "Satuan", width: "10" },
            { name: "Kondisi", width: "10" },
            { name: "Tipe YTD", width: "20" },
            { name: "Status", width: "15" },
            { name: "Action", width: "10" },
        ],
    });

    geekDatatables({
        target: "#dttb-master-data",
        url: urlApi + "master-data",
        sorting: [0, "desc"],
        apiKey: "data",
        column: [
            {
                col: "id",
                mid: true,
                mod: {
                    aTargets: [0],
                    bSortable: false,
                    bSearchable: false,
                    mRender: function (data, type, full, draw) {
                        var row = draw.row;
                        var start = draw.settings._iDisplayStart;
                        var length = draw.settings._iDisplayLength;

                        var counter = start + 1 + row;

                        return counter;
                    },
                },
            },
            {
                col: "parameter",
                mid: true,
                mod: {
                    aTargets: [1],
                    //bSortable:false,
                    mRender: function (data, type, full, draw) {
                        return data;
                    },
                },
            },
            {
                col: "sumber",
                mid: true,
                mod: {
                    aTargets: [2],
                    //bSortable:false,
                    mRender: function (data, type, full, draw) {
                        return data;
                    },
                },
            },
            {
                col: "satuan",
                mid: true,
                mod: {
                    aTargets: [3],
                    //bSortable:false,
                    mRender: function (data, type, full, draw) {
                        return data;
                    },
                },
            },
            {
                col: "kondisi.name",
                mid: true,
                mod: {
                    aTargets: [4],
                    bSearchable:false,
                    bSortable:false,
                    mRender: function (data, type, full, draw) {
                        let dataShow =
                            full?.kondisi?.value !== undefined
                                ? full?.kondisi?.value
                                : "-";
                        return dataShow;
                    },
                },
            },
            {
                col: "type_ytd",
                mid: true,
                mod: {
                    aTargets: [5],
                    bSearchable:false,
                    bSortable:false,
                    mRender: function (data, type, full, draw) {
                        let dataShow =
                            full?.type_ytd?.value !== undefined
                                ? full?.type_ytd?.value
                                : "-";
                        return dataShow;
                    },
                },
            },
            {
                col: "status",
                mid: true,
                mod: {
                    aTargets: [6],
                    //bSortable:false,
                    mRender: function (data, type, full, draw) {
                        let statusCheck =
                            data == true ? "checked='checked'" : "";
                        let html =
                            `
                    <div style="justify-content: center;display: flex;">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" ` +
                            statusCheck +
                            ` value="` +
                            full.id +
                            `" onclick="changeStatus(` +
                            full.id +
                            `)" id="flexSwitchDefault"/>
                        </div>
                    </div>`;
                        return html;
                    },
                },
            },
            {
                col: "id",
                mid: true,
                mod: {
                    aTargets: [-1],
                    bSortable: false,
                    bSearchable: false,
                    mRender: function (data, type, full) {
                        var button =
                            `
                <a class="btn btn-sm btn-icon me-1" href="javascript:;" onclick="edit(` +
                            data +
                            `)">
                    <span class="svg-icon svg-icon-2x svg-icon-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black" />
                            <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black" />
                            <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black" />
                        </svg>
                    </span>
                </a>`;

                        return button;
                    },
                },
            },
        ],
    });
}

function tablePerspective() {
    document.getElementById("table-1").innerHTML = ewpTable({
        targetId: "dttb-master-perspective",
        class: "table gy-5 gs-7 table-row-bordered border rounded",
        column: [
            { name: "No", width: "10" },
            { name: "Perspective", width: "65" },
            { name: "Status", width: "15" },
            { name: "Action", width: "10" },
        ],
    });

    geekDatatables({
        target: "#dttb-master-perspective",
        url: urlApi + "master-data/perspectives",
        sorting: [1, "desc"],
        apiKey: "data",
        column: [
            {
                col: "id",
                mid: true,
                mod: {
                    aTargets: [0],
                    bSortable: false,
                    bSearchable: false,
                    mRender: function (data, type, full, draw) {
                        var row = draw.row;
                        var start = draw.settings._iDisplayStart;
                        var length = draw.settings._iDisplayLength;

                        var counter = start + 1 + row;

                        return counter;
                    },
                },
            },
            {
                col: "name",
                mid: true,
                mod: {
                    aTargets: [1],
                    //bSortable:false,
                    mRender: function (data, type, full, draw) {
                        return data;
                    },
                },
            },
            {
                col: "status",
                mid: true,
                mod: {
                    aTargets: [2],
                    //bSortable:false,
                    mRender: function (data, type, full, draw) {
                        let statusCheck =
                            data == true ? "checked='checked'" : "";
                        let html =
                            `
                    <div style="justify-content: center;display: flex;">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" ` +
                            statusCheck +
                            ` value="` +
                            full.id +
                            `" onclick="changeStatus(` +
                            full.id +
                            `)" id="flexSwitchDefault"/>
                        </div>
                    </div>`;
                        return html;
                    },
                },
            },
            {
                col: "id",
                mid: true,
                mod: {
                    aTargets: [-1],
                    bSortable: false,
                    bSearchable: false,
                    mRender: function (data, type, full) {
                        var button =
                            `
                <a class="btn btn-sm btn-icon me-1" href="javascript:;" onclick="edit(` +
                            data +
                            `,'`+full.name+`')">
                    <span class="svg-icon svg-icon-2x svg-icon-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black" />
                            <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black" />
                            <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black" />
                        </svg>
                    </span>
                </a>`;

                        return button;
                    },
                },
            },
        ],
    });
}

function tableSasaran() {
    document.getElementById("table-2").innerHTML = ewpTable({
        targetId: "dttb-master-sasaran",
        class: "table gy-5 gs-7 table-row-bordered border rounded",
        column: [
            { name: "No", width: "10" },
            { name: "Perspective", width: "35" },
            { name: "Sasaran", width: "30" },
            { name: "Status", width: "15" },
            { name: "Action", width: "10" },
        ],
    });

    geekDatatables({
        target: "#dttb-master-sasaran",
        url: urlApi + "master-data/strategic-targets",
        sorting: [1, "desc"],
        apiKey: "data",
        column: [
            {
                col: "id",
                mid: true,
                mod: {
                    aTargets: [0],
                    bSortable: false,
                    bSearchable: false,
                    mRender: function (data, type, full, draw) {
                        var row = draw.row;
                        var start = draw.settings._iDisplayStart;
                        var length = draw.settings._iDisplayLength;

                        var counter = start + 1 + row;

                        return counter;
                    },
                },
            },
            {
                col: "name",
                mid: true,
                mod: {
                    aTargets: [1],
                    //bSortable:false,
                    mRender: function (data, type, full, draw) {
                        return data;
                    },
                },
            },
            {
                col: "perspective",
                mid: true,
                mod: {
                    aTargets: [2],
                    //bSortable:false,
                    mRender: function (data, type, full, draw) {
                        return noNull(full?.perspective?.name);
                    },
                },
            },
            {
                col: "status",
                mid: true,
                mod: {
                    aTargets: [3],
                    //bSortable:false,
                    mRender: function (data, type, full, draw) {
                        let statusCheck =
                            data == true ? "checked='checked'" : "";
                        let html =
                            `
                    <div style="justify-content: center;display: flex;">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" ` +
                            statusCheck +
                            ` value="` +
                            full.id +
                            `" onclick="changeStatus(` +
                            full.id +
                            `)" id="flexSwitchDefault"/>
                        </div>
                    </div>`;
                        return html;
                    },
                },
            },
            {
                col: "id",
                mid: true,
                mod: {
                    aTargets: [-1],
                    bSortable: false,
                    bSearchable: false,
                    mRender: function (data, type, full) {
                        var button =
                            `
                <a class="btn btn-sm btn-icon me-1" href="javascript:;" onclick="edit(` +
                            data +
                            `,'`+full.name+`')">
                    <span class="svg-icon svg-icon-2x svg-icon-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="black" />
                            <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="black" />
                            <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="black" />
                        </svg>
                    </span>
                </a>`;

                        return button;
                    },
                },
            },
        ],
    });
}

function create() {
    event.preventDefault();
    $("#modal-add #modal-title").html("Tambah Master Data");
    clearForm();
    sPerspektif();
    sKondisi();
    sTipeYTD();
    $('#btn-tambah').addClass('d-none')
    $("#modal-add").modal("show");
}

function clearForm() {
    $("#modal-add #nama-1").val("");
    $("#modal-add #sasaran-name").val("");
    $("#modal-add #select-perspektif-sasaran").val(null).trigger("change");
    $("#modal-add #select-perspektif-parameter").val(null).trigger("change");
    $("#modal-add #select-sasaran").val(null).trigger("change");
    $("#modal-add #parameter").val("");
    $("#modal-add #formula").val("");
    $("#modal-add #satuan").val("");
    $("#modal-add #select-kondisi").val(null).trigger("change");
    $("#modal-add #select-tipe-ytd").val(null).trigger("change");
    $('#modal-add [name="sumber"]:checked').prop("checked",false);
    $("#modal-add #keterangan").val("");
    $("#modal-add #kt_widget_tab_3 #id").val("");
    $("#modal-add #kt_widget_tab_2 #id").val("");
    $("#modal-add #kt_widget_tab_1 #id").val("");

    $("#checkbox-setuju").prop("checked", false);
    $("#select-sasaran").prop("disabled", true);
    objEvidence = [];

    $(".menu-form").removeClass("active");
    $(".menu-form").removeClass("show");

    $(".menu-form-pilih").addClass("active show");

    $('[name="finance_usage"]:checked').prop("checked", false);
    let uuid=uuidv4()
    let html=`
    <div class="row mx-0 ev-`+uuid+`">
        <div class="col-12 p-0">
            <label class="fs-5 fw-bold mt-2">Keterangan Tipe Evidence</label>
        </div>
        <div class="col-12 p-0">
            <input type="hidden" name="id-ev" value="`+uuid +`"/>
            <input type="text" class="form-control" name="evidence-name" id="evidence-name-`+uuid +`" placeholder="Masukkan keterangan tipe evidence" value="" />
        </div>
    </div>		
    `
    $("#modal-add #evidence-list").html(html);
}

function edit(id,name='') {
    event.preventDefault();
    clearForm();
    ewpLoadingShow();
    $("#modal-add #modal-title").html("Edit Master Data");
    if (id != null) {
        let url=""
        if(dttbTypeData=='3'){
            url=urlApi + "master-data/show/" + id
        }else if(dttbTypeData=='2'){
            url=urlApi + "master-data/strategic-targets/" + id
        }else{
            url=urlApi + "master-data/perspectives/" + id
        }

        $.ajax({
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization: "Bearer " + localStorage.getItem("ppre_token"),
            },
            url: url,
            success: function (response) {
                ewpLoadingHide();
                $('#btn-tambah').removeClass('d-none')
                res = response.data;
                $("#modal-add #kt_widget_tab_"+dttbTypeData+" #id").val(id);
                statusForm = dttbTypeData;

                if(dttbTypeData=='3'){
                    if (res?.perspective?.id !== undefined) {
                        let per = "";
                        per +=
                            "<option selected='selected' value='" +
                            res?.perspective?.id +
                            "'>" +
                            res?.perspective?.name +
                            "</option>";
    
                        $("#modal-add #select-perspektif-parameter")
                            .append(per)
                            .trigger("change");
                        
                    }
                    sPerspektif();
                    if (res?.strategic_target?.id !== undefined) {
                        let sar = "";
                        sar +=
                            "<option selected='selected' value='" +
                            res?.strategic_target?.id +
                            "'>" +
                            res?.strategic_target?.name +
                            "</option>";
    
                        $("#modal-add #select-sasaran")
                            .append(sar)
                            .trigger("change");
                        
                    }
                    sSasaran(res?.perspective?.id);
                    if (res?.kondisi?.id !== undefined) {
                        let kon = "";
                        kon +=
                            "<option selected='selected' value='" +
                            res?.kondisi?.id +
                            "'>" +
                            res?.kondisi?.value +
                            "</option>";
    
                        $("#modal-add #select-kondisi")
                            .append(kon)
                            .trigger("change");
                        sKondisi();
                    }
    
                    sTipeYTD();
                    if (res?.type_ytd?.id !== undefined) {
                        let ytd = "";
                        ytd +=
                            "<option selected='selected' value='" +
                            res?.type_ytd?.id +
                            "'>" +
                            res?.type_ytd?.value +
                            "</option>";
    
                        $("#modal-add #select-tipe-ytd")
                            .append(ytd)
                            .trigger("change");
                    }
    
                    $("#modal-add #parameter").val(res.parameter);
                    $("#modal-add #formula").val(res.formula);
                    $("#modal-add #satuan").val(res.satuan);
                    $("#modal-add #keterangan").val(res.keterangan);
                    
    
                    if (res.evidence.length > 0) {
                        let html = ``;
                        let ev = res.evidence;
                        for (e in ev) {
                            let deleteButton =
                                e == 0
                                    ? ""
                                    : `<button type="button" class="btn-icon btn btn-danger btn-sm" onclick="hapusEvidence('` +
                                      ev[e].id +
                                      `')"><i class="bi bi-dash-lg"></i></button>`;
                            html +=
                                `
                            <div class="row mx-0 mt-3" id="ev-` +
                                ev[e].id +
                                `">
                                <div class="col-10 p-0">
                                    <label class="fs-5 fw-bold mt-2">Keterangan Tipe Evidence</label>
                                </div>
                                <div class="col-2 p-0 text-right mb-2">
                                    ` +
                                deleteButton +
                                `
                                </div>
                                <div class="col-12 p-0">
                                    <input type="hidden" name="id-ev" value="`+ ev[e].id +`"/>
                                    <input type="text" class="form-control" name="evidence-name" id="evidence-name-`+ ev[e].id +`" placeholder="Masukkan keterangan tipe evidence" value="` +
                                ev[e].name +
                                `" />
                                </div>
                            </div>
                            `;
                        }
    
                        $("#modal-add #evidence-list").html(html);
                    }else{
                        let uuid=uuidv4()
                        let html=`
                        <div class="row mx-0" id="ev-`+uuid+`">
                            <div class="col-12 p-0">
                                <label class="fs-5 fw-bold mt-2">Keterangan Tipe Evidence</label>
                            </div>
                            <div class="col-12 p-0">
                            <input type="hidden" name="id-ev" value="`+ uuid +`"/>
                                <input type="text" class="form-control" name="evidence-name" id="evidence-name-`+ uuid +`" placeholder="Masukkan keterangan tipe evidence" value="" />
                            </div>
                        </div>		
                        `
                        $("#modal-add #evidence-list").html(html);
                    }
                }else if(dttbTypeData=='2'){
                    $("#modal-add #sasaran-name").val(name)
                    if(res?.perspective?.id!==undefined){
                        let per = "";
                        per +=
                            "<option selected='selected' value='" +
                            res?.perspective?.id +
                            "'>" +
                            res?.perspective?.name +
                            "</option>";
    
                        $("#modal-add #select-perspektif-sasaran")
                            .append(per)
                            .trigger("change");
                    }
                    sPerspektif();
                }else{
                    $("#modal-add #nama-1").val(name)
                }
                
                $("#modal-add .radio-" + res.sumber).prop("checked", true);

                $("#modal-add").modal("show");

                //menu
                $(".menu-"+dttbTypeData).addClass("active");
                $(".menu-"+dttbTypeData).addClass("show");
                $("#modal-add input.menu-"+dttbTypeData).prop("checked", true);
                $("#kt_widget_tab_"+dttbTypeData).addClass("active show");
                $(".menu-form-pilih").removeClass("active show");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                ewpLoadingHide();
                handleErrorDetail(xhr);
            },
        });
    }
}

function hapusEvidence(id) {
    $("#ev-" + id).remove();
}

function tambahEvidence() {
    let id = uuidv4();
    let html =
        `
    <div class="row mx-0 mt-3" id="ev-` +
        id +
        `">
        <div class="col-10 p-0">
            <label class="fs-5 fw-bold mt-2">Keterangan Tipe Evidence</label>
        </div>
        <div class="col-2 p-0 text-right mb-2">
            <button type="button" class="btn-icon btn btn-danger btn-sm" onclick="hapusEvidence('` +
        id +
        `')"><i class="bi bi-dash-lg"></i></button>
        </div>
        <div class="col-12 p-0">
            <input type="hidden" name="id-ev" value="`+id +`"/>
            <input type="text" class="form-control" name="evidence-name" id="evidence-name-`+id+`" placeholder="Masukkan keterangan tipe evidence" value="" />
        </div>
    </div>
    `;

    $("#modal-add #evidence-list").append(html);
}

function serializeEvidence() {
    objEvidence = [];

    let ids = $("#modal-add [name='id-ev']").serializeArray();
    //let ev = $("#modal-add [name='evidence-name']").serializeArray();
    for (i in ids) {
        if($('#evidence-name-'+ids[i].value).val()!==''){
            objEvidence.push({
                id:ids[i].value.length>11?"":ids[i].value,
                name: $('#evidence-name-'+ids[i].value).val(),
            });
        }
    }
}

function simpan() {
    ewpLoadingShow();
    serializeEvidence();

    let data = {};

    let link = "";

    if (statusForm == "1") {
        data = {
            name: $("#modal-add #nama-1").val(),
        };

        link =  $("#modal-add #kt_widget_tab_"+statusForm+" #id").val() == ""
        ? urlApi + "master-data/store-perspective"
        : urlApi +
          "master-data/perspectives/" +
          $("#modal-add #kt_widget_tab_"+dttbTypeData+" #id").val();
    } else if (statusForm == "2") {
        data = {
            name: $("#modal-add #sasaran-name").val(),
            perspective_id: $("#modal-add #select-perspektif-sasaran").val(),
        };

        link =  $("#modal-add #kt_widget_tab_"+statusForm+" #id").val() == ""
        ? urlApi + "master-data/store-strategic-target"
        : urlApi +
          "master-data/strategic-targets/" +
          $("#modal-add #kt_widget_tab_"+dttbTypeData+" #id").val();
    } else if (statusForm == "3") {
        data = {
            perspective_id: $("#modal-add #select-perspektif-parameter").val(),
            strategic_target_id: $("#modal-add #select-sasaran").val(),
            parameter: $("#modal-add #parameter").val(),
            formula: $("#modal-add #formula").val(),
            satuan: $("#modal-add #satuan").val(),
            kondisi_id: $("#modal-add #select-kondisi").val(),
            type_ytd_id: $("#modal-add #select-tipe-ytd").val(),
            sumber: $('#modal-add [name="sumber"]:checked').val(),
            keterangan: $("#modal-add #keterangan").val(),
            evidence: objEvidence,
        };
        link =
            $("#modal-add #kt_widget_tab_"+statusForm+" #id").val() == ""
                ? urlApi + "master-data/store"
                : urlApi +
                  "master-data/update/" +
                  $("#modal-add #kt_widget_tab_"+dttbTypeData+" #id").val();
    } else {
        console.log("invalid statusForm");
    }

    let tipe =
        $("#modal-add #kt_widget_tab_"+dttbTypeData+" #id").val() == "" ? "POST" : "PUT";

    $.ajax({
        type: tipe,
        dataType: "json",
        data: data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: "Bearer " + localStorage.getItem("ppre_token"),
        },
        url: link,
        success: function (response) {
            let status =
                $("#modal-add #kt_widget_tab_"+dttbTypeData+" #id").val() == ""
                    ? "disimpan"
                    : "dirubah";
            ewpLoadingHide();
            Swal.fire({
                title: "Berhasil!",
                text: "Data berhasil " + status + ".",
                icon: "success",
            }).then((result) => {
                table();
                tablePerspective()
                tableSasaran()
                $("#modal-add").modal("hide");
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            ewpLoadingHide();
            handleErrorDetail(xhr);
        },
    });
}

function changeStatus(id) {
    let link=""
    let type=""
    if(dttbTypeData=='1'){
        link=urlApi +"master-data/perspectives/"+id+"/switch-status"
        type="POST"
    }else if(dttbTypeData=='2'){
        link=urlApi + "master-data/strategic-targets/"+id+"/switch-status"
        type="POST"
    }else if(dttbTypeData=='3'){
        link=urlApi + "master-data/change-status/" + id
        type="PATCH"
    }

    $.ajax({
        type: type,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: "Bearer " + localStorage.getItem("ppre_token"),
        },
        url: link,
        success: function (response) {
            toastr.optionsOverride = 'positionclass = "toast-bottom-right"';
            toastr.options.positionClass = "toast-bottom-right";
            toastr.success("Status prioritas berhasil dirubah");
            table();
            tablePerspective()
            tableSasaran()
        },
        error: function (response) {
            handleError(response);
        },
    });
}

function sPerspektif() {
    $(".select-perspektif").select2({
        allowClear: true,
        placeholder: "Pilih Perspektif",
        ajax: {
            url: urlApi + "master-data/get-perspective",
            dataType: "json",
            type: "GET",
            quietMillis: 50,
            headers: {
                Authorization: "Bearer " + localStorage.getItem("ppre_token"),
            },
            data: function (term) {
                return {
                    search: term.term,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data.data["perspective"], function (item) {
                        return {
                            text: item.name,
                            id: item.id,
                        };
                    }),
                };
            },
        },
    });
}

function sSasaran(param) {
    let params = param !== null ? "?perspective_id=" + param : "";
    let keterangan =
        param !== null
            ? "Pilih Sasaran Strategis"
            : "Silahkan pilih perspektif terlebih dahulu";
    $("#select-sasaran").select2({
        allowClear: true,
        placeholder: keterangan,
        ajax: {
            url: urlApi + "master-data/get-strategic-target" + params,
            dataType: "json",
            type: "GET",
            quietMillis: 50,
            headers: {
                Authorization: "Bearer " + localStorage.getItem("ppre_token"),
            },
            data: function (term) {
                return {
                    search: term.term,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(
                        data.data["strategic_target"],
                        function (item) {
                            return {
                                text: item.name,
                                id: item.id,
                            };
                        }
                    ),
                };
            },
        },
    });
}

function sKondisi() {
    $("#select-kondisi").select2({
        allowClear: true,
        placeholder: "Pilih Kondisi",
        ajax: {
            url: urlApi + "master-data/get-kondisi",
            dataType: "json",
            type: "GET",
            quietMillis: 50,
            headers: {
                Authorization: "Bearer " + localStorage.getItem("ppre_token"),
            },
            data: function (term) {
                return {
                    search: term.term,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data.data["kondisi"], function (item) {
                        return {
                            text: item.value,
                            id: item.id,
                        };
                    }),
                };
            },
        },
    });
}

function sTipeYTD() {
    $("#select-tipe-ytd").select2({
        allowClear: true,
        placeholder: "Pilih Tipe YTD",
        ajax: {
            url: urlApi + "master-data/get-type-ytd",
            dataType: "json",
            type: "GET",
            quietMillis: 50,
            headers: {
                Authorization: "Bearer " + localStorage.getItem("ppre_token"),
            },
            data: function (term) {
                return {
                    search: term.term,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data.data["type_ytd"], function (item) {
                        return {
                            text: item.value,
                            id: item.id,
                        };
                    }),
                };
            },
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
