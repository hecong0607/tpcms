var tips_img  = $('.tips_img');
$(tips_img).mouseover(function(e){
    var left = $(this).offset().left+30;
    var top = $(this).offset().top-5;
    var title = $(this).attr('data-title');
    var next = $(this).next();
    if(next.length!=0){
        $(next).remove();
    } else {
        var html = "<div class='tooltipdi' style='left:"+left+"px;top:"+top+"px;'><span><b></b><em></em>"+ title +"</span></div>";
        $(this).after(html);
    }
});
$(tips_img).mouseleave(function(e){
    var left = $(this).offset().left+30;
    var top = $(this).offset().top-5;
    var title = $(this).attr('data-title');
    var next = $(this).next();
    if(next.length!=0){
        $(next).remove();
    } else {
        var html = "<div class='tooltipdi' style='left:"+left+"px;top:"+top+"px;'><span><b></b><em></em>"+ title +"</span></div>";
        $(this).after(html);
    }
});