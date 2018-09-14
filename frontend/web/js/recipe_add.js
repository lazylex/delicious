var sum=0;

$(document).ready(function(){
    $(".accordion h3:first").addClass("active");
    $(".accordion div:not(:first)").hide();
    $(".accordion h3").click(function(){

        $(this).next("ul").slideToggle("slow")
            .siblings("ul:visible").slideUp("slow");
        $(this).toggleClass("active");
        $(this).siblings("h3").removeClass("active");
    });
});