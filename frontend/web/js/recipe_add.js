var sum=0;
for(var i=1;i<8;i++)
{
    $("#btn-num-green"+i.toString(10)).animate({
        opacity: 1,
        marginLeft: "-30px",
    }, 700 +i*300);
}

$("#add_button")
    .animate({
            marginLeft: "-10%",
        }
    ,2500)
    .animate({
    marginLeft: "50%",
}, 1000);


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