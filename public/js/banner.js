var $jq = jQuery.noConflict();
$jq(document).ready(function() { 
    $('.slideshow-container').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        arrows:false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,

    });
});

// slick lấy đúng kích thước của phần tử trong slider

//scroll down
// window.onscroll = function() {scrollFunction()};

// function scrollFunction() {
//   if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
//     document.getElementById("nav").style.top = "0";
//   } else {
//     document.getElementById("nav").style.top = "-50px";
//   }
// }