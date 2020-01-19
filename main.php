<?php
session_start();
include "db.php";

if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
            $cat_name = $row["cat_title"];
			echo "
            <li id='filter-button' style='width:309.484px;'>
				<a id='category' cid='$cid' class='selected' href=''
				style='margin-bottom: 5px; background: #fa792f;'>$cat_name</a>
            </li>
            ";
		}
	}
}


if(isset($_POST["bottomleft"])){
	

	$b_query = "SELECT * FROM bottomleft";
	$query = mysqli_query($con,$b_query) or die(mysqli_error($con));
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_array($query)){ 

			$title = $row['title'];
			$link = $row['link'];


			echo "
			<img src='$link' alt=''>
			";
			

		}
	}

}


if(isset($_POST["bottomright"])){
	

	$b_query = "SELECT * FROM bottomright";
	$query = mysqli_query($con,$b_query) or die(mysqli_error($con));
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_array($query)){ 

			$title = $row['title'];
			$link = $row['link'];


			echo "
			<img src='$link' alt=''>
			";
			

		}
	}

}




if(isset($_POST["topbanner1"])){
	

	$b_query = "SELECT * FROM topbanner1";
	$query = mysqli_query($con,$b_query) or die(mysqli_error($con));
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_array($query)){ 

			$title = $row['title'];
			$link = $row['link'];


			echo "
			background-repeat: no-repeat; background-image: url('$link'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit; z-index: 20;
			";
			

		}
	}

}


if(isset($_POST["topbanner2"])){
	

	$b_query = "SELECT * FROM topbanner2";
	$query = mysqli_query($con,$b_query) or die(mysqli_error($con));
	if(mysqli_num_rows($query) > 0){
		while($row = mysqli_fetch_array($query)){ 

			$title = $row['title'];
			$link = $row['link'];


			echo "
			background-repeat: no-repeat; background-image: url('$link'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit; z-index: 20;
			";
			

		}
	}

}




if(isset($_POST["mob_category"])){
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
            $cat_name = $row["cat_title"];
			echo "
            <li
				id='menu-item-mobile-1079' 
				class='haru-menu menu_style_dropdown   menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-882 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children level-0 '
				>
				<a cid='$cid' id='product_linker' href=''>$cat_name</a>
				</li>
            ";
		}
	}
}




if(isset($_POST["m_products"])){
	if(isset($_POST["cat_id"])){
		$id = $_POST["cat_id"];
	}else{
		$id = 1;
	}
	
	$sql_counter = "SELECT * FROM products WHERE product_cat = '$id'";
	$run_query = mysqli_query($con,$sql_counter) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
		$pid = $row["product_id"];
		$product_cat = $row["product_cat"];
		$product_title = $row["product_title"];
		$product_image = $row["product_image"];
		$product_style = $row["product_style"];
		$product_price = $row["product_price"];

		echo "
		<li cid='$product_cat' class='product'>
		<div class='product-inner'>
			<div class='product-thumbnail'>
				<a id='product_link' href='' pid='$pid' href=''
					class='woocommerce-LoopProduct-link woocommerce-loop-product__link'>
					
					<div class='product-thumb-primary'>
						<img width='270' height='270' src='$product_image'
							class='attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image' alt=''
							sizes='(max-width: 270px) 100vw, 270px' style='min-height:190px;'> </div>
				</a>
				<div class='product-actions'>
					<div style='width : 100%;' class='add-to-cart-wrapper'>
					<a id='atc' pid='$pid' rel='nofollow' href='' data-quantity='1' data-product_id='69' data-product_sku=''
							class='add_to_cart_button product_type_variable button product_type_variable add_to_cart_button' style='width : 100%;' >
							<i class='icofont icofont-cart-alt'style='font-size: xx-large;' ></i>
							<span class='haru-tooltip button-tooltip'>Add to cart</span></a></div>
				</div>
			</div>
	
			<div class='product-info'>
				<a id='product_link' href='' pid='$pid'
					class='woocommerce-LoopProduct-link woocommerce-loop-product__link'>
					<h2 class='woocommerce-loop-product__title'>$product_title</h2>
				</a>
				<div class='star-rating'><span style='width:90%'>Rated <strong class='rating'>4.50</strong> out of 5</span>
				</div>
				<span class='price'><span class='woocommerce-Price-amount amount'><span
				class='woocommerce-Price-currencySymbol'>₦</span>$product_price</span></span>
			</div>
		</div>
	</li>
		";}
	}

}

if(isset($_POST["product_link"])){
	$_SESSION["p_id"] = $_POST["p_id"];

}


if (isset($_POST["searcher"])) {

	$keyword = $_POST['keyword'];

    if (!empty($keyword)) {
      $sql = "SELECT * FROM products WHERE product_title LIKE '%$keyword%'";
	  $query = mysqli_query($con, $sql);
	  if (mysqli_num_rows($query) > 0) {
		while($row = mysqli_fetch_array($query)){
			$pid = $row["product_id"];
			$product_cat = $row["product_cat"];
			$product_title = $row["product_title"];
			$product_image = $row["product_image"];
			$product_style = $row["product_style"];
			$product_price = $row["product_price"];
			echo "
			<li cid='$product_cat' class='product'>
			<div class='product-inner'>
				<div class='product-thumbnail'>
					<a id='product_link' href='' pid='$pid' href=''
						class='woocommerce-LoopProduct-link woocommerce-loop-product__link'>
						
						<div class='product-thumb-primary'>
							<img width='270' height='270' src='$product_image'
								class='attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image' alt=''
								sizes='(max-width: 270px) 100vw, 270px' style='min-height:190px;'> </div>
					</a>
					<div class='product-actions'>
						<div style='width : 100%;' class='add-to-cart-wrapper'>
						<a id='atc' pid='$pid' rel='nofollow' href='' data-quantity='1' data-product_id='69' data-product_sku=''
								class='add_to_cart_button product_type_variable button product_type_variable add_to_cart_button' style='width : 100%;' >
								<i class='icofont icofont-cart-alt'style='font-size: xx-large;' ></i>
								<span class='haru-tooltip button-tooltip'>Add to cart</span></a></div>
					</div>
				</div>
		
				<div class='product-info'>
					<a id='product_link' href='' pid='$pid'
						class='woocommerce-LoopProduct-link woocommerce-loop-product__link'>
						<h2 class='woocommerce-loop-product__title'>$product_title</h2>
					</a>
					<div class='star-rating'><span style='width:90%'>Rated <strong class='rating'>4.50</strong> out of 5</span>
					</div>
					<span class='price'><span class='woocommerce-Price-amount amount'><span
								class='woocommerce-Price-currencySymbol'>₦</span>$product_price</span></span>
				</div>
			</div>
		</li>
			";}

	  }
    }else {
        echo "<h2 style='color:green;'>Sorry, your search result returns nothing</h2>";
    }
}


if(isset($_POST["cart_update"])){

    if(isset($_SESSION['guest_uid'])){
        $guest = $_SESSION['guest_uid'];
		$_SESSION['p_id'] = $_POST['p_id'];
        $p_id = $_SESSION['p_id'];
        $sql = "SELECT * FROM guest_cart WHERE p_id = '$p_id' AND user_id = '$guest'";
		$run_query = mysqli_query($con,$sql);
        $count = mysqli_num_rows($run_query);
        
        if($count > 0){
			echo "
            already exists in your cart.
        
			";
		}else{
            $sql = "SELECT * FROM products WHERE product_id = '$p_id'";
			$run_query = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($run_query);
				$id = $row["product_id"];
				$pro_name = $row["product_title"];
				$pro_image = $row["product_image"];
				$pro_price = $row["product_price"];
			$sql = "INSERT INTO `guest_cart` 
			(`p_id`, `ip_add`, `user_id`, `product_title`,
			`product_image`, `qty`, `price`, `total_amt`)
			VALUES ('$p_id', '0', '$guest', '$pro_name', 
			'$pro_image', '1', '$pro_price', '$pro_price')";
			if(mysqli_query($con,$sql)){
				echo "
				sent into your cart.
				";
			}
        }
    }elseif(!isset($_SESSION['guest_uid'])){

        $bytes = random_bytes(5);
        $guest_id = bin2hex($bytes);
        $_SESSION['guest_uid'] = $guest_id;
        $p_id = $_POST['p_id'];


        $sql = "SELECT * FROM products WHERE product_id = '$p_id'";
        $run_query = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($run_query);
            $id = $row["product_id"];
            $pro_name = $row["product_title"];
            $pro_image = $row["product_image"];
            $pro_price = $row["product_price"];
        $sql = "INSERT INTO `guest_cart` 
        (`p_id`, `ip_add`, `user_id`, `product_title`,
        `product_image`, `qty`, `price`, `total_amt`)
        VALUES ('$p_id', '0', '$guest_id', '$pro_name', 
        '$pro_image', '1', '$pro_price', '$pro_price')";
        if(mysqli_query($con,$sql)){
            echo "
            sent into your cart.
            ";
        }

    }
   
}

if(isset($_POST["get_cart_product"])){


    if(isset($_SESSION['guest_uid'])){
        
    $guest = $_SESSION['guest_uid'];
	$sql = "SELECT * FROM guest_cart WHERE user_id = '$guest'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	if($count > 0){
		$no = 0;
		$total_amt = 0;
		while($row=mysqli_fetch_array($run_query)){
            
            $id = $row["p_id"];
			$pro_name = $row["product_title"];
			$pro_image = $row["product_image"];
			$qty = $row["qty"];
			$pro_price = $row["price"];
			$total = $row["total_amt"];
			$price_array = array($total);
			$total_sum = array_sum($price_array);
			$total_amt = $total_amt + $total_sum;
			$_SESSION['t_amount'] = $total_amt;
			setcookie("ta",$total_amt,strtotime("+1 day"),"/","","",TRUE);
                echo "
                <ul  $no class='woocommerce-mini-cart cart_list product_list_widget '>
                <li class='woocommerce-mini-cart-item mini_cart_item'  >
                    <div class='cart-left'>
                        <a href='../heart-tablet/index.html'>
                            <img width='270' height='270' src='$pro_image'
                                class='attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image'
                                alt='' />Heart Tablet&nbsp;
                        </a>
                    </div>
                    <div class='cart-right'>
                        <a href=''>
                        $pro_name </a>

                        <span class='quantity'>1 &times; <span class='woocommerce-Price-amount amount'><span
                                    class='woocommerce-Price-currencySymbol'>₦</span>$pro_price</span></span>
                        <br />
                        <a id='remove_item' remove_id='$id' ref='' href='' class='remove' aria-label='Remove this item' data-product_id='81'
                            data-product_sku=''>&times;</a> </div>
                </li>
                </ul>
			";
            $no = $no + 1;
            
            $_SESSION['num'] = $no;
            
        }
        echo "
        <div class='cart-total'>
            <p class='total'><strong>Total:</strong> 
            <span class='woocommerce-Price-amount amount'>
            <span class='woocommerce-Price-currencySymbol'>₦</span>$total_amt</span>
            </p>
            <p class='woocommerce-mini-cart__buttons buttons'>
            <a href='view/View.php' class='button wc-forward' style='background:#fa792f;'>View cart</a>
            </p>
        </div>
        ";
        
        }
    }

}


if(isset($_POST["removeFromCart"])){
	$pid = $_POST["removeId"];

		if(isset($_SESSION['guest_uid'])){
			$uid = $_SESSION["guest_uid"];
			$price = $_SESSION['t_amount'];
			$sql = "SELECT * FROM guest_cart WHERE user_id = '$uid' AND p_id = '$pid'";
			$run_query = mysqli_query($con,$sql);
			while($row=mysqli_fetch_array($run_query)){
				$pro_price = $row["price"];
				$_SESSION['t_amount'] = $pro_price - $price;
			}
			
			$sql = "DELETE FROM guest_cart WHERE user_id = '$uid' AND p_id = '$pid'";
			$run_query = mysqli_query($con,$sql);

			if($run_query){
				echo "
				Removed from cart
				";
			}
    }
}

if(isset($_POST["cart_counter"])){
    $response = array();
    
    if(!isset($_SESSION["guest_uid"])){
        $response["on"] = 0;
	 }elseif(isset($_SESSION["guest_uid"])){
		$guest = $_SESSION['guest_uid'];
        $sql = "SELECT * FROM guest_cart WHERE user_id = '$guest'";
        $run_query = mysqli_query($con,$sql);
        $count = mysqli_num_rows($run_query);
        if($count > 0){
            $response["on"] = $count;
        }else{
            $response["on"] = 0;
            $response["msg"] = "
            <ul class='woocommerce-mini-cart cart_list product_list_widget '>
             <li class='empty'>
              <h4>Empty cart</h4>
              <p class='woocommerce-mini-cart__empty-message'>
               No products in the cart.
              </p>
             </li>
            </ul>

            ";
        }
	}
    echo json_encode($response);


}


if(isset($_POST["product_linker"])){
	$_SESSION["cid"] = $_POST["c_id"];

}

?>