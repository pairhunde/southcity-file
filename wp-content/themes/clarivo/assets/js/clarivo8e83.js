/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

(function ($) {
    "use strict";
    var HaruClarivo = {
        init: function() {
            HaruClarivo.base.init();
            HaruClarivo.appointment.init();
            HaruClarivo.department.init();
            HaruClarivo.doctor.init();
        }
    };
    HaruClarivo.base = {
        init: function() {
            HaruClarivo.base.shortcodeImagesGallery();
            HaruClarivo.base.shortcodeCounter();
            HaruClarivo.base.shortcodeVideo();
        },
        shortcodeImagesGallery: function() {
            $('.images-gallery-shortcode-wrap').each(function(){
                var $this = $(this);
                var $columns = parseInt($this.attr('data-columns'));

                // Filter show/hide gallery
                $this.find('.gallery-content').hide();
                // Init first gallery
                $this.find('.gallery-content').first().find('.image-group').slick({
                    slidesToShow: $columns,
                    slidesToScroll: 1,
                    arrows: true,
                    infinite: true,
                    centerMode: false,
                    centerPadding: '0px',
                    variableWidth: false,
                    responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                  ]
                });
                $this.find('.gallery-content').first().show();

                // Filter click
                $this.find('.gallery-filters a').on('click', function(e){
                    e.preventDefault();

                    // Episode active
                    $this.find('.gallery-filters a').removeClass('active');
                    $this.find('.gallery-content').hide();

                    $(this).addClass('active');
                    var current_gallery     = $(this).data('gallery');
                    $this.find('#gallery-' + current_gallery).show();
                    // Init slick when filter
                    $this.find('#gallery-' + current_gallery + ' .image-group:not(.slick-initialized )').each(function(){
                        // Maybe need destroy and re init
                        $(this).slick({
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            arrows: true,
                            infinite: true,
                            centerMode: false,
                            centerPadding: '0px',
                            variableWidth: false,
                            responsive: [
                                {
                                    breakpoint: 991,
                                    settings: {
                                        slidesToShow: 3,
                                        slidesToScroll: 1,
                                    }
                                },
                                {
                                    breakpoint: 767,
                                    settings: {
                                        slidesToShow: 1,
                                        slidesToScroll: 1
                                    }
                                }
                            ]
                        });
                    });
                });
            });
        },
        shortcodeCounter: function() {
            $('.counter-shortcode-wrap').each(function(){
                var $this = $(this);

                // Appear
                if (!$(".gr-animated").length) return;

                $(".gr-animated").appear();

                $(document.body).on("appear", ".gr-animated", function () {
                    $(this).addClass("go");
                });

                $(document.body).on("disappear", ".gr-animated", function () {
                    $(this).removeClass("go");
                });

                // Counter
                if (!$(".gr-number-counter").length) return;
                $(".gr-number-counter").appear(); // require jquery-appear

                $('body').on("appear", ".gr-number-counter", function () {
                    var counter = $(this);
                    if (!counter.hasClass("count-complete")) {
                        counter.countTo({
                            speed: 1500,
                            refreshInterval: 100,
                            onComplete: function () {
                                counter.addClass("count-complete");
                            }
                        });
                    }
                });
                
                $('body').on("disappear", ".gr-number-counter", function () {
                    $(this).removeClass("count-complete");
                });
            });
        },
        shortcodeVideo: function() {
            $('.video-popup-link').magnificPopup({
                type: 'iframe',
                iframe: {
                    markup: '<div class="mfp-iframe-scaler">'+
                            '<div class="mfp-close"></div>'+
                            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                            '<div class="mfp-title">Some caption</div>'+
                          '</div>'
                },
                callbacks: {
                    markupParse: function(template, values, item) {
                        values.title = item.el.attr('title');
                    }   
                }
            });
        },
    };

    HaruClarivo.appointment = {
        init: function() {
            HaruClarivo.appointment.appointmentForm();
        },
        appointmentForm: function() {
            $('.appointment-register').each(function() {
                var haru_appointment_form = $(this);
                // Select Deparment and Doctor Process @TODO: select department then show doctor in selected department
                haru_appointment_form.find('select[name="department"]').select2();
                haru_appointment_form.find('select[name="doctor"]').select2();

                // Select appointment time
                haru_appointment_form.find('.appointment-time').datetimepicker({
                    format:'Y/m/d H:i',
                    minDate: '0',
                    step: 30
                });

                // Submit form
                haru_appointment_form.submit(function (e) {
                    e.preventDefault();

                    if ( HaruClarivo.appointment.validateEventForm(haru_appointment_form) ) {
                        haru_appointment_form.find('.haru-notice').slideUp(200);
                        haru_appointment_form.find('.haru-appointment-loader').slideDown(200);

                        // After validate input
                        var data = $(this).serializeArray();

                        $.ajax({
                            type: 'POST',
                            url: haru_framework_ajax_url,
                            data: data,
                            success: function (response) {
                                var result = $.parseJSON(response);
                                if( result.success ) {
                                    if( result.message !== '' ) {
                                        haru_appointment_form.find('.response-message').append('<div class="register-success">' + result.message + '</div>');
                                        // Hide contact form
                                        // haru_appointment_form.find('.appointment-form-info').hide();
                                        haru_appointment_form.find('.appointment-register-submit').hide();
                                    }
                                    console.log(result);
                                } else {
                                    // Display failed message
                                    haru_appointment_form.find('.response-message').append('<div class="register-failed">' + result.message + '</div>');
                                    // Hide contact form
                                    // haru_appointment_form.find('.appointment-form-info').hide();
                                    haru_appointment_form.find('.appointment-register-submit').hide();
                                }
                            },
                            error: function (errorThrown) {
                                if( result.message !== '' ) {
                                    haru_appointment_form.find('.response-message').append('<div class="error">' + result.message + '</div>');
                                }
                            }
                        });
                    }

                    e.returnValue = false;
                });
            });
        },
        validateEventForm: function(eventForm) {
            var haru_appointmentForm = $(eventForm);

            var valid = true;
            // check require fields
            haru_appointmentForm.find('.haru-require').each(function () {
                if ($(this).val() == '') {
                    haru_appointmentForm.find('.haru-notice.require-field').slideDown(200);
                    valid = false;
                }
            });
            // check email
            haru_appointmentForm.find('.haru-email').each(function () {
                if (! HaruClarivo.appointment.validateEmail($(this).val())) {
                    haru_appointmentForm.find('.haru-notice.email-invalid').slideDown(200);
                    valid = false;
                }
            });
            return valid;
        },
        validateEmail: function (email) {
            var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return regex.test(email);
        },
        
    };

    HaruClarivo.department = {
        init: function() {
            HaruClarivo.department.tabToggle();
        },
        tabToggle: function() {
            $('.tab-toggle').each(function() {
                var $this = $(this);
                $('.sub-content', $(this).not('.active')).hide();

                if($(this).hasClass('active')) {
                    // Run slick
                    HaruClarivo.department.doctorCarousel($this);
                }

                $('.tab-title', $(this)).on('click', function() {
                    $this.toggleClass('active');
                    $this.find('.sub-content').slideToggle('fast');
                    // Run slick
                    HaruClarivo.department.doctorCarousel($this);
                })
            });
        },
        doctorCarousel: function($this) {
            $this.find('.department-doctors').each(function() {
                var $this = $(this);

                $this.find('.slider-for:not(.slick-initialized )').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: false,
                    asNavFor: $('.slider-nav', $this)
                });
                $this.find('.slider-nav:not(.slick-initialized )').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    asNavFor: $('.slider-for', $this),
                    dots: false,
                    centerMode: true,
                    centerPadding: '0px',
                    focusOnSelect: true,
                    responsive: [{
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 2
                            }
                        }
                    ]
                });
            });
        }
    };

    HaruClarivo.doctor = {
        init: function() {
            HaruClarivo.doctor.shortcodeDoctor();
            HaruClarivo.doctor.doctorLoadMore();
            HaruClarivo.doctor.doctorInfiniteScroll();
        },
        shortcodeDoctor: function() {
            var default_filter = [];
            var array_filter = []; // Push filter to an array to process when don't have filter

            $('.doctor-shortcode-wrap:not(.carousel)').each(function(index, value) {
                // Process filter each shortcode
                $(this).find('.doctor-filter li').first().find('a').addClass('selected');
                default_filter[index] = $(this).find('.doctor-filter li').first().find('a').attr('data-option-value');

                var self = $(this);
                var $container = $(this).find('.doctor-list'); // parent element of .item
                var $filter = $(this).find('.doctor-filter a');
                var masonry_options = {
                    'gutter': 0
                };

                array_filter[index] = $filter;

                // Add to process products layout style
                var layoutMode = 'fitRows';
                if (($(this).hasClass('masonry'))) {
                    var layoutMode = 'masonry';
                }

                for (var i = 0; i < array_filter.length; i++) {
                    if (array_filter[i].length == 0) {
                        default_filter = '';
                    }
                    $container.isotope({
                        itemSelector: '.doctor-item', // .item
                        transitionDuration: '0.4s',
                        masonry: masonry_options,
                        layoutMode: layoutMode,
                        filter: default_filter[i]
                    });
                }

                imagesLoaded(self, function() {
                    $container.isotope('layout');
                });

                $(window).resize(function() {
                    $container.isotope('layout');
                });

                $filter.click(function(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    var $this = $(this);
                    // Don't proceed if already selected
                    if ($this.hasClass('selected')) {
                        return false;
                    }
                    var filters = $this.closest('ul');
                    filters.find('.selected').removeClass('selected');
                    $this.addClass('selected');

                    var options = {
                            layoutMode: layoutMode,
                            transitionDuration: '0.4s',
                            packery: {
                                horizontal: true
                            },
                            masonry: masonry_options
                        },
                        key = filters.attr('data-option-key'),
                        value = $this.attr('data-option-value');
                    value = value === 'false' ? false : value;
                    options[key] = value;

                    $container.isotope(options);
                });
            });
        },
        doctorLoadMore: function() {
            $('.doctor-shortcode-paging-wrap .doctor-load-more').off().on('click', function(event) {
                event.preventDefault();

                var $this = $(this).button('loading');
                var link = $(this).attr('data-href');
                var shortcode_wrapper = '.doctor-shortcode-wrap';
                var contentWrapper = '.doctor-shortcode-wrap .doctor-list'; // parent element of .item
                var element = '.doctor-item'; // .item

                $.get(link, function(data) {
                    var next_href = $('.doctor-load-more', data).attr('data-href');
                    var $newElems = $(element, data).css({
                        opacity: 0
                    });

                    $(contentWrapper).append($newElems);
                    $newElems.imagesLoaded(function() {
                        $newElems.animate({
                            opacity: 1
                        });

                        $(contentWrapper).isotope('appended', $newElems);
                        setTimeout(function() {
                            $(contentWrapper).isotope('layout');
                        }, 400);

                        HaruClarivo.doctor.init();
                    });


                    if (typeof(next_href) == 'undefined') {
                        $this.parent().remove();
                    } else {
                        $this.button('reset');
                        $this.attr('data-href', next_href);
                    }

                });
            });
        },
        doctorInfiniteScroll: function() {
            var shortcode_wrapper = '.doctor-shortcode-wrap';
            var contentWrapper = '.doctor-shortcode-wrap .doctor-list'; // parent element of .item
            $('.doctor-list', shortcode_wrapper).infinitescroll({
                navSelector: "#infinite_scroll_button",
                nextSelector: "#infinite_scroll_button a",
                itemSelector: ".doctor-item", // .item
                loading: {
                    'selector': '#infinite_scroll_loading',
                    'img': haru_framework_theme_url + '/assets/images/ajax-loader.gif',
                    'msgText': 'Loading...',
                    'finishedMsg': ''
                }
            }, function(newElements, data, url) {
                var $newElems = $(newElements).css({
                    opacity: 0
                });
                $newElems.imagesLoaded(function() {
                    $newElems.animate({
                        opacity: 1
                    });

                    $(contentWrapper).isotope('appended', $newElems);
                    setTimeout(function() {
                        $(contentWrapper).isotope('layout');
                    }, 400);

                    HaruClarivo.doctor.init();
                });

            });
        }
    }

    $(document).ready(function() {
        HaruClarivo.init();
    });
})(jQuery);