jQuery(document).ready(function() {




    jQuery("body").delegate("#login", "click", function (event) {
        event.preventDefault();
        var user_login = jQuery("#uname").val();
        var password = jQuery("#pass").val();

        var submit = 1;

        console.log(user_login);
        console.log(password);
        jQuery.ajax({
            method: "POST",
            url: "dashboard.php",
            data: { user_login: user_login, password: password, submit: submit },
            dataType: "json",
            success: function (r) {
                console.log(r);
                if (r.success == false) {
                    if (r.errors.username) {
                        jQuery(".emailerr").html(r.errors.username);
                    } else if (!r.errors.username) {
                        jQuery(".emailerr").html("");
                    }

                    if (r.errors.password) {
                        jQuery(".pass").html(r.errors.password);
                    } else if (!r.errors.password) {
                        jQuery(".pass").html("");
                    }
                } else if (r.invaliduser == true) {
                    if (r.username) {
                        jQuery(".emailerr").html(r.username);
                        jQuery(".pass").html("");
                    } else if (!r.username) {
                        jQuery(".emailerr").html("");
                    }

                } else if (r.success == true) {
                    jQuery(".emailerr").html("");
                    jQuery(".pass").html("");
                    alert("Welcome");
                    window.location.href = "category.html";

                }

            }
        })
    });




    
//PageLoader
category();
    function category() {
        jQuery.ajax({
            url: "dashboard.php",
            method: "POST",
            data: { category: 1 },
            success: function(data) {
                jQuery("#cat").html(data);
            }
        })
    }



    product();
    function product() {
        jQuery.ajax({
            url: "dashboard.php",
            method: "POST",
            data: { products: 1 },
            success: function(data) {
                jQuery("#prod").html(data);
            }
        })
    }


    paystack();
    function paystack() {
        console.log("work yo");
        jQuery.ajax({
            url: "dashboard.php",
            method: "POST",
            data: { paystack: 1 },
            success: function(data) {
                jQuery("#notif").html(data);
                console.log(data);
            }
        })
    }


    //Delete Button
    var clicked;
    jQuery("body").delegate("#del", "click", function(event) {
        event.preventDefault();
        window.clicked = jQuery(this).attr('dclicked');
        swal({
            title: 'Are you sure?',
            text: "You want to Delete!",
            type: 'warning',
            buttons: {
                cancel: {
                    visible: true,
                    text: 'No, cancel!',
                    className: 'btn btn-danger'
                },
                confirm: {
                    text: 'Yes, delete it!',
                    className: 'btn btn-success dmodal'
                }
            }
        })
    });



    var clickedprod;
    jQuery("body").delegate("#prod-del", "click", function(event) {
        event.preventDefault();
        window.clickedprod = jQuery(this).attr('dclicked');
        jQuery.jStorage.set("a", 10000);
        
        swal({
            title: 'Are you sure?',
            text: "You want to Delete!",
            type: 'warning',
            buttons: {
                cancel: {
                    visible: true,
                    text: 'No, cancel!',
                    className: 'btn btn-danger'
                },
                confirm: {
                    text: 'Yes, delete it!',
                    className: 'btn btn-success pmodalsuccess'
                }
            }
        })
    });






//Delete button in modal Backend function caller
    jQuery("body").delegate(".dmodal", "click", function(event) {
        event.preventDefault();
        var catitem = window.clicked;
        jQuery.ajax({
            url: "dashboard.php",
            method: "POST",
            data: { catitem: catitem, delete: 1 },
            success: function(data) {
                category();
            }
        })
    });



    jQuery("body").delegate(".pmodalsuccess", "click", function(event) {
        event.preventDefault();
        var proditem = window.clickedprod;
        jQuery.ajax({
            url: "dashboard.php",
            method: "POST",
            data: { proditem: proditem, prodelete: 1 },
            success: function(data) {
                product();
            }
        })
    });






//Edit modal
    var catglobal;
    jQuery("body").delegate("#ed", "click", function(event) {
        event.preventDefault();
        window.catglobal = jQuery(this).attr('cat');
        jQuery("#addCat").attr('placeholder', window.catglobal);

    });



    var prodglobal;
    var proddesc;
    var proddesc;
    var prodprice;
    jQuery("body").delegate("#prod-ed", "click", function(event) {
        event.preventDefault();
        window.prodglobal = jQuery(this).attr('prod');
        window.editprod = jQuery(this).attr('eclicked');
        window.proddesc = jQuery(this,"#getproddesc").text();
        window.prodprice = jQuery(this).attr('price');
        jQuery("#editName").attr('value', window.prodglobal);
        jQuery("#editdesc").html(window.proddesc.trim());
        jQuery("#editprice").attr('value', window.prodprice);
        jQuery("#thisproduct").attr('value', window.editprod);
        console.log(window.proddesc.trim());
        jQuery.ajax({
            url: "dashboard.php",
            method: "POST",
            data: { cat_names: 1 },
            success: function(data) {
                jQuery('.cat-names').html(data);
            }
        })

    });






//Edit button in modal
    jQuery("body").delegate("#updateButton", "click", function(event) {
        event.preventDefault();
        var catinput = jQuery("#addCat").val();
        var catholder = jQuery("#addCat").attr('placeholder');
        var editcategory = 1;

        jQuery.ajax({
            type: "POST",
            url: "dashboard.php",
            data: { catholder: catholder, catinput: catinput, editcategory: editcategory },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if(data.success == false){

                    if (data.errors.noinput) {
                        jQuery("#editname").html(data.errors.noinput);
                    } else if (!data.errors.noinput) {
                        jQuery("#editname").html("*");
                    }

                }else if(data.success == true){

                    jQuery("#addCat").val("");
                    jQuery("#addCat").attr('placeholder', catinput);
                    jQuery("#updated").html("UPDATED!!");
                    category();
                }
                
            }
        })

    });



    jQuery("#updateproduct").on('click',(function(event) {
        event.preventDefault();
        var formdata = jQuery('#formdata').get(0);
        console.log(formdata);
        jQuery.ajax({
            type: "POST",
            url: "../../../dashboard.php",
            data: new FormData(formdata),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if(data.success == false){

                    if (data.errors.name) {
                        jQuery("#editnameloader").html(data.errors.name);
                    } else if (!data.errors.name) {
                        jQuery("#editnameloader").html("*");
                    }

                    if (data.errors.desc) {
                        jQuery("#editdescloader").html(data.errors.desc);
                    } else if (!data.errors.desc) {
                        jQuery("#editdescloader").html("*");
                    }

                    if (data.errors.price) {
                        jQuery("#editpriceloader").html(data.errors.price);
                    } else if (!data.errors.price) {
                        jQuery("#editpriceloader").html("*");
                    }

                    if (data.errors.image) {
                        jQuery(".filetochange").html(data.errors.image);
                    } else if (!data.errors.image) {
                        jQuery(".filetochange").html("*");
                    }else if (data.errors.format) {
                        jQuery(".filetochange").html(data.errors.format);
                    }
                }else if(data.success == true){

                    jQuery(".filetochange").html("<h1>Updated</h1>");
                    product();
                }
                
            }
        })

    }));





//Add Products and categories
    jQuery("body").delegate("#addRowButton", "click", function(event) {
        event.preventDefault();
        var catinput = jQuery("#addName").val();
        var addcategory = 1;

        jQuery.ajax({
            type: "POST",
            url: "dashboard.php",
            data: { catinput: catinput, addcategory: addcategory },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if(data.success == false){

                    if (data.errors.noinput) {
                        jQuery("#error").html(data.errors.noinput);
                    } else if (!data.errors.noinput) {
                        jQuery("#error").html("*");
                    }

                }else if(data.success == true){

                    jQuery("#added").html("ADDED!!");
                    jQuery("#error").html("");
                    category();
                    jQuery('#addRowModal').modal('hide');
                    jQuery("#added").html("");
                    jQuery("#addName").val("");
                }
                
            }
        })

    });


    jQuery("body").delegate("#addprod", "click", function(event) {
        event.preventDefault();
        jQuery.ajax({
            url: "dashboard.php",
            method: "POST",
            data: { cat_names: 1 },
            success: function(data) {
                jQuery('.cat-names').html(data);
            }
        })

    });


    jQuery(".addbutton").on('click',(function(event) {
        event.preventDefault();
        var formdata = jQuery('#addformdata').get(0);
        console.log(formdata);
        jQuery.ajax({
            type: "POST",
            url: "../../../dashboard.php",
            data: new FormData(formdata),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if(data.success == false){

                    if (data.errors.name) {
                        jQuery("#addnameloader").html(data.errors.name);
                    } else if (!data.errors.name) {
                        jQuery("#addnameloader").html("*");
                    }

                    if (data.errors.desc) {
                        jQuery("#adddescloader").html(data.errors.desc);
                    } else if (!data.errors.desc) {
                        jQuery("#adddescloader").html("*");
                    }

                    if (data.errors.price) {
                        jQuery("#addpriceloader").html(data.errors.price);
                    } else if (!data.errors.price) {
                        jQuery("#addpriceloader").html("*");
                    }

                    if (data.errors.image) {
                        jQuery(".addfile").html(data.errors.image);
                    } else if (!data.errors.image) {
                        jQuery(".addfile").html("*");
                    }else if (data.errors.format) {
                        jQuery(".addfile").html(data.errors.format);
                    }
                }else if(data.success == true){


                    product();
                }
                
            }
        })

    }));


 
    


    jQuery("body").delegate("#addprod", "click", function(event) {
        event.preventDefault();
        jQuery.ajax({
            url: "dashboard.php",
            method: "POST",
            data: { cat_names: 1 },
            success: function(data) {
                jQuery('.cat-names').html(data);
            }
        })

    });


    jQuery("#bl").on('click',(function(event) {
        event.preventDefault();
        var formdata = jQuery('#blform').get(0);
        console.log(formdata);
        jQuery.ajax({
            type: "POST",
            url: "../../../dashboard.php",
            data: new FormData(formdata),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if(data.success == false){

                    if (data.errors.image) {
                        jQuery(".bl").html(data.errors.image);
                    } else if (!data.errors.image) {
                        jQuery(".bl").html("*");
                    }
                }else if(data.success == true){
                    jQuery(".bl").html("Uploaded");
                }
                
            }
        })

    }));




    jQuery("#br").on('click',(function(event) {
        event.preventDefault();
        var formdata = jQuery('#brform').get(0);
        console.log(formdata);
        jQuery.ajax({
            type: "POST",
            url: "../../../dashboard.php",
            data: new FormData(formdata),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if(data.success == false){

                    if (data.errors.image) {
                        jQuery(".br").html(data.errors.image);
                    } else if (!data.errors.image) {
                        jQuery(".br").html("*");
                    }
                }else if(data.success == true){
                    jQuery(".br").html("Uploaded");
                }
                
            }
        })

    }));


    jQuery("#bt1").on('click',(function(event) {
        event.preventDefault();
        var formdata = jQuery('#brform').get(0);
        console.log(formdata);
        jQuery.ajax({
            type: "POST",
            url: "../../../dashboard.php",
            data: new FormData(formdata),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if(data.success == false){

                    if (data.errors.image) {
                        jQuery(".br").html(data.errors.image);
                    } else if (!data.errors.image) {
                        jQuery(".br").html("*");
                    }
                }else if(data.success == true){
                    jQuery(".br").html("Uploaded");
                }
                
            }
        })

    }));
})