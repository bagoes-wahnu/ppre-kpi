jQuery(document).ready(function($) {
    show()
    pageActive()

});	

function pageActive(){
    $('#nav-struktur-organisasi').addClass('active')
}

function show(){
    ewpLoadingShow()
    $.ajax({
        type: "GET",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: urlApi + "organization-structure/index",
        beforeSend: function (xhr) {
          xhr.setRequestHeader(
            "Authorization",
            "Bearer " + localStorage.getItem("ppre_token")
          );
        },
        success: function (response) {
            let res=response.data.structure
            let html=``
            if(res.length>0){
                for (p in res){
                    let child1=res[p].bawahan
                    let htmlC1=``
                    if(child1.length>0){
                        for (c1 in child1){
                            //CHILD2 - start
                            let child2=child1[c1].bawahan
                            let htmlC2=``
                            if(child2.length>0){
                                for (c2 in child2){        
                                    //CHILD3 - start
                                    let child3=child2[c2].bawahan
                                    let htmlC3=``
                                    if(child3.length>0){
                                        for (c3 in child3){   
                                            //CHILD4 - start
                                            let child4=child3[c3].bawahan
                                            let htmlC3=``
                                            if(child4.length>0){
                                                for (c4 in child4){                                    
                                                    htmlC3+=`
                                                        <li data-jstree='{ "opened" : true }'>
                                                            <span class="mb-4">`+child4[c4].name+`</span>
                                                        </li>
                                                    `
                                                }
                                            }    
                                            //CHILD4 - end                                  
                                            htmlC3+=`
                                                <li data-jstree='{ "opened" : true }'>
                                                    <span class="mb-4">`+child3[c3].name+`</span>
                                                    <ul>
                                                    `+htmlC4+`
                                                    </ul>
                                                </li>
                                            `
                                        }
                                    }    
                                    //CHILD3 - end                     
                                    htmlC2+=`
                                        <li data-jstree='{ "opened" : true }'>
                                            
                                            <span class="mb-4">`+child2[c2].name+`</span>
                                            <ul>
                                            `+htmlC3+`
                                            </ul>
                                        </li>
                                    `
                                }
                            }
                            //CHILD2 - end
                            htmlC1+=`
                                <li data-jstree='{ "opened" : true }'>
                                    <span class="mb-4">`+child1[c1].name+`</span>
                                    <ul>
                                    `+htmlC2+`
                                    </ul>
                                </li>
                            `
                        }
                    }
                    
                    html+=`
                    <ul>
                        <li data-jstree='{ "opened" : true }'>
                            <span class="mb-4">`+res[p].name+`</span>
                            <ul>
                            `+htmlC1+`
                            </ul>
                        </li>
                    </ul>
                    `
                }

                $('#list-struktur').html(html).jstree({
                    "core" : {
                        "themes" : {
                            "responsive": false
                        }
                    },
                    "types" : {
                        "default" : {
                            "icon" : "bi bi-circle-fill text-primary"
                        },
                    },
                    "plugins": ["types"]
                });
            }else{
                $('#div-empty').removeClass("d-none")
            }
            
           ewpLoadingHide()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            ewpLoadingHide()
          handleErrorDetail(xhr);
        },
    });
}