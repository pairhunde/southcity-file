<?php
  session_start();
  include "../db.php";

  if(isset($_SESSION["p_id"])){
    $id = $_SESSION["p_id"];
    $sql_counter = "SELECT * FROM products WHERE product_id = '$id'";
	$run_query = mysqli_query($con,$sql_counter) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
        $_SESSION["product_cat"] = $row["product_cat"];
		$_SESSION["product_title"] = $row["product_title"];
        $_SESSION["product_image"] = $row["product_image"];
        $_SESSION["product_desc"] = $row["product_desc"];
        $_SESSION["product_price"] = $row["product_price"];
      }
    }

    if(!isset($_SESSION["guest_uid"])){
        $_SESSION['num'] = 0;
    }
  }


?>

<!DOCTYPE html>
<!-- Open HTML -->
<html lang="en-US">
    <!-- Open Head -->
    
<!-- Mirrored from demo.harutheme.com/clarivo/product/multivitamin-fresh-liquid/ by HTTrack Website Copier/3.x [XR&CO'2017], Tue, 28 May 2019 08:19:12 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="../../../../external.html?link=http://gmpg.org/xfn/11">
                                            <link rel="shortcut icon" href="../../wp-content/themes/clarivo/framework/admin-assets/images/theme-options/favicon.ico" />
                            				<script type="text/javascript">document.documentElement.className = document.documentElement.className + ' yes-js js_active js'</script>
			<title></title>
			<style>
				.wishlist_table .add_to_cart, a.add_to_wishlist.button.alt { border-radius: 16px; -moz-border-radius: 16px; -webkit-border-radius: 16px; }			</style>
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/11\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/11\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/demo.harutheme.com\/clarivo\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.9.10"}};
			!function(a,b,c){function d(a,b){var c=String.fromCharCode;l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,a),0,0);var d=k.toDataURL();l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,b),0,0);var e=k.toDataURL();return d===e}function e(a){var b;if(!l||!l.fillText)return!1;switch(l.textBaseline="top",l.font="600 32px Arial",a){case"flag":return!(b=d([55356,56826,55356,56819],[55356,56826,8203,55356,56819]))&&(b=d([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]),!b);case"emoji":return b=d([55358,56760,9792,65039],[55358,56760,8203,9792,65039]),!b}return!1}function f(a){var c=b.createElement("script");c.src=a,c.defer=c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var g,h,i,j,k=b.createElement("canvas"),l=k.getContext&&k.getContext("2d");for(j=Array("flag","emoji"),c.supports={everything:!0,everythingExceptFlag:!0},i=0;i<j.length;i++)c.supports[j[i]]=e(j[i]),c.supports.everything=c.supports.everything&&c.supports[j[i]],"flag"!==j[i]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[j[i]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(h=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",h,!1),a.addEventListener("load",h,!1)):(a.attachEvent("onload",h),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),g=c.source||{},g.concatemoji?f(g.concatemoji):g.wpemoji&&g.twemoji&&(f(g.twemoji),f(g.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
<link rel='stylesheet' id='contact-form-7-css'  href='../wp-content/plugins/contact-form-7/includes/css/styles972f.css' type='text/css' media='all' />
<link rel='stylesheet' id='rs-plugin-settings-css'  href='../wp-content/plugins/revslider/public/assets/css/settingsdd22.css' type='text/css' media='all' />
<style id='rs-plugin-settings-inline-css' type='text/css'>
#rs-demo-id {}
</style>
<link rel='stylesheet' id='photoswipe-css'  href='../wp-content/plugins/woocommerce/assets/css/photoswipe/photoswipe46df.css' type='text/css' media='all' />
<link rel='stylesheet' id='photoswipe-default-skin-css'  href='../wp-content/plugins/woocommerce/assets/css/photoswipe/default-skin/default-skin46df.css' type='text/css' media='all' />
<link rel='stylesheet' id='woocommerce-layout-css'  href='../wp-content/plugins/woocommerce/assets/css/woocommerce-layout46df.css' type='text/css' media='all' />
<link rel='stylesheet' id='woocommerce-smallscreen-css'  href='../wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen46df.css' type='text/css' media='only screen and (max-width: 768px)' />
<link rel='stylesheet' id='woocommerce-general-css'  href='../wp-content/plugins/woocommerce/assets/css/woocommerce46df.css' type='text/css' media='all' />
<link rel='stylesheet' id='jquery-colorbox-css'  href='../wp-content/plugins/yith-woocommerce-compare/assets/css/colorbox8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='yith-woocompare-widget-css'  href='../wp-content/plugins/yith-woocommerce-compare/assets/css/widget8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='woocommerce_prettyPhoto_css-css'  href='../wp-content/plugins/woocommerce/assets/css/prettyPhoto46df.css' type='text/css' media='all' />
<link rel='stylesheet' id='jquery-selectBox-css'  href='../wp-content/plugins/yith-woocommerce-wishlist/assets/css/jquery.selectBox7359.css' type='text/css' media='all' />
<link rel='stylesheet' id='yith-wcwl-main-css'  href='../wp-content/plugins/yith-woocommerce-wishlist/assets/css/style77e6.css' type='text/css' media='all' />
<link rel='stylesheet' id='yith-wcwl-font-awesome-css'  href='../wp-content/plugins/yith-woocommerce-wishlist/assets/css/font-awesome.min1849.css' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-css'  href='../wp-content/themes/clarivo/assets/libraries/bootstrap/css/bootstrap.min8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='font-awesome-css'  href='../wp-content/plugins/js_composer/assets/lib/bower/font-awesome/css/font-awesome.min8b06.css' type='text/css' media='all' />
<style id='font-awesome-inline-css' type='text/css'>
[data-font="FontAwesome"]:before {font-family: 'FontAwesome' !important;content: attr(data-icon) !important;speak: none !important;font-weight: normal !important;font-variant: normal !important;text-transform: none !important;line-height: 1 !important;font-style: normal !important;-webkit-font-smoothing: antialiased !important;-moz-osx-font-smoothing: grayscale !important;}
</style>
<link rel='stylesheet' id='font-awesome-animation-css'  href='../wp-content/themes/clarivo/assets/libraries/fonts-awesome/css/font-awesome-animation.min8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='icofont-css'  href='../wp-content/themes/clarivo/assets/libraries/icofont/css/icofont8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='ionicons-css'  href='../wp-content/themes/clarivo/assets/libraries/ionicons/css/ionicons.min8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='jplayer-css'  href='../wp-content/themes/clarivo/assets/libraries/jPlayer/skin/haru/skin8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='owl-carousel-css'  href='../wp-content/themes/clarivo/assets/libraries/owl-carousel/assets/owl.carousel.min8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='prettyPhoto-css'  href='../wp-content/themes/clarivo/assets/libraries/prettyPhoto/css/prettyPhoto8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='magnific-popup-css'  href='../wp-content/themes/clarivo/assets/libraries/magnificPopup/magnific-popup8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='megamenu-animate-css'  href='../wp-content/themes/clarivo/framework/core/megamenu/assets/css/animate8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='haru-vc-customize-css'  href='../wp-content/themes/clarivo/assets/css/vc-customize8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='haru-theme-style-css'  href='../wp-content/themes/clarivo/style8e83.css' type='text/css' media='all' />
<link rel='stylesheet' id='redux-google-fonts-haru_clarivo_options-css'  href='../../../../external.html?link=http://fonts.googleapis.com/css?family=Lato%3A100%2C300%2C400%2C700%2C900%2C100italic%2C300italic%2C400italic%2C700italic%2C900italic%7CNunito+Sans%3A200%2C300%2C400%2C600%2C700%2C800%2C900%2C200italic%2C300italic%2C400italic%2C600italic%2C700italic%2C800italic%2C900italic&amp;ver=1523703253' type='text/css' media='all' />
<script type="text/template" id="tmpl-variation-template">
	<div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>

	<div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>

	<div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
	<p>Sorry, this product is unavailable. Please choose a different combination.</p>
</script>
<script type='text/javascript' src='../wp-includes/js/jquery/jqueryb8ff.js'></script>
<script type='text/javascript' src='../wp-includes/js/jquery/jquery-migrate.min330a.js'></script>
<script type='text/javascript' src='../wp-content/plugins/revslider/public/assets/js/jquery.themepunch.tools.mindd22.js'></script>
<script type='text/javascript' src='../wp-content/plugins/revslider/public/assets/js/jquery.themepunch.revolution.mindd22.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var wc_add_to_cart_params = {"ajax_url":"\/clarivo\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/clarivo\/?wc-ajax=%%endpoint%%","i18n_view_cart":"View cart","cart_url":"http:\/\/demo.harutheme.com\/clarivo\/cart\/","is_cart":"","cart_redirect_after_add":"no"};
/* ]]> */
</script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min46df.js'></script>
<script type='text/javascript' src='../wp-content/plugins/js_composer/assets/js/vendors/woocommerce-add-to-cart8b06.js'></script>
<link rel='https://api.w.org/' href='../wp-json/index.html' />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="../xmlrpc0db0.php" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="../wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 4.9.10" />
<meta name="generator" content="WooCommerce 3.3.5" />
<link rel="canonical" href="index.html" />
<link rel='shortlink' href='../index45c8.html' />
<link rel="alternate" type="application/json+oembed"/>
<link rel="alternate" type="text/xml+oembed" />
<style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1505441751475{padding-top: 3% !important;padding-bottom: 5% !important;background-color: #363636 !important;}.vc_custom_1505381369490{background-color: #333333 !important;}.vc_custom_1521368236575{margin-top: 15px !important;margin-bottom: 20px !important;}.vc_custom_1521368264792{margin-bottom: 15px !important;}.vc_custom_1521368227837{margin-top: 15px !important;margin-bottom: 20px !important;}.vc_custom_1521368257769{margin-bottom: 15px !important;}.vc_custom_1521368246120{margin-top: 15px !important;margin-bottom: 20px !important;}.vc_custom_1521368257769{margin-bottom: 15px !important;}.vc_custom_1521373587572{margin-bottom: 20px !important;}.vc_custom_1505443136902{padding-top: 25px !important;}.vc_custom_1521373663006{margin-bottom: 25px !important;}.vc_custom_1521373893755{margin-bottom: 0px !important;}</style>	<noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
	<meta name="generator" content="Powered by WPBakery Page Builder - drag and drop page builder for WordPress."/>
<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="http://demo.harutheme.com/clarivo/wp-content/plugins/js_composer/assets/css/vc_lte_ie9.min.css" media="screen"><![endif]--><meta name="generator" content="Powered by Slider Revolution 5.4.7.2 - responsive, Mobile-Friendly Slider Plugin for WordPress with comfortable drag and drop interface." />
<script type="text/javascript">function setREVStartSize(e){									
						try{ e.c=jQuery(e.c);var i=jQuery(window).width(),t=9999,r=0,n=0,l=0,f=0,s=0,h=0;
							if(e.responsiveLevels&&(jQuery.each(e.responsiveLevels,function(e,f){f>i&&(t=r=f,l=e),i>f&&f>r&&(r=f,n=e)}),t>r&&(l=n)),f=e.gridheight[l]||e.gridheight[0]||e.gridheight,s=e.gridwidth[l]||e.gridwidth[0]||e.gridwidth,h=i/s,h=h>1?1:h,f=Math.round(h*f),"fullscreen"==e.sliderLayout){var u=(e.c.width(),jQuery(window).height());if(void 0!=e.fullScreenOffsetContainer){var c=e.fullScreenOffsetContainer.split(",");if (c) jQuery.each(c,function(e,i){u=jQuery(i).length>0?u-jQuery(i).outerHeight(!0):u}),e.fullScreenOffset.split("%").length>1&&void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0?u-=jQuery(window).height()*parseInt(e.fullScreenOffset,0)/100:void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0&&(u-=parseInt(e.fullScreenOffset,0))}f=u}else void 0!=e.minHeight&&f<e.minHeight&&(f=e.minHeight);e.c.closest(".rev_slider_wrapper").css({height:f})					
						}catch(d){console.log("Failure at Presize of Slider:"+d)}						
					};</script>
<style type="text/css" title="dynamic-css" class="options-output">body{background-repeat:no-repeat;background-size:cover;background-attachment:fixed;background-position:center center;}body{font-family:Lato;font-weight:400;font-style:normal;font-size:14px;}h1{font-family:Lato;font-weight:700;font-style:normal;font-size:36px;}h2{font-family:Lato;font-weight:700;font-style:normal;font-size:28px;}h3{font-family:Lato;font-weight:700;font-style:normal;font-size:24px;}h4{font-family:Lato;font-weight:400;font-style:normal;font-size:21px;}h5{font-family:Lato;font-weight:400;font-style:normal;font-size:18px;}h6{font-family:Lato;font-weight:400;font-style:normal;font-size:14px;}.navbar .navbar-nav a{font-family:Lato;font-weight:400;font-size:14px;}.page-title-inner h1{font-family:Lato;font-weight:700;font-style:normal;font-size:36px;}.page-title-inner .page-sub-title{font-family:"Nunito Sans";font-weight:400;font-style:italic;font-size:14px;}</style><noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>    </head>
    <!-- Close Head -->
    <body class="product-template-default single single-product postid-279 woocommerce woocommerce-page layout-wide top-header wpb-js-composer js-comp-ver-5.4.7 vc_responsive">
        <!-- Display newsletter popup -->
        <!-- Open haru main -->
        <div id="haru-main">
            <div class="haru-top-header">
    <div class="container">
        <div class="row">
                            <div class="top-sidebar top-header-left col-md-6 col-sm-12 col-xs-12">
                    <aside id="text-5" class="widget widget_text">			<div class="textwidget"><ul class="topheader-info-left">
<li><i class="icofont icofont-ui-call"></i><span class="info-label">Call us:</span>+234 0815 5479698</li>
<li><i class="icofont icofont-envelope"></i><span class="info-label">Email:</span>support@southcitypharmacy.com</li>
</ul>
</div>
		</aside>                </div>
                                        <div class="top-sidebar top-header-right col-md-6 col-sm-12 col-xs-12">
                    <aside id="text-6" class="widget widget_text">			<div class="textwidget">
                    <ul class="topheader-info-right">
<li class="book-appointment" style="background: #fa792f;"><a href="#"><i class="icofont icofont-medical-sign"></i>Book Appointment</a></li>
</ul>
</div>
		</aside>                </div>
                    </div>
    </div>
</div>    <header id="haru-mobile-header" class="haru-mobile-header header-mobile-3 header-mobile-sticky">
        <div class="haru-mobile-header-wrap menu-mobile-fly">
        <div class="container haru-mobile-header-container">
            <div class="haru-mobile-header-inner">
                <div class="toggle-icon-wrap toggle-mobile-menu" data-ref="haru-nav-mobile-menu" data-drop-type="fly">
                    <div class="toggle-icon"> <span></span></div>
                </div>
                <!-- Header mobile customize -->
                <div class="header-elements">
                                        <div class="header-elements-item search-button-wrap">
    <a href="javascript:;" class="header-search-button" data-search-type="ajax"><i class="icon ion-ios-search-strong"></i></a>
</div>                                                                <div class="header-elements-item mini-cart-wrap no-price">
    <div class="widget_shopping_cart_content">
        <div class="widget_shopping_cart_icon">
    <i class="ion-bag"></i>
    <span id="cart_total_main" class="total" style="background: #fa792f;">
    
    </span>
</div>
<div class="sub-total-text"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>68.47</span></div>
<div class="cart_list_wrap has-cart">
    <!-- Use for Mini Cart Sidebar -->
    <div class="mini-cart-sidebar-header">Mini Cart<span class="canvas-sidebar-close"></span></div>
    <div id="cart_list">
    </div>
 
    
    </div>    </div>
</div>                                    </div>
                <!-- End Header mobile customize -->
                                    <div class="header-logo-mobile">
                        <a  href="#" title="southcity &#8211;">
                            <img src="../scp.png" alt="southcity –" width="140" style="margin-bottom: 5px;" />
                        </a>
                    </div>
                            </div>
            <div id="haru-nav-mobile-menu" class="haru-mobile-header-nav menu-mobile-fly">
                <div class="mobile-menu-header">Menu<span class="mobile-menu-close"></span></div>
     <ul id="menu-mobile-menu" class="haru-nav-mobile-menu">

</ul>                                            </div>
                            <div class="haru-mobile-menu-overlay"></div>
                    </div>
    </div>
</header>    <header id="haru-header" class="haru-main-header header-1 header-sticky sticky_light">
    <div class="haru-header-nav-above-wrap">
        <div class="container">
            <div class="header-nav-above d-flex justify-content-between">
                <div class="header-left align-self-center">
                            <div class="header-elements header-elements-left">
        <ul class="header-elements-item header-social-network-wrap">
    <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
<li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
<li><a href="#" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
<li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
</ul>    </div>
                    </div>
                <div class="align-self-center">
                    
<div class="header-logo has-logo-sticky">
    <a href="../../index.html" class="logo-default" title="">
        <img src="../../wp-content/uploads/2018/03/logo.png" alt="" width="270" />
    </a>
    <a href="../../index.html" class="logo-retina" title="">
        <img src="../../wp-content/uploads/2018/03/logo.png" alt="" width="270"/>
    </a>
        <a href="../../index.html" class="logo-sticky" title="">
        <img src="../../wp-content/uploads/2018/03/logo.png" alt="" width="270" />
    </a>
    </div>                </div>
                <div class="header-right align-self-center">
                            <div class="header-elements header-elements-right">
        <div class="header-elements-item search-button-wrap">
    <a href="javascript:;" class="header-search-button" data-effect="ZoomIn"><i class="wicon icon ion-ios-search-strong"></i></a>
</div>
<div class="header-elements-item mini-cart-wrap no-price">
    <div class="widget_shopping_cart_content">
        <div class="widget_shopping_cart_icon">
    <i class="ion-bag"></i>
    <span id="cart_total" class="total" style="background: #fa792f;"></span>
</div>
<div class="sub-total-text"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>68.47</span></div>
<div class="cart_list_wrap has-cart">
    <!-- Use for Mini Cart Sidebar -->
    <div class="mini-cart-sidebar-header">Mini Cart<span class="canvas-sidebar-close"></span></div>
<!-- end product list -->
    <div id="cart_view" >
    
    </div>
    </div>    </div>
</div>    </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="haru-header-nav-wrap">
        <div class="container">
            <div class="header-navigation navbar navbar-toggleable-md" role="navigation">
                <div class="d-flex justify-content-center mx-auto">
                    <div class="header-primary-menu">
                                                    <div id="primary-menu" class="menu-wrap">
                                <ul id="main-menu" class="haru-main-menu nav-collapse navbar-nav"><li id="menu-item-1080" class="haru-menu menu_style_dropdown   menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-has-children level-0 "><a href="../index.php">Home</a><b class="menu-caret"></b>

</li>
<li id="menu-item-268" class="haru-menu haru_megamenu menu_style_tab mega-col-columns-2   menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children level-0 "><a href="#">Contact US</a><b class="menu-caret"></b>

</li>

<li id="menu-item-23" class="haru-menu menu_style_dropdown   menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children level-0 "><a href="../../blog/index.html">About Us</a><b class="menu-caret"></b>
</li>
<li id="menu-item-557" class="haru-menu menu_style_dropdown   menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children level-0 "><a href="#">Blog</a><b class="menu-caret"></b>
</li>
</ul>                            </div>
                                            </div>
                    <div class="header-elements">
                                            </div>
                </div>
            </div>
        </div>
    </div>
</header>            
    <div id="haru-search-popup" class="white-popup mfp-hide mfp-with-anim">
        <div class="haru-search-wrap" data-hint-message="Please type at least 3 character to search...">
            <form method="get" action="../../../../external.html?link=http://demo.harutheme.com/clarivo" class="search-popup-form" data-search-type="ajax">
                <input type="search" name="s" autocomplete="off" placeholder="Search for...">
                <button type="submit"><i class="icon-search ion-ios-search-strong"></i></button>
                <input type="hidden" name="post_type" value="product"> <!-- post_type[] -->
            </form>
                            <div class="ajax-search-result"></div>
                    </div>
    </div>
                <!-- Open HARU Content Main -->
            <div id="haru-content-main" class="clearfix">
            

    <div class="haru-page-title-section" style="background-image: url(../wp-content/themes/clarivo/framework/admin-assets/images/theme-options/bg-page-title.jpg)">
            <section  class="haru-page-title-wrapper page-title-wrapper-bg" >
            <div class="container">
                <div class="page-title-inner">
                    <div class="block-center-inner">
                        <h2 style="margin-bottom : 1.5em;"><?php echo $_SESSION["product_title"]; ?></h2>
                                            </div>
                </div>
            </div>
        </section>
               
        </div>
<div class="haru-single-product">

    <div class="container clearfix">

                <div class="row clearfix">
        
            
            <div class="single-product-content col-md-12 col-sm-12 col-xs-12">
                                <div class="single-product-inner">
                    
                        
	<div id="woocommerce-message" role="alert">
     
    </div>

<div id="product-279" class="post-279 product type-product status-publish has-post-thumbnail product_cat-capsule product_cat-injection product_cat-medication product_cat-syrup product_tag-capsule product_tag-paste product_tag-powder product_tag-spray product_tag-suppository product_tag-syrup product_tag-tablet clearfix first instock shipping-taxable purchasable product-type-simple">
    <div class="single-product-top">
        <div class="single-product-image-wrap">
            



<div class="single-product-image-inner">
    <div id="product-images" class="owl-carousel owl-theme owl-loaded owl-drag">
            <div class="owl-stage-outer">
                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 575px;">
                <div class="owl-item active" style="width: 570px; margin-right: 5px;">
                    <div>
                        <a href="" itemprop="image" class="woocommerce-main-image" title="" data-rel="prettyPhoto[product-gallery]" data-index="0">
        <img width="" height="" src="../<?php echo $_SESSION['product_image']?>" class="attachment-shop_single size-shop_single" alt="" sizes="(max-width: 600px) 100vw, 600px">
        </a>
        </div>
        </div>
        </div>
        </div>
        <div class="owl-nav disabled"><div class="owl-prev disabled"><i class="fa fa-angle-left"></i></div><div class="owl-next disabled"><i class="fa fa-angle-right"></i></div></div><div class="owl-dots disabled"><div class="owl-dot active"><span></span></div></div></div>
</div>        </div>
        <div class="summary entry-summary">
            <h1 class="product_title entry-title"> <?php echo $_SESSION["product_title"]; ?> 
            </h1><p class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span><?php echo $_SESSION["product_price"]; ?></span></p>
<div class="woocommerce-product-details__short-description">
    <h3 style="color:#fa792f;">DESCRIPTION</h3>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
</div>

	

		<div class="quantity" style="display: inline-block;">
		<label class="screen-reader-text" for="quantity">Quantity</label>
		<input type="number" id="quantity" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric" aria-labelledby="" />
	</div>
	
		<button id="update_cart" class="cart single_add_to_cart_button button alt" style="background:#fa792f; padding: 13.5px;">Add to cart</button>
 
	

	

<div class="yith-wcwl-add-to-wishlist add-to-wishlist-279">
            <div class="yith-wcwl-add-button show" style="display:block">

<img src="../../wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
        </div>

        <div style="clear:both"></div>
        <div class="yith-wcwl-wishlistaddresponse"></div>
    
</div><div class="product_meta">

    
    
    <span class="posted_in"><span class="label">Categories:</span> <a href="../../product-category/capsule/index.html" rel="tag">Capsule</a>, <a href="../../product-category/injection/index.html" rel="tag">Injection</a>, <a href="../../product-category/medication/index.html" rel="tag">Medication</a>, <a href="../../product-category/syrup/index.html" rel="tag">Syrup</a></span>
    
</div>

<div class="post-social-share">
            <div class="social-share-wrapper">
            
            <ul class="social-share">
                <li class="social-label">
                    Share:                 </li>
                                    <li>
                        <a onclick="window.open('','sharer', 'toolbar=0,status=0,width=620,height=280');"  href="javascript:;">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                
                                    <li>
                        <a onclick="popUp=window.open('','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;"  href="javascript:;">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                
                                    <li>
                        <a onclick="popUp=window.open('','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                            <i class="fa fa-pinterest"></i>
                        </a>
                    </li>
                            </ul>
        </div>
    </div>

        </div><!-- .summary -->
    </div>
    
    


    <section class="related products">

        <h2>Related Products</h2>

        <ul class="haru-carousel related-products owl-carousel owl-theme"
            data-items="4"
            data-items-tablet="3"
            data-items-mobile="2"
            data-margin="30"
            data-autoplay="false"
            data-slide-duration="6000"
        >
            
                <li class="post-277 product type-product status-publish has-post-thumbnail product_cat-capsule product_cat-injection product_cat-medication product_cat-syrup product_tag-capsule product_tag-paste product_tag-powder product_tag-spray product_tag-suppository product_tag-syrup product_tag-tablet clearfix last instock shipping-taxable purchasable product-type-simple">
    <div class="product-inner">
                <div class="product-thumbnail">
            <a href="../tongue-sore-capsule/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><div class="product-label">



</div>                            <div class="product-thumb-primary">
                    <img width="270" height="270" src="../../wp-content/uploads/2017/10/product11-270x270.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" srcset="//demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product11-270x270.jpg 270w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product11-100x100.jpg 100w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product11-150x150.jpg 150w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product11-300x300.jpg 300w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product11-540x540.jpg 540w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product11.jpg 600w" sizes="(max-width: 270px) 100vw, 270px" />                </div>
                    </a>            <div class="product-actions">
                
<div class="yith-wcwl-add-to-wishlist add-to-wishlist-277">
            <div class="yith-wcwl-add-button show" style="display:block">

            
<a href="index9ce5.html" rel="nofollow" data-product-id="277" data-product-type="simple" class="add_to_wishlist" ><i class="icofont icofont-heart"></i><span class="haru-tooltip button-tooltip">Wishlist</span>
</a>
<img src="../../wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
        </div>

        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
            <span class="feedback">Product added!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>  
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
            <span class="feedback">The product is already in the wishlist!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div style="clear:both"></div>
        <div class="yith-wcwl-wishlistaddresponse"></div>
    
</div>   	<div class="button-in compare add_to_compare"><a class="compare" href="../../../../external.html?link=http://demo.harutheme.com/clarivo?action=yith-woocompare-add-product&amp;id=277" data-product_id="277"><i class="icofont icofont-signal"></i><span class="haru-tooltip button-tooltip">Compare</span></a></div><div class="add-to-cart-wrapper"><a rel="nofollow" href="indexc486.html" data-quantity="1" data-product_id="277" data-product_sku="" class="add_to_cart_button product_type_simple button product_type_simple add_to_cart_button ajax_add_to_cart"><i class="icofont icofont-shopping-cart"></i><span class="haru-tooltip button-tooltip">Add to cart</span></a></div><div class="button-in quickview"><a class="quickview" href="../../wp-admin/admin-ajax6df5.html"><i class="icofont icofont-search"></i><span class="haru-tooltip button-tooltip">Quick view</span></a></div>            </div>
        </div>
        
        <div class="product-info">
            <a href="../tongue-sore-capsule/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><h2 class="woocommerce-loop-product__title">Tongue sore capsule</h2></a>
	<span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>17.42</span></span>
        </div>
            </div>
</li>

            
                <li class="post-80 product type-product status-publish has-post-thumbnail product_cat-capsule product_cat-spray product_cat-vitamin product_tag-inhaler product_tag-paste product_tag-spray product_tag-suppository product_tag-tablet clearfix first instock shipping-taxable purchasable product-type-simple">
    <div class="product-inner">
                <div class="product-thumbnail">
            <a href="../sore-capsule/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><div class="product-label">



</div>                            <div class="product-thumb-primary">
                    <img width="270" height="270" src="../../wp-content/uploads/2017/09/product15-270x270.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" srcset="//demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product15-270x270.jpg 270w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product15-100x100.jpg 100w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product15-150x150.jpg 150w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product15-300x300.jpg 300w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product15-540x540.jpg 540w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product15.jpg 600w" sizes="(max-width: 270px) 100vw, 270px" />                </div>
                    </a>            <div class="product-actions">
                
<div class="yith-wcwl-add-to-wishlist add-to-wishlist-80">
            <div class="yith-wcwl-add-button show" style="display:block">

            
<a href="indexb673.html" rel="nofollow" data-product-id="80" data-product-type="simple" class="add_to_wishlist" ><i class="icofont icofont-heart"></i><span class="haru-tooltip button-tooltip">Wishlist</span>
</a>
<img src="../../wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
        </div>

        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
            <span class="feedback">Product added!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>  
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
            <span class="feedback">The product is already in the wishlist!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div style="clear:both"></div>
        <div class="yith-wcwl-wishlistaddresponse"></div>
    
</div>   	<div class="button-in compare add_to_compare"><a class="compare" href="../../../../external.html?link=http://demo.harutheme.com/clarivo?action=yith-woocompare-add-product&amp;id=80" data-product_id="80"><i class="icofont icofont-signal"></i><span class="haru-tooltip button-tooltip">Compare</span></a></div><div class="add-to-cart-wrapper"><a rel="nofollow" href="index15fb.html" data-quantity="1" data-product_id="80" data-product_sku="" class="add_to_cart_button product_type_simple button product_type_simple add_to_cart_button ajax_add_to_cart"><i class="icofont icofont-shopping-cart"></i><span class="haru-tooltip button-tooltip">Add to cart</span></a></div><div class="button-in quickview"><a class="quickview" href="../../wp-admin/admin-ajax3930.html"><i class="icofont icofont-search"></i><span class="haru-tooltip button-tooltip">Quick view</span></a></div>            </div>
        </div>
        
        <div class="product-info">
            <a href="../sore-capsule/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><h2 class="woocommerce-loop-product__title">Sore Capsule</h2></a><div class="star-rating"><span style="width:80%">Rated <strong class="rating">4.00</strong> out of 5</span></div>
	<span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>13.35</span></span>
        </div>
            </div>
</li>

            
                <li class="post-82 product type-product status-publish has-post-thumbnail product_cat-capsule product_cat-ointment product_cat-syrup product_tag-capsule product_tag-paste product_tag-solution product_tag-suppository product_tag-syrup product_tag-tablet clearfix last instock shipping-taxable purchasable product-type-simple">
    <div class="product-inner">
                <div class="product-thumbnail">
            <a href="../brain-medication/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><div class="product-label">



</div>                            <div class="product-thumb-primary">
                    <img width="270" height="270" src="../../wp-content/uploads/2017/09/product12-270x270.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" srcset="//demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product12-270x270.jpg 270w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product12-100x100.jpg 100w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product12-150x150.jpg 150w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product12-300x300.jpg 300w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product12-540x540.jpg 540w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product12.jpg 600w" sizes="(max-width: 270px) 100vw, 270px" />                </div>
                    </a>            <div class="product-actions">
                
<div class="yith-wcwl-add-to-wishlist add-to-wishlist-82">
            <div class="yith-wcwl-add-button show" style="display:block">

            
<a href="index3b6f.html" rel="nofollow" data-product-id="82" data-product-type="simple" class="add_to_wishlist" ><i class="icofont icofont-heart"></i><span class="haru-tooltip button-tooltip">Wishlist</span>
</a>
<img src="../../wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
        </div>

        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
            <span class="feedback">Product added!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>  
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
            <span class="feedback">The product is already in the wishlist!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div style="clear:both"></div>
        <div class="yith-wcwl-wishlistaddresponse"></div>
    
</div>   	<div class="button-in compare add_to_compare"><a class="compare" href="../../../../external.html?link=http://demo.harutheme.com/clarivo?action=yith-woocompare-add-product&amp;id=82" data-product_id="82"><i class="icofont icofont-signal"></i><span class="haru-tooltip button-tooltip">Compare</span></a></div><div class="add-to-cart-wrapper"><a rel="nofollow" href="indexe038.html" data-quantity="1" data-product_id="82" data-product_sku="" class="add_to_cart_button product_type_simple button product_type_simple add_to_cart_button ajax_add_to_cart"><i class="icofont icofont-shopping-cart"></i><span class="haru-tooltip button-tooltip">Add to cart</span></a></div><div class="button-in quickview"><a class="quickview" href="../../wp-admin/admin-ajaxa019.html"><i class="icofont icofont-search"></i><span class="haru-tooltip button-tooltip">Quick view</span></a></div>            </div>
        </div>
        
        <div class="product-info">
            <a href="../brain-medication/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><h2 class="woocommerce-loop-product__title">Brain Medication</h2></a><div class="star-rating"><span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5</span></div>
	<span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>13.68</span></span>
        </div>
            </div>
</li>

            
                <li class="post-278 product type-product status-publish has-post-thumbnail product_cat-capsule product_cat-injection product_cat-medication product_cat-syrup product_tag-capsule product_tag-paste product_tag-powder product_tag-spray product_tag-suppository product_tag-syrup product_tag-tablet clearfix first instock shipping-taxable purchasable product-type-simple">
    <div class="product-inner">
                <div class="product-thumbnail">
            <a href="../paraxetal-150ml-liquid/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><div class="product-label">



</div>                            <div class="product-thumb-primary">
                    <img width="270" height="270" src="../../wp-content/uploads/2017/10/product1-270x270.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" srcset="//demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product1-270x270.jpg 270w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product1-100x100.jpg 100w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product1-150x150.jpg 150w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product1-300x300.jpg 300w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product1-540x540.jpg 540w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/10/product1.jpg 600w" sizes="(max-width: 270px) 100vw, 270px" />                </div>
                    </a>            <div class="product-actions">
                
<div class="yith-wcwl-add-to-wishlist add-to-wishlist-278">
            <div class="yith-wcwl-add-button show" style="display:block">

            
<a href="index04dd.html" rel="nofollow" data-product-id="278" data-product-type="simple" class="add_to_wishlist" ><i class="icofont icofont-heart"></i><span class="haru-tooltip button-tooltip">Wishlist</span>
</a>
<img src="../../wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
        </div>

        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
            <span class="feedback">Product added!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>  
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
            <span class="feedback">The product is already in the wishlist!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div style="clear:both"></div>
        <div class="yith-wcwl-wishlistaddresponse"></div>
    
</div>   	<div class="button-in compare add_to_compare"><a class="compare" href="../../../../external.html?link=http://demo.harutheme.com/clarivo?action=yith-woocompare-add-product&amp;id=278" data-product_id="278"><i class="icofont icofont-signal"></i><span class="haru-tooltip button-tooltip">Compare</span></a></div><div class="add-to-cart-wrapper"><a rel="nofollow" href="index72b4.html" data-quantity="1" data-product_id="278" data-product_sku="" class="add_to_cart_button product_type_simple button product_type_simple add_to_cart_button ajax_add_to_cart"><i class="icofont icofont-shopping-cart"></i><span class="haru-tooltip button-tooltip">Add to cart</span></a></div><div class="button-in quickview"><a class="quickview" href="../../wp-admin/admin-ajaxae0b.html"><i class="icofont icofont-search"></i><span class="haru-tooltip button-tooltip">Quick view</span></a></div>            </div>
        </div>
        
        <div class="product-info">
            <a href="../paraxetal-150ml-liquid/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><h2 class="woocommerce-loop-product__title">Paraxetal 150ml liquid</h2></a>
	<span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>17.42</span></span>
        </div>
            </div>
</li>

            
                <li class="post-69 product type-product status-publish has-post-thumbnail product_cat-tablet product_tag-powder product_tag-solution product_tag-spray product_tag-suppository product_tag-syrup product_tag-tablet clearfix last instock sale shipping-taxable purchasable product-type-variable has-default-attributes has-children">
    <div class="product-inner">
                <div class="product-thumbnail">
            <a href="../cancer-medicine/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><div class="product-label">

	<span class="onsale">Sale!</span>


    <span class="on-new product-flash">New</span>



</div>                            <div class="product-thumb-primary">
                    <img width="270" height="270" src="../../wp-content/uploads/2017/09/product16-270x270.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" srcset="//demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product16-270x270.jpg 270w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product16-100x100.jpg 100w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product16-150x150.jpg 150w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product16-300x300.jpg 300w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product16-540x540.jpg 540w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product16.jpg 600w" sizes="(max-width: 270px) 100vw, 270px" />                </div>
                    </a>            <div class="product-actions">
                
<div class="yith-wcwl-add-to-wishlist add-to-wishlist-69">
            <div class="yith-wcwl-add-button hide" style="display:none">

            
<a href="indexb0f8.html" rel="nofollow" data-product-id="69" data-product-type="variable" class="add_to_wishlist" ><i class="icofont icofont-heart"></i><span class="haru-tooltip button-tooltip">Wishlist</span>
</a>
<img src="../../wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
        </div>

        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
            <span class="feedback">Product added!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>  
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div class="yith-wcwl-wishlistexistsbrowse show" style="display:block">
            <span class="feedback">The product is already in the wishlist!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div style="clear:both"></div>
        <div class="yith-wcwl-wishlistaddresponse"></div>
    
</div>   	<div class="button-in compare add_to_compare"><a class="compare" href="../../../../external.html?link=http://demo.harutheme.com/clarivo?action=yith-woocompare-add-product&amp;id=69" data-product_id="69"><i class="icofont icofont-signal"></i><span class="haru-tooltip button-tooltip">Compare</span></a></div><div class="add-to-cart-wrapper"><a rel="nofollow" href="../cancer-medicine/index.html" data-quantity="1" data-product_id="69" data-product_sku="" class="add_to_cart_button product_type_variable button product_type_variable add_to_cart_button"><i class="icofont icofont-cart-alt"></i><span class="haru-tooltip button-tooltip">Select options</span></a></div><div class="button-in quickview"><a class="quickview" href="../../wp-admin/admin-ajaxcf56.html"><i class="icofont icofont-search"></i><span class="haru-tooltip button-tooltip">Quick view</span></a></div>            </div>
        </div>
        
        <div class="product-info">
            <a href="../cancer-medicine/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><h2 class="woocommerce-loop-product__title">Cancer Medicine</h2></a><div class="star-rating"><span style="width:90%">Rated <strong class="rating">4.50</strong> out of 5</span></div>
	<span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>12.00</span> &ndash; <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>16.00</span></span>
        </div>
            </div>
</li>

            
                <li class="post-84 product type-product status-publish has-post-thumbnail product_cat-injection product_cat-ointment product_cat-spray product_tag-capsule product_tag-medication product_tag-solution product_tag-spray product_tag-suppository product_tag-tablet clearfix first instock sale shipping-taxable purchasable product-type-variable has-default-attributes has-children">
    <div class="product-inner">
                <div class="product-thumbnail">
            <a href="../mouth-spray/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><div class="product-label">

	<span class="onsale">Sale!</span>



</div>                            <div class="product-thumb-primary">
                    <img width="270" height="270" src="../../wp-content/uploads/2017/09/product8-270x270.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="" srcset="//demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product8-270x270.jpg 270w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product8-100x100.jpg 100w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product8-150x150.jpg 150w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product8-300x300.jpg 300w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product8-540x540.jpg 540w, //demo.harutheme.com/clarivo/wp-content/uploads/2017/09/product8.jpg 600w" sizes="(max-width: 270px) 100vw, 270px" />                </div>
                    </a>            <div class="product-actions">
                
<div class="yith-wcwl-add-to-wishlist add-to-wishlist-84">
            <div class="yith-wcwl-add-button hide" style="display:none">

            
<a href="index9901.html" rel="nofollow" data-product-id="84" data-product-type="variable" class="add_to_wishlist" ><i class="icofont icofont-heart"></i><span class="haru-tooltip button-tooltip">Wishlist</span>
</a>
<img src="../../wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />
        </div>

        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
            <span class="feedback">Product added!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>  
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div class="yith-wcwl-wishlistexistsbrowse show" style="display:block">
            <span class="feedback">The product is already in the wishlist!</span>
            <a href="../../wishlist/index.html" rel="nofollow">
                <i class="icofont icofont-heart"></i>
                <span class="haru-tooltip button-tooltip">Browse</span>
            </a>
        </div>

        <div style="clear:both"></div>
        <div class="yith-wcwl-wishlistaddresponse"></div>
    
</div>   	<div class="button-in compare add_to_compare"><a class="compare" href="../../../../external.html?link=http://demo.harutheme.com/clarivo?action=yith-woocompare-add-product&amp;id=84" data-product_id="84"><i class="icofont icofont-signal"></i><span class="haru-tooltip button-tooltip">Compare</span></a></div><div class="add-to-cart-wrapper"><a rel="nofollow" href="../mouth-spray/index.html" data-quantity="1" data-product_id="84" data-product_sku="" class="add_to_cart_button product_type_variable button product_type_variable add_to_cart_button"><i class="icofont icofont-cart-alt"></i><span class="haru-tooltip button-tooltip">Select options</span></a></div><div class="button-in quickview"><a class="quickview" href="../../wp-admin/admin-ajax722a.html"><i class="icofont icofont-search"></i><span class="haru-tooltip button-tooltip">Quick view</span></a></div>            </div>
        </div>
        
        <div class="product-info">
            <a href="../mouth-spray/index.html" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><h2 class="woocommerce-loop-product__title">Mouth Spray</h2></a><div class="star-rating"><span style="width:90%">Rated <strong class="rating">4.50</strong> out of 5</span></div>
	<span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>12.00</span> &ndash; <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>13.00</span></span>
        </div>
            </div>
</li>

                    </ul>

    </section>


</div><!-- #product-279 -->


                                    </div>
                </main></div>            </div>

            
                </div>
        
    </div>

</div>
                        </div>
            <!-- Close HARU Content Main -->

                        <footer id="haru-footer-main" class="footer-default-copy-2">
                    <div class="container clearfix">
<div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1505441751475 vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="haru-col-sm-6 wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3 vc_col-xs-12"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div  class="wpb_single_image wpb_content_element vc_align_left">
		
		<figure class="wpb_wrapper vc_figure">
			<div class="vc_single_image-wrapper   vc_box_border_grey"></div>
		</figure>
	</div>
<p style="color: #999999;text-align: left" class="vc_custom_heading default">An injection puts a small amount of filler<br />
into a chosen area with the aim of helping to tempo rarily reduce the visibility </p>                        <div class="  ">
                <div class="footer-social-shortcode-wrap style_3 ">
    <div class="footer-social-content">
        <ul class="social-list align-left">
                                                    <li>
                        <a href="#" target=" _blank"><i class="fa fa-facebook"></i></a>
                    </li>
                                                                        <li>
                        <a href="#" target="_self"><i class="fa fa-twitter"></i></a>
                    </li>
                                                                        <li>
                        <a href="#" target="_self"><i class="fa fa-instagram"></i></a>
                    </li>
                                                                        <li>
                        <a href="#" target="_self"><i class="fa fa-google-plus"></i></a>
                    </li>
                                        </ul>
    </div>
</div>            </div>
                    </div></div></div><div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3 vc_col-xs-12"><div class="vc_column-inner "><div class="wpb_wrapper"><h3 style="font-size: 18px;color: #f7f7f7;text-align: left" class="vc_custom_heading vc_custom_1521368236575 default">INFOMATION</h3><div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_custom_1521368264792  vc_custom_1521368264792" ><span class="vc_sep_holder vc_sep_holder_l"><span  style="border-color:rgb(68,68,68);border-color:rgba(68,68,68,0.5);" class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span  style="border-color:rgb(68,68,68);border-color:rgba(68,68,68,0.5);" class="vc_sep_line"></span></span>
</div>                        <div class="  ">
                <div class="footer-contact-shortcode-wrap style_3 ">
    <div class="footer-contact-content">
        <ul class="contact-information">
                                <li><span class="contact-icon fa fa-map-marker"></span><span class="contact-label">PO Box 16122 Collins Street, West   Victoria 8007, Australia  </span>
                    
                    </li>
                                <li><span class="contact-icon fa fa-phone"></span><span class="contact-label">Tel. 08155479698</span>

                    
                    </li>
                                <li><span class="contact-icon fa fa-envelope-o"></span><span class="contact-label">Email. support@southcitypharmarcy.com</span>
                    
                    </li>
                    </ul>
    </div>
</div>            </div>
                    </div></div></div><div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3 vc_col-xs-12"><div class="vc_column-inner "><div class="wpb_wrapper"><h3 style="font-size: 18px;color: #f7f7f7;text-align: left" class="vc_custom_heading vc_custom_1521368227837 default">USEFUL LINKS</h3><div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_custom_1521368257769  vc_custom_1521368257769" ><span class="vc_sep_holder vc_sep_holder_l"><span  style="border-color:rgb(68,68,68);border-color:rgba(68,68,68,0.5);" class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span  style="border-color:rgb(68,68,68);border-color:rgba(68,68,68,0.5);" class="vc_sep_line"></span></span>
</div>                        <div class="  ">
                <div class="footer-link-shortcode-wrap style_3 ">
    <div class="footer-link-content">
        <ul class="link-list">
                                                    <li>
                        <a href="#" target="_self">About Store</a>
                    </li>
                                                                        <li>
                        <a href="#" target="_self">New Collection</a>
                    </li>
                                                                        <li>
                        <a href="#" target="_self">Woman Drug</a>
                    </li>
                                                                        <li>
                        <a href="#" target="_self">Contact Us</a>
                    </li>
                                                                        <li>
                        <a href="#" target="_self">Latest News</a>
                    </li>
                                        </ul>
    </div>
</div>            </div>
                    </div></div></div><div class="haru-col-sm-6 wpb_column vc_column_container vc_col-sm-6 vc_col-lg-3 vc_col-md-3 vc_col-xs-12"><div class="vc_column-inner "><div class="wpb_wrapper"><h3 style="font-size: 18px;color: #f7f7f7;text-align: left" class="vc_custom_heading vc_custom_1521368246120 default">SUBSCRIBE</h3><div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_pos_align_center vc_separator_no_text vc_custom_1521368257769  vc_custom_1521368257769" ><span class="vc_sep_holder vc_sep_holder_l"><span  style="border-color:rgb(68,68,68);border-color:rgba(68,68,68,0.5);" class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span  style="border-color:rgb(68,68,68);border-color:rgba(68,68,68,0.5);" class="vc_sep_line"></span></span>
</div><p style="color: #999999;text-align: left" class="vc_custom_heading vc_custom_1521373587572 default">Enter your email address for our mailing list to keep yourself updated.</p><div role="form" class="wpcf7" id="wpcf7-f951-o1" lang="en-US" dir="ltr">
<div class="screen-reader-response"></div>
<form action="../../../../external.html?link=http://demo.harutheme.com/clarivo/product/multivitamin-fresh-liquid/#wpcf7-f951-o1" method="post" class="wpcf7-form" novalidate="novalidate">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="951" />
<input type="hidden" name="_wpcf7_version" value="5.0.1" />
<input type="hidden" name="_wpcf7_locale" value="en_US" />
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f951-o1" />
<input type="hidden" name="_wpcf7_container_post" value="0" />
</div>
<div class="hr-subscribe2">
<span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Enter your email..." /></span><span class="submit"><input type="submit" value="Subscribe" class="wpcf7-form-control wpcf7-submit" /></span>
</div>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div></div></div></div></div></div></div></div></div><div class="vc_row-full-width vc_clearfix"></div><div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1505381369490 vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner vc_custom_1505443136902"><div class="wpb_wrapper"><div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element  vc_custom_1521373663006" >
		<div class="wpb_wrapper">
			<p class="footer-copyright" style="text-align: left;">Southcitypharmacy- 2019</p>

		</div>
	</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div  class="wpb_single_image wpb_content_element vc_align_right  vc_custom_1521373893755">
		
		<figure class="wpb_wrapper vc_figure">
			<div class="vc_single_image-wrapper   vc_box_border_grey"><img width="326" height="28" src="../../wp-content/uploads/2018/03/cards.png" class="vc_single_image-img attachment-full" alt="" srcset="http://demo.harutheme.com/clarivo/wp-content/uploads/2018/03/cards.png 326w, http://demo.harutheme.com/clarivo/wp-content/uploads/2018/03/cards-300x26.png 300w" sizes="(max-width: 326px) 100vw, 326px" /></div>
		</figure>
	</div>
</div></div></div></div></div></div></div></div><div class="vc_row-full-width vc_clearfix"></div>
    </div>
            </footer>
                    </div>
        <!-- Close haru main -->
        <a class="back-to-top" href="javascript:;">
    <i class="fa fa-angle-up"></i>
</a>    <div class="haru-ajax-overflow">
        <div class="haru-ajax-loading">
            <div class="loading-wrapper">
                <div class="spinner" id="spinner_one"></div>
                <div class="spinner" id="spinner_two"></div>
                <div class="spinner" id="spinner_three"></div>
                <div class="spinner" id="spinner_four"></div>
                <div class="spinner" id="spinner_five"></div>
                <div class="spinner" id="spinner_six"></div>
                <div class="spinner" id="spinner_seven"></div>
                <div class="spinner" id="spinner_eight"></div>
            </div>
        </div>
    </div>
        <script type="application/ld+json">{"@context":"https:\/\/schema.org\/","@type":"Product","@id":"http:\/\/demo.harutheme.com\/clarivo\/product\/multivitamin-fresh-liquid\/","name":"Multivitamin fresh liquid","image":"http:\/\/demo.harutheme.com\/clarivo\/wp-content\/uploads\/2017\/10\/product5.jpg","description":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.","sku":"","offers":[{"@type":"Offer","price":"16.45","priceCurrency":"USD","availability":"https:\/\/schema.org\/InStock","url":"http:\/\/demo.harutheme.com\/clarivo\/product\/multivitamin-fresh-liquid\/","seller":{"@type":"Organization","name":"Clarivo - Multipurpose Pharmacy and Medical WordPress theme","url":"http:\/\/demo.harutheme.com\/clarivo"}}]}</script>
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

	<!-- Background of PhotoSwipe. It's a separate element as animating opacity is faster than rgba(). -->
	<div class="pswp__bg"></div>

	<!-- Slides wrapper with overflow:hidden. -->
	<div class="pswp__scroll-wrap">

		<!-- Container that holds slides.
		PhotoSwipe keeps only 3 of them in the DOM to save memory.
		Don't modify these 3 pswp__item elements, data is added later on. -->
		<div class="pswp__container">
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
		</div>

		<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
		<div class="pswp__ui pswp__ui--hidden">

			<div class="pswp__top-bar">

				<!--  Controls are self-explanatory. Order can be changed. -->

				<div class="pswp__counter"></div>

				<button class="pswp__button pswp__button--close" aria-label="Close (Esc)"></button>

				<button class="pswp__button pswp__button--share" aria-label="Share"></button>

				<button class="pswp__button pswp__button--fs" aria-label="Toggle fullscreen"></button>

				<button class="pswp__button pswp__button--zoom" aria-label="Zoom in/out"></button>

				<!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
				<!-- element will get class pswp__preloader--active when preloader is running -->
				<div class="pswp__preloader">
					<div class="pswp__preloader__icn">
						<div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						</div>
					</div>
				</div>
			</div>

			<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
				<div class="pswp__share-tooltip"></div>
			</div>

			<button class="pswp__button pswp__button--arrow--left" aria-label="Previous (arrow left)"></button>

			<button class="pswp__button pswp__button--arrow--right" aria-label="Next (arrow right)"></button>

			<div class="pswp__caption">
				<div class="pswp__caption__center"></div>
			</div>

		</div>

	</div>

</div>
<link rel='stylesheet' id='js_composer_front-css'  href='../wp-content/plugins/js_composer/assets/css/js_composer.min8b06.css' type='text/css' media='all' />
<link rel='stylesheet' id='vc_google_fonts_abril_fatfaceregular-css'  href='../../../external.html?link=http://fonts.googleapis.com/css?family=Abril+Fatface%3Aregular&amp;ver=4.9.10' type='text/css' media='all' />
<script type='text/javascript'>
/* <![CDATA[ */
var wpcf7 = {"apiSettings":{"root":"http:\/\/demo.harutheme.com\/clarivo\/wp-json\/contact-form-7\/v1","namespace":"contact-form-7\/v1"},"recaptcha":{"messages":{"empty":"Please verify that you are not a robot."}}};
/* ]]> */
</script><script src="main.js"></script>

<script type='text/javascript' src='../wp-content/plugins/contact-form-7/includes/js/scripts972f.js'></script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/zoom/jquery.zoom.min82b5.js'></script>
<script type='text/javascript' src='../../wp-content/plugins/js_composer/assets/lib/bower/flexslider/jquery.flexslider-min8b06.js'></script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/photoswipe/photoswipe.min0235.js'></script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/photoswipe/photoswipe-ui-default.min0235.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var wc_single_product_params = {"i18n_required_rating_text":"Please select a rating","review_rating_required":"yes","flexslider":{"rtl":false,"animation":"slide","smoothHeight":true,"directionNav":false,"controlNav":"thumbnails","slideshow":false,"animationSpeed":500,"animationLoop":false,"allowOneSlide":false},"zoom_enabled":"1","zoom_options":[],"photoswipe_enabled":"1","photoswipe_options":{"shareEl":false,"closeOnScroll":false,"history":false,"hideAnimationDuration":0,"showAnimationDuration":0},"flexslider_enabled":"1"};
/* ]]> */
</script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/frontend/single-product.min46df.js'></script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min44fd.js'></script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min6b25.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var woocommerce_params = {"ajax_url":"\/clarivo\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/clarivo\/?wc-ajax=%%endpoint%%"};
/* ]]> */
</script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min46df.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var wc_cart_fragments_params = {"ajax_url":"\/clarivo\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/clarivo\/?wc-ajax=%%endpoint%%","cart_hash_key":"wc_cart_hash_7768a70e28d6ccfe78a2cd926e0f0fe4","fragment_name":"wc_fragments_7768a70e28d6ccfe78a2cd926e0f0fe4"};
/* ]]> */
</script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min46df.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var yith_woocompare = {"ajaxurl":"\/clarivo\/?wc-ajax=%%endpoint%%","actionadd":"yith-woocompare-add-product","actionremove":"yith-woocompare-remove-product","actionview":"yith-woocompare-view-table","actionreload":"yith-woocompare-reload-product","added_label":"Added","table_title":"Product Comparison","auto_open":"yes","loader":"http:\/\/demo.harutheme.com\/clarivo\/wp-content\/plugins\/yith-woocommerce-compare\/assets\/images\/loader.gif","button_text":"Compare","cookie_name":"yith_woocompare_list","close_label":"Close"};
/* ]]> */
</script>
<script type='text/javascript' src='../wp-content/plugins/yith-woocommerce-compare/assets/js/woocompare.mina1ec.js'></script>
<script type='text/javascript' src='../wp-content/plugins/yith-woocommerce-compare/assets/js/jquery.colorbox-min13ac.js'></script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.min005e.js'></script>
<script type='text/javascript' src='../wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.selectBox.min7359.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */

/* ]]> */
</script>
<script type='text/javascript' src='../wp-content/plugins/yith-woocommerce-wishlist/assets/js/jquery.yith-wcwl77e6.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/libraries/bootstrap/js/bootstrap.min8e83.js'></script>
<script type='text/javascript' src='../wp-includes/js/comment-reply.min8e83.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/libraries/jPlayer/jquery.jplayer.min8e83.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/libraries/owl-carousel/owl.carousel.min8e83.js'></script>
<script type='text/javascript' src='../wp-includes/js/imagesloaded.min55a0.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/libraries/infinitescroll/jquery.infinitescroll.min8e83.js'></script>
<script type='text/javascript' src='../wp-content/plugins/js_composer/assets/lib/bower/isotope/dist/isotope.pkgd.min8b06.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/libraries/stellar/jquery.stellar.min8e83.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/libraries/modernizr/modernizr8e83.js'></script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/jquery-cookie/jquery.cookie.min330a.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/libraries/magnificPopup/jquery.magnific-popup.min8e83.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/libraries/headroom/jQuery.headroom8e83.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/libraries/headroom/headroom.min8e83.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/framework/core/megamenu/assets/js/megamenu8e83.js'></script>
<script type='text/javascript' src='../wp-includes/js/underscore.min4511.js'></script>

<script src="../shop/View_files/haru-main.js.download"></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpUtilSettings = {"ajax":{"url":"\/clarivo\/wp-admin\/admin-ajax.php"}};
/* ]]> */
</script>
<script type='text/javascript' src='../wp-includes/js/wp-util.min8e83.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var wc_add_to_cart_variation_params = {"wc_ajax_url":"\/clarivo\/?wc-ajax=%%endpoint%%","i18n_no_matching_variations_text":"Sorry, no products matched your selection. Please choose a different combination.","i18n_make_a_selection_text":"Please select some product options before adding this product to your cart.","i18n_unavailable_text":"Sorry, this product is unavailable. Please choose a different combination."};
/* ]]> */
</script>
<script type='text/javascript' src='../wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.min46df.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var haru_framework_ajax_url = "index.html\/\/demo.harutheme.com\/clarivo\/wp-admin\/admin-ajax.php?activate-multi=true";
var searchUrl = "index.html\/\/demo.harutheme.com\/clarivo\/?s=";
var haru_framework_constant = {"product_compare":"Compare","product_viewcart":"View Cart"};
var haru_framework_theme_url = "index.html\/\/demo.harutheme.com\/clarivo\/wp-content\/themes\/clarivo";
/* ]]> */
</script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/js/haru-main8e83.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/js/haru-shop-ajax.min8e83.js'></script>
<script type='text/javascript' src='../wp-content/themes/clarivo/assets/js/clarivo8e83.js'></script>
<script type='text/javascript' src='../wp-includes/js/wp-embed.min8e83.js'></script>
<script type='text/javascript' src='../wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min8b06.js'></script>
    </body>


</html>