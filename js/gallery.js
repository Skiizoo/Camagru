pageSize = 6;
showPage(1);

function showPage(pageNumber) {
    $(".li_list_gallery").hide();
    $(".li_list_gallery").each(function(n) {
        if (n >= pageSize * (pageNumber - 1) && n < pageSize * pageNumber)
            $(this).show();
    });    
}

$(".a_pagination").click(function() {
    $(".a_pagination").removeClass("current");
    $(this).addClass("current");
    showPage(parseInt($(this).text())) 
});