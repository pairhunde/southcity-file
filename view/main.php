<?php
session_start();
include "../db.php";



if(isset($_POST["view_cart_product"])){

	if(isset($_SESSION["guest_uid"])){
	$uid = $_SESSION["guest_uid"];
	$sql = "SELECT * FROM guest_cart WHERE user_id = '$uid'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	if($count > 0){
		$no = 1;
		$total_amt = 0;
		while($row=mysqli_fetch_array($run_query)){
			$id = $row["id"];
			$pro_id = $row["p_id"];
			$pro_name = $row["product_title"];
			$pro_image = $row["product_image"];
			$qty = $row["qty"];
			$pro_price = $row["price"];
			$total = $row["total_amt"];
			$price_array = array($total);
			$total_sum = array_sum($price_array);
			$total_amt = $total_amt + $total_sum;
			$_SESSION['t_sum'] = $total_amt;
			setcookie("ta",$total_amt,strtotime("+1 day"),"/","","",TRUE);
			if(isset($_POST["view_cart_product"])){
                echo " 
                <tr  class='woocommerce-cart-form__cart-item cart_item'>
				<td class='product-thumbnail'>
                        <a href=''><img width='145' height='145' src='$pro_image' class='attachment-145x180 size-145x180 wp-post-image' alt='' sizes='(max-width: 145px) 100vw, 145px'></a>                    
                        </td>

                    <td class='product-name' data-title='Product'>
                        <a href=''>$pro_name</a>                    
                        </td>

                    <td class='product-price' data-title='Price'>
                        <span class='woocommerce-Price-amount amount'><span class='woocommerce-Price-currencySymbol'>₦</span>$pro_price</span>                    
                        </td>

                    <td class='product-quantity' data-title='Quantity'>
                        	<div id='qty' class='quantity'>
		<label class='screen-reader-text' for='quantity_5d00f42167bc9'>Quantity</label>
		<input type='number' id='$pro_id' class='input-text qty text' step='1' min='0' max='' name='quantity' price='$pro_price' value='$qty' title='Qty' size='4' pattern='[0-9]*' inputmode='numeric'>
	</div>
	                    </td>

                    <td class='product-subtotal' data-title='Total'>
                        <span class='woocommerce-Price-amount amount'><span class='woocommerce-Price-currencySymbol'>₦</span>$total</span>                    
                        </td>

                    <td id='remove_product' class='product-remove'>
<a href='' id='remove_item' remove_id='$pro_id' class='remove' title='Remove this item' data-product_id='81' data-product_sku=''>×</a></td>
</tr>"  ;
			}
		}
        echo "
        <tr>
            <td colspan='6' class='actions'>
                <input id='update_cart' type='submit' class='button' name='update_cart' value='Update Cart'>
            </td>
        
        </tr>
        ";

    }else{
        echo "0";
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
				class='$cid haru-menu menu_style_dropdown   menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-882 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children level-0 '
				>
				<a href='https://southcitypharmacy.ng/shop/shop.php'>$cat_name</a>
				</li>
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
            
            $id = $row["id"];
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
                                    class='woocommerce-Price-currencySymbol'>₦</span>$pro_price</span></span>
                        <br />
                        <a id='remove_order' remove_id='$id' ref='' href='' class='remove' aria-label='Remove this item' data-product_id='81'
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
            <a href='https://southcitypharmacy.ng/view/View.php' class='button wc-forward' style='background:#fa792f;'>View cart</a>
            </p>
        </div>
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


if(isset($_POST["cart_update"])){
	
	if(isset($_SESSION["guest_uid"])){

		$uid = $_SESSION["guest_uid"];
		$items = json_decode($_POST['selector']);
		$errors = array();
		$response = array();
		$success = 0;
		for ($i=0; $i < count($items); $i++) { 
			$check = $items[$i];
			$pid = $check->pro_id;
			$qty = $check->eVal;
			$price = $check->p_price;
            $total = $price * $qty ;
            $_SESSION['t_sum'] = $total;
			$sql = "UPDATE guest_cart SET qty = '$qty',price='$price',total_amt='$total' 
	WHERE user_id = '$uid' AND p_id='$pid'";
	$run_query = mysqli_query($con,$sql);
	if($run_query > 0){
		$success = $run_query;	
	}
	}
	if($success > 0){
		echo "Cart Updated";	
	}

    }
}

if(isset($_POST["removeFromOrder"])){
	$pid = $_POST["removeId"];
    if(isset($_SESSION['guest_uid'])){
		$uid = $_SESSION["guest_uid"];
		$sql = "DELETE FROM guest_cart WHERE user_id = '$uid' AND id = '$pid'";
		$run_query = mysqli_query($con,$sql);
		unset($_SESSION['t_sum']);
		if($run_query){
			echo "
			Removed from cart
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
				$pid
				";
			}
    }
}


if(isset($_POST["view_cart_tsum"])){
	if(isset($_SESSION['guest_uid'])){
		if(isset($_SESSION['t_sum'])){
			echo $_SESSION['t_sum'];
		}else{
			echo "0";
		}
	}
}


?>