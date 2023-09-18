$( document ).ready(function() {
    if ($(window).width() < 767) {
        let html = $(".alerts_main_container").html();
        $(".wprm-wrapper").prepend(html);
        setTimeout(function(){
            let menu_height = Math.round($(".wprm-wrapper").height()-40);
            $("header").next("div").css("margin-top",menu_height+"px");
        },2000);
    }
});

$( document ).ready(function() {
    setTimeout(function(){
        let menu_height = Math.round($("header").height());
        $("header").next("div").css("margin-top",menu_height+"px");
    },900);     
});
