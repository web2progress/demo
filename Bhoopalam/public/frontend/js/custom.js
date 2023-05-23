window.onscroll = function() {
    mScroll()
};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;


function mScroll() {
    if ($(window).scrollTop() > 100) {
        header.classList.add("sticky");
        $('.navbar-brand.dd').addClass('.d-hide')
        $('.navbar-brand.ss').removeClass('.d-hide')
    } else {
        header.classList.remove("sticky");

        $('.navbar-brand.dd').removeClass('.d-hide')
        $('.navbar-brand.ss').addClass('.d-hide')
    }
}


$(window).scroll(function(event) {
    if ($(window).scrollTop() > 100) {
        $("#test").attr("src", "assets/images/mcblack-logo.png");
    } else {
        $("#test").attr("src", "assets/images/MCLogo-1.png");
    }
});



$(document).ready(function() {
    $('.dropdown-submenu a.test').on("click", function(e) {
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });
});