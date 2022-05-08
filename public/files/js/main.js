$(document).ready(function() {
    //    resposive-megamenu-mobile------------------


    $(".box-header-sidebar").on('click', function(e) {
        e.preventDefault();
        $(".box-header-sidebar").removeClass("activeacc");
        $(this).addClass("activeacc");
        $(this).next().slideToggle(200);
    });
    $(".js-example-basic-multiple").select2();
    

});