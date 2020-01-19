jQuery(document).ready(function() {

    mob_cat();
    main_products();
    cart_count();
    cart_container();
    

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

    function cart_container(){
        jQuery.ajax({
            url	:	"main.php",
            method	:	"POST",
            data	:	{get_cart_product:1},
            success	:	function(data){
                jQuery("#cart_view").html(data);
                jQuery("#cart_list").html(data);
                console.log(data);
            }
        })
        
    }


    function cart_count(){
        jQuery.ajax({
            url	:	"main.php",
            method	:	"POST",
            data	:	{cart_counter:1},
            dataType: "json",
            success	:	function(data){
                jQuery("#cart_total_main").html(data.on);
                jQuery("#cart_total").html(data.on);

            console.log(data);
            }
        })
    }
    
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



    jQuery("body").delegate("#product_link", "click", function(event) {
        event.preventDefault();
        var cid = jQuery(this).attr('cid');
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { product_link: 1, c_id: cid },
            success: function(data) {
                window.location.href = "../shop/shop.php";
            }
        })
    });

    jQuery("body").delegate("#product_linker", "click", function(event) {
        event.preventDefault();
        var pid = jQuery(this).attr('pid');
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { product_linker: 1, p_id: pid },
            success: function(data) {
                window.location.href = "../product/index.php";
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
                console.log(data);
            }
        })
    })
})