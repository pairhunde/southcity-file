jQuery(document).ready(function() {

    cat();
    mob_cat()
    main_products();
    cart_container();
    cart_count();
    
    
    bottomleft();
    bottomright();

    function cat() {
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { category: 1 },
            success: function(data) {
                jQuery("#filter-center").html(data);
            }
        })
    }
    
    function bottomleft() {
        console.log("bottom");
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { bottomleft: 1 },
            success: function(data) {
                jQuery("#bottomleft").html(data);
            }
        })
    }

    function bottomright(){
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { bottomright: 1 },
            success: function(data) {
                jQuery("#bottomright").html(data);
            }
        })
    }



    topbanner1();
    function topbanner1(){
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { topbanner1: 1 },
            success: function(data) {
                jQuery(".tp-bgimg").attr("style",data);
                console.log(data);
            }
        })
    }


    topbanner2();
    function topbanner2(){
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { topbanner2: 1 },
            success: function(data) {
                jQuery(".rev-slidebg").attr("style",data);
                console.log(data);
            }
        })
    }

    
    
        jQuery(".toggle-icon-wrap").click(function(event){
        event.preventDefault();
        jQuery(this).toggleClass('in');
        jQuery("#haru-nav-mobile-menu").toggleClass('in');
        
      
    })
    
    jQuery(".mobile-menu-close").click(function(event){
        event.preventDefault();
        jQuery("#haru-nav-mobile-menu").removeClass('in');
        
      
    })

    function mob_cat() {
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { mob_category: 1 },
            success: function(data) {
                jQuery("#menu-mobile-menu").html(data);
            }
        })
    }

    function main_products() {

        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { m_products: 1 },
            success: function(data) {
                jQuery("#products_main").html(data);


            }
        })
    }

    jQuery("body").delegate("#category", "click", function(event) {
        event.preventDefault();
        jQuery("#products_main").html("<h3>Loading...</h3>");
        var cid = jQuery(this).attr('cid');
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { m_products: 1, cat_id: cid },
            success: function(data) {
                jQuery("#products_main").html(data);
            }
        })
    });

    jQuery("body").delegate("#product_linker", "click", function(event) {
        event.preventDefault();
        var cid = jQuery(this).attr('cid');
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { product_linker: 1, c_id: cid },
            success: function(data) {
                window.location.href = "shop/shop.php";
            }
        })
    });


    jQuery("body").delegate(".submitter", "click", function (event) {
        event.preventDefault();
        var keyword = jQuery(".searcher").val();


        console.log(keyword);

        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { keyword: keyword, searcher: 1 },
            success: function(r) {
                jQuery(".wpb_revslider_element").remove();
                jQuery(".delivery_box").remove();
                jQuery(".product-filters").remove();
                jQuery(".borderfiller").remove();
                jQuery("#products_main").html(r);
                //jQuery("#products_main").html(data);

            }
        })

    });


    jQuery("body").delegate("#product_link", "click", function(event) {
        event.preventDefault();
        var pid = jQuery(this).attr('pid');
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { product_link: 1, p_id: pid },
            success: function(data) {
                window.location.href = "product/index.php";
            }
        })
    });


    jQuery("body").delegate("#atc", "click", function(event) {
        event.preventDefault();
        var pid = jQuery(this).attr('pid');
        console.log(pid);
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { cart_update: 1, p_id: pid },
            success: function(data) {
                cart_container();
                cart_count();
                alert(data);
            }
        })


    })



    function cart_container() {
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { get_cart_product: 1 },
            success: function(data) {
                jQuery("#cart_view").html(data);
                jQuery("#cart_list").html(data);
                cart_count();
                console.log(data);
            }
        })

    }

    jQuery("body").delegate("#remove_item", "click", function(event) {
        event.preventDefault();
        var pid = jQuery(this).attr("remove_id");
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { removeFromCart: 1, removeId: pid },
            success: function(data) {
                cart_container();
                cart_count();
            }
        })
    })

    function cart_count() {
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { cart_counter: 1 },
            dataType: "json",
            success: function(data) {
                jQuery("#cart_total_main").html(data.on);
                jQuery("#cart_total").html(data.on);
            }
        })
    }







})