var sum=0;
var elements = 10;
for(var i=elements;i>0;i--)
{
    $("#btn-num-green"+i.toString(10)).animate({
        opacity: 1,
        marginTop: "-6px",
    }, 900 +(elements + 1 -i)*300);
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