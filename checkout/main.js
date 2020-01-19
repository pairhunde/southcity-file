jQuery(document).ready(function() {

    view_final_order();
    cart_container();
    viewcart_totalsum();
    cart_count();





    jQuery("#place_order").submit(function(e) {
        e.preventDefault();
        var first_name = jQuery("#billing_first_name").val();
        var last_name = jQuery("#billing_last_name").val();
        var address = jQuery("#billing_address").val();
        var city = jQuery("#billing_city").val();
        var state = jQuery("#billing_state").val();
        var phone = jQuery("#billing_phone").val();
        var email = jQuery("#billing_email").val();
        var country = jQuery("#billing_country").val();
        console.log("HEllooooooooooooooo");
        var submit_odr = null;

        if (jQuery("#place_order_btn").attr('active') == 'yes') {
            values = { 'submit_odr': true };
        }
        console.log(values['submit_odr']);
        jQuery.ajax({
            type: "POST",
            url: "main.php",
            data: { first_name: first_name, last_name: last_name, address: address, city: city, state: state, phone: phone, email: email, country: country, submit_odr: values["submit_odr"] },
            dataType: "json",
            success: function(r) {
                console.log(r);
                if (r.success == false) {

                    if (r.errors.first_name) {
                        jQuery(".first_name").html(r.errors.first_name);
                    } else {
                        jQuery(".first_name").html("");
                    }

                    if (r.errors.last_name) {
                        jQuery(".last_name").html(r.errors.last_name);
                    } else {
                        jQuery(".last_name").html("");
                    }

                    if (r.errors.address) {
                        jQuery(".address").html(r.errors.address);
                    } else {
                        jQuery(".address").html("");
                    }

                    if (r.errors.city) {
                        jQuery(".city").html(r.errors.city);
                    } else {
                        jQuery(".city").html("");
                    }

                    if (r.errors.state) {
                        jQuery(".state").html(r.errors.state);
                    } else {
                        jQuery(".state").html("");
                    }

                    if (r.errors.phone) {
                        jQuery(".phone").html(r.errors.phone);
                    } else {
                        jQuery(".phone").html("");
                    }

                    if (r.errors.country) {
                        jQuery(".country").html(r.errors.country);
                    } else {
                        jQuery(".country").html("");
                    }

                    if (r.errors.email) {
                        jQuery(".email").html(r.errors.email);
                    } else {
                        jQuery(".email").html("");
                    }
                } else if (r.success === true) {
                    alert("Click ok to pay");
                    window.location.href = "initialize.php";
                }


            }
        })
    })


    jQuery("body").delegate(".paywithbtc", "click", function(e) {
        e.preventDefault();
        var first_name = jQuery("#billing_first_name").val();
        var last_name = jQuery("#billing_last_name").val();
        var address = jQuery("#billing_address").val();
        var city = jQuery("#billing_city").val();
        var state = jQuery("#billing_state").val();
        var phone = jQuery("#billing_phone").val();
        var email = jQuery("#billing_email").val();
        var country = jQuery("#billing_country").val();
        var btc = "btc";
        console.log("HEllooooooooooooooo");

        jQuery.ajax({
            type: "POST",
            url: "main.php",
            data: { btc: btc, first_name: first_name, last_name: last_name, address: address, city: city, state: state, phone: phone, email: email, country: country, submit_btc: 1 },
            dataType: "json",
            success: function(r) {
                console.log(r);
                if (r.success == false) {

                    if (r.errors.first_name) {
                        jQuery(".first_name").html(r.errors.first_name);
                    } else {
                        jQuery(".first_name").html("");
                    }

                    if (r.errors.last_name) {
                        jQuery(".last_name").html(r.errors.last_name);
                    } else {
                        jQuery(".last_name").html("");
                    }

                    if (r.errors.address) {
                        jQuery(".address").html(r.errors.address);
                    } else {
                        jQuery(".address").html("");
                    }

                    if (r.errors.city) {
                        jQuery(".city").html(r.errors.city);
                    } else {
                        jQuery(".city").html("");
                    }

                    if (r.errors.state) {
                        jQuery(".state").html(r.errors.state);
                    } else {
                        jQuery(".state").html("");
                    }

                    if (r.errors.phone) {
                        jQuery(".phone").html(r.errors.phone);
                    } else {
                        jQuery(".phone").html("");
                    }

                    if (r.errors.country) {
                        jQuery(".country").html(r.errors.country);
                    } else {
                        jQuery(".country").html("");
                    }

                    if (r.errors.email) {
                        jQuery(".email").html(r.errors.email);
                    } else {
                        jQuery(".email").html("");
                    }
                    alert("please complete the form")
                } else if (r.success === true) {
                    alert("Click ok to pay with bitcoins");
                    window.location.href = "index.php";
                }


            }
        })
    })


    jQuery(".toggle-icon-wrap").click(function(event){
        event.preventDefault();
        jQuery(this).toggleClass('in');
        jQuery("#haru-nav-mobile-menu").toggleClass('in');
        mobile-menu-close
        console.log("workiiiiiiiiiiiiiii");
      
    })
    
    jQuery(".mobile-menu-close").click(function(event){
        event.preventDefault();
        jQuery("#haru-nav-mobile-menu").removeClass('in');
        
        console.log("workiiiiiiiiiiiiiii");
      
    })


    function view_final_order() {
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { view_final: 1 },
            success: function(data) {
                jQuery("#view_final_order").html(data);



            }
        })

    };

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

    function cart_count() {
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { cart_counter: 1 },
            dataType: "json",
            success: function(data) {
                jQuery("#cart_total_main").html(data.on);
                jQuery("#cart_total").html(data.on);

                console.log(data);
            }
        })
    }


    jQuery("body").delegate("#remove_order", "click", function(event) {
        event.preventDefault();
        var pid = jQuery(this).attr("remove_id");
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { removeFromOrder: 1, removeId: pid },
            success: function(data) {
                alert(data);
                viewcart_container();
                viewcart_totalsum();
                cart_container();

            }
        })
    });


    function viewcart_totalsum() {
        jQuery.ajax({
            url: "main.php",
            method: "POST",
            data: { view_cart_tsum: 1 },
            success: function(data) {

                jQuery("#sub_t").html(data);
                jQuery("#main_total").html(data);

                console.log(data);
            }
        })

    };

})