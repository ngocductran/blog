$(document).ready(function() {
    $(window).resize(function(){
        if ($(window).width() > 767) {
            $("#sline").removeClass("mb-4");
            $("#item-sline").addClass("flex-column");
        }
        else{
            $("#sline").addClass("mb-4");
            $("#item-sline").addClass("justify-content-around");
            $("#item-sline").removeClass("flex-column");
        };
    });

    $("#sline-one").addClass("active");
});


