require("./theme-vendor");
jQuery(document).ready(function ($) {

    // Handle external links confirmation
    $("a[target='_blank']").on('click', function (event) {
        if (!confirm("You are about to leave our website, continue?")) {
            event.preventDefault();
        }
    });

    /** =============================================================== **/
    /** Menu toggler  **/
    /** =============================================================== **/

    $('.hamburger').on("click", function (e) {
        e.preventDefault();
        $(this).toggleClass('is-active');
    });

    // $("img").each(function(index, val) {
    //     let imageSrc = $(this).attr("src").toLowerCase();
    //     if(imageSrc.indexOf("logo") == -1 && imageSrc.indexOf("bubble") == -1) {
    //         $(this).wrap('<div class="watermark"></div>');
    //     }
    // });

    /** =============================================================== **/
    /** Init Input masks **/
    /** =============================================================== **/

    $(".phone-mask").inputmask({
        "mask": "(999) 999-9999"
    });

    $(".zip-mask").inputmask({
        "mask": "99999",
        "placeholder": "",
    });


    $(".fullwidthslideshow").slick({
        dots: false,
        infinite: true,
        variableWidth: true,
        centerMode: true,
        centerPadding: '300px',
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    centerMode: true,
                    centerPadding: '100px',
                }
            },
            {
                breakpoint: 768,
                settings: {
                    centerMode: true,
                    centerPadding: '30px',
                    dots: true
                }
            }
        ]

    });

//Testimonial carousel section    

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav , .slider-content',
        infinite: true,
    });

    $('.slider-content').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav , .slider-for',
        infinite: true,
    });

    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for , .slider-content',
        //dots: true,
        arrows: false,
        centerMode: true,
        focusOnSelect: true,
        infinite: true,
    });


//Image Gallery section

    $('.image-gallery').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        asNavFor: '.image-gallery-nav',
        infinite: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    dots: true,
                    fade: false,
                }
            }
        ]
    });

    $('.image-gallery-nav').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        asNavFor: '.image-gallery',
        //dots: true,
        arrows: true,
        centerMode: true,
        focusOnSelect: true,
        infinite: true,
    });


    $('.image-grid').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        infinite: true,
    });


//next and prev buttons functionality for timeline sliders
    $('.index-bar-on .timeline-index-next').click(function () {
        $('.index-bar-on .slick-next').click();
    });
    $('.index-bar-on .timeline-index-prev').click(function () {
        $('.index-bar-on .slick-prev').click();
    });
    $('.index-bar-off .timeline-index-next').click(function () {
        $('.index-bar-off .slick-next').click();
    });
    $('.index-bar-off .timeline-index-prev').click(function () {
        $('.index-bar-off .slick-prev').click();
    });

//hide empty year slide in timeline carousel
    $(".timeline-carousel-section.index-bar-on").find('.slick-slide').each(function () {
        $(this).find('.slide-main').each(function () {
            if ($(this).children().length == 0) {
                $(this).addClass('hidemyslide');
                $('.hidemyslide').closest('.slick-slide').hide();
            }
        });
    });

    $('.featured-media .playicon').click(function () {
        var iconId = jQuery(this).attr('data-id');
        var videoType = jQuery(this).attr('type');
        //alert(videoType);
        if (videoType == 'youtubeplayicon') {
            $('iframe[data-id="' + iconId + '"]')[0].src += "?autoplay=1";
        }
        if (videoType == 'vimeoplayicon') {
            $('iframe[data-id="' + iconId + '"]')[0].src += "&autoplay=1";
        }

        //var clickedEle =$('iframe[data-id="'+ iconId +'"] .ytp-large-play-button').click();
        //console.log(clickedEle);

        // $('.ytp-large-play-button').click();

        $(this).hide();
        $('.featured-media .thumb_' + iconId + '').hide();
        $('.featured-media iframe[data-id="' + iconId + '"]').show();
        $('.wrapiframe[data-id="' + iconId + '"]').addClass('iframepadding');

    });

});

/** =============================================================== **/
/** Accessibility Improvements **/
/** =============================================================== **/

// Determine accessibility focus based on mouse/keyboard use
document.body.addEventListener('mousedown', function () {
    document.body.classList.add('using-mouse');
});
document.body.addEventListener('keydown', function () {
    document.body.classList.remove('using-mouse');
});


// Carousel Play/pause
jQuery(document).on("click", "#playButton", function (e) {
    e.preventDefault();
    jQuery('#herocarousel').carousel('cycle');
    jQuery(this).toggleClass('d-none').next().toggleClass("d-none");
});
jQuery(document).on("click", "#pauseButton", function (e) {
    e.preventDefault();
    jQuery('#herocarousel').carousel('pause');
    jQuery(this).toggleClass('d-none').prev().toggleClass("d-none");
});

setTimeout(function () {
    // Wrapped table inside
    jQuery(".wysiwyg-section").find("table").each(function () {
        jQuery(this).wrap('<div class="table-wrap"></div>')
    });
}, 500);


// Carousel Active
jQuery(".carousel-indicators").find("li.list-inline-item").on("click", function () {
    jQuery(this).parent().find("li").removeClass("active");
    jQuery(this).addClass("active");
});

$('#custCarousel').on('slide.bs.carousel', function (e) {
    console.log(e);
})