let id=$('#id').val()
let year=""
let unit_id=""
let targeted_id=""
let parameterArr=[]
let deletedArr=[]


jQuery(document).ready(function($) {
    
    pageActive()

    sUnit()
    let unitsArr=[]

    
    $(document).on("change", '[name="chk-no-target"]', function (e) {
        let ids=$(this).val()
        if($(this).prop("checked")){
            $('#target-'+ids).attr("readonly",true).addClass('text-muted').val("")
        }else{
            $('#target-'+ids).attr("readonly",false).removeClass('text-muted')
        }
    });
    
    $(document).on("change", '.chk-bobot', function (e) {
        let ids=$(this).val()
        let id_this=$(this).parents('.list-unit').find('#id-parent-'+ids)
        let id_modal=id_this.val()
        if($(this).prop('checked')){
            $('#modal-'+id_modal+' #bobot-detail-'+ids).removeClass('d-none')
        }else{
            $('#modal-'+id_modal+'#bobot-detail-'+ids).addClass('d-none')
        }
    });

    $(document).on("hide.bs.modal", '#modal', function (e) {
       serializeSubsTarget($(this+ " #id_target").val())
    });

    $(document).on("keyup", '[name="lbl-bobot"]', function (e) {
        calculateBobot()
    });

    $(document).on("keyup", '[name="target-sub"]', function (e) {
        let ids=$(this).prop('id')
        let id_th=ids.replace('target-sub-',"")
        // let id_modal=$('#id-parent-'+id_this).val()
        
        let id_this=$(this).parents('.list-unit').find('#id-parent-'+id_th)
        let id_modal=id_this.val()
        let sa = $('#modal-'+id_modal+' [name="target-sub"]').serializeArray()
        let totalTarget=0

        console.log($(this).parents('.list-unit'))
        for(s in sa){
            if(sa[s].value!==""){
                totalTarget+=parseFloat(sa[s].value)
            }
        }
        console.log({sa})
        let initialValue=$('#target-'+id_modal).val()
        let total=parseFloat(initialValue)-parseFloat(totalTarget)
        $('#modal-'+id_modal+" #totalTarget-"+id_th).val(totalTarget)
        $('#modal-'+id_modal+" #sisa-"+id_modal).html(total)

    });

    $(document).on("change", '.select_parameter', function (e) {
        let ids=$(this).prop('id')
        let value=$(this).val()
        let id_selected=ids.replace("parameter-","")
        console.log(ids)
        console.log(value)
        console.log(parameterArr)
        for(pa in parameterArr){
            if(parameterArr[pa].id==value){
                let evidenceText=""
                let ev=parameterArr[pa].evidence
                if(ev.length>1){
                    for(e in ev){
                        evidenceText+=ev[e]?.name+", "
                    }
                }else if(ev.length==1){
                    evidenceText=ev[0]?.name
                }else{
                    evidenceText="-"
                }

                let sumberText=""
                switch(parameterArr[pa].sumber) {
                    case "1":
                    sumberText="KPI Korporat"
                    break;
                    case "2":
                    sumberText="Spesifik"
                    break;
                    case "3":
                    sumberText="RKAP"
                    break;
                    default:
                    sumberText=""
                }

                $('#perspective-'+id_selected).html(parameterArr[pa]?.perspective?.name)
                $('#formula-'+id_selected).html(parameterArr[pa]?.formula)
                $('#st-'+id_selected).html(parameterArr[pa]?.strategic_target?.name)
                $('#sumber-'+id_selected).html(sumberText)
                $('#satuan-'+id_selected).html(parameterArr[pa]?.satuan)
                $('#status-'+id_selected).html(parameterArr[pa]?.status)
                $('#ytd-'+id_selected).html(parameterArr[pa]?.type_ytd?.value)
                $('#evidence-'+id_selected).html(evidenceText)

                
            }
        }
    });

    $(document).on("change", '#tanggal', function (e) {
        let value=$(this).val()
        year=value
    });

    $(document).on("click", '[name="chk-parameter"]', function (e) {
        let sa = $('[name="chk-parameter"]').serializeArray()
        if(sa.length>1){
            $('.btn-rollback').addClass('d-none')
            targeted_id=""
        }else{
            $('.btn-rollback').removeClass('d-none')
            targeted_id=$(this).val()
        }
    });

    

    $('#tanggal').datepicker({
        rtl: KTUtil.isRTL(),
        format: "yyyy",
        autoclose:true,
        todayHighlight: true,
        viewMode: "years",
        minViewMode: "years"
    })

    
    if(rl_now==rl_unit){
        $('.div-filter').addClass("d-none")
        $('#btn-simpan-draft').addClass("d-none")
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        year = urlParams.get('year')
        unit_id=localStorage.getItem("ppre_userID")
        show()
    }else if(rl_now==rl_korporat){
        console.log({rl_now})
        console.log({rl_korporat})
        //$('#div-tanggal').removeClass("d-none")
        show()
        unit_id=""
        year=$('#tanggal').val()
        $('#div-title').addClass('d-none')
        $('.div-year').removeClass('d-none')
        console.log("tes")
        sYear()
    }else if(rl_now==rl_direksi){
        console.log({rl_direksi})
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        year = urlParams.get('year')
        
        $('.year').html(year)
        $('.title').html('Tahun '+year)
        $('.div-filter,#div-simpan,.btn-add').addClass("d-none")
        $('.btn-approve,.btn-rollback').removeClass('d-none')
        $('.btn-add').addClass("text-right")
        unit_id=""
        show()
    }else{//ADMIN
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        year = urlParams.get('year')
        show()
        $('.year').html(year)
        $('.title').html('Tahun '+year)
        $('.btn-add').removeClass("text-right")
        //$('#btn-empty').removeClass("d-none")
        // /$('.btn-approve,.btn-rollback').removeClass('d-none')
    }

    
});	

function pageActive(){
    $('#nav-setting-kpi').addClass('active')
}

async function show(){
    ewpLoadingShow();
    deletedArr=""
    if($('#select_unit').val()!==''&&$('#select_unit').val()!==null||rl_now==rl_unit||rl_now==rl_direksi){
        try {
            let data = await modalUnit();
            unitsArr=data?.data?.units
            console.log({unitsArr})
            if(data){
                $('#btn-empty,#text-empty').removeClass('d-none')
                $('#text-null').addClass('d-none')
                let yearId=id
                if(rl_now==rl_korporat){
                    yearId=$('#select_year').val()
                }
                $.ajax({
                    type: "GET",
                    headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    url: urlApi + "setting-kpi/targets?year_id="+yearId+"&unit_id="+unit_id,
                    beforeSend: function (xhr) {
                    xhr.setRequestHeader(
                        "Authorization",
                        "Bearer " + localStorage.getItem("ppre_token")
                    );
                    },
                    success: function (response) {
                        ewpLoadingHide();
                        let res=response.data.targets
                        let html=``
                        let htmlModal=``
                        let parentArr=[]
            
                        if(res.length>0){
                            $('#empty-handler').addClass('d-none')
                            $('.parameter').removeClass('d-none')
            
                            let unitListHtml=""
                            if(unitsArr?.length>0){
                                for(un in unitsArr){
                                    let initInisial=unitsArr[un].name.split(" ")
                                    let inisial=""
                                    if(initInisial.length>1){
                                        inisial=initInisial[0].substring(0, 1)+""+initInisial[1].substring(0, 1)
                                    }else{
                                        inisial=initInisial[0].substring(0, 1)
                                    }
                                    
                                    unitListHtml+=`
                                    <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="0">
                                    <input type="hidden" class="id-parent" id="id-parent-`+unitsArr[un].id+`" />
                                        <div class="d-flex align-items-center">
                                            <label class="form-check form-check-custom form-check-solid me-5">
                                                <input class="form-check-input chk-bobot chk-bobot-`+unitsArr[un].id+`" id="chk-bobot-`+unitsArr[un].id+`" type="checkbox" name="chk-bobot[]" data-kt-check="true" data-kt-check-target="[data-user-id='0']" value="`+unitsArr[un].id+`" />
                                            </label>
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-warning text-danger fw-bold" style="text-transform: uppercase;">`+inisial+`</span>
                                            </div>
                                            <div class="ms-5">
                                                <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">`+unitsArr[un].name+`</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="bobot-detail-`+unitsArr[un].id+`" class="col-12 row mx-0 d-none" style="padding:0 1rem 1rem 4rem">
                                        <div class="col-6 ps-0">
                                            <label class="text-gray-600 mb-2">Target</label>
                                            <input type="text" class="form-control" name="target-sub" id="target-sub-`+unitsArr[un].id+`" placeholder="Target"/>
                                        </div>
                                        <div class="col-6 ps-0">
                                            <label class="text-gray-600 mb-2">Bobot</label>
                                            <input type="text" class="form-control" name="bobot-sub" id="bobot-sub-`+unitsArr[un].id+`" placeholder="Bobot"/>
                                        </div>
                                    </div>
                                    <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
                                    `
                                }
                            }
                            
                            if(res.length>0){
                                for (i in res){
                                    let evidenceText=""
                                    let parent_identifier=""
                                    let ev=res[i].parameter?.evidence
                                    
                
                                    if(ev.length>1){
                                        for(e in ev){
                                            evidenceText+=ev[e].name+", "
                                        }
                                    }else if(ev.length==1){
                                        evidenceText=ev[0].name
                                    }else{
                                        evidenceText="-"
                                    }
                
                                    let sumberText=""
                                    switch(res[i].parameter?.sumber) {
                                        case "1":
                                        sumberText="KPI Korporat"
                                        break;
                                        case "2":
                                        sumberText="Spesifik"
                                        break;
                                        case "3":
                                        sumberText="RKAP"
                                        break;
                                        default:
                                        sumberText=""
                                    }
                                    
                                    if(res[i].parent_id==0||rl_now==rl_unit||rl_now==rl_direksi){
                                        parentArr.push({
                                            parent_id:res[i]?.id,
                                            children_ids:[]
                                        })
                                        parent_identifier=res[i]?.id
                                        let is_disabled=res[i].status_id==0?"":"readonly"
                                        let is_muted=res[i].status_id==0?"":"text-muted"
                                        let chk_disabled=""
                                        let div_disabled=""
                                        if(rl_now==rl_direksi&&res[i].status_id=='1'){
                                            chk_disabled=""
                                            div_disabled="col-11"
                                        }else{
                                            chk_disabled="d-none"
                                            div_disabled="col-12"
                                        }
                                        let is_check=parseFloat(res[i]?.target)==0?'checked=checked':''
                                        let showChild=rl_now!==rl_admin?"d-none":""
                                        
                                        html+=`
                                        <div class="row mx-0 p-0">
                                            <div class="col-1 p-0 checkbox-parameter `+chk_disabled+`" style="justify-content: center;display: flex;">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="`+res[i].id+`" name="chk-parameter" id="chk-parameter-`+res[i].id+`"/>
                                                    <label class="form-check-label" for="chk-parameter-`+res[i].id+`">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="`+div_disabled+` row mx-0 p-4 my-8 border-dashed rounded div-parameter" id="parent-`+res[i]?.id+`">
                                                <input type="hidden" name="targets[]" value="`+res[i]?.id+`"/>
                                                <div class="col-3 mb-10 ps-0">
                                                    <label class="text-gray-600">Parameter</label>
                                                    <select class="form-select select_parameter `+is_muted+`" data-control="select2" name="lbl-parameter" id="parameter-`+res[i]?.id+`" data-placeholder="Pilih parameter" `+is_disabled+`>
                                                        <option select="selected" value="`+res[i]?.parameter?.id+`">`+res[i]?.parameter?.parameter+`</option>
                                                    </select>
                                                </div>
                                                <div class="col-2 mb-10">
                                                    <label class="text-gray-600">PIC KPI Korporat</label>
                                                    <input type="text" class="form-control lbl-pic `+is_muted+`" name="lbl-pic" id="pic-`+res[i]?.id+`" placeholder="Masukkan nama PIC" value="`+res[i]?.pic+`" `+is_disabled+`/>
                                                </div>
                                                <div class="col-2 mb-10">
                                                    <div class="form-check form-check-custom form-check-solid form-check-sm mt-3">
                                                        <input class="form-check-input" name="chk-no-target" type="checkbox" `+is_check+` value="`+res[i]?.parameter?.id+`" id="chk-no-target-`+res[i]?.parameter?.id+`"/>
                                                        <label class="form-check-label" for="chk-no-target-`+res[i]?.parameter?.id+`">
                                                            Tidak Ada Target
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-2 mb-10">
                                                    <label class="text-gray-600">Target</label>
                                                    <input type="text" class="form-control lbl-target `+is_muted+`" name="lbl-target" id="target-`+res[i]?.id+`" placeholder="Masukan target" value="`+res[i]?.target+`" `+is_disabled+`/>
                                                </div>
                                                <div class="col-2 mb-10">
                                                    <label class="text-gray-600">Bobot</label>
                                                    <input type="text" class="form-control lbl-bobot `+is_muted+`" name="lbl-bobot" id="bobot-`+res[i]?.id+`" placeholder="Bobot" value="`+res[i]?.bobot+`" `+is_disabled+`/>
                                                </div>
                                                <div class="col-1 mb-10 py-2">
                                                    <button class="btn btn-danger btn-icon" onclick="deleteParameter('`+res[i]?.id+`')"><i class="bi bi-dash-lg"></i></button>
                                                </div>
                                                
                                                <div class="col-3 mb-2 ps-0">
                                                    <label class="text-gray-600">Perspective</label>
                                                    <h5 id="perspective-`+res[i]?.id+`">`+res[i]?.parameter?.perspective?.name+`</h5>
                                                </div>
                                                <div class="col-3 mb-2">
                                                    <label class="text-gray-600">Formula</label>
                                                    <h5 id="formula-`+res[i]?.id+`">`+res[i]?.parameter?.formula+`</h5>
                                                </div>
                                                <div class="col-3 mb-2">
                                                    <label class="text-gray-600">Sasaran Strategis</label>
                                                    <h5 id="st-`+res[i]?.id+`">`+res[i]?.parameter?.strategic_target?.name+`</h5>
                                                </div>
                                                <div class="col-3 text-center py-4">
                                                    <button class="btn btn-secondary btn-icon btn-xs" id="btn-`+res[i]?.id+`" onclick="openDetail('`+res[i]?.id+`')"><i class="bi bi-chevron-right"></i></button>
                                                </div>
                                                
                                                <div id="detail-`+res[i]?.id+`" class="row mx-0 p-0" style="display: none">
                                                    <div class="mb-2 col-3 ps-0">
                                                        <label class="text-gray-600">Sumber</label>
                                                        <h5 id="sumber-`+res[i]?.id+`">`+sumberText+`</h5>
                                                    </div>
                                                    <div class="mb-2 col-1n5">
                                                        <label class="text-gray-600">Satuan</label>
                                                        <h5 id="satuan-`+res[i]?.id+`">`+res[i]?.parameter?.satuan+`</h5>
                                                    </div>
                                                    <div class="mb-2 col-1n5">
                                                        <label class="text-gray-600">Kondisi</label>
                                                        <h5 id="status-`+res[i]?.id+`">`+res[i]?.parameter?.status+`</h5>
                                                    </div>
                                                    <div class="mb-2 col-3">
                                                        <label class="text-gray-600">Tipe TYD</label>
                                                        <h5 id="ytd-`+res[i]?.id+`">`+res[i]?.parameter?.type_ytd?.value+`</h5>
                                                    </div>
                                                    <div class="mb-2 col-2">
                                                        <label class="text-gray-600">Evidence</label>
                                                        <h5 id="evidence-`+res[i]?.id+`">`+evidenceText+`</h5>
                                                    </div>
                                                </div>
                        
                                                <div class="col-12 row mx-0 px-0 mt-6 `+showChild+`">
                                                    <div class="col-3 ps-0 py-3">
                                                        <p class="text-muted">Unit dengan parameter sama</p>
                                                    </div>
                                                    <div class="col-2">
                                                        <button class="btn btn-light-warning btn-sm" onclick="modalUnitOpen(`+res[i]?.id+`)" `+is_disabled+`>Lihat Unit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        `
                    
                                        htmlModal+=`
                                        <div class="modal fade" id="modal-`+res[i]?.id+`" tabindex="-1" aria-hidden="true">
                                        <input type="hidden" id="totalTarget-`+res[i]?.id+`" />
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <div class="modal-content">
                                                    <div class="modal-header pb-0 border-0 justify-content-end">
                                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                            <span class="svg-icon svg-icon-1">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-10">
                                                        <input type="hidden" id="id_target"/>
                                                        <div class="text-center mb-13">
                                                            <h1 class="mb-3">Daftar Unit</h1>
                                                            <div class="text-muted fw-bold fs-5">Terapkan bobot pada unit</div>
                                                        </div>
                                                        <div id="kt_modal_users_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="inline">
                                                            <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">
                                                                <input type="hidden" />
                                                                <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <input type="text" class="form-control form-control-lg form-control-solid px-15" name="search" value="" placeholder="Search ..." data-kt-search-element="input" />
                                                                <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                                                                    <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                                                                </span>
                                                                <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="clear">
                                                                    <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                                                        </svg>
                                                                    </span>
                                                                </span>
                                                            </form>
                                                            <div class="py-5">
                                                                <div data-kt-search-element="results">
                                                                    <div class="mh-375px scroll-y me-n7 pe-7 list-unit">
                                                                    `+unitListHtml+`
                                                                    </div>
                                                                    <div class="d-flex mt-15">
                                                                    <div class="col-3">
                                                                        <label class="text-gray-600">Sisa Target</label>
                                                                        <h2 id="sisa-`+res[i]?.id+`">`+res[i]?.target+`</h2>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <div data-kt-search-element="empty" class="text-center d-none">
                                                                    <div class="fw-bold py-10">
                                                                        <div class="text-gray-600 fs-3 mb-2">Pencarian '[Search]'</div>
                                                                        <div class="text-muted fs-6">Belum ada data yang dapat ditampilkan.</div>
                                                                    </div>
                                                                    {{--<div class="text-center px-5">
                                                                        <img src="assets/media/illustrations/sketchy-1/1.png" alt="" class="w-100 h-200px h-sm-325px" />
                                                                    </div>--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        `
                                    }else if(rl_now==rl_admin||rl_now==rl_korporat){
                                        console.log({parentArr})
                                        for(p in parentArr){
                                            if(parentArr[p].parent_id==res[i]?.parent_id){
                                                parentArr[p].children_ids.push({
                                                    id:res[i]?.unit_id,
                                                    bobot:res[i]?.bobot,
                                                    target:res[i]?.target
                                                })
                                            }else{
                                                //console.log("others: "+res[i]?.unit_id)
                                            }
                                        }
                                    }
                                }
                                $('#list-parameter').html(html)
                                $('#list-modal').html(htmlModal)
                                sParameter()
                            }
                           
    
                            //[Apply to subtargets]
                            for(pa in parentArr){
                                let chk=parentArr[pa].children_ids
                                let totalTarget=0
                                for (c in chk){
                                    $('#modal-'+parentArr[pa].parent_id+" .chk-bobot-"+chk[c].id).prop("checked",true)
                                    $('#modal-'+parentArr[pa].parent_id+' #bobot-detail-'+chk[c].id).removeClass('d-none')
                                    $('#modal-'+parentArr[pa].parent_id+" #target-sub-"+chk[c].id).val(chk[c].target).addClass(res[i].status_id==0?"":"text-muted").attr(res[i].status_id==0?"":"readonly",true)
                                    $('#modal-'+parentArr[pa].parent_id+" #bobot-sub-"+chk[c].id).val(chk[c].bobot).addClass(res[i].status_id==0?"":"text-muted").attr(res[i].status_id==0?"":"readonly",true)
                                    $('#modal-'+parentArr[pa].parent_id+" #totalTarget-"+chk[c].id).val(totalTarget)
                                    totalTarget+=chk[c].target
                                }
                                let initialValue=$('#target-'+parentArr[pa].parent_id).val()
                                let total=parseFloat(initialValue)-parseFloat(totalTarget)
                                
                                $('#modal-'+parentArr[pa].parent_id+" #sisa-"+parentArr[pa].parent_id).html(total)
                                $('#modal-'+parentArr[pa].parent_id+" .id-parent").val(parentArr[pa].parent_id)
                                console.log($('#modal-'+parentArr[pa].parent_id+" .id-parent").val())
                            }
                                
                            calculateBobot()

                            if(rl_now!==rl_direksi){
                                $('#div-simpan').removeClass('d-none')
                            }
                        }else{
                            $('#empty-handler').removeClass('d-none')
                            if(rl_now==rl_direksi){
                                $('#div-simpan, #btn-empty,#text-empty,#text-null').addClass("d-none")
                                $('#text-direksi').removeClass("d-none")
                            }else{
                                $('#div-simpan').removeClass("d-none")
                            }
                            
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        ewpLoadingHide();
                    handleErrorDetail(xhr);
                    },
                })
            }
          } catch(err) {
            console.log(err);
          }
    }else{
        ewpLoadingHide()
        $('#empty-handler').removeClass('d-none')
        $('.parameter').addClass('d-none')
    }
   
}

function calculateBobot(){
    //[Calculate bobot in general]
    const lblBobot=$('[name="lbl-bobot"]').serializeArray()
    let sumBobot=0
    for (lb in lblBobot){
        sumBobot+=parseFloat(lblBobot[lb].value)
    }
    $('#total-bobot').html(sumBobot)
}

function modalUnit(){
    ewpLoadingShow();
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "GET",
            headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: urlApi + "setting-kpi/target-units?hide_id="+unit_id,
            beforeSend: function (xhr) {
            xhr.setRequestHeader(
                "Authorization",
                "Bearer " + localStorage.getItem("ppre_token")
            );
            },
            success: function (response) {
                resolve(response)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                reject(xhr)
            },
        });
    })
}

function modalUnitOpen(id_target){
    $('#modal-'+id_target).modal('show')
    $('#modal-'+id_target+' #id_target').val(id_target)
    $('#modal-'+id_target+' .empty-handler').addClass('d-none')
    $('#modal-'+id_target+' #sisa-'+id_target).val($('#bobot-'+id_target).val())
}

function filter(){
    unit_id=$('#select_unit').val()
    show()
}

function openDetail(param) {
    $('#detail-'+param).toggle()
    if($('#detail-'+param).css('display')=='flex'){
        $('#btn-'+param).html(`<i class="bi bi-chevron-down"></i>`)
    }else{
        $('#btn-'+param).html(`<i class="bi bi-chevron-right"></i>`)
    }
}
  
function tambahParameter(){
    let uuid=uuidv4()
    const html = `
    <div class="col-12 row mx-0 p-4 my-8 border-dashed rounded div-parameter new-target" id="parent-`+uuid+`">
    <input type="hidden" name="targets[]" value="`+uuid+`"/>
        <div class="col-3 mb-10 ps-0">
            <label class="text-gray-600">Parameter</label>
            <select class="form-select select_parameter" data-control="select2" name="lbl-parameter" id="parameter-`+uuid+`" data-placeholder="Pilih parameter">
            </select>
        </div>
        <div class="col-2 mb-10">
            <label class="text-gray-600">PIC KPI Korporat</label>
            <input type="text" class="form-control lbl-pic" name="lbl-pic" id="pic-`+uuid+`" placeholder="Masukkan nama PIC"/>
        </div>
        <div class="col-2 mb-10">
            <div class="form-check form-check-custom form-check-solid form-check-sm mt-3">
                <input class="form-check-input" name="chk-no-target" type="checkbox" value="`+uuid+`" id="chk-no-target-`+uuid+`"/>
                <label class="form-check-label" for="chk-no-target-`+uuid+`">
                    Tidak Ada Target
                </label>
            </div>
        </div>
        <div class="col-2 mb-10">
            <label class="text-gray-600">Target</label>
            <input type="text" class="form-control lbl-target" name="lbl-target" id="target-`+uuid+`" placeholder="Masukan target"/>
        </div>
        <div class="col-2 mb-10">
            <label class="text-gray-600">Bobot</label>
            <input type="text" class="form-control lbl-bobot" name="lbl-bobot" id="bobot-`+uuid+`" placeholder="Bobot"/>
        </div>
        <div class="col-1 mb-10 py-2">
            <button class="btn btn-danger btn-icon" onclick="deleteParameter('`+uuid+`')"><i class="bi bi-dash-lg"></i></button>
        </div>
        
        <div class="col-3 mb-2 ps-0">
            <label class="text-gray-600">Perspective</label>
            <h5 id="perspective-`+uuid+`">Financial</h5>
        </div>
        <div class="col-3 mb-2">
            <label class="text-gray-600">Formula</label>
            <h5 id="formula-`+uuid+`">Laba Operasi (standalone)</h5>
        </div>
        <div class="col-3 mb-2">
            <label class="text-gray-600">Sasaran Strategis</label>
            <h5 id="st-`+uuid+`">Increase Profitability</h5>
        </div>
        <div class="col-3 text-center py-4">
            <button class="btn btn-secondary btn-icon btn-xs" id="btn-`+uuid+`" onclick="openDetail('`+uuid+`')"><i class="bi bi-chevron-right"></i></button>
        </div>
        
        <div id="detail-`+uuid+`" class="row mx-0 p-0" style="display: none">
            <div class="mb-2 col-3 ps-0">
                <label class="text-gray-600">Sumber</label>
                <h5 id="sumber-`+uuid+`">KPI Korporat</h5>
            </div>
            <div class="mb-2 col-1n5">
                <label class="text-gray-600">Satuan</label>
                <h5 id="satuan-`+uuid+`">Rp</h5>
            </div>
            <div class="mb-2 col-1n5">
                <label class="text-gray-600">Kondisi</label>
                <h5 id="status-`+uuid+`">></h5>
            </div>
            <div class="mb-2 col-3">
                <label class="text-gray-600">Tipe TYD</label>
                <h5 id="ytd-`+uuid+`">Accumulated</h5>
            </div>
            <div class="mb-2 col-2">
                <label class="text-gray-600">Evidence</label>
                <h5 id="evidence-`+uuid+`">Laporan X</h5>
            </div>
        </div>

        <div class="col-12 row mx-0 px-0 mt-6">
            <div class="col-3 ps-0 py-3">
                <p class="text-muted">Unit dengan parameter sama</p>
            </div>
            <div class="col-2">
                <button class="btn btn-light-warning btn-sm" onclick="modalUnitOpen('`+uuid+`')">Lihat Unit</button>
            </div>
        </div>
    </div>
    `
    

    $('#list-parameter').append(html)

    let unitListHtml=``
    for(un in unitsArr){
        let initInisial=unitsArr[un].name.split(" ")
        let inisial=""
        if(initInisial.length>1){
            inisial=initInisial[0].substring(0, 1)+""+initInisial[1].substring(0, 1)
        }else{
            inisial=initInisial[0].substring(0, 1)
        }
        
        unitListHtml+=`
        <div class="rounded d-flex flex-stack bg-active-lighten p-4" data-user-id="0">
        <input type="hidden" class="id-parent" id="id-parent-`+unitsArr[un].id+`" />
            <div class="d-flex align-items-center">
                <label class="form-check form-check-custom form-check-solid me-5">
                    <input class="form-check-input chk-bobot chk-bobot-`+unitsArr[un].id+`" id="chk-bobot-`+unitsArr[un].id+`" type="checkbox" name="chk-bobot[]" data-kt-check="true" data-kt-check-target="[data-user-id='0']" value="`+unitsArr[un].id+`" />
                </label>
                <div class="symbol symbol-35px symbol-circle">
                    <span class="symbol-label bg-light-warning text-danger fw-bold" style="text-transform: uppercase;">`+inisial+`</span>
                </div>
                <div class="ms-5">
                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">`+unitsArr[un].name+`</a>
                </div>
            </div>
        </div>
        <div id="bobot-detail-`+unitsArr[un].id+`" class="col-12 row mx-0 d-none" style="padding:0 1rem 1rem 4rem">
            <div class="col-6 ps-0">
                <label class="text-gray-600 mb-2">Target</label>
                <input type="text" class="form-control" name="target-sub" id="target-sub-`+unitsArr[un].id+`" placeholder="Target"/>
            </div>
            <div class="col-6 ps-0">
                <label class="text-gray-600 mb-2">Bobot</label>
                <input type="text" class="form-control" name="bobot-sub" id="bobot-sub-`+unitsArr[un].id+`" placeholder="Bobot"/>
            </div>
        </div>
        <div class="border-bottom border-gray-300 border-bottom-dashed"></div>
        `
    }

    const modalNewHtml =`
        <div class="modal fade" id="modal-`+uuid+`" tabindex="-1" aria-hidden="true">
        <input type="hidden" id="totalTarget-`+uuid+`" />
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header pb-0 border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-10">
                        <input type="hidden" id="id_target"/>
                        <div class="text-center mb-13">
                            <h1 class="mb-3">Daftar Unit</h1>
                            <div class="text-muted fw-bold fs-5">Terapkan bobot pada unit</div>
                        </div>
                        <div id="kt_modal_users_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="inline">
                            <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">
                                <input type="hidden" />
                                <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                    </svg>
                                </span>
                                <input type="text" class="form-control form-control-lg form-control-solid px-15" name="search" value="" placeholder="Search ..." data-kt-search-element="input" />
                                <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                                    <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                                </span>
                                <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="clear">
                                    <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                        </svg>
                                    </span>
                                </span>
                            </form>
                            <div class="py-5">
                                <div data-kt-search-element="results">
                                    <div class="mh-375px scroll-y me-n7 pe-7 list-unit">
                                    `+unitListHtml+`
                                    </div>
                                    <div class="d-flex mt-15">
                                    <div class="col-3">
                                        <label class="text-gray-600">Sisa Target</label>
                                        <h2 id="sisa-`+uuid+`"></h2>
                                    </div>
                                    </div>
                                </div>
                                <div data-kt-search-element="empty" class="text-center d-none">
                                    <div class="fw-bold py-10">
                                        <div class="text-gray-600 fs-3 mb-2">Pencarian '[Search]'</div>
                                        <div class="text-muted fs-6">Belum ada data yang dapat ditampilkan.</div>
                                    </div>
                                    {{--<div class="text-center px-5">
                                        <img src="assets/media/illustrations/sketchy-1/1.png" alt="" class="w-100 h-200px h-sm-325px" />
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `

    $('#list-modal').append(modalNewHtml)
    $('#modal-'+uuid+" .id-parent").val(uuid)
    $('.parameter').removeClass('d-none')
    $('#empty-handler').addClass('d-none')
    sParameter()
}

function deleteParameter(param){
    let count= $('.div-parameter').length
    if(count==1){
        $('.parameter').addClass('d-none')
        $('#empty-handler').removeClass('d-none')
    }

    if(param.length<11){
        deletedArr.push(param)
    }

    $('#parent-'+param).remove()
}

let targets=[]
let subs=[]

function serializeTarget(){
    targets=[]

    const tar = $('[name="targets[]"]').serializeArray()
    
    if(tar.length>0){
        for(s in tar){

            const subArr = $('#modal-'+tar[s].value+' [name="chk-bobot[]"]').serializeArray()
            subs=[]
            for (sb in subArr){
                if(subArr.length>0){
                    const subTarget= $('#modal-'+tar[s].value+' #target-sub-'+subArr[sb].value).val()
                    const subBobot=$('#modal-'+tar[s].value+' #bobot-sub-'+subArr[sb].value).val()
                    console.log(subArr[sb].value)
                    console.log($('#modal-'+tar[s].value+' #target-sub-'+subArr[sb].value))
                    subs.push(//subtarget
                        {
                            unit_id:subArr[sb].value,
                            target:subTarget,
                            bobot:subBobot,
                        }
                    )
                }
            }
        

            const par = $('#parameter-'+tar[s].value).val()
            const pic = $('#pic-'+tar[s].value).val()
            const trg = $('#target-'+tar[s].value).val()
            const bob = $('#bobot-'+tar[s].value).val()
            let ids=""
            if(tar[s].value.length<10){
                ids=tar[s].value
            }else{
                ids=""
            }
            targets.push(
                {
                    id:ids,
                    parameter_id:par,
                    unit_id:rl_now==rl_unit?unit_id:$('#select_unit').val(),
                    pic:pic,
                    target:trg==''?0:trg,
                    bobot:bob,
                    subtargets: subs
                }
            )
        }
    }
}

function simpan(param) {
    ewpLoadingShow()
    serializeTarget()

    let data = {
        send: param,
        year_id:id=="korporat"?$('#select_year').val():id,
        targets:targets,
        deleted_targets:deletedArr
    }
    let link = urlApi + "setting-kpi/targets"
    let tipe ="POST"

    if(targets.length>0){
        $.ajax({
            type: tipe,
            dataType: "json",
            data:data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Authorization: "Bearer " + localStorage.getItem("ppre_token"),
            },
            url: link,
            success: function (response) {
                ewpLoadingHide();
                let status =
                    param == 0
                        ? "Setting disimpan sebagai draft."
                        : "Setting berhasil disimpan";
                
                Swal.fire({
                    title: "Berhasil!",
                    text: status,
                    icon: "success",
                }).then((result) => {
                    show();
                    $("#modal").modal("hide");
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                ewpLoadingHide();
                handleErrorDetail(xhr);
            },
        });
    }else{
        hapus($("#modal #id").val())
    }
    
}


function accept() {

    let sa = $('[name="chk-parameter"]').serializeArray()
    let id=[]
    if(sa.length>0){
        for (s in sa){
            id.push(sa[s].value)
        }
    }
    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: "Bearer " + localStorage.getItem("ppre_token"),
        },
        data:{id},
        url: urlApi + "setting-kpi/targets/approve",
        success: function (response) {
            Swal.fire({
                title: "Berhasil!",
                text: "Pengajuan di Approve",
                icon: "success",
            }).then((result) => {
                show();
            });
        },
        error: function (response) {
            handleError(response);
        },
    });
}

function rollback() {
    $('#modal-rollback').modal('show')
    $('#modal-rollback #id_target').val(targeted_id)
}

function ajaxRollback() {
    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: "Bearer " + localStorage.getItem("ppre_token"),
        },
        data:{description:$('#modal-rollback #note-rollback').val()},
        url: urlApi + "setting-kpi/targets/reject/"+$('#modal-rollback #id_target').val(),
        success: function (response) {
            Swal.fire({
                title: "Berhasil!",
                text: "Pengajuan di Rollback",
                icon: "success",
            }).then((result) => {
                show();
                $('#modal-rollback').modal('hide')
            });
        },
        error: function (response) {
            handleError(response);
        },
    });
}

function sUnit(){
    $("#select_unit").select2({
        allowClear: true,
        placeholder: "Pilih korporat/unit",
        ajax: {
          url: urlApi + "setting-kpi/target-units",
          dataType: "json",
          type: "GET",
          quietMillis: 50,
          headers: {
              "Authorization" : "Bearer "+localStorage.getItem('ppre_token'),
          },
         
          data: function (term) {
            return {
                "search":term.term,
             };
          },
          processResults: function (data) {
            return {
              results: $.map(data.data.units, function (item) {
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

function sParameter(){
    $(".select_parameter").select2({
        allowClear: true,
        placeholder: "Pilih Parameter",
        ajax: {
          url: urlApi + "setting-kpi/target-parameters",
          dataType: "json",
          type: "GET",
          quietMillis: 50,
          headers: {
              "Authorization" : "Bearer "+localStorage.getItem('ppre_token'),
          },
         
          data: function (term) {
            return {
                "search":term.term,
             };
          },
          processResults: function (data) {
            parameterArr=data.data['parameters']
            return {
              results: $.map(data.data['parameters'], function (item) {
                return {
                  text: item.parameter,
                  id: item.id,
                };
              }),
            };
          },
        },
      });
}

function sYear() {
    $("#select_year").select2({
        allowClear: true,
        placeholder: "Pilih year",
        ajax: {
            url: urlApi + "setting-kpi/target-years",
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
                    results: $.map(data.data.target_years, function (item) {
                        return {
                            text: item.year,
                            id: item.id,
                        };
                    }),
                };
            },
        },
    });
}