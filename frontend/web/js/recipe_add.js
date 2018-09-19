var sum=0;
for(var i=7;i>0;i--)
{
    $("#btn-num-green"+i.toString(10)).animate({
        opacity: 1,
        marginTop: "-6px",
    }, 700 +(8-i)*300);
}

$("#add_button")
    .animate({
            marginLeft: "-10%",
        }
    ,1000)
    .animate({
    marginLeft: "50%",
}, 500);


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