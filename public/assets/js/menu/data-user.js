
let typeUser=""
let typeAtasan=""
$(document).ready(function () {
    table();
    $(document).on("click", '[name="type"]', function (e) {
        let types = $(this).val();
        $('.div-form-child').addClass('d-none')
        typeUser=types
        $('.div-name label').html("Nama")
        $('.div-simpan').removeClass('d-none')
        if(types=='1'){
            $('.div-name,.div-base').removeClass('d-none')
        }else if(types=='2'){
            $('.div-name label').html("Nama Unit")
            $('.div-pimpinan,.div-name,.div-base').removeClass('d-none')
        }else{
            $('.div-is-atasan').removeClass('d-none')
        }
    });

    $(document).on("click", '[name="is_atasan"]', function (e) {
        let atasan= $(this).val();
        $('.div-form-child').addClass('d-none')
        $('.div-name label').html("Nama")
        // if(typeUser=='2' && atasan=='1'){
        //     $('.div-name label').html("Nama Unit")
        //     $('.div-pimpinan,.div-is-atasan,.div-name,.div-base').removeClass('d-none')
        // }else if(typeUser=='2' && atasan=='0'){
        //     $('.div-name label').html("Nama Direksi")
        //     $('.div-name,.div-base,.div-is-atasan').removeClass('d-none')
        // }else 
        typeAtasan=atasan
        if(typeUser=='3' && atasan=='1'){
            $('.div-name label').html("Nama Direksi")
            $('.div-pimpinan,.div-is-atasan,.div-name,.div-base').removeClass('d-none')
        }else if(typeUser=='3' && atasan=='0'){
            $('.div-name label').html("Nama Direksi")
            $('.div-name,.div-base,.div-is-atasan').removeClass('d-none')
        }
    });
    sPimpinan()
    // pageActive()
});

$("body").on('click', '.adjs-btn-del', function (e) {
    $(this).parent().parent().parent().remove()
});

function table() {
    document.getElementById("table-wrapper").innerHTML = ewpTable({
      targetId: "dttb-data-user",
      class: "table table-bordered table-head-custom table-vertical-center",
      column: [
        { name: "No", width: "10" },
        { name: "Nama", width: "40" },
        { name: "Tipe", width: "20" },
        { name: "Status", width: "20" },
        { name: "Action", width: "15" },
      ],
    });
  
    // let disableColumn=roleLogin==rl_candal?true:false
    // let sortingColumn=roleLogin==rl_candal?5:1
    geekDatatables({
      target: "#dttb-data-user",
      url: urlApi + "master-user",
      sorting: [1, "desc"],
      apiKey: "data",
      column: [
        {
            col: "id", 
            mid: true,
            mod: {
                aTargets: [0],
                bSortable:false,
                bSearchable:false,
                mRender: function (data, type, full,draw) {
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
                mRender: function (data, type, full,draw) {
                    return data
                },
            },
        },
        {
            col: "role_id", 
            mid: true,
            mod: {
                aTargets: [2],
                bSearchable:false,
                mRender: function (data, type, full,draw) {
                    return full.tipe
                },
            },
        },
        {
            col: "status", 
            mid: true,
            mod: {
                aTargets: [3],
                //bSortable:false,
                mRender: function (data, type, full,draw) {
                    // if(data=="1"){
                    //     var status=`
                    //     <div class="form-check form-check-solid form-switch fv-row">
                    //         <input class="form-check-input w-46px h-25px" type="checkbox" id="status" checked="checked" disabled/>
                    //     </div>
                    //     `
                    // }else{
                    //     var status=`
                    //     <div class="form-check form-check-solid form-switch fv-row">
                    //         <input class="form-check-input w-46px h-25px" type="checkbox" id="status" disabled/>
                    //     </div>
                    //     `
                    // }
                    let statusCheck=data==true?"checked='checked'":""
                    var status=`
                    <div style="justify-content: center;display: flex;">
                        <div class="form-check form-check-solid form-switch fv-row">
                        <input class="form-check-input w-46px h-25px" type="checkbox" `+statusCheck+` value="`+full.id+`" id="status" onclick="changeStatus(`+full.id+`)"/>
                        </div>
                    </div>
                    `
                    return status
                },
            },
        },
        {
          col: "id",
          mid: true,
          mod: {
            aTargets: [-1],
            bSortable:false,
            bSearchable:false,
            mRender: function (data, type, full) {
                var button=``
                if(full.role_id!=='1'){
                    button=`
                    <a onclick="edit(`+data+`)" data-bs-toggle="modal" data-bs-target="#kt_modal_edit">
                        <span>
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 5C0 2.23858 2.23858 0 5 0H27C29.7614 0 32 2.23858 32 5V27C32 29.7614 29.7614 32 27 32H5C2.23858 32 0 29.7614 0 27V5Z" fill="white"/>
                            <path d="M21.669 14.9489L15.2958 21.6868C15.1069 21.8865 14.8442 21.9997 14.5693 21.9997L11.6666 21.9997C11.1143 21.9997 10.6666 21.5519 10.6666 20.9997L10.6666 18.0713C10.6666 17.8116 10.7676 17.562 10.9484 17.3755L17.3877 10.7293C17.772 10.3326 18.4051 10.3226 18.8018 10.7069C18.8055 10.7106 18.8093 10.7143 18.813 10.718L21.6496 13.5546C22.0324 13.9375 22.041 14.5555 21.669 14.9489Z" fill="#FCAD00"/>
                            </svg>
                        </span>
                    </a>
                    `
                }
                
                  return button;
            },
          },
        },
    ],
});
}

function create()
{
    event.preventDefault()
    clearForm()
    sPimpinan()
    $("#modal-add #modal-title").html("Tambah Master User")
    $("#kt_modal_add").modal("show");
    $('.div-active').removeClass('active')
    $('[name="type"]').prop('disabled',false)
}

function clearForm(){
    $('#kt_modal_add [name="type"]:checked').prop('checked',false)
    $('#kt_modal_add [name="is_atasan"]:checked').prop('checked',false)
    $('#kt_modal_add #select-pimpinan').val(null).trigger("change")
    $("#kt_modal_add #nama-unit").val("")
    $("#kt_modal_add #field-nama").val("")
    $("#kt_modal_add #username").val("")
    $("#kt_modal_add #password").val("")
    $("#kt_modal_add #pic").val("")
    $('.div-name,.div-base,.div-is-atasan,.div-simpan').addClass('d-none')
}

// function is_atasan(param){
//     // typeDinas=param;
//     switch(param) {
//         case "1":
//             $("#field-jenis").removeClass("d-none")
//             // SlcBtn("TP1")
//             // notSlcBtn("TP2")
//             // paramDinas=2
//             break;
//         case "0":
//             $("#field-jenis").addClass("d-none")
//             // SlcBtn("TP2")
//             // notSlcBtn("TP1")
//             // paramDinas=1
//             // $('#select-sector-penomoran-cr').val(null).trigger("change")
//             // $('#select-sector-penomoran-ed').val(null).trigger("change")
//             break;
//         default:

//       }
// }

function edit(id) 
{
    clearForm()
    ewpLoadingShow();
    if (id != null) {
        $.ajax({
          type: "GET",
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "Authorization": "Bearer " + localStorage.getItem("ppre_token")
          },
          url: urlApi + "master-user/detail/" + id,
          success: function (response) {
            ewpLoadingHide();
            res = response.data.user;
            let roles=res.role.id
            $("#kt_modal_add #modal-title").html("Edit Data User")
            $("#kt_modal_add #id").val(id)
            $('[name="type"]').prop('disabled',true)
            if(roles=='3'){
                typeUser='1'
                $('.div-name,.div-base,.div-simpan').removeClass('d-none')
                
                $('#kt_modal_add .type-1').prop('checked',true)
                $('#kt_modal_add .type-1').prop('disabled',false)
                $("#kt_modal_add #field-nama").val(res.name)
                $("#kt_modal_add #username").val(res.username)
                $("#kt_modal_add #pic").val(res.pic)

            }else if(roles=='2'){
                typeUser='3'
                $('#kt_modal_add .type-3').prop('checked',true)
                $('#kt_modal_add .type-3').prop('disabled',false)
                if(res.jenis!=='2'){
                    if(res.atasan!==null){
                        $('.is_atasan1').prop('checked',true)
                        typeAtasan='1'
                        $('#kt_modal_add .radio-1').prop('checked','true')
                        let usr =
                        "<option selected='selected' value='" +
                        res?.atasan?.id +
                        "'>" +
                        res?.atasan?.name +
                        "</option>";
        
                        $("#kt_modal_add #select-pimpinan")
                            .append(usr)
                            .trigger("change");
                    }else{
                        typeAtasan='0'
                        $('#kt_modal_add .radio-0').prop('checked','true')
                    }
                }

                $("#kt_modal_add #field-nama").val(res.name)
                $("#kt_modal_add #username").val(res.username)
                $("#kt_modal_add #pic").val(res.pic)
                $('.div-name label').html("Nama Direksi")
                $('.div-name,.div-base,.div-is-atasan,.div-simpan').removeClass('d-none')
            }else if(roles=='4'){
                typeAtasan='1'
                typeUser='2'
                $('.div-name label').html("Nama Unit")
                $('.div-pimpinan,.div-name,.div-base,.div-simpan').removeClass('d-none')
                $('#kt_modal_add .type-2').prop('checked',true)
                $('#kt_modal_add .type-2').prop('disabled',false)
                let usr =
                "<option selected='selected' value='" +
                res?.atasan?.id +
                "'>" +
                res?.atasan?.name +
                "</option>";

                $("#kt_modal_add #select-pimpinan")
                    .append(usr)
                    .trigger("change");

                $("#kt_modal_add #field-nama").val(res.name)
                $("#kt_modal_add #username").val(res.username)
                $("#kt_modal_add #pic").val(res.pic)
                $('.div-name label').html("Nama Unit")
            } 
            $("#kt_modal_add").modal("show");
          },
          error: function (xhr, ajaxOptions, thrownError) {
            ewpLoadingHide();
            handleErrorDetail(xhr);
          },
        });
    }
    
}

function hapus (id_konsumen) 
{
    event.preventDefault()
    Swal.fire({
        title: 'Apakah anda yakin akan menghapus data ini?',
        text: "Data yang sudah dihapus tidak dapat dikembalikan kembali",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#d14529',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {  
            $.ajax({
                type: "DELETE",
                headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Authorization": "Bearer " + localStorage.getItem("ppre_token") },
                url: urlApi+"master/consumer/" + id_konsumen ,
                success: function (response) {
                    Swal.fire({
                        title:"Berhasil",
                        text:"Data berhasil dihapus.",
                        icon:"success",
                        confirmButtonText: "Selesai",
                        customClass: {
                            confirmButton: "btn btn-success",
                        }
                    })
                    table();
                },
                error: function ( xhr, ajaxOptions, thrownError) {
                    handleErrorDetail(xhr)
                },
            });
        }
    })
}

function simpan(){
    ewpLoadingShow()
        let data = {}
        // data = {
        //     type: typeUser,
        //     is_atasan: $('#kt_modal_add [name="is_atasan"]:checked').val(),
        //     unit: $("#kt_modal_add #nama-unit").val(),
        //     jenis: $('#kt_modal_add [name="jenis"]:checked').val(),
        //     name: $("#kt_modal_add #field-nama").val(),
        //     username: $("#kt_modal_add #username").val(),
        //     password: $("#kt_modal_add #password").val(),
        //     atasan: $('#kt_modal_add #select-pimpinan').val(),
        //     pic: $("#kt_modal_add #pic").val(),
        // };
        if(typeUser=='1'){
            data={
                type: typeUser,
                name: $("#kt_modal_add #field-nama").val(),
                username: $("#kt_modal_add #username").val(),
                password: $("#kt_modal_add #password").val(),
                pic: $("#kt_modal_add #pic").val(),
            };
        }else if(typeUser=='2'){
            data={
                type: typeUser,
                is_atasan: 1,
                name: $("#kt_modal_add #field-nama").val(),
                username: $("#kt_modal_add #username").val(),
                password: $("#kt_modal_add #password").val(),
                atasan: $('#kt_modal_add #select-pimpinan').val(),
                pic: $("#kt_modal_add #pic").val(),
                jenis:2
            };
        }
        // else if(typeUser=='2' && typeAtasan=='1'){
        //     data={
        //         type: typeUser,
        //         is_atasan: $('#kt_modal_add [name="is_atasan"]:checked').val(),
        //         name: $("#kt_modal_add #field-nama").val(),
        //         username: $("#kt_modal_add #username").val(),
        //         password: $("#kt_modal_add #password").val(),
        //         pic: $("#kt_modal_add #pic").val(),
        //     };
        // }
        else if(typeUser=='3' && typeAtasan=='0'){
            data={
                type: '2',
                //is_atasan: $('#kt_modal_add [name="is_atasan"]:checked').val(),
                name: $("#kt_modal_add #field-nama").val(),
                username: $("#kt_modal_add #username").val(),
                password: $("#kt_modal_add #password").val(),
                pic: $("#kt_modal_add #pic").val(),
                jenis:1
            };
        }
        else if(typeUser=='3' && typeAtasan=='1'){
            
            data={
                type: '2',
                is_atasan: $('#kt_modal_add [name="is_atasan"]:checked').val(),
                atasan: $('#kt_modal_add #select-pimpinan').val(),
                name: $("#kt_modal_add #field-nama").val(),
                username: $("#kt_modal_add #username").val(),
                password: $("#kt_modal_add #password").val(),
                pic: $("#kt_modal_add #pic").val(),
                jenis: 1
            };
        }

        let tipe = $("#kt_modal_add #id").val() == "" ? "POST" : "PUT";
        let link = $("#kt_modal_add #id").val() == ""
        ? urlApi + "master-user/store"
        : urlApi +
          "master-user/update/" +
          $("#kt_modal_add #id").val();
        $.ajax({
            type: tipe,
            dataType: "json",
            data: data,
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "Authorization": "Bearer " + localStorage.getItem("ppre_token") },
            url: link,
            success: function (response) {
            let status = $("#kt_modal_add #id").val() == "" ? "disimpan" : "dirubah";
            //if($('#status-prioritas').prop('checked')){
                //changeStatus(response.data.consumer.id,$('#status-prioritas').prop('checked'))
            //} 
            ewpLoadingHide()
            Swal.fire({
                title: "Berhasil!",
                text: "Data berhasil " + status + ".",
                icon: "success",
            }).then((result) => {
                table();
                $("#kt_modal_add").modal("hide");
            });
            
           
            
            },
            error: function (xhr, ajaxOptions, thrownError) {
            ewpLoadingHide()
            handleErrorDetail(xhr)
        },
    });
}

function changeStatus(id){
    $.ajax({
        type:'PATCH',
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        "Authorization": "Bearer " + localStorage.getItem("ppre_token")  
        },
        // data:{
        //     id:id,
        //     aktif:((document.getElementById('check-'+id).checked) ? 1 : 0)
        // },
        url : urlApi + 'master-user/change-status/'+id,
        success : function(response){
            toastr.success('Status prioritas berhasil dirubah');
            table()
        },
        error : function(response){
            handleError(response)
        }
    })
}

function sPimpinan() {
    $("#select-pimpinan").select2({
        allowClear: true,
        placeholder: "Pilih Pimpinan",
        ajax: {
            url: urlApi + "master-user/get-pimpinan",
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
                    results: $.map(data.data["user"], function (item) {
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

function btnEditStamp(){
    is_editStamp=!is_editStamp
    if(is_editStamp){
         $('#edit-stempel').html("Batal")
         $('#div-all-stempel').removeClass('d-none')
    }else{
         $('#edit-stempel').html("Edit")
         $('#div-all-stempel').addClass('d-none')
    }
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