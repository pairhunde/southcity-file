/**
 * @package    HaruTheme
 * @version    1.0.0
 * @author     Administrator <admin@harutheme.com>
 * @copyright  Copyright (c) 2017, HaruTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://harutheme.com
*/

var HARU = HARU || {};
(function ($) {
    "use strict";

    var $window = $(window),
        deviceAgent = navigator.userAgent.toLowerCase(),
        isMobile    = deviceAgent.match(/(iphone|ipod|android|iemobile)/),
        isMobileAlt = deviceAgent.match(/(iphone|ipod|ipad|android|iemobile)/),
        $body       = $('body');

    var products_ajax_category_data = []; // Use this for product ajax category shortcode

    // Base functions
    HARU.base = {
        init: function() {
            HARU.base.haruCarousel();
            HARU.base.prettyPhoto(); // @TODO: new lightbox (outdate)
            HARU.base.stellar();
            HARU.base.newsletterPopup();
        },
        haruCarousel: function() {
            $('.haru-carousel.owl-carousel').each(function(index, value){
                var $self          = $(this);
                var items          = parseInt($(this).attr('data-items'));
                var items_tablet   = parseInt($(this).attr('data-items-tablet'));
                var items_mobile   = parseInt($(this).attr('data-items-mobile'));
                var margin         = parseInt($(this).attr('data-margin'));
                var autoplay       = $(this).attr('data-autoplay') == 'true' ? true : false;
                var loop           = $(this).attr('data-loop') == 'true' ? true : false;
                var slide_duration = parseInt($(this).attr('data-slide-duration'));

                $self.owlCarousel({
                    items : items,
                    margin: margin,
                    loop: loop,
                    center: false,
                    mouseDrag: true,
                    touchDrag: true,
                    pullDrag: true,
                    freeDrag: false,
                    stagePadding: 0,
                    merge: false,
                    mergeFit: true,
                    autoWidth: false,
                    startPosition: 0,
                    URLhashListener: false,
                    nav: true,
                    navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                    rewind: true,
                    navElement: 'div',
                    slideBy: 1,
                    dots: true,
                    dotsEach: false,
                    lazyLoad: false,
                    lazyContent: false,

                    autoplay: autoplay, // autoplay
                    autoplayTimeout: slide_duration,
                    autoplayHoverPause: true,
                    
                    smartSpeed: 250,
                    fluidSpeed: false,
                    autoplaySpeed: false,
                    navSpeed: false,
                    dotsSpeed: false,
                    dragEndSpeed: false,
                    responsive: {
                        0: {
                            items: (items < items_mobile) ? items : items_mobile
                        },
                        500: {
                            items: (items < items_mobile) ? items : items_mobile
                        },
                        768: {
                            items: items_tablet
                        },
                        991: {
                            items: items
                        },
                        1200: {
                            items: items
                        },
                        1300: {
                            items: items
                        }
                    },
                    responsiveRefreshRate: 200,
                    responsiveBaseElement: window,
                    video: false,
                    videoHeight: false,
                    videoWidth: false,
                    animateOut: false,
                    animateIn: false,
                    fallbackEasing: 'swing',

                    info: false,

                    nestedItemSelector: false,
                    itemElement: 'div',
                    stageElement: 'div',

                    navContainer: false,
                    dotsContainer: false
                });
            });
        },
        prettyPhoto: function() {
            $("a[data-rel^='prettyPhoto']").prettyPhoto({
                hook:'data-rel',
                social_tools:'',
                animation_speed:'normal',
                theme:'light_square'
            });
        },
        stellar: function() {
            $.stellar({
                horizontalScrolling: false,
                scrollProperty: 'scroll',
                positionProperty: 'position'
            });
        },
        newsletterPopup: function() {
            // Reference: http://stackoverflow.com/questions/1458724/how-to-set-unset-cookie-with-jquery
            var et_popup_closed = $.cookie('haru_popup_closed');
            var popup_effect    = $('.haru-popup').data('effect');
            var popup_delay     = $('.haru-popup').data('delay');

            setTimeout(function() {
                $('.haru-popup').magnificPopup({
                    items: {
                      src: '#haru-popup',
                      type: 'inline'
                    },
                    removalDelay: 500, //delay removal by X to allow out-animation
                    callbacks: {
                        beforeOpen: function() {
                            this.st.mainClass = popup_effect;
                        },
                        beforeClose: function() {
                        if($('#showagain:checked').val() == 'do-not-show')
                            $.cookie('haru_popup_closed', 'do-not-show', { expires: 1, path: '/' } );
                        },
                    }
                    // (optionally) other options
                });

                if(et_popup_closed != 'do-not-show' && $('.haru-popup').length > 0 && $('body').hasClass('open-popup')) {
                    $('.haru-popup').magnificPopup('open');
                }  
            }, popup_delay);
        },
        isDesktop: function () {
            var responsive_breakpoint = 991;

            return window.matchMedia('(min-width: ' + (responsive_breakpoint + 1) + 'px)').matches;
        }
    }

    // Blog functions
    HARU.blog = {
        init: function() {
            HARU.blog.jPlayerSetup();
            HARU.blog.loadMore();
            HARU.blog.infiniteScroll();
            HARU.blog.gridLayout();
            HARU.blog.masonryLayout();
        },
        windowResized: function() {
            HARU.blog.processWidthAudioPlayer();
        },  
        jPlayerSetup: function() {
            $('.jp-jplayer').each(function () {
                var $this = $(this),
                    url            = $this.data('audio'),
                    title          = $this.data('title'),
                    type           = url.substr(url.lastIndexOf('.') + 1),
                    player         = '#' + $this.data('player'),
                    audio          = {};
                    audio[type]    = url;
                    audio['title'] = title;
                    $this.jPlayer({
                        ready: function () {
                            $this.jPlayer('setMedia', audio);
                    },
                    swfPath: '../libraries/jPlayer',
                    cssSelectorAncestor: player
                });
            });
            HARU.blog.processWidthAudioPlayer();
        },
        processWidthAudioPlayer: function() {
            setTimeout(function () {
                $('.jp-audio .jp-type-playlist').each(function () {
                    var _width = $(this).outerWidth() - $('.jp-play-pause', this).outerWidth() - parseInt($('.jp-play-pause', this).css('margin-left').replace('px',''),10) - parseInt($('.jp-progress', this).css('margin-left').replace('px',''),10) - $('.jp-volume', this).outerWidth() - parseInt($('.jp-volume', this).css('margin-left').replace('px',''),10) - 15;
                    $('.jp-progress', this).width(_width);
                });
            }, 100);
        },
        loadMore: function() {
            $('.blog-load-more').on('click', function (event) {
                event.preventDefault();
                var $this          = $(this).button('loading');
                var link           = $(this).attr('data-href');
                var contentWrapper = '.archive-content-layout .row';
                var element        = 'article';

                $.get(link, function (data) {
                    var next_href = $('.blog-load-more', data).attr('data-href');
                    var $newElems = $(element, data).css({
                        opacity: 0
                    });

                    $(contentWrapper).append($newElems);
                    $newElems.imagesLoaded(function () {
                        HARU.base.haruCarousel(); // Maybe don't need
                        HARU.blog.jPlayerSetup();
                        HARU.base.prettyPhoto();
                        $newElems.animate({
                            opacity: 1
                        });

                        // Process masonry/grid blog layout
                        if( ($(contentWrapper).parent().hasClass('layout-style-masonry')) || ($(contentWrapper).parent().hasClass('layout-style-grid')) ) {
                            $(contentWrapper).isotope('appended', $newElems);
                            setTimeout(function() {
                                $(contentWrapper).isotope('layout');
                            }, 400);
                        }

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
        infiniteScroll: function() {
            var contentWrapper = '.archive-content-layout .row';

            if ( $(contentWrapper).length ) {
                $(contentWrapper).infinitescroll({
                    navSelector: "#infinite_scroll_button",
                    nextSelector: "#infinite_scroll_button a",
                    itemSelector: "article",
                    loading: {
                        'selector': '#infinite_scroll_loading',
                        'img': haru_framework_theme_url + '/assets/images/ajax-loader.gif',
                        'msgText': 'Loading...',
                        'finishedMsg': ''
                    }
                }, function (newElements, data, url) {
                    var $newElems = $(newElements).css({
                        opacity: 0
                    });
                    $newElems.imagesLoaded(function () {
                        HARU.base.haruCarousel(); // Maybe don't need
                        HARU.blog.jPlayerSetup();
                        HARU.base.prettyPhoto();
                        $newElems.animate({
                            opacity: 1
                        });

                        // Process masonry/grid blog layout
                        if (($(contentWrapper).parent().hasClass('layout-style-masonry'))  || ($(contentWrapper).parent().hasClass('layout-style-grid'))) {
                            $(contentWrapper).isotope('appended', $newElems);
                            setTimeout(function() {
                                $(contentWrapper).isotope('layout');
                            }, 400);
                        }
                    });
                });
            }
        },
        gridLayout: function() {
            var $blog_grid = $('.layout-style-grid .row');

            if ( $blog_grid.length ) {
                $blog_grid.imagesLoaded( function() {
                    $blog_grid.isotope({
                        itemSelector : 'article',
                        layoutMode: "fitRows"
                    });
                    setTimeout(function () {
                        $blog_grid.isotope('layout');
                    }, 500);
                });
            }
        },
        masonryLayout : function() {
            var $blog_masonry = $('.layout-style-masonry .row');

            if ( $blog_masonry.length ) {
                $blog_masonry.imagesLoaded( function() {
                    $blog_masonry.isotope({
                        itemSelector : 'article',
                        layoutMode: "masonry"
                    });

                    setTimeout(function () {
                        $blog_masonry.isotope('layout');
                    }, 500);
                });
            }
        }
    }

    // Page functions
    HARU.page = {
        init: function() {
            HARU.page.backToTop();
            HARU.page.overlayVisualComposer();
        },
        windowLoad: function() {
            if ($body.hasClass('haru-site-preloader')) {
                HARU.page.pageIn();
            }
        },
        pageIn: function() {
            setTimeout(function() {
                $('#haru-site-preloader').fadeOut(300);
            }, 300);
        },
        backToTop: function() {
            var $backToTop = $('.back-to-top');
            if ( $backToTop.length > 0 ) {
                $backToTop.click(function(event) {
                    event.preventDefault();
                    $('html,body').animate({
                        scrollTop: '0px'
                    }, 800);
                });
                $window.on('scroll', function (event) {
                    var scrollPosition = $window.scrollTop();
                    var windowHeight = $window.height() / 2;
                    if (scrollPosition > windowHeight) {
                        $backToTop.addClass('in');
                    }
                    else {
                        $backToTop.removeClass('in');
                    }
                });
            }
        },
        overlayVisualComposer : function() {
            $('[data-overlay-color]').each(function() {
                var $selector = $(this);
                setTimeout(function() {
                    var overlay_color = $selector.data('overlay-color');
                    var html = '<div class="overlay-bg-vc" style="background-color: '+ overlay_color +'"></div>';
                    $selector.prepend(html);
                }, 100);
            });
        },
    }

    // Header functions
    HARU.header = {
        init: function () {
            HARU.header.stickyHeadroom();
            HARU.header.menuMobile();
            HARU.header.canvasSidebar(); // Canvas Sidebar
            HARU.header.cartSidebar(); // Cart Sidebar
            HARU.header.verticalMenu();
            HARU.header.searchButton(); // Search button popup
            HARU.header.searchBox(); // Search box ajax
            HARU.header.searchProductCategory(); // Search product with category
        },
        windowResized : function(){
            if (HARU.base.isDesktop()) {
                $('.toggle-icon-wrap[data-drop]').removeClass('in');
            }
            var $adminBar = $('#wpadminbar');

            if ($adminBar.length > 0) {
                $body.attr('data-offset', $adminBar.outerHeight() + 1);
            }
            if ($adminBar.length > 0) {
                $body.attr('data-offset', $adminBar.outerHeight() + 1);
            }
            HARU.header.menuMobileFly();
            HARU.header.menuMobileDropdown();
        },
        windowLoad: function() {
            HARU.header.menuMobileDropdown();
            HARU.header.menuMobileFly();
        },
        stickyHeadroom : function() {
            // $("#haru-header.header-sticky, #haru-mobile-header.header-mobile-sticky").headroom({
            $("#haru-header.header-sticky").headroom({
                tolerance: 5,
                offset : 205,
                classes: {
                    initial: "headroom",
                    pinned: "headroom--pinned",
                    unpinned: "headroom--unpinned"
                },
                onTop : function() {
                    // Process to hide vertical menu
                    // Show menu if on homepage
                    if ( $('body').hasClass('home') || $('body').hasClass('vertical-menu') )  {
                        $('#vertical-menu-wrap').show();
                    }               
                },
                onNotTop : function() {
                    // Process to hide vertical menu
                    $('#vertical-menu-wrap').hide();
                }
            });

        },
        menuMobile : function() {
            $('.toggle-mobile-menu[data-ref]').click(function(event) {
                event.preventDefault();

                var $this     = $(this);
                var data_drop = $this.data('ref');
                $this.toggleClass('in');
                switch ($this.data('drop-type')) {
                    case 'dropdown':
                        $('#' + data_drop).slideToggle();
                        break;
                    case 'fly':
                        $('body').toggleClass('menu-mobile-in');
                        $('#' + data_drop).toggleClass('in');
                        break;
                }
            });

            $('.toggle-icon-wrap[data-ref]:not(.toggle-mobile-menu)').click(function(event) {
                event.preventDefault();

                var $this    = $(this);
                var data_ref = $this.data('ref');
                $this.toggleClass('in');
                $('#' + data_ref).toggleClass('in');
            });

            $('.haru-mobile-menu-overlay, .mobile-menu-close').click(function() {
                $body.removeClass('menu-mobile-in');

                $('#haru-nav-mobile-menu').removeClass('in');
                $('.toggle-icon-wrap[data-ref]').removeClass('in');
            });
        },
        menuMobileDropdown: function() {
            var top = 0;
            if (($('#wpadminbar').length > 0) && ($('#wpadminbar').css('position') == 'fixed')) {
                top = $('#wpadminbar').outerHeight();
            }
            if (top > 0) {
                $('.haru-mobile-header-nav.menu-mobile-fly').css('top',top + 'px');
            } else {
                $('.haru-mobile-header-nav.menu-mobile-fly').css('top','');
            }
        },
        menuMobileFly: function() {
            var top = 0;

            if (($('#wpadminbar').length > 0) && ($('#wpadminbar').css('position') == 'fixed')) {
                top = $('#wpadminbar').outerHeight();
            }
            if (top > 0) {
                $('.haru-mobile-header-nav.menu-mobile-fly').css('top',top + 'px');
            } else {
                $('.haru-mobile-header-nav.menu-mobile-fly').css('top','');
            }
        },
        cartSidebar: function () {
            $('.cart-mask-overlay').on('click', function(event) {
                if (($(event.target).closest('.cart-sidebar .cart_list_wrap').length == 0) && ($(event.target).closest('.cart-sidebar')).length == 0) {
                    $('.cart_list_wrap').removeClass('in');
                    $('.cart-mask-overlay').removeClass('in');
                }
            });

            $('.cart-sidebar').on('click', function (event) {
                event.preventDefault();
                $('.cart_list_wrap').toggleClass('in');
                $('.cart-mask-overlay').toggleClass('in');
            });
            $('.cart-sidebar-close').on('click', function (event) {
                event.preventDefault();
                $('.cart_list_wrap').removeClass('in');
                $('.cart-mask-overlay').removeClass('in');
            });
        },
        canvasSidebar: function () {
            $('.canvas-mask-overlay').on('click', function(event) {
                if (($(event.target).closest('.haru-canvas-sidebar-wrap').length == 0) && ($(event.target).closest('.canvas-sidebar-toggle')).length == 0) {
                    $('.haru-canvas-sidebar-wrap').removeClass('in');
                    $('.canvas-mask-overlay').removeClass('in');
                }
            });

            $('.canvas-sidebar-toggle').on('click', function (event) {
                event.preventDefault();
                $('.haru-canvas-sidebar-wrap').toggleClass('in');
                $('.canvas-mask-overlay').toggleClass('in');
            });
            $('.canvas-sidebar-close').on('click', function (event) {
                event.preventDefault();
                $('.haru-canvas-sidebar-wrap').removeClass('in');
                $('.canvas-mask-overlay').removeClass('in');
            });
        },
        verticalMenu: function () {
            // Close menu if not on homepage
            if ( !$('body').hasClass('home') && !$('body').hasClass('vertical-menu') ) {
                $(document).on('click', function(e) {
                    var container = $(".vertical-menu-wrap");
                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        $('#vertical-menu-wrap').hide();
                    }
                });
            } else {
                $('#vertical-menu-wrap').show();
            }

            $('.vertical-menu-toggle').on('click', function (event) {
                event.preventDefault();
                $('#vertical-menu-wrap').slideToggle(300);
            });

            if ( $( '#vertical-menu-wrap' ).length > 0 ) {
                var all_item = 0;
                var items_show = $('#vertical-menu-wrap').data('items-show')-1;

                var all_item = $('#vertical-menu-wrap .vertical-megamenu>li').length;
                if ( all_item > (items_show + 1) ) {
                    $('#vertical-menu-wrap').addClass('show-view-all');
                }

                $('#vertical-menu-wrap').find('.vertical-megamenu>li').each(function(i) {
                    all_item = all_item + 1;
                  
                    if (i > items_show) {
                        $(this).addClass('menu-item-more');
                    }
                })
            }
            
            $(document).on('click', '.vertical-view-cate',function() {
                var $this = $(this);
                $(this).toggleClass('show-category');
                $(this).closest('.vertical-menu-wrap').find('li.menu-item-more').each(function() {
                    $(this).toggleClass('show');
                });
                var open_text = $(this).data('open-text');
                var close_text = $(this).data('close-text');
                if ( $this.hasClass('show-category') ) {
                    $this.html(close_text);
                } else {
                    $this.html(open_text);
                }
            });

        },
        searchButton: function() {
            var popup_effect    = 'search-popup ZoomIn';

            $('.header-search-button').magnificPopup({
                items: {
                    src: '#haru-search-popup',
                    type: 'inline'
                },
                removalDelay: 500, // delay removal by X to allow out-animation
                callbacks: {
                    beforeOpen: function() {
                        this.st.mainClass = popup_effect;
                    },
                    open: function() {
                        // Clear search form and result
                        $('.ajax-search-result', '.haru-search-wrap').html('');
                        $('input[type="text"]', '.haru-search-wrap').val('');

                        HARU.header.searchButtonProcess();
                    },
                    beforeClose: function() {
                        // Do something
                    },
                }
                // (optionally) other options
            });
        },
        searchButtonProcess : function() {
            $('.haru-search-wrap').each(function() {
                var $this = $(this);

                if ( $('.search-popup-form', $this).data('search-type') == 'ajax' ) {
                    // Clear

                    // Doesn't allow submit form
                    $('.search-popup-form', $this).submit(function() {
                        return false;
                    });
                    // Process when typing
                    $('input[type="search"]', $this).on('keyup', function(event) {
                        var s_timeOut_search = null;

                        if (event.altKey || event.ctrlKey || event.shiftKey || event.metaKey) {
                            return;
                        }

                        // Process when select ajax result
                        var keys = ["Control", "Alt", "Shift"];
                        if (keys.indexOf(event.key) != -1) return;
                        switch (event.which) {
                            case 38:    // Press Up Key
                                HARU.header.process_search_up($this);
                                break;
                            case 40:    // Press Down Key
                                HARU.header.process_search_down($this);
                                break;
                            case 13:    // Press Enter Key
                                var $item = $('li.selected a', $this);
                                if ($item.length == 0) {
                                    event.preventDefault();
                                    return false;
                                }
                                HARU.header.process_search_enter($this);
                                break;
                            default:
                                clearTimeout(s_timeOut_search);
                                s_timeOut_search = setTimeout(function() {
                                    popup_seach($this);
                                }, 1000); // Can cause can't up/down select
                                break;
                        }
                    });

                    // Process keyword
                    function popup_seach($this) {
                        var keyword = $('input[type="search"]', $this).val();

                        if (keyword.length < 3) {
                            var hint_message = $this.attr('data-hint-message');

                            $('.ajax-search-result', $this).html('<ul><li class="no-result">' + hint_message + '</li></ul>');
                            return;
                        }
                        // Process icon-search
                        $('.icon-search', $this).addClass('fa-spinner fa fa-spin');
                        $('.icon-search', $this).removeClass('ion-ios-search-strong');
                        // Ajax result
                        $.ajax({
                            type   : 'POST',
                            data   : 'action=popup_search_result&keyword=' + keyword,
                            url    : haru_framework_ajax_url,
                            success: function (data) {
                                $('.icon-search', $this).removeClass('fa-spinner fa fa-spin');
                                $('.icon-search', $this).addClass('ion-ios-search-strong');
                                
                                if (data) {
                                    $('.ajax-search-result', $this).html(data);
                                    $('.ajax-search-result', $this).scrollTop(0);
                                }
                            },
                            error : function(data) {
                                $('.icon-search', $this).removeClass('fa-spinner fa fa-spin');
                                $('.icon-search', $this).addClass('ion-ios-search-strong');
                            }
                        });
                    }
                    // Process keyword up, down, enter
                } else {
                    return false; // Standard Search
                }
            });
        },
        searchBox: function() {
            $('.haru-search-box-wrap').each(function() {
                var $this = $(this);

                if ($('.search-box-form', $this).data('search-type') == 'ajax') {
                    // Clear or close all state when closed search
                    $(document).on('click', function(event) {
                        if ($(event.target).closest('.ajax-search-result', $this).length == 0) {
                            $('.ajax-search-result', $this).html('');
                            $('> input[type="text"]', $this).val('');
                        }
                    });
                    // Don't allow submit form
                    $('.search-box-form', $this).submit(function() {
                        return false;
                    });
                    // Process when typing
                    $('.search-box-form > input[type="text"]', $this).on('keyup', function(event) {
                        var s_timeOut_search = null;

                        if (event.altKey || event.ctrlKey || event.shiftKey || event.metaKey) {
                            return;
                        }

                        var keys = ["Control", "Alt", "Shift"];
                        if (keys.indexOf(event.key) != -1) return;
                        switch (event.which) {
                            case 27:    // Press ESC key
                                $('.ajax-search-result', $this).html('');
                                $(this).val('');
                                break;
                            case 38:    // Press UP key
                                HARU.header.process_search_up($this);
                                break;
                            case 40:    // Press DOWN key
                                HARU.header.process_search_up($this);
                                break;
                            case 13:    // Press ENTER key
                                HARU.header.process_search_enter($this);
                                break;
                            default:
                                clearTimeout(s_timeOut_search);
                                s_timeOut_search = setTimeout(function() {
                                    box_search($this);
                                }, 1000);
                                break;
                        }
                    });
                    // Process keyword
                    function box_search($this) {
                        var keyword = $('input[type="text"]', $this).val();

                        if (keyword.length < 3) {
                            var hint_message = $this.attr('data-hint-message');

                            $('.ajax-search-result', $this).html('<ul><li class="no-result">' + hint_message + '</li></ul>');
                            return;
                        }
                        // Process icon-search
                        $('button > i', $this).addClass('fa-spinner fa fa-spin');
                        $('button > i', $this).removeClass('ion-ios-search-strong');
                        // Ajax result
                        $.ajax({
                            type   : 'POST',
                            data   : 'action=popup_search_result&keyword=' + keyword,
                            url    : haru_framework_ajax_url,
                            success: function (data) {
                                $('button > i', $this).removeClass('fa-spinner fa fa-spin');
                                $('button > i', $this).addClass('ion-ios-search-strong');
                                
                                if (data) {
                                    $('.ajax-search-result', $this).html(data);
                                    $('.ajax-search-result', $this).scrollTop(0);
                                }
                            },
                            error : function(data) {
                                $('button > i', $this).removeClass('fa-spinner fa fa-spin');
                                $('button > i', $this).addClass('ion-ios-search-strong');
                            }
                        });
                    }
                    // Process keyword up, down, enter
                } else {
                    return false; // Standard Search
                }
            });
        },
        searchProductCategory: function() {
            $('.search-product-category').each(function() {
                var $productCategory = $('.select-category', this);
                var $this            = $(this);

                // Clear or close all state when closed search
                $(document).on('click', function(event) {
                    if ($(event.target).closest('.select-category', $this).length === 0) {
                        $(' > ul', $productCategory).slideUp(300);
                    }
                    if (($(event.target).closest('.ajax-search-result', $this).length === 0)) {
                        $('.ajax-search-result', $this).html('');
                        $('input', $this).val('');
                    }
                });

                var sHtml = '<li><span data-catid="-1" data-value="' + $('> span', $productCategory).text() + '">[' + $('> span', $productCategory).text() + ']</span></li>';
                $('> ul', $productCategory).prepend(sHtml);

                // Select Category
                $('> span', $productCategory).on('click', function() {
                    $('> ul', $(this).parent()).slideToggle(300);
                });

                // Category Click
                $('li > span', $productCategory).on('click', function() {
                    var $this = $(this);
                    var id = $this.attr('data-catid');
                    var text = '';
                    if (typeof ($this.attr('data-value')) != "undefined") {
                        text = $this.attr('data-value');
                    }
                    else {
                        text = $this.text();
                    }

                    var $cat_current = $('> span', $productCategory);
                    $cat_current.text(text);
                    $cat_current.attr('data-catid', id);
                    $(' > ul', $productCategory).slideUp(300);
                });

                // Process when typing
                $('input[type="text"]', $this).on('keyup', function(event) {
                    var s_timeOut_search = null;

                    if (event.altKey || event.ctrlKey || event.shiftKey || event.metaKey) {
                        return;
                    }

                    var keys = ["Control", "Alt", "Shift"];
                    if (keys.indexOf(event.key) != -1) return;
                    switch (event.which) {
                        case 37:
                        case 39:
                            break;
                        case 27:    // Press ESC key
                            $('.ajax-search-result', $this).html('');
                            $(this).val('');
                            break;
                        case 38:    // Press UP key
                            HARU.header.process_search_up($this);
                            break;
                        case 40:    // Press DOWN key
                            HARU.header.process_search_down($this);
                            break;
                        case 13:    // Press ENTER key
                            var $item = $('.ajax-search-result li.selected a', $this);
                            if ($item.length == 0) {
                                event.preventDefault();
                                return false;
                            }

                            HARU.header.process_search_enter($this);

                            event.preventDefault();
                            break;
                        default:
                            clearTimeout(s_timeOut_search);
                            s_timeOut_search = setTimeout(function() {
                                category_search($this);
                            }, 1000);
                            break;
                    }
                });

                function category_search($this) {
                    var keyword = $('input[type="text"]', $this).val();
                    if (keyword.length < 3) {
                        var hint_message = $this.attr('data-hint-message');

                        $('.ajax-search-result', $this).html('<ul><li class="no-result">' + hint_message + '</li></ul>');
                        return;
                    }
                    // Process icon-search
                    $('button > i', $this).addClass('fa-spinner fa-spin');
                    $('button > i', $this).removeClass('fa-search');
                    $.ajax({
                        type   : 'POST',
                        data   : 'action=search_product_category&keyword=' + keyword + '&cat_id=' + $('.select-category > span', $this).attr('data-catid'),
                        url    : haru_framework_ajax_url,
                        success: function (data) {
                            $('button > i', $this).removeClass('fa-spinner fa-spin');
                            $('button > i', $this).addClass('fa-search');
                            if (data) {
                                $('.ajax-search-result', $this).html(data);
                                $('.ajax-search-result', $this).scrollTop(0);
                            }
                        },
                        error : function(data) {
                            $('button > i', $this).removeClass('fa-spinner fa-spin');
                            $('button > i', $this).addClass('fa-search');
                        }
                    });
                }
            });            
        },
        process_search_up : function($this) {
            var $item = $('li.selected', $this);

            if ($('li', $this).length < 2) return; // Only one item
            var $prev_item = $item.prev();

            $item.removeClass('selected');
            if ($prev_item.length) {
                $prev_item.addClass('selected');
            } else {
                $('li:last', $this).addClass('selected');
                $prev_item = $('li:last', $this);
            }
            if ($prev_item.position().top < $('.ajax-search-result', $this).scrollTop()) {
                $('.ajax-search-result', $this).scrollTop($prev_item.position().top);
            } else if ($prev_item.position().top + $prev_item.outerHeight() > $('.ajax-search-result', $this).scrollTop() + $('.ajax-search-result', $this).height()) {
                $('.ajax-search-result', $this).scrollTop($prev_item.position().top - $('.ajax-search-result', $this).height() + $prev_item.outerHeight());
            }
        },
        process_search_down : function($this) {
            var $item = $('li.selected', $this);

            if ($('li', $this).length < 2) return; // Only one item
            var $next_item = $item.next();

            $item.removeClass('selected');
            if ($next_item.length) {
                $next_item.addClass('selected');
            } else {
                $('li:first', $this).addClass('selected');
                $next_item = $('li:first', $this);
            }
            if ($next_item.position().top < $('.ajax-search-result', $this).scrollTop()) {
                $('.ajax-search-result', $this).scrollTop($next_item.position().top);
            } else if ($next_item.position().top + $next_item.outerHeight() > $('.ajax-search-result', $this).scrollTop() + $('.ajax-search-result', $this).height()) {
                $('.ajax-search-result', $this).scrollTop($next_item.position().top - $('.ajax-search-result', $this).height() + $next_item.outerHeight());
            }
        },
        process_search_enter : function($this) {
            var $item = $('li.selected a', $this);

            if ($item.length > 0) {
                window.location = $item.attr('href');
            }
        }
    };

    // Woocommerce functions
    HARU.woocommerce = {
        init: function() {
            HARU.woocommerce.singleProductImages();
            HARU.woocommerce.shopMasonry();
            HARU.woocommerce.addToCart();
            HARU.woocommerce.addToWishlist();
            HARU.woocommerce.compare();
            HARU.woocommerce.quickView();
            HARU.woocommerce.changeArchiveLayout();
            HARU.woocommerce.addToCartVariation();
            // Shortcode ajax
            HARU.woocommerce.shortcodeIsotope();
            // Product ajax category
            HARU.woocommerce.productAjaxCategory();
            HARU.woocommerce.productCountdown();
        },
        windowResized : function () {
            // Do something
        },
        windowLoad : function() {
            // Do something
        },
        singleProductImages : function() {
            // http://poligon.pro/owl/
            // https://github.com/OwlCarousel2/OwlCarousel2/issues/80
            // https://codepen.io/washaweb/pen/KVRxRW
            if ( $('.haru-single-product').length ) {
                var sync1    = $("#product-images", ".single-product-image-inner");
                var sync2    = $("#product-thumbnails", ".single-product-image-inner");
                var flag     = false;
                var duration = 500;

                sync1
                    .owlCarousel({
                        items: 1,
                        margin: 5,
                        nav: true,
                        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                        dots: true
                    })
                    .on('changed.owl.carousel', function (e) {
                        if (!flag) {
                            flag = true;
                            sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
                            flag = false;
                        }

                        // Add class synced to current slide
                        var current = e.item.index;
                        sync2
                            .find(".owl-item")
                            .removeClass("synced")
                            .eq(current)
                            .addClass("synced");
                    });

                sync2
                    .owlCarousel({
                        margin: 20,
                        items: 4,
                        nav: true,
                        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                        center: false,
                        dots: true,
                        onInitialized : function() {
                            sync2.find(".owl-item").eq(0).addClass("synced");
                        }
                    })
                    .on('click', '.owl-item', function () {
                        sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);
                    })
                    .on('changed.owl.carousel', function (e) {
                        if ( !flag ) {
                            flag = true;        
                            sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
                            flag = false;
                        }
                    });

                $(document).on('change','.variations_form .variations select,.variations_form .variation_form_section select,div.select',function() {
                    var variation_form   = $(this).closest( '.variations_form' );
                    var current_settings = {},
                        reset_variations = variation_form.find( '.reset_variations' );
                    variation_form.find('.variations select,.variation_form_section select' ).each( function() {
                        // Encode entities
                        var value = $(this ).val();

                        // Add to settings array
                        current_settings[ $( this ).attr( 'name' ) ] = jQuery(this ).val();
                    });

                    variation_form.find('.variation_form_section div.select input[type="hidden"]' ).each( function() {
                        // Encode entities
                        var value = $(this ).val();

                        // Add to settings array
                        current_settings[ $( this ).attr( 'name' ) ] = jQuery(this ).val();
                    });

                    var all_variations = variation_form.data( 'product_variations' );
                    var variation_id   = 0;
                    var match          = true;

                    for (var i = 0; i < all_variations.length; i++) {
                        match                     = true;
                        var variations_attributes = all_variations[i]['attributes'];
                        for(var attr_name in variations_attributes) {
                            var val1 = variations_attributes[attr_name];
                            var val2 = current_settings[attr_name];
                            if (val1 == undefined || val2 == undefined ) {
                                match = false;
                                break;
                            }
                            if (val1.length == 0) {
                                continue;
                            }

                            if (val1 != val2) {
                                match = false;
                                break;
                            }
                        }
                        if (match) {
                            variation_id = all_variations[i]['variation_id'];
                            break;
                        }
                    }

                    if (variation_id > 0) {
                        var index = parseInt($('a[data-variation_id*="|'+variation_id+'|"]','#product-images').data('index'),10) ;
                        if (!isNaN(index) ) {
                            sync1.trigger('to.owl.carousel', [index, duration, true]);
                        }
                    }
                });
            }
        },
        shopMasonry : function() {
            var $shop_masonry = $('.haru-archive-product .archive-product-wrapper .products');

            if ( $shop_masonry.length ) {
                $shop_masonry.imagesLoaded( function() {
                    $shop_masonry.isotope({
                        itemSelector : 'li.product',
                        'gutter': 10,
                        layoutMode: "fitRows" // masonry
                    });

                    setTimeout(function () {
                        $shop_masonry.isotope('layout');
                    }, 500);
                });
            }
        },
        addToCart : function () {
            $(document).on('click', '.add_to_cart_button', function () {

                var button = $(this),
                    buttonWrap = button.parent();

                if (!button.hasClass('single_add_to_cart_button') && button.is( '.product_type_simple' )) {
   
                    button.addClass("added-spinner");
                    button.find('i').attr('class', 'fa fa-spinner fa-spin');
                }

            });

            $body.bind("added_to_cart", function (event, fragments, cart_hash, $thisbutton) {

                HARU.woocommerce.init();

                var is_single_product = $thisbutton.hasClass('single_add_to_cart_button');

                if (is_single_product) return;

                setTimeout(function () {
                    var button         = $thisbutton,
                        buttonWrap     = button.parent(),
                        buttonViewCart = buttonWrap.find('.added_to_cart'),
                        // addedTitle     = buttonViewCart.text(),
                        productWrap    = buttonWrap.parent().parent().parent().parent();

                        // buttonWrap.find('.added').remove();
                        buttonViewCart.html('<i class="ion-checkmark-round"></i><span class="haru-tooltip button-tooltip">' + haru_framework_constant.product_viewcart + '</span>');
                }, 10);

            });
        },
        addToWishlist : function() {
            $(document).on('click', '.add_to_wishlist', function () {
                var button = $(this),
                    buttonWrap = button.parent().parent();

                if (!buttonWrap.parent().hasClass('single-product-function')) {
                    button.addClass("added-spinner");
                    button.find('i').attr('class', 'fa fa-spinner fa-spin');

                    var productWrap = buttonWrap.parent().parent().parent().parent();
                    if (typeof(productWrap) == 'undefined') {
                        return;
                    }
                    productWrap.addClass('active');
                }

            });

            $body.bind("added_to_wishlist", function (event, fragments, cart_hash, $thisbutton) {
                var button = $('.added-spinner.add_to_wishlist'),
                    buttonWrap = button.parent().parent();
                if (!buttonWrap.parent().hasClass('single-product-function')) {
                    var productWrap = buttonWrap.parent().parent().parent().parent();
                    if (typeof(productWrap) == 'undefined') {
                        return;
                    }
                    setTimeout(function () {
                        productWrap.removeClass('active');
                        button.removeClass('added-spinner');
                    }, 700);
                }
                // Add to update wishlist
                HARU.woocommerce.updateWishlist();
            });
            // Add to update wishlist on wishlist page
            $('#yith-wcwl-form table tbody tr td a.remove, #yith-wcwl-form table tbody tr td a.add_to_cart_button').live('click',function() {
                var old_num_product = $('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
                var count = 1;
                var time_interval = setInterval(function(){
                    count++;
                    var new_num_product = $('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
                    if( old_num_product != new_num_product || count == 20 ) {
                        clearInterval(time_interval);
                        HARU.woocommerce.updateWishlist();
                    }
                },500);
            });
        },
        updateWishlist : function() {
            if( typeof haru_framework_ajax_url == 'undefined' ) {
                return;
            }
                
            var wishlist_wrapper = jQuery('.my-wishlist-wrap');
            if( wishlist_wrapper.length == 0 ) {
                return;
            }
            
            wishlist_wrapper.addClass('loading');
            
            jQuery.ajax({
                type : 'POST',
                url : haru_framework_ajax_url,
                data : {
                    action : 'update_woocommerce_wishlist'
                },
                success : function(response) {
                    var first_icon = wishlist_wrapper.children('i.fa:first');
                    wishlist_wrapper.html(response);
                    if( first_icon.length > 0 ){
                        wishlist_wrapper.prepend(first_icon);
                    }
                    wishlist_wrapper.removeClass('loading');
                }
            });      
        },
        compare : function () {
            $('a.compare').on('click', function (event) {
                event.preventDefault();
                var button = $(this);

                setTimeout(function () {
                    button.html('<i class="icon ion-ios-shuffle"></i><span class="haru-tooltip button-tooltip">' + haru_framework_constant.product_compare + '</span>');
                }, 5000);
                // Maybe need change time to make icon work
            });
        },
        quickView : function() {
            $('a.quickview').prettyPhoto({
                deeplinking: false,
                opacity: 1,
                social_tools: false,
                default_width: 900,
                default_height: 600,
                theme: 'pp_woocommerce',
                changepicturecallback : function() {
                    $('.pp_inline').find('form.variations_form').wc_variation_form();
                    $('.pp_inline').find('form.variations_form .variations select').change();
                    $('body').trigger('wc_fragments_loaded');
                    
                    $('.pp_woocommerce').addClass('loaded');

                    var sync1    = $("#product-images",".popup-product-quick-view-wrapper .single-product-image-inner");
                    var sync2    = $("#product-thumbnails",".popup-product-quick-view-wrapper .single-product-image-inner");
                    var flag     = false;
                    var duration = 500;

                    sync1
                        .owlCarousel({
                            items: 1,
                            margin: 5,
                            nav: true,
                            navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                            dots: true
                        })
                        .on('changed.owl.carousel', function (e) {
                            if (!flag) {
                                flag = true;
                                sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
                                flag = false;
                            }

                            // Add class synced to current slide
                            var current = e.item.index;
                            sync2
                                .find(".owl-item")
                                .removeClass("synced")
                                .eq(current)
                                .addClass("synced");
                        });

                    sync2
                        .owlCarousel({
                            margin: 20,
                            items: 4,
                            nav: true,
                            navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                            center: false,
                            dots: true,
                            onInitialized : function() {
                                sync2.find(".owl-item").eq(0).addClass("synced");
                            }
                        })
                        .on('click', '.owl-item', function () {
                            sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);
                        })
                        .on('changed.owl.carousel', function (e) {
                            if ( !flag ) {
                                flag = true;        
                                sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
                                flag = false;
                            }
                        });

                    // Re run addToCartVariation to make it work
                    HARU.woocommerce.addToCartVariation();

                    $(document).on('change','.variations_form .variations select,.variations_form .variation_form_section select,div.select',function() {
                        var variation_form   = $(this).closest( '.variations_form' );
                        var current_settings = {},
                            reset_variations = variation_form.find( '.reset_variations' );
                        variation_form.find('.variations select,.variation_form_section select' ).each( function() {
                            // Encode entities
                            var value = $(this ).val();

                            // Add to settings array
                            current_settings[ $( this ).attr( 'name' ) ] = jQuery(this ).val();
                        });

                        variation_form.find('.variation_form_section div.select input[type="hidden"]' ).each( function() {
                            // Encode entities
                            var value = $(this ).val();

                            // Add to settings array
                            current_settings[ $( this ).attr( 'name' ) ] = jQuery(this ).val();
                        });

                        var all_variations = variation_form.data( 'product_variations' );
                        var variation_id   = 0;
                        var match          = true;

                        for (var i = 0; i < all_variations.length; i++) {
                            match                     = true;
                            var variations_attributes = all_variations[i]['attributes'];
                            for(var attr_name in variations_attributes) {
                                var val1 = variations_attributes[attr_name];
                                var val2 = current_settings[attr_name];
                                if (val1 == undefined || val2 == undefined ) {
                                    match = false;
                                    break;
                                }
                                if (val1.length == 0) {
                                    continue;
                                }

                                if (val1 != val2) {
                                    match = false;
                                    break;
                                }
                            }
                            if (match) {
                                variation_id = all_variations[i]['variation_id'];
                                break;
                            }
                        }

                        if (variation_id > 0) {
                            var index = parseInt($('a[data-variation_id*="|'+variation_id+'|"]','#product-images').data('index'),10) ;
                            if (!isNaN(index) ) {
                                sync1.trigger('to.owl.carousel', [index, duration, true]);
                            }
                        }
                    });
                }
            });
        },
        addToCartVariation: function() {
            $('.variations_form .variations ul.variable-items-wrapper').each(function (i, el) {

                var select = $(this).prev('select');
                var li = $(this).find('li');
                $(this).on('click', 'li:not(.selected)', function () {
                    var value = $(this).data('value');

                    li.removeClass('selected');
                    select.val('').trigger('change'); // Add to fix VM15713:1 Uncaught TypeError: Cannot read property 'length' of null
                    select.val(value).trigger('change');
                    $(this).addClass('selected');
                });

                $(this).on('click', 'li.selected', function () {
                    li.removeClass('selected');
                    select.val('').trigger('change');
                    select.trigger('click');
                    select.trigger('focusin');
                    select.trigger('touchstart');
                });
            });

            $('.variations_form .variations').each(function (i, el) {
                $(this).on('click', '.reset_variations',function() {
                    $('.variations_form .variations').find('li').removeClass('selected');
                });
            });
        },
        shortcodeIsotope: function () {
            var default_filter = [];
            var array_filter   = []; // Push filter to an array to process when don't have filter

            $('.products-shortcode-wrap').each(function(index, value) {
                // Process filter each shortcode
                $(this).find('.product-filters ul li').first().find('a').addClass('selected');
                default_filter[index] = $(this).find('.product-filters ul li').first().find('a').attr('data-option-value')

                var self            = $(this);
                var $container      = $(this).find('.products'); // parent element of .item
                var $filter         = $(this).find('.product-filters a');
                var masonry_options = {
                    'gutter' : 0
                };
                
                array_filter[index] = $filter;

                // Add to process products layout style
                var shortcode_inner = '.products-shortcode-wrap';
                var layoutMode      = 'fitRows';
                if ( ($(shortcode_inner).hasClass('masonry')) ) {
                    var layoutMode = 'masonry';
                }

                for( var i = 0; i < array_filter.length; i++ ) {
                    if( array_filter[i].length == 0 ) {
                        default_filter = '';
                    }
                    $container.isotope({
                        itemSelector : 'li.product', // .item
                        transitionDuration : '0.5s',
                        masonry : masonry_options,
                        layoutMode : layoutMode,
                        filter: default_filter[i]
                    });   
                }                  

                imagesLoaded(self,function(){
                    $container.isotope('layout');
                });

                $(window).resize(function(){
                    $container.isotope('layout');
                });

                $filter.click(function(e){
                    e.stopPropagation();
                    e.preventDefault();

                    var $this = jQuery(this);
                    // don't proceed if already selected
                    if ($this.hasClass('selected')) {
                        return false;
                    }
                    var filters = $this.closest('ul');
                    filters.find('.selected').removeClass('selected');
                    $this.addClass('selected');

                    var options = {
                            layoutMode : 'fitRows',
                            transitionDuration : '0.5s',
                            'masonry' : {
                                'gutter' : 0
                            }
                        },
                    key          = filters.attr('data-option-key'),
                    value        = $this.attr('data-option-value');
                    value        = value === 'false' ? false : value;
                    options[key] = value;

                    $container.isotope(options);
                });

                // Loadmore
                $('.product-load-more', self).off().on('click', function (event) {
                    event.preventDefault();

                    var $this           = $(this).button('loading');
                    var link            = $(this).attr('data-href');
                    var element         = '.products-shortcode-wrap li.product'; // .item

                    $.get(link, function (data) {
                        var next_href = $('.product-load-more', data).attr('data-href');
                        var $newElems = $(element, data).css({
                            opacity: 0
                        });

                        $container.append($newElems);
                        $newElems.imagesLoaded(function () {
                            $newElems.animate({
                                opacity: 1
                            });

                            $container.isotope('appended', $newElems);
                            setTimeout(function() {
                                $container.isotope('layout');
                            }, 400);

                            HARU.woocommerce.init();
                        });

                        if (typeof(next_href) == 'undefined') {
                            $this.parent().remove();
                        } else {
                            $this.button('reset');
                            $this.attr('data-href', next_href);
                        }
                    });
                });

                // Infinite Scroll
                $container.infinitescroll({
                    navSelector: "#infinite_scroll_button",
                    nextSelector: "#infinite_scroll_button a",
                    itemSelector: ".products-shortcode-wrap li.product", // .item
                    loading: {
                        'selector': '#infinite_scroll_loading',
                        'img': haru_framework_theme_url + '/assets/images/ajax-loader.gif',
                        'msgText': 'Loading...',
                        'finishedMsg': ''
                    }
                }, function (newElements, data, url) {
                    var $newElems = $(newElements).css({
                        opacity: 0
                    });
                    $newElems.imagesLoaded(function () {
                        $newElems.animate({
                            opacity: 1
                        });

                        $container.isotope('appended', $newElems);
                        setTimeout(function() {
                            $container.isotope('layout');
                        }, 400);

                        HARU.woocommerce.init();
                    });
                });
            });
        },
        productAjaxCategory: function () {
            $('.haru-woo-shortcodes-products-ajax-category').each(function(){
                var $this = $(this);

                $this.find('.products-tabs .tab-item').bind('click', function() {
                    if ( $(this).hasClass('current') || $(this).parents('.haru-woo-shortcodes-products-ajax-category').find('.products-content').hasClass('loading') ){
                        return;
                    }
                    var element       = $(this).parents('.haru-woo-shortcodes-products-ajax-category');
                    var element_id    = element.attr('id');
                    var product_cat   = $(this).data('product_cat');
                    var see_more_link = $(this).data('link');
                    var atts          = element.data('atts');
                    
                    var is_all_tab = $(this).hasClass('all-tab') ? 1 : 0;
                    
                    if ( element.find('a.see-more-button').length > 0 ) {
                        element.find('a.see-more-button').attr('href', see_more_link);
                    }
                    
                    element.find('.products-tabs .tab-item').removeClass('current');
                    $(this).addClass('current');
                    
                    /* Check cache */
                    var tab_data_index = element_id + '-' + product_cat.toString().split(',').join('-');
                    if ( products_ajax_category_data[tab_data_index] != undefined ){
                        element.find('.products-content .products').remove();
                        element.find('.products-content').append( products_ajax_category_data[tab_data_index] );

                        // Generate Isotope Grid
                        HARU.woocommerce.haru_product_ajax_category_isotope( element );

                        // Generate Products Slider
                        HARU.woocommerce.haru_product_ajax_category_slider( element, atts.show_nav, atts.auto_play, atts.columns, atts.slide_duration );
                        
                        // Recall quickView
                        HARU.woocommerce.quickView();

                        /* See more button handle */
                        HARU.woocommerce.haru_product_ajax_category_view_more( element, atts );
                        
                        return;
                    }
                    
                    element.find('.products-content').addClass('loading');

                    $.ajax({
                        type : "POST",
                        timeout : 30000,
                        url : haru_framework_ajax_url,
                        data : {
                            action: 'haru_get_product_content_in_category_tab', 
                            atts: atts, 
                            product_cat: product_cat, 
                            is_all_tab: is_all_tab
                        },
                        error: function(xhr,err) {
                            
                        },
                        success: function(response) {
                            if ( response ) {       
                                element.find('.products-content .products').remove();
                                element.find('.products-content').append( response ).find('li.product-type').css('opacity',0).animate({opacity: 1},500);

                                /* save cache */
                                products_ajax_category_data[tab_data_index] = response;
                                
                                /* See more button handle */
                                HARU.woocommerce.haru_product_ajax_category_view_more( element, atts );

                                /* Generate isotope */
                                if ( $this.hasClass('grid') ) {
                                    HARU.woocommerce.haru_product_ajax_category_isotope( element );
                                    HARU.woocommerce.quickView();
                                } 
                                if ( $this.hasClass('slider') ) { 
                                    HARU.woocommerce.haru_product_ajax_category_slider( element, atts.show_nav, atts.auto_play, atts.columns, atts.slide_duration );
                                    HARU.woocommerce.quickView();
                                }
                            }
                            element.find('.products-content').removeClass('loading');
                        }
                    });
                });
            });

            // Click first tab when page load
            $('.haru-woo-shortcodes-products-ajax-category.grid').each(function() {
                $(this).find('.products-tabs .tab-item:first').trigger('click');
            });

            $('.haru-woo-shortcodes-products-ajax-category.slider').each(function() {
                $(this).find('.products-tabs .tab-item:first').trigger('click');
            });
        },
        haru_product_ajax_category_isotope: function(element) {
            if ( element.find('.products-content.grid li.type-product').length > 0 ) {
                setTimeout(function(){
                    element.find('.products-content.grid .products').isotope({
                        itemSelector : 'li.type-product',
                        layoutMode: 'fitRows'
                    });
                }, 100);
            }
        },
        haru_product_ajax_category_slider: function( element, show_nav, auto_play, columns, slide_duration ) {
            if( element.find('.products-content li.type-product').length > 0 ) {
                show_nav       = (show_nav == 1) ? true : false;
                auto_play      = (auto_play == 1) ? true : false;
                columns        = parseInt(columns);
                slide_duration = parseInt(slide_duration);
                var _slider_data = { 
                    items : columns,
                    margin: 20,
                    loop: true,
                    center: false,
                    mouseDrag: true,
                    touchDrag: true,
                    pullDrag: true,
                    freeDrag: false,
                    stagePadding: 0,
                    merge: false,
                    mergeFit: true,
                    autoWidth: false,

                    startPosition: 0,
                    URLhashListener: false,
                    nav: show_nav,
                    navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                    rewind: true,
                    navElement: 'div',

                    slideBy: 1,
                    dots: true,
                    dotsEach: false,
                    lazyLoad: false,
                    lazyContent: false,

                    autoplay: auto_play,
                    autoplayTimeout: slide_duration, // Need change to option
                    autoplayHoverPause: true,
                    smartSpeed: 250,
                    fluidSpeed: false,
                    autoplaySpeed: false,
                    navSpeed: false,
                    dotsSpeed: false,
                    dragEndSpeed: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        500: {
                            items: 2
                        },
                        991: {
                            items: columns
                        },
                        1200: {
                            items: columns
                        },
                        1300: {
                            items: columns
                        }
                    },
                    responsiveRefreshRate: 200,
                    responsiveBaseElement: window,
                    video: false,
                    videoHeight: false,
                    videoWidth: false,
                    animateOut: false,
                    animateIn: false,
                    fallbackEasing: 'swing',

                    info: false,

                    nestedItemSelector: false,
                    itemElement: 'div',
                    stageElement: 'div',

                    navContainer: false,
                    dotsContainer: false
                };
                
                element.find('.products-content.slider .products').owlCarousel( _slider_data );
            }
        },
        haru_product_ajax_category_view_more: function(element, atts) {
            var hide_see_more = element.find('.products .hide-see-more').length;
            element.find('.products .hide-see-more').remove();
            
            if ( element.find('.tab-item.current').hasClass('general-tab') && atts.hide_see_more_general_tab == 1 ) {
                hide_see_more = true;
            }
            
            if ( element.find('.products .product').length == 0 ) {
                hide_see_more = true;
            }
            
            if ( atts.show_see_more_button == 1 ) {
                if ( hide_see_more ) {
                    element.find('.see-more-wrapper').addClass('hidden');
                    element.removeClass('has-see-more-button');
                }
                else {
                    element.find('.see-more-wrapper').removeClass('hidden');
                    element.addClass('has-see-more-button');
                }
            }
        },
        productCountdown: function(element, atts) {
            $('.countdown-time').each(function(){
                var days_text = $(this).attr('data-days-text');
                var hours_text = $(this).attr('data-hours-text');
                var minutes_text = $(this).attr('data-minutes-text');
                var seconds_text = $(this).attr('data-seconds-text');
                var sale_from = $(this).attr('data-sale-from');
                var sale_to = $(this).attr('data-sale-to');

                $(this).countdown(sale_to, function(event) {
                    $(this).html(
                        event.strftime(
                            '<ul class="list-time">' +
                                '<li class="cd-days"><p class="countdown-number">%D</p> <p class="countdown-text">' + days_text + '</p></li>' +
                                '<li class="cd-hours"><p class="countdown-number">%H</p><p class="countdown-text">' + hours_text + '</p></li>' + 
                                '<li class="cd-minutes"><p class="countdown-number">%M</p><p class="countdown-text">' + minutes_text + '</p></li>' + 
                                '<li  class="cd-seconds"> <p class="countdown-number">%S</p><p class="countdown-text">' + seconds_text + '</p></li>' +
                            '</ul>'
                        )
                    );
                });
            });
        },
    }

    // Document ready
    HARU.onReady = {
        init: function () {
            HARU.base.init();
            HARU.header.init();
            HARU.page.init();
            HARU.blog.init();
            HARU.woocommerce.init();
        }
    };

    // Window resize
    HARU.onResize = {
    	init: function() {
            HARU.header.windowResized();
    	}
    }

    // Window onLoad
    HARU.onLoad = {
    	init: function() {
            HARU.header.windowLoad();
    		HARU.page.windowLoad();
    	}
    }

    // Window onScroll
    HARU.onScroll = {
    	init: function() {
    		
    	}
    }
    $(window).resize(HARU.onResize.init);
    $(window).scroll(HARU.onScroll.init);
    $(document).ready(HARU.onReady.init);
    $(window).load(HARU.onLoad.init); 

})(jQuery);