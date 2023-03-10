import lightGallery from "lightgallery";
import lgThumbnail from "lightgallery/plugins/thumbnail"
import lgZoom from "lightgallery/plugins/zoom"

window.lightGallery = lightGallery;
window.lgThumbnail = lgThumbnail;
window.lgZoom = lgZoom;

window.$ = window.jQuery = require("jquery");

lightGallery(document.getElementById("gallery"), {
    selector: ".swiper-image",
    plugins: [lgZoom, lgThumbnail],
    speed: 500,
    galleryId: 1,
});

var sliderSwiper = new Swiper(".slider-swiper", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 5000,
    },
});

var videosSwiper = new Swiper(".videos-swiper", {
    scrollbar: {
        el: ".swiper-scrollbar",
        hide: false,
    },
    slidesPerView: 1,
    spaceBetween: 30,
    slidesOffsetBefore: 12,
    slidesOffsetAfter: 12,
    breakpoints: {
        576: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        992: {
            slidesPerView: 4,
            slidesOffsetBefore: $(".mi-logo").offset().left - 12,
            slidesOffsetAfter: $(".mi-logo").offset().left - 12,
        },
        1200: {
            slidesPerView: 5,
            slidesOffsetBefore: $(".mi-logo").offset().left - 12,
            slidesOffsetAfter: $(".mi-logo").offset().left - 12,
        },
    },
});

var productsSwiper = new Swiper(".products-swiper", {
    scrollbar: {
        el: ".swiper-scrollbar",
        hide: false,
    },
    slidesPerView: 1,
    spaceBetween: 24,
    slidesOffsetBefore: 12,
    slidesOffsetAfter: 12,
    breakpoints: {
        576: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 3,
        },
        992: {
            slidesPerView: 4,
            slidesOffsetBefore: $(".mi-logo").offset().left - 12,
            slidesOffsetAfter: $(".mi-logo").offset().left - 12,
        },
        1200: {
            slidesPerView: 5,
            slidesOffsetBefore: $(".mi-logo").offset().left - 12,
            slidesOffsetAfter: $(".mi-logo").offset().left - 12,
        },
    },
});

$(document).ready(function () {
    // $("#offcanvas .nav li a").click(function (event) {
    //     $("#offcanvas").removeClass("show");
    //     $(".offcanvas-backdrop").remove();
    //     $("body").removeAttr("style");
    // });
});
