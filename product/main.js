jQuery(document).ready(function () {
    cart_container();
    cart_count();
    mob_cat();

    
	jQuery("body").delegate("#update_cart","click",function(event){
        event.preventDefault();

        jQuery.ajax({
            url	:	"main.php",
            method	:	"POST",
            data	:	{cart_update:1},
            success	:	function(data){
                jQuery('#woocommerce-message').html(data);
                cart_count();
                cart_container();
                console.log(data);
            }
        })

        
    })

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

    jQuery("body").delegate("#remove_item","click",function(event){
        event.preventDefault();
        var pid = jQuery(this).attr("remove_id");
        jQuery.ajax({
            url	:	"main.php",
            method	:	"POST",
            data	:	{removeFromCart:1,removeId:pid},
            success	:	function(data){
                cart_count();
                cart_container();
                console.log(data);
            }
        })
    })

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

    jQuery("body").delegate("#closer","click",function(event){
        event.preventDefault();
        jQuery("#woocommerce-message").html("");
      
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


})