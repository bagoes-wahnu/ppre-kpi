let id=$('#id').val()

let year=""
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
year = urlParams.get('year')

jQuery(document).ready(function($) {
    
    pageActive()
    $('#year-title').html('Tahun '+year)
});	

function pageActive(){
    $('#nav-setting-rumus').addClass('active')
    show()
}

function show(){
    ewpLoadingShow();

    $.ajax({
        type: "GET",
        headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: urlApi + "setting-kpi/condition-formulas?year_id="+id,
        beforeSend: function (xhr) {
        xhr.setRequestHeader(
            "Authorization",
            "Bearer " + localStorage.getItem("ppre_token")
        );
        },
        success: function (response) {
            ewpLoadingHide();
            let conditions = response.data.conditions
            // console.log(conditions)

            let htmlCondition = ``
            if (conditions.length > 0) {

                for (c in conditions) {
                    let condition = conditions[c]
                    let conditionFormulas = conditions[c].condition_formulas

                    let htmlConditionFormula = ``
                    if (conditionFormulas.length > 0) {

                        for (cf in conditionFormulas) {
                            let conditionFormula = conditionFormulas[cf]

                            let htmlBtnConditionFormula = ``
                            if (cf == 0) {
                                htmlBtnConditionFormula = `
                                <button class="btn btn-icon btn-light-primary btn-active-light-primary " onclick="addConditionFormula('${condition.id}', '${condition.name}')"><i class="bi bi-plus-lg"></i></button>`
                            }
                            else{
                                htmlBtnConditionFormula = `
                                <button class="btn btn-icon btn-danger btn-active-light-primary " onclick="removeConditionFormula('${condition.id}','${conditionFormula.id}')"><i class="bi bi-dash-lg"></i></button>`
                            }

                            let htmlOperatorOption = `<option value="" selected></option><option value=">"> > </option><option value="<"> < </option><option value=">="> >= </option><option value="<="> <= </option>`
                            if (conditionFormula.operator == '>') {htmlOperatorOption = `<option value=""></option><option value=">" selected> > </option><option value="<">  < </option><option value=">="> >=</option><option value="<="> <= </option>`}
                            if (conditionFormula.operator == '<') {htmlOperatorOption = `<option value=""></option><option value=">" > > </option><option value="<" selected> <  </option><option value=">=">>= </option><option value="<="> <= </option>`}
                            if (conditionFormula.operator == '>=') {htmlOperatorOption = `<option value=""></option><option value=">" > > </option><option value="<"> <  </option><option value=">=" selected> >=</option><option value="<="> <= </option>`}
                            if (conditionFormula.operator == '<=') {htmlOperatorOption = `<option value=""></option><option value=">" > > </option><option value="<"> <  </option><option value=">="> >=</option><option value="<=" selected> <= </option>`}

                            htmlConditionFormula += `
                             <tr class="condition-formula-item" id="condition-formula-item-${conditionFormula.id}">
                                    <input type="hidden" id="field-id-condition-formula-${conditionFormula.id}" value="${conditionFormula.id}"/>
                                    <input type="hidden" id="field-id-condition-${conditionFormula.id}" value="${condition.id}"/>
                                    <input type="hidden" id="field-condition-name-${conditionFormula.id}" value="${condition.name}"/>

                                    <td><input type="text" class="form-control skor" id="skor-${conditionFormula.id}" placeholder="Cth: 4" value="${noZero(conditionFormula.score).split('.').join(',')}"/></td>
                                    <td><input type="text" class="form-control kategori" id="kategori-${conditionFormula.id}" placeholder="Cth: Exceed Expectation" value="${noZero(conditionFormula.category)}"/></td>
                                    <td><input type="text" class="form-control keterangan" id="keterangan-${conditionFormula.id}" placeholder="Cth: Realisasi < 90%" value="${noZero(conditionFormula.description)}"/></td>
                                    <td>
                                        <select class="form-select select-operator" data-control="select2" id="select-operator-${conditionFormula.id}" data-placeholder="Pilih Kondisi">
                                            `+htmlOperatorOption+`
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control nilai nilai-min" id="nilai-min-${conditionFormula.id}" placeholder="Cth: 10" value="${noZero(conditionFormula.start_value).split('.').join(',')}"/></td>
                                    <td><input type="text" class="form-control nilai nilai-max" id="nilai-max-${conditionFormula.id}" placeholder="Cth: 12"  value="${noZero(conditionFormula.end_value).split('.').join(',')}"/></td>
                                    <td class="">
                                       `+htmlBtnConditionFormula+` 
                                    </td>
                                </tr>`
                        }
                    }
                    else{
                        let randIdFormula = Math.random().toString().substr(2, 8)
                        htmlConditionFormula += `<tr class="condition-formula-item" id="condition-formula-item-${randIdFormula}">
                            <input type="hidden" id="field-id-condition-formula-${randIdFormula}" value=""/>
                            <input type="hidden" id="field-id-condition-${randIdFormula}" value="${condition.id}"/>
                            <input type="hidden" id="field-condition-name-${randIdFormula}" value="${condition.name}"/>

                            <td><input type="text" class="form-control skor" id="skor-${randIdFormula}" placeholder="Cth: 4" value=""/></td>
                            <td><input type="text" class="form-control kategori" id="kategori-${randIdFormula}" placeholder="Cth: Exceed Expectation" value=""/></td>
                            <td><input type="text" class="form-control keterangan" id="keterangan-${randIdFormula}" placeholder="Cth: Realisasi < 90%" value=""/></td>
                            <td>
                                <select class="form-select select-operator" data-control="select2" id="select-operator-${randIdFormula}" data-placeholder="Pilih Kondisi">
                                    <option value="" selected></option>
                                    <option value=">"> > </option>
                                    <option value="<"> < </option>
                                    <option value=">="> >= </option>
                                    <option value="<="> <= </option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control nilai nilai-min" id="nilai-min-${randIdFormula}" placeholder="Cth: 10" value=""/></td>
                            <td><input type="text" class="form-control nilai nilai-max" id="nilai-max-${randIdFormula}" placeholder="Cth: 12"  value=""/></td>
                            <td class="">
                               <button class="btn btn-icon btn-light-primary btn-active-light-primary" onclick="addConditionFormula('${condition.id}', '${condition.name}')"><i class="bi bi-plus-lg"></i></button>
                            </td>
                        </tr>`
                    }

                    htmlCondition += `
                    <div class="mt-8 mb-8 tab-pane fade show active div-condition-formula-group border border-secondary rounded p-4" id="div-condition-formula-group-${condition.id}">
                        <div class="d-flex flex-column fv-row mb-2">
                            <label class="fs-3 fw-bold mb-2">${condition.name}</label>
                            
                        </div>
                        <table class="table gs-0 gy-1" id="table-condition-formula-group-${condition.id}">
                            <thead>
                                <tr class="fs-6 ">
                                    <th scope="col" style="width:10%">Skor</th>
                                    <th scope="col" style="width:25%">Kategori</th>
                                    <th scope="col" style="width:25%">Keterangan</th>
                                    <th scope="col" style="width:15%">Kondisi</th>
                                    <th scope="col" style="width:10%">Nilai</th>
                                    <th scope="col" style="width:10%" ></th>
                                    <th scope="col" style="width:5%" ></th>
                                </tr>
                            </thead>
                            <tbody id="table-body-condition-formula-${condition.id}">
                               
                               `+htmlConditionFormula+`

                            </tbody>
                        </table>
                    </div>`
                }
            }

            $('#list-rumus-kondisi').html(htmlCondition)

            $('.select-operator').select2()

            ewpFloatOnly('.skor')
            ewpFloatOnly('.nilai')
        },
        error: function (xhr, ajaxOptions, thrownError) {
            ewpLoadingHide();
            handleErrorDetail(xhr);
        }
    })
}


function addConditionFormula(condition_id, condition_name) {

    let randIdFormula = Math.random().toString().substr(2, 8)

    $('#table-body-condition-formula-'+condition_id).append(`
        <tr class="condition-formula-item" id="condition-formula-item-${randIdFormula}">
            <input type="hidden" id="field-id-condition-formula-${randIdFormula}" value=""/>
            <input type="hidden" id="field-id-condition-${randIdFormula}" value="${condition_id}"/>
            <input type="hidden" id="field-condition-name-${randIdFormula}" value="${condition_name}"/>

            <td><input type="text" class="form-control skor" id="skor-${randIdFormula}" placeholder="Cth: 4" value=""/></td>
            <td><input type="text" class="form-control kategori" id="kategori-${randIdFormula}" placeholder="Cth: Exceed Expectation" value=""/></td>
            <td><input type="text" class="form-control keterangan" id="keterangan-${randIdFormula}" placeholder="Cth: Realisasi < 90%" value=""/></td>
            <td>
                <select class="form-select select-operator" data-control="select2" id="select-operator-${randIdFormula}" data-placeholder="Pilih Kondisi">
                    <option value="" selected></option>
                    <option value=">"> > </option>
                    <option value="<"> < </option>
                    <option value=">="> >= </option>
                    <option value="<="> <= </option>
                </select>
            </td>
            <td><input type="text" class="form-control nilai nilai-min" id="nilai-min-${randIdFormula}" placeholder="Cth: 10" value=""/></td>
            <td><input type="text" class="form-control nilai nilai-max" id="nilai-max-${randIdFormula}" placeholder="Cth: 12"  value=""/></td>
            <td class="">
               <button class="btn btn-icon btn-danger btn-active-light-primary" onclick="removeConditionFormula('${condition_id}','${randIdFormula}')"><i class="bi bi-dash-lg"></i></button>
            </td>
        </tr>`)

    $('.select-operator').select2()

    ewpFloatOnly('.skor')
    ewpFloatOnly('.nilai')
}


function removeConditionFormula(condition_id, condition_formula_id){
   
    let id_formula = $('#field-id-condition-formula-'+condition_formula_id).val()
    
    if (id_formula !== '') {
        $.ajax({
            type: "DELETE",
            headers: { 
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "Authorization": "Bearer " + localStorage.getItem("ppre_token") },
            url: urlApi+"setting-kpi/condition-formulas/" + id_formula ,
            success: function (response) {
                toastr.success("Data Rumus kondisi berhasil di hapus!");
                $('#condition-formula-item-'+condition_formula_id).remove()
            },
            error: function (xhr, ajaxOptions, thrownError) {
                  handleErrorDetail(xhr)
            },
        });
    }
    else{
         $('#condition-formula-item-'+condition_formula_id).remove()
    }
}



function simpan() {

    ewpLoadingShow()

    let condition_formula_datas = []

    $('.condition-formula-item').each(function(index, el) {
        let id_el = $(this).attr('id')
        let arr = id_el.split("-")
        let unique_id = arr[arr.length - 1]

        let id_condition_formula = $('#field-id-condition-formula-'+unique_id).val() !== '' ? $('#field-id-condition-formula-'+unique_id).val() : null
        let id_condition = $('#field-id-condition-'+unique_id).val() !== '' ? $('#field-id-condition-'+unique_id).val() : null

        let condition_formula_data = {
            id : id_condition_formula,
            year_id : id,
            kondisi_id : id_condition,
            name : $('#field-condition-name-'+unique_id).val(),
            score : $('#skor-'+unique_id).val().split(',').join('.'),
            category : $('#kategori-'+unique_id).val(),
            description : $('#keterangan-'+unique_id).val(),
            operator : $('#select-operator-'+unique_id).val(),
            start_value : $('#nilai-min-'+unique_id).val().split(',').join('.'),
            end_value : $('#nilai-max-'+unique_id).val().split(',').join('.'),
        }
        condition_formula_datas.push(condition_formula_data)
    });

    let data = {
        year_id:id,
        condition_formulas:condition_formula_datas
    }

    // console.log(data)

    $.ajax({
        type: "POST",
        dataType: "json",
        data:data,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Authorization: "Bearer " + localStorage.getItem("ppre_token"),
        },
        url: urlApi + "setting-kpi/condition-formulas",
        success: function (response) {
            ewpLoadingHide();
            
            Swal.fire({
                title: "Berhasil!",
                text: "Setting berhasil disimpan",
                icon: "success",
            }).then((result) => {
                show();
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            ewpLoadingHide();
            handleErrorDetail(xhr);
        },
    });
}


var ewpFloatOnly = function(target){
    $(target).keydown(function (e) {
        
        if($(target).val().match(/\./g) == null){
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 188]) !== -1 ||
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    return ;
                }   
        } else {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                    return ;
                }
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
}