$(document).ready(function(){
    $(".fas").on("click", function(){
        var contentPanelId = $(this).attr("id");
        var a = "#infPers_" + contentPanelId;
        var b = '#wishPers_' + contentPanelId;
        if ($(b).css('display') == 'none'){
            $(a).css("display","none");
            $(b).css("display","inline-block");
           
        }
        else{
            $(b).css("display","none");
            $(a).css("display","inline-block");
        }
    });
});