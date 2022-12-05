function setBreadcrump (title = '', subTitle = [])
{
    $('#xm-title').html(title)

    textSubTitle = `<a href="#" class="opacity-75 hover-opacity-100">
                        <i class="flaticon2-shelter text-white icon-1x"></i>
                    </a>`
    
	$.each(subTitle, function (index, value) {
        textSubTitle += `<span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                    <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">`+value+`</a>`
    })

    $('#xm-sub-title').html(textSubTitle)
}