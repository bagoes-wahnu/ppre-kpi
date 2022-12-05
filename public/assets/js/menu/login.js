jQuery(document).ready(function() {
    $('.input-login').keyup(function(event){
        event.preventDefault();
        if (event.keyCode === 13) {
            login()
        }
    })
    $("#btn-eye1").click(function () {
        let status= $("#inp-eye1").attr("type") =="text"?"password":"text"
        let icondel= $("#inp-eye1").attr("type") =="text"?"la-eye":"la-eye-slash"
        let icons= $("#inp-eye1").attr("type") !=="text"?"la-eye":"la-eye-slash"
        $("#inp-eye1").attr("type",status)
        $("#i-eye1").addClass(icons)
        $("#i-eye1").removeClass(icondel)
    });
});


function loadStart(){
    //start
    $('#btn-simpan .indicator-label').css('display','none')
    $('#btn-simpan .indicator-progress').css('display','inline')
}

function loadStop(){
    //finished
    $('#btn-simpan .indicator-label').css('display','inline')
    $('#btn-simpan .indicator-progress').css('display','none')
}


function login(){
    $.ajax({
        url:urlApi+'login',
        type:'POST',
        data:{
            username: $('#xa-username').val(), 
            password: $('#xa-password').val()
            // password: $('#inp-eye1').val()
        },
        beforeSend:function(){
            loadStart()
        },
        success:function(response){
            let res = response.data

            var authJSON = {
                    "ppre_token" : res.token.access_token,
                    "ppre_userID" :  res.user.id,
                    "ppre_userName" : res.user.name,
                    "ppre_roleID" : res.user.role_id.id,
                    "ppre_roleName" : res.user.role_id.name,
                    "status" : 1
                }

            if (localStorage.getItem('ppre_credential') !== null) {
                var credentialJSON = JSON.parse(localStorage.getItem('ppre_credential'))
                var newCredentialJSON = []

                for (c in credentialJSON) {
                    let cred = credentialJSON[c]
                    if (cred.status == 1) {
                        var new_cred = {
                            "ppre_token" : cred.ppre_token,
                            "ppre_userID" :  cred.ppre_userID,
                            "ppre_userName" : cred.ppre_userName,
                            "ppre_roleID" : res.user.role_id.id,
                            "ppre_roleName" : res.user.role_id.name,
                            "status" : 0
                        }
                    } else{
                        var new_cred = cred
                    }

                    if (cred.ppre_userID !== res.user.id) {
                        newCredentialJSON.push(new_cred)
                    }
                }
            }
            else{
                var newCredentialJSON = []
            }

            newCredentialJSON.push(authJSON)
            const credentialSTRING = JSON.stringify(newCredentialJSON);
            localStorage.setItem("ppre_credential", credentialSTRING);

            localStorage.setItem("ppre_token", res.token.access_token);
            localStorage.setItem("ppre_userID", res.user.id);
            localStorage.setItem("ppre_userName", res.user.name);
            localStorage.setItem("ppre_roleID", res.user.role_id.id);
            localStorage.setItem("ppre_roleName", res.user.role_id.name);

            window.location.href = baseUrl+"dashboard";
        },
        error:function(msg, status, error){
            let code = msg.status
            let  message = msg.responseJSON.status.message
            let type = 'error'

            if(code == 401){
                type = 'warning'
            }
            
            loadStop()
            
            localStorage.setItem("token", '');
            Swal.fire('Oopss...', message, type);
        }
    });
}

function showPassword(){
    if(document.getElementById('xa-password').type == 'password') {
        document.getElementById('xa-password').type = 'text'
    } else {
        document.getElementById('xa-password').type = 'password'
    }
}
