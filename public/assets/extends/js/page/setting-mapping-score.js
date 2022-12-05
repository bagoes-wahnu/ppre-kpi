jQuery(document).ready(function($) {
    show()
    pageActive()

    $(document).on("click", '.check-color', function (e) {
        let ids=$(this).val()
        $('.check-color').prop('checked',false)
        $(this).prop('checked',true)
    });
});	

//color green,teal,orange,yellow,red
let colorStatus=['#50CD89',"#1BC5BD","#FFA800","#FFC700","#F1416C"]

function pageActive(){
    $('#nav-setting-mapping').addClass('active')
}

function clear(){
    $('#modal #name').val("")
    $('#modal #desc').val("")
    $('#modal #mapping-start').val("")
    $('#modal #mapping-end').val("")
    $('#modal .check-color:checked').attr("checked",false)
}

function show(){
    ewpLoadingShow()
    $.ajax({
        type: "GET",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: urlApi + "setting-mapping-score",
        beforeSend: function (xhr) {
          xhr.setRequestHeader(
            "Authorization",
            "Bearer " + localStorage.getItem("ppre_token")
          );
        },
        success: function (response) {
            let res=response.data.setting_mapping_score
            console.log(res)
            let html=``
            for (i in res){
                let color=res[i].color!==null?res[i]?.color?.code:'#ccc'
                html+=`
                <div class="col-md-3 px-2" style="width:20%">
                    <div class="text-center setting-item border rounded p-4" style="">
                        <h4 class="text-dark font-weight-bolder" id="title-`+res[i].id+`">`+res[i].name+`</h4>
                        <span class="text-muted" style="font-size:12px">`+res[i].description+`</span>
                        <h1 class=" font-weight-bolder mt-1" >
                            <span class="data-1 text-darkblue">`+fltNum(res[i].min_value)+` -  `+fltNum(res[i].max_value)+`</span> 
                            <a href="javascript:;" class="btn"  data-toggle="m-tooltip" title="`+res[i].description+`" style="padding: 4px !important">
                                <span class="">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="12" fill="`+color+`"/>
                                    <g clip-path="url(#clip0)">
                                    <path d="M12.6783 8.82144L15.1787 11.3218L9.74917 16.7513L7.51987 16.9974C7.22143 17.0304 6.96929 16.7781 7.00249 16.4796L7.25054 14.2488L12.6783 8.82144ZM16.7251 8.44917L15.5511 7.27515C15.1849 6.90894 14.591 6.90894 14.2248 7.27515L13.1203 8.37964L15.6207 10.88L16.7251 9.77554C17.0914 9.40913 17.0914 8.81538 16.7251 8.44917Z" 
                                    fill="`+color+`"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0">
                                    <rect width="10" height="10" fill="white" transform="translate(7 7)"/>
                                    </clipPath>
                                    </defs>
                                    </svg>
                                </span>
                            </a>
                            <a href="javascript:;" class="btn" onclick="editSetting('`+res[i].id+`')" data-toggle="m-tooltip" title="Edit " style="padding: 4px !important">
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
                `
            }
            $('#list-mapping').html(html)
            ewpLoadingHide()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            ewpLoadingHide()
          handleErrorDetail(xhr);
        },
    });
}

function editSetting(param) {
    clear()
    ewpLoadingShow()
    $.ajax({
        type: "GET",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: urlApi + "setting-mapping-score/detail/"+param,
        beforeSend: function (xhr) {
          xhr.setRequestHeader(
            "Authorization",
            "Bearer " + localStorage.getItem("ppre_token")
          );
        },
        success: function (response) {
            let res=response.data.setting_nilai_parameter
            $('#modal #id').val(res.id)
            $('#modal #name').val(res.name)
            $('#modal #desc').val(res.description)
            $('#modal #mapping-start').val(fltNum(res.min_value))
            $('#modal #mapping-end').val(fltNum(res.max_value))

           
            let resColor=response.data.color_list
            let html=``
            for (i in resColor){
                let status=resColor[i].id==res?.color?.id?"checked='checked'":""
                html+=`
                <div class="form-check form-check-custom form-check-solid pe-0" style="width:auto !important;">
                    <input class="form-check-input check-color" type="checkbox" `+status+` value="`+resColor[i].id+`" style="background-color:`+resColor[i].code+`"/>
                    <label class="form-check-label" for="flexCheckDefault"></label>
                </div>
                `
            }
            $('#modal #list-color').html(html)

            $('#modal .modal-title,#modal .modal-desc').html($('#title-'+param).html())
            $('#modal').modal('show')
            ewpLoadingHide()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            ewpLoadingHide()
          handleErrorDetail(xhr);
        },
    });
}

function simpan(){
    loadStart()
    ewpLoadingShow()
    let param= $('#modal #id').val()
    let link="setting-mapping-score/update/"+param
    let data={
        "nama": $('#modal #name').val(),
        "keterangan": $('#modal #desc').val(),
        "nilai_minimal": $('#modal #mapping-start').val(),
        "nilai_maksimal": $('#modal #mapping-end').val(),
        "id_warna": $('#modal .check-color:checked').val(),
    }

    $.ajax({
          type: "PUT",
          dataType: "json",
          data: data,
          url: urlApi+link,
          beforeSend: function (xhr) {
          xhr.setRequestHeader(
              "Authorization",
              "Bearer " + localStorage.getItem("ppre_token")
          );
          },
          success: function (response) {
          loadStop()
            
            $('#modal').modal('hide')
            ewpLoadingHide()
            toastr.success("Nilai parameter berhasil tersimpan!");
            show()
          },
          error: function (xhr, ajaxOptions, thrownError) {
            loadStop()
            ewpLoadingHide()
            handleErrorDetail(xhr)
        },
    });
}