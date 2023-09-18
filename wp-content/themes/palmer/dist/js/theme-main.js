(window["webpackJsonp"] = window["webpackJsonp"] || []).push([
    ["/js/theme-main"],
    {
        /***/ "./node_modules/moment/locale sync recursive (en-gb)\\.js":
        /*!*****************************************************!*\
    !*** ./node_modules/moment/locale sync (en-gb)\.js ***!
    \*****************************************************/
        /*! no static exports found */
        /***/ function (module, exports, __webpack_require__) {
            var map = {
                "./en-gb.js": "./node_modules/moment/locale/en-gb.js",
            };

            function webpackContext(req) {
                var id = webpackContextResolve(req);
                return __webpack_require__(id);
            }
            function webpackContextResolve(req) {
                if (!__webpack_require__.o(map, req)) {
                    var e = new Error("Cannot find module '" + req + "'");
                    e.code = "MODULE_NOT_FOUND";
                    throw e;
                }
                return map[req];
            }
            webpackContext.keys = function webpackContextKeys() {
                return Object.keys(map);
            };
            webpackContext.resolve = webpackContextResolve;
            module.exports = webpackContext;
            webpackContext.id =
                "./node_modules/moment/locale sync recursive (en-gb)\\.js";

            /***/
        },

        /***/ "./src/js/theme-main.js":
        /*!******************************!*\
    !*** ./src/js/theme-main.js ***!
    \******************************/
        /*! no static exports found */
        /***/ function (module, exports, __webpack_require__) {
            __webpack_require__(/*! ./theme-vendor */ "./src/js/theme-vendor.js");

            //Change color of slick fullwidth slider
            function changeSlideColor() {
                jQuery(".fullwidthslideshowsection").each((index, item) => {
                    setTimeout(() => {
                        jQuery(item)
                            .find(".overlay")
                            .attr(
                                "data-colored",
                                jQuery(".slick-current")
                                    .find(".overflow-hidden")
                                    .attr("data-color")
                            );
                    }, 300);
                });
            }

            //Chiropractor map id 4 search field placeholder text change
            jQuery(window).on('load',function () {
                setTimeout(function(){
                    if ($('#wpgmza_map_4').length) {
                        $('#wpgmza_map_4 .wpgmza-modern-store-locator .wpgmza-address.addressInput').attr('placeholder', 'Search by address, city and state, or zip code');
                    }
                },500);
            });

            jQuery(document).ready(function ($) {

                //sidebar-menu
                jQuery(".sidebar-dynamic-menu").find("li.menu-item-has-children span.fas").removeAttr("data-target");
                jQuery(".sidebar-dynamic-menu").find("li.menu-item-has-children span.fas[aria-expanded='true']").toggleClass("fa-angle-down fa-angle-up").parent().toggleClass("active");
                jQuery(".sidebar-dynamic-menu span.fas").on("click", function (e) {
                    e.preventDefault();
                    jQuery(this).toggleClass("fa-angle-down fa-angle-up").parent().toggleClass("active").next().slideToggle();
                });

                //function for number counter
                function counterText() {
                    $(".counter").each(function () {
                        var $this = $(this),
                            countTo = $this.attr("data-number");
                        $({
                            countNum: $this.text(),
                        }).animate(
                            {
                                countNum: countTo,
                            },
                            {
                                duration: 3000,
                                easing: "swing",
                                step: function () {
                                    //$this.text(Math.ceil(this.countNum));
                                    $this.text(Math.ceil(this.countNum).toLocaleString("en"));
                                },
                                complete: function () {
                                    $this.text(Math.ceil(this.countNum).toLocaleString("en"));
                                    //alert('finished');
                                },
                            }
                        );
                    });
                }

                const el = document.querySelector("#counter-box .buttons_wrap");
                const observer = new window.IntersectionObserver(
                    ([entry]) => {
                        if (entry.isIntersecting) {
                            counterText();
                            return;
                        }
                    },
                    {
                        root: null,
                        threshold: 0.05, // set offset 0.1 means trigger if atleast 10% of element in viewport
                    }
                );

                if (jQuery("#counter-box .buttons_wrap").length > 0) {
                    observer.observe(el);
                }

                //Directory page js for tabs
                const tabs = document.querySelectorAll(
                    ".person-campus-wrapper .tabs li"
                );
                const sections = document.querySelectorAll(
                    ".person-campus-wrapper .person-campus-content"
                );

                tabs.forEach((tab) => {
                    tab.addEventListener("click", (e) => {
                        e.preventDefault();
                        removeActiveTab();
                        addActiveTab(tab);
                    });
                });

                const removeActiveTab = () => {
                    tabs.forEach((tab) => {
                        tab.classList.remove("is-active");
                    });
                    sections.forEach((section) => {
                        section.classList.remove("is-active");
                    });
                };

                const addActiveTab = (tab) => {
                    tab.classList.add("is-active");
                    const href = tab.querySelector("a").getAttribute("href");
                    const matchingSection = document.querySelector(href);
                    matchingSection.classList.add("is-active");
                };

                // Testimonial Carousel
                // jQuery(".carousel-indicators")
                //   .find("li.list-inline-item")
                //   .on("click", function () {
                //     jQuery(this).parent().find("li").removeClass("active");
                //     jQuery(this).addClass("active");
                //   });

                // jQuery('#custCarousel').on('slide.bs.carousel', function (e) {
                //   // console.log(e.to);
                //   let slideto = parseInt(1) + parseInt(e.to);
                //   jQuery('#custCarousel .carousel-indicators .list-inline-item.active').removeClass('active');
                //   jQuery('#custCarousel .carousel-indicators .list-inline-item:nth-child('+ slideto +')').addClass('active');
                // })

                // Handle external links confirmation
                $("a[target='_blank']").on("click", function (event) {
                    if (!confirm("You are about to leave our website, continue?")) {
                        event.preventDefault();
                    }
                });

                //Change color of slick fullwidth slider
                changeSlideColor();

                if ($(".fullwidthslideshow").length > 0) {
                    $(".fullwidthslideshow").on(
                        "beforeChange",
                        function (event, slick, currentSlide, nextSlide) {
                            console.log(nextSlide);
                            changeSlideColor();
                        }
                    );
                }
                /** =============================================================== **/

                /** Menu toggler  **/

                /** =============================================================== **/

                $(".hamburger").on("click", function (e) {
                    e.preventDefault();
                    $(this).toggleClass("is-active");
                }); // $("img").each(function(index, val) {
                //     let imageSrc = $(this).attr("src").toLowerCase();
                //     if(imageSrc.indexOf("logo") == -1 && imageSrc.indexOf("bubble") == -1) {
                //         $(this).wrap('<div class="watermark"></div>');
                //     }
                // });

                /** =============================================================== **/

                /** Init Input masks **/

                /** =============================================================== **/

                $(".phone-mask").inputmask({
                    mask: "(999) 999-9999",
                });
                $(".zip-mask").inputmask({
                    mask: "99999",
                    placeholder: "",
                });
                $(".fullwidthslideshow").slick({
                    dots: false,
                    infinite: true,
                    centerMode: true,
                    arrows: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: "300px",
                    responsive: [
                        {
                            breakpoint: 1400,
                            settings: {
                                centerMode: true,
                                centerPadding: '180px',
                            }
                        },
                        {
                            breakpoint: 991,
                            settings: {
                                centerMode: true,
                                centerPadding: '101px',
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                dots: true,
                                centerMode: false,
                            },
                        },
                    ],
                });

                $(".fullwidthslideshow").on(
                    "afterChange init",
                    function (event, slick, direction) {
                        console.log("afterChange/init", event, slick, slick.$slides);
                        // remove all prev/next
                        slick.$slides.removeClass("prevdiv").removeClass("nextdiv");

                        // find current slide
                        for (var i = 0; i < slick.$slides.length; i++) {
                            var $slide = $(slick.$slides[i]);
                            if ($slide.hasClass("slick-current")) {
                                // update DOM siblings
                                $slide.prev().addClass("prevdiv");
                                $slide.next().addClass("nextdiv");
                                break;
                            }
                        }
                    }
                );
                $(".fullwidthslideshow").on("beforeChange", function (event, slick) {
                    // optional, but cleaner maybe
                    // remove all prev/next
                    slick.$slides.removeClass("prevdiv").removeClass("nextdiv");
                });

                //Testimonial carousel section

                $(".slider-for").slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: ".slider-nav , .slider-content",
                    infinite: true,
                });
                $(".slider-content").slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: ".slider-nav , .slider-for",
                    infinite: true,
                });
                $(".slider-nav").slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: ".slider-for , .slider-content",
                    //dots: true,
                    arrows: false,
                    centerMode: true,
                    focusOnSelect: true,
                    infinite: true,
                });

                //Image Gallery section
                $(".image-gallery-section").each(function (index, val) {
                    var $this = $(this);

                    $this.find(".image-gallery").addClass(`image-gallery-${index}`);

                    $this
                        .find(".image-gallery-arrows")
                        .addClass(`image-gallery-arrows-${index}`);

                    $(`.image-gallery-${index}`).slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        fade: true,
                        asNavFor: `.image-gallery-nav-${index}`,
                        infinite: true,
                        appendArrows: $(`.image-gallery-arrows-${index}`),
                        prevArrow: `<div class="gallery_arrow gallery_arrow_${index}_left slick-prev"></div>`,
                        nextArrow: `<div class="gallery_arrow gallery_arrow_${index}_right slick-next"></div>`,
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    dots: true,
                                    fade: false,
                                },
                            },
                        ],
                    });

                    $this
                        .find(".image-gallery-nav")
                        .addClass(`image-gallery-nav-${index}`);
                    $(`.image-gallery-nav-${index}`).slick({
                        slidesToShow: 6,
                        slidesToScroll: 1,
                        asNavFor: `.image-gallery-${index}`,
                        //dots: true,
                        arrows: false,
                        // centerMode: true,
                        focusOnSelect: true,
                        infinite: true,
                    });
                });

                ///Ends here

                $(".image-grid").slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: true,
                    infinite: true,
                });
                //Flexible Cta blocks slider
                $(".flexible-ctablocks-slider").slick({
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                fade: false,
                            },
                        },
                    ],
                });

                //Persons grid slider
                $(".persons-grid-slider").slick({
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                fade: false,
                            },
                        },
                    ],
                });

                //Persons list slider
                $(".persons-list-slider").slick({
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                fade: false,
                                dots: true,
                                adaptiveHeight: true,
                            },
                        },
                    ],
                });

                //Image blocks large slider
                $(".imageblocks-large-slider").slick({
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                fade: false,
                                dots: true,
                                adaptiveHeight: true,
                            },
                        },
                    ],
                });

                //Resources slider
                $(".resource_wrap_slider").slick({
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                fade: false,
                                arrows: false,
                            },
                        },
                    ],
                });

                //Quick links bar overlap when its under hero components
                var check_element = $( ".hero-banner-block" ).next().attr('class');
                if(check_element == 'quicklinksbar'){
                    $('.hero-banner-block .hero-banner-captions').addClass('extra_spacing');
                }

                //featured media section play videos inline
                $(".featured-media .playicon").click(function () {
                    var iconId = jQuery(this).attr("data-id");
                    var videoType = jQuery(this).attr("type"); //alert(videoType);

                    if (videoType == "youtubeplayicon") {
                        $('iframe[data-id="' + iconId + '"]')[0].src += "?autoplay=1";
                    }

                    if (videoType == "vimeoplayicon") {
                        $('iframe[data-id="' + iconId + '"]')[0].src += "&autoplay=1";
                    } //var clickedEle =$('iframe[data-id="'+ iconId +'"] .ytp-large-play-button').click();
                    //console.log(clickedEle);
                    // $('.ytp-large-play-button').click();

                    $(this).hide();
                    $(".featured-media .thumb_" + iconId + "").hide();
                    $('.featured-media iframe[data-id="' + iconId + '"]').show();
                    $('.wrapiframe[data-id="' + iconId + '"]').addClass(
                        "iframepadding"
                    );
                });

                //Hero video play pause
                $(".hero-video #player").hide();
                $(".hero-video #playButton").click(function () {
                    //console.log('play');
                    $(this).addClass("d-none");
                    $(".hero-video #pauseButton").removeClass("d-none");
                    $(".hero-video .carousel-caption").css("bottom", "5px");
                    $(".hero-video .preview").hide();
                    $(".hero-video #player").show();
                    $(".hero-video #player").trigger("play");
                });

                $(".hero-video #pauseButton").click(function () {
                    // alert('pause');
                    $(this).addClass("d-none");
                    $(".hero-video #playButton").removeClass("d-none");
                    $(".hero-video .preview").hide();
                    $(".hero-video #player").show();
                    $(".hero-video #player").trigger("pause");
                    $(".hero-video .carousel-caption").css("bottom", "0px");
                });

                // Animation for CTA flexible blocks
                $(".flexible-ctablocks .block").each(function () {
                    var block = $(this);
                    var cardId = block.attr("data-id");
                    var heightThreshold =
                        $(".flexible-ctablocks .row").offset().top - 250;
                    var heightThreshold_end =
                        $(".flexible-ctablocks .row").offset().top +
                        $(".flexible-ctablocks .row").height();
                    $(window).scroll(function () {
                        var scroll = $(window).scrollTop();

                        if (scroll >= heightThreshold && scroll <= heightThreshold_end) {
                            block.addClass("animate_me_" + cardId);
                        }
                    });
                });

                //set cookie for alert banner
                $(".alert_msg .close").click(function () {
                    console.log("Set cookie to not show this alert again.");
                    // Set a cookie
                    jQuery.cookie("alert", "hide", { expired: 7, path: "/" });
                });

                //detect cookie set and hide alert bar
                if (jQuery.cookie("alert") == "hide") {
                    console.log(jQuery.cookie("alert"));
                    jQuery(".alert_msg").addClass("cookieSet");
                }

                //Events Grid Load more pagination
                $(".events_grid #show").hide();
                $(".events_grid #hide").hide();
                if ($(window).width() <= 992) {
                    $(".events_grid #show").show();
                    $(".events_grid .toggleclass_2").hide();
                    $(".events_grid .toggleclass_3").hide();
                    $(".events_grid #hide").click(function () {
                        $(".events_grid .toggleclass_2").hide();
                        $(".events_grid .toggleclass_3").hide();
                        $(this).hide();
                        $("#show").show();
                    });
                    $(".events_grid #show").click(function () {
                        $(".events_grid .toggleclass_2").show();
                        $(".events_grid .toggleclass_3").show();
                        $(this).hide();
                        $(".events_grid #hide").show();
                    });
                }

                // Hero slideshow play/pause
                $("#herocarousel").carousel({
                    pause: false,
                });
                $("#playCarousel").click(function () {
                    $("#herocarousel").carousel("pause");
                    $(this).toggleClass("d-none").next().toggleClass("d-none");
                });
                $("#pauseCarousel").click(function () {
                    $("#herocarousel").carousel("cycle");
                    $(this).toggleClass("d-none").prev().toggleClass("d-none");
                });

                //Like button on events

                setTimeout(function () {
                    $(".pld-like-wrap span:last-child").before("<span>Like</span>");
                    $(".st-btn.st-last span.st-label").before(
                        '<i class="fas fa-plus"></i>'
                    );
                    $(".st-btn.st-last img").remove();
                    $('#st-1 .st-btn[data-network="sharethis"] span').show();
                    $('#st-1 .st-btn[data-network="twitter"] span').show();
                }, 1000);

                jQuery(document).bind("keyup", function (e) {
                    if (e.keyCode == 39) {
                        jQuery("#featured-news-carousel a.carousel-control-prev").trigger(
                            "click"
                        );
                    } else if (e.keyCode == 37) {
                        jQuery("#featured-news-carousel a.carousel-control-next").trigger(
                            "click"
                        );
                    }
                });

                // Hide breadcrumb-title block
                if($('.landing-page .hero-section').length) {
                    $('body').addClass('hide-breadcrumb-title');
                }
            });

            // Autoplay video on page load
            $(document).ready(function(){
                if($(window).width() > 767)
                {
                    $(".hero-video #playButton").trigger('click');
                }
            });

            $(document).ready(function() {
                //$('#wprmenu_bar').off('click');

                var logo_html = $("<div />").append($("#wprmenu_bar .menu_title").clone()).html();
                $('#wprmenu_bar').prepend(logo_html);

                var back_button = "<div class='back-button-wrapper'><button class='back-button'>Back</button><div class='close-button-wrapper'><button class='close-button'>close</button></div>";
                var close_button = "<div class='close-button-wrapper'><button class='close-button'>close</button></div>";
                $('#wprmenu_bar').after(back_button);
                $('#mg-wprm-wrap').prepend(close_button);

                var search_button = "<button class='search-button'></button>";
                $('#wprmenu_bar .hamburger').before(search_button);

                $('#wprmenu_bar .search-button').click(function () {
                    $('.wpr-search-form input').focus();
                });

                $("#wprmenu_menu_ul li.menu-item-has-children:not('.quicklinks_menu') .wprmenu_icon").click(function () {
                    $(this).parent().addClass("current-item-active");
                    $('body').addClass('active-back-button');
                });
                $('#wprmenu_bar').click(function () {
                    $('#wprmenu_menu_ul li.menu-item-has-children').removeClass("current-item-active");
                });

                /** Back Button **/
                $('.back-button').on('click', function (e) {
                    e.preventDefault();
                    $('.cbp-spmenu .wprmenu_icon').attr('tabindex', '0');
                    $('body').removeClass('active-back-button');
                    $('.cbp-spmenu li, .cbp-spmenu li a').removeAttr('tabindex');
                    $("#wprmenu_menu_ul li").each(function (index) {
                        if ($(this).hasClass('current-item-active')) {
                            $(this).children('.sub-menu').css('display', 'none');
                            $(this).removeClass('current-item-active');
                            $(this).children('.wprmenu_icon').removeClass('wprmenu_par_opened');
                        }
                    });
                });

                /** Close Button **/
                $('.close-button-wrapper .close-button').click(function () {
                    if ($('.wprm-wrapper #wprmenu_bar').hasClass('active')) {
                        $('.wprm-wrapper #wprmenu_bar').removeClass('active');
                    }
                    if ($('.wprm-wrapper #wprmenu_bar .hamburger').hasClass('is-active')) {
                        $('.wprm-wrapper #wprmenu_bar .hamburger').removeClass('is-active');
                    }
                    if ($('.wprm-wrapper .cbp-spmenu').hasClass('cbp-spmenu-open')) {
                        $('.wprm-wrapper .cbp-spmenu').removeClass('cbp-spmenu-open');
                    }
                    $('body').removeClass('active-back-button');
                    $('html').removeClass('wprmenu-body-fixed');

                    $('.cbp-spmenu .wprmenu_icon').attr('tabindex', '0');
                    $('.cbp-spmenu li, .cbp-spmenu li a').removeAttr('tabindex');

                    $('#wprmenu_bar .menu_title a').removeAttr('tabindex');
                    $('#wprmenu_bar .search-button').removeAttr('tabindex');

                    $("#wprmenu_menu_ul li").each(function (index) {
                        if ($(this).hasClass('current-item-active')) {
                            $(this).children('.sub-menu').css('display', 'none');
                            $(this).removeClass('current-item-active');
                            $(this).children('.wprmenu_icon').removeClass('wprmenu_par_opened');
                        }
                    });

                    $('#wprmenu_bar .hamburger').focus();
                });


                /*** Sidebar menu ***/
                $(".sidebar-dynamic-menu ul li").each(function() {
                    if($(this).hasClass('current-menu-parent')) {
                        $('body').addClass("js-current-menu-parent");
                    }
                });

                /** Blogs filter **/
                $('.news-list ul.listing li').on('click',function(){
                    $('#news-center-page form .search').trigger('click');
                });

                if($('.sidebar .custom-menu-block').length) {
                    $('body').addClass('custom-menu-block');
                }

                /** Accessibility **/
                $('#wprmenu_bar .hamburger').attr({ role:"button", tabindex:"0" });
                $('#wprmenu_bar .hamburger').keypress(function (e) {
                    var key = e.which;
                    if(key == 13) {
                        $(this).trigger('click');
                        if($(this).parent().hasClass('active')) {
                            $('#wprmenu_bar .menu_title a').attr('tabindex', '-1');
                            $('#wprmenu_bar .search-button').attr('tabindex', '-1');
                        }
                    }
                });
                $('.cbp-spmenu .wprmenu_icon').attr('tabindex', '0');
                $('.cbp-spmenu .wprmenu_icon').keypress(function (e) {
                    var key = e.which;
                    if(key == 13) {
                        $(this).trigger('click');
                    }
                });

                $('.cbp-spmenu > ul > li > .wprmenu_icon').keypress(function (e) {
                    var key = e.which;
                    if (key == 13) {
                        if ($(this).parent().hasClass('current-item-active')) {
                            $(this).parent().parent().find('> li:not(.current-item-active)').attr('tabindex', '-1');
                            $(this).parent().parent().find('> li:not(.current-item-active) a').attr('tabindex', '-1');
                            $(this).parent().parent().find('> li:not(.current-item-active) span').attr('tabindex', '-1');
                        }
                    }
                });

            });

            jQuery(document).ready(function() {
                if( $('#sticky-anchor').length ) {
                    function sticky_relocate() {
                        var window_top = $(window).scrollTop();
                        var div_top = $('#sticky-anchor').offset().top;
                        if (window_top + 50 > div_top) {
                            $('body').addClass('stick-quicklinksbar');
                        } else {
                            $('body').removeClass('stick-quicklinksbar');
                        }
                    }

                    $(function () {
                        $(window).scroll(sticky_relocate);
                        sticky_relocate();
                    });
                }
            });


            // Carousel Play/pause
            // jQuery(document).on("click", "#playButton", function (e) {
            //   e.preventDefault();
            //   //alert('play');
            //   jQuery("#herocarousel").carousel("cycle");
            //   jQuery(this).toggleClass("d-none").next().toggleClass("d-none");
            // });
            // jQuery(document).on("click", "#pauseButton", function (e) {
            //   e.preventDefault();
            //   //alert('pause');
            //   jQuery("#herocarousel").carousel("pause");
            //   jQuery(this).toggleClass("d-none").prev().toggleClass("d-none");
            // });

            setTimeout(function () {
                // Wrapped table inside
                jQuery(".wysiwyg-section")
                    .find("table")
                    .each(function () {
                        jQuery(this).wrap('<div class="table-wrap"></div>');
                    });
            }, 500);



            /** =============================================================== **/

            /** Video Gridder **/

            jQuery(document).ready(function(){

            jQuery('section.video-gridder-section .nav-tabs li').on('click',function(){
                jQuery('.nav-tabs li').each(function(){
                jQuery(this).find('a').removeClass('active');
            });

            });

            jQuery('section.video-gridder-section .video_title').on('click',function(){
            var cat_id = '#' + jQuery('.tab-pane.active').attr('id');
                //alert(cat_id);
                var video_id = jQuery(this).attr('data-id');
                var video_name = jQuery(this).attr('video-name');
             //console.log(video_id);
             //console.log(video_name);
             //alert(jQuery(this).attr('data-id'));
             jQuery( cat_id + ' .video_title').each(function(){
                jQuery(this).removeClass('active');
             });
             jQuery( cat_id + ' .video_title[video-name='+video_name+']').addClass('active');
             jQuery( cat_id + ' .video_detail').each(function(){
                jQuery(this).removeClass('active');
             });
             jQuery(cat_id + ' .video_detail').each(function(){
                if(jQuery(this).attr('data-id') == video_id){
                    //jQuery('.video_detail[video-name="'+ video_name +'"]').addClass('active');
                    jQuery(cat_id + ' .video_detail[data-id ='+ video_id +']').addClass('active');
                }
            });
         });


            //on see transcription
            jQuery('section.video-gridder-section .switch_button').on('click',function(){
                if(jQuery(this).find('span').text()=='see transcript'){
                    jQuery(this).prev().show();
                    jQuery(this).prev().prev().hide();
                    jQuery(this).find('span').text('see caption');
                }
                else if(jQuery(this).find('span').text()=='see caption'){
                    jQuery(this).prev().hide();
                    jQuery(this).prev().prev().show();
                    jQuery(this).find('span').text('see transcript');
                }
            });

         });


            function statssection() {
                var statssection = document.querySelectorAll(".statssection");

                for (var i = 0; i < statssection.length; i++) {
                    var windowHeight = window.innerHeight;
                    var elementTop = statssection[i].getBoundingClientRect().top;
                    var elementVisible = 800;

                    if (elementTop < windowHeight - elementVisible) {
                        statssection[i].classList.add("active");
                    } else {
                        statssection[i].classList.remove("active");
                    }
                }
            }

            window.addEventListener("scroll", statssection);

            function fullwidthmediasection() {
                var fullwidthmediasection = document.querySelectorAll(".fullwidthmediasection");

                for (var n = 0; n < fullwidthmediasection.length; n++) {
                    var windowHeight = window.innerHeight;
                    var elementTop = fullwidthmediasection[n].getBoundingClientRect().top;
                    var elementVisible = 1100;

                    if (elementTop < windowHeight - elementVisible) {
                        fullwidthmediasection[n].classList.add("active");
                    } else {
                        fullwidthmediasection[n].classList.remove("active");
                    }
                }
            }

            window.addEventListener("scroll", fullwidthmediasection);

            function events_grid() {
                var events_grid = document.querySelectorAll(".events_grid");

                for (var m = 0; m < events_grid.length; m++) {
                    var windowHeight = window.innerHeight;
                    var elementTop = events_grid[m].getBoundingClientRect().top;
                    var elementVisible = 50;

                    if (elementTop < windowHeight - elementVisible) {
                        events_grid[m].classList.add("active");
                    } else {
                        events_grid[m].classList.remove("active");
                    }
                }
            }

            window.addEventListener("scroll", events_grid);


            /** =============================================================== **/

            /** Accessibility Improvements **/

            /** =============================================================== **/
            // Determine accessibility focus based on mouse/keyboard use

            // document.body.addEventListener("mousedown", function () {
            //     document.body.classList.add("using-mouse");
            // });
            // document.body.addEventListener("keydown", function () {
            //     document.body.classList.remove("using-mouse");
            // });

            /***/
            jQuery(document).ready(function() {
                var label = $("label[for^='search-form-']");
                if (label.length && label.next().is('input')) {
                    label.next().attr('id', label.attr('for'));
                    label.html(label.next().attr('placeholder'));
                }
            });
        },

        /***/ "./src/js/theme-vendor.js":
        /*!********************************!*\
    !*** ./src/js/theme-vendor.js ***!
    \********************************/
        /*! no static exports found */
        /***/ function (module, exports, __webpack_require__) {
            /**
             * Loading required JS scripts and plugins such as jQuery and Bootstrap
             */
            window._ = __webpack_require__(
                /*! lodash */ "./node_modules/lodash/lodash.js"
            );
            window.Popper = __webpack_require__(
                /*! popper.js */ "./node_modules/popper.js/dist/esm/popper.js"
            )["default"];
            window.$ = window.jQuery = __webpack_require__(
                /*! jquery */ "./node_modules/jquery/dist/jquery.js"
            );

            __webpack_require__(
                /*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js"
            );

            __webpack_require__(
                /*! es6-promise */ "./node_modules/es6-promise/dist/es6-promise.js"
            ).polyfill();
            /**
             * Loading theme JS plugins
             */

            window.moment = __webpack_require__(
                /*! moment */ "./node_modules/moment/moment.js"
            ); // Require inputmask using jquery

            __webpack_require__(
                /*! inputmask/dist/inputmask/jquery.inputmask */ "./node_modules/inputmask/dist/inputmask/jquery.inputmask.js"
            );

            __webpack_require__(
                /*! inputmask/dist/inputmask/inputmask.date.extensions */ "./node_modules/inputmask/dist/inputmask/inputmask.date.extensions.js"
            );

            window.Inputmask = __webpack_require__(
                /*! inputmask */ "./node_modules/inputmask/index.js"
            );

            __webpack_require__(
                /*! slick-carousel */ "./node_modules/slick-carousel/slick/slick.js"
            );

            /***/
        },

        /***/ "./src/scss/theme-main.scss":
        /*!**********************************!*\
    !*** ./src/scss/theme-main.scss ***!
    \**********************************/
        /*! no static exports found */
        /***/ function (module, exports) {
            // removed by extract-text-webpack-plugin
            /***/
        },

        /***/ "./src/scss/theme-vendors.scss":
        /*!*************************************!*\
    !*** ./src/scss/theme-vendors.scss ***!
    \*************************************/
        /*! no static exports found */
        /***/ function (module, exports) {
            // removed by extract-text-webpack-plugin
            /***/
        },

        /***/ 0:
        /*!*********************************************************************************************!*\
    !*** multi ./src/js/theme-main.js ./src/scss/theme-vendors.scss ./src/scss/theme-main.scss ***!
    \*********************************************************************************************/
        /*! no static exports found */
        /***/ function (module, exports, __webpack_require__) {
            __webpack_require__(
                /*! C:\MAMP\htdocs\Projects-WP\P-Palmer\C-Palmer\wp-content\themes\palmer\src\js\theme-main.js */ "./src/js/theme-main.js"
            );
            __webpack_require__(
                /*! C:\MAMP\htdocs\Projects-WP\P-Palmer\C-Palmer\wp-content\themes\palmer\src\scss\theme-vendors.scss */ "./src/scss/theme-vendors.scss"
            );
            module.exports = __webpack_require__(
                /*! C:\MAMP\htdocs\Projects-WP\P-Palmer\C-Palmer\wp-content\themes\palmer\src\scss\theme-main.scss */ "./src/scss/theme-main.scss"
            );

            /***/
        },
    },
    [[0, "/js/manifest", "/js/vendor"]],
]);
//# sourceMappingURL=theme-main.js.map
