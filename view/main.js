jQuery( document ).ready(function() {

    viewcart_container();
    mob_cat();
    cart_count();
    
	function viewcart_container(){
			jQuery.ajax({
				url	:	"main.php",
				method	:	"POST",
				data	:	{view_cart_product:1},
				success	:	function(data){
					console.log(data);
                    
                    if(data == 0){
                        jQuery("#checkout").attr("disabled", "true");
                    }else{
                        jQuery("#view_cart_order").html(data);
                    }

                    cart_container();
                    cart_count();
					
				}
			})
			
        };

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
        

        function cart_count(){
            jQuery.ajax({
                url	:	"main.php",
                method	:	"POST",
                data	:	{cart_counter:1},
                dataType: "json",
                success	:	function(data){
                    jQuery("#cart_total_main").html(data.on);
                    jQuery("#cart_total").html(data.on);
    
                console.log(data.on);
                }
            })
        }

        jQuery("body").delegate("#update_cart","click",function(event){
			event.preventDefault();
			
			var elements = jQuery('#qty input[name="quantity"]'),
			postBody = [];
			for (var i=0; i<elements.length; i++) {
				var element = jQuery(elements[i]);
				
				postBody.push({
					pro_id: element.attr('id'),
					eVal: element.val(),
					p_price: element.attr('price')
				})

			}

			jQuery.ajax({
				url	:	"main.php",
				method	:	"POST",
				data	:	{cart_update:1, selector:JSON.stringify(postBody)},
				success	:	function(data){
					alert(data);
                    viewcart_container();
                    viewcart_totalsum();
                    cart_container();
				}
			})

			
        });

        jQuery("body").delegate("#remove_order","click",function(event){
            event.preventDefault();
            var pid = jQuery(this).attr("remove_id");
            jQuery.ajax({
                url	:	"main.php",
                method	:	"POST",
                data	:	{removeFromOrder:1, removeId:pid},
                success	:	function(data){
                    alert(data);
                    viewcart_container();
                    viewcart_totalsum();
                    cart_container();
                    
                }
            })
        });

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

        
        viewcart_totalsum();
		function viewcart_totalsum(){
			jQuery.ajax({
				url	:	"main.php",
				method	:	"POST",
				data	:	{view_cart_tsum:1},
				success	:	function(data){
					
					jQuery("#sub_t").html(data);
					jQuery("#main_total").html(data);
					
					console.log(data);
				}
			})
			
        };

        jQuery("body").delegate("#checkout","click",function(event){
            event.preventDefault();
            var pid = jQuery(this).attr('pid');
            jQuery.ajax({
                url		:	"main.php",
                method	:	"POST",
                data	:	{product_link:1 , p_id:pid},
                success	:	function(data){
                window.location.href = "https://southcitypharmacy.ng/checkout/Checkout.php";
                }
            })
          });
        


		
})