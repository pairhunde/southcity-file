<?php
session_start();
include "../db.php";




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
				<a cid='$cid' id='product_link' href='../shop/shop.php'>$cat_name</a>
				</li>
            ";
		}
	}
}


if(isset($_POST["product_link"])){
	$_SESSION["cid"] = $_POST["c_id"];

}

if(isset($_POST["cart_update"])){

    if(isset($_SESSION['guest_uid'])){
        $guest = $_SESSION['guest_uid'];
        $pro_title = $_SESSION["product_title"];

        $p_id = $_SESSION['p_id'];
        $sql = "SELECT * FROM guest_cart WHERE p_id = '$p_id' AND user_id = '$guest'";
		$run_query = mysqli_query($con,$sql);
        $count = mysqli_num_rows($run_query);
        
        if($count > 0){
			echo "
            <div class='woocommerce-message' role='alert'>
            <a id='closer' ref='' href='' style='float:right;' class='remove' aria-label='Remove this item' 
                data-product_id='81'
                data-product_sku=''>&times;</a>
            &ldquo; $pro_title &rdquo; already exists in your cart.
            </div>
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
			(`id`, `p_id`, `ip_add`, `user_id`, `product_title`,
			`product_image`, `qty`, `price`, `total_amt`)
			VALUES ('$id', '$p_id', '0', '$guest', '$pro_name', 
			'$pro_image', '1', '$pro_price', '$pro_price')";
			if(mysqli_query($con,$sql)){
				echo "
				<div class='woocommerce-message' role='alert'>
                <a id='closer' ref='' href='' style='float:right;' class='remove' aria-label='Remove this item' 
                data-product_id='81'
                data-product_sku=''>&times;</a>
                &ldquo; $pro_title &rdquo; sent into your cart.
                </div>
				";
			}
        }
    }else{

        $bytes = random_bytes(5);
        $guest_id = bin2hex($bytes);
        $_SESSION['guest_uid'] = $guest_id;
        $p_id = $_SESSION['p_id'];


        $sql = "SELECT * FROM products WHERE product_id = '$p_id'";
        $run_query = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($run_query);
            $id = $row["product_id"];
            $pro_name = $row["product_title"];
            $pro_image = $row["product_image"];
            $pro_price = $row["product_price"];
        $sql = "INSERT INTO `guest_cart` 
        (`id`, `p_id`, `ip_add`, `user_id`, `product_title`,
        `product_image`, `qty`, `price`, `total_amt`)
        VALUES ('$id', '$p_id', '0', '$guest', '$pro_name', 
        '$pro_image', '1', '$pro_price', '$pro_price')";
        if(mysqli_query($con,$sql)){
            echo "
            <div class='woocommerce-message' role='alert'>
            <a id='closer'  ref='' href='' style='float:right;' class='remove' aria-label='Remove this item' 
            data-product_id='81'
            data-product_sku=''>&times;</a>
            &ldquo; $pro_title &rdquo; sent into your cart.
            </div>
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
                            <img width='270' height='270' src='../$pro_image'
                                class='attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image'
                                alt='' />Heart Tablet&nbsp;
                        </a>
                    </div>
                    <div class='cart-right'>
                        <a href=''>
                        $pro_name </a>

                        <span class='quantity'>1 &times; <span class='woocommerce-Price-amount amount'><span
                                    class='woocommerce-Price-currencySymbol'>&#36;</span>$pro_price</span></span>
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
            <span class='woocommerce-Price-currencySymbol'>$</span>$total_amt</span>
            </p>
            <p class='woocommerce-mini-cart__buttons buttons'>
            <a href='../view/View.php' class='button wc-forward'>View cart</a>
            <a href='../checkout/Checkout.php' class='button checkout wc-forward'>Checkout</a>
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
	 }else{
		$guest = $_SESSION['guest_uid'];
        $p_id = $_SESSION['p_id'];
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


?>