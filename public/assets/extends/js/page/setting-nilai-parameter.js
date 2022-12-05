jQuery(document).ready(function($) {
    show()
    pageActive()
});	

function pageActive(){
    $('#nav-setting-nilai').addClass('active')
}

function editSetting(param) {
    $('#modal #id').val(param)
    $('#modal #poin').val($('#input-'+param).val())
    $('#modal .modal-title,#modal .modal-desc').html($('#title-'+param).html())
    
	$('#modal').modal('show')
}

function show(){
    ewpLoadingShow()
    $.ajax({
        type: "GET",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: urlApi + "setting-parameter",
        beforeSend: function (xhr) {
          xhr.setRequestHeader(
            "Authorization",
            "Bearer " + localStorage.getItem("ppre_token")
          );
        },
        success: function (response) {
            let res=response.data.setting_nilai_parameter
            console.log(res)
            for (i in res){
                if(res[i].key_setting=="minimal"){
                    console.log($('.data-1'))
                    $('.data-1').html(noNull(fltNum(res[i].value)))
                     $('#input-1').val(fltNum(res[i].value))
                }else if(res[i].key_setting=="maksimal"){
                    console.log($('.data-2'))
                    $('.data-2').html(noNull(fltNum(res[i].value)))
                     $('#input-2').val(fltNum(res[i].value))
                }else{
                    console.log("other")
                }
                
            }
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
    let link="setting-parameter/update/"+param
    let data={"nilai": $('#modal #poin').val()}
    
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

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };