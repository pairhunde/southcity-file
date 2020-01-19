<?php
session_start();
include "../db.php";

if(isset($_POST["submit_odr"])){
	
	
	if($_SESSION["guest_uid"]){
		$guest_uid = $_SESSION["guest_uid"];
	}
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
	$fullname = $first_name . " " . $last_name;
	$errors = array();
	$response = array();

	if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['address']) || empty($_POST['city']) || empty($_POST['state']) || empty($_POST['country']) || empty($_POST['email']) || empty($_POST['phone'])){ 

	
		if(empty($_POST['first_name'])){
			$errors["first_name"] = "* First name is required";
		}
		
		if(empty($last_name)){
			$errors["last_name"] = "* Last name is required";
		}

		if(empty($_POST['address'])){
			$errors["address"] = "* Address is required";
		}

		if(empty($_POST['city'])){
			$errors["city"] = "* City is required";
		}

		if(empty($_POST['state'])){
			$errors["state"] = "* State is required";
		}
		
		if(empty($_POST['country'])){
			$errors["country"] = "* Country is required";
		}

		if(empty($_POST['email'])){
			$errors["email"] = "* Email is required";
		}

		if(empty($_POST['phone'])){
			$errors["phone"] = "* Phone is required";
		}
	
		$response["errors"] = $errors;

		$response["success"] = false;
		echo json_encode($response);
	}elseif(!empty($first_name) && !empty($last_name) && !empty($address) && !empty($city) && !empty($state) && !empty($country) && !empty($email) && !empty($phone)){
			
		if(isset($_SESSION["guest_uid"])){
		$sql = "INSERT INTO `orders` 
		(`user_id`, `first_name`, `last_name`, `address`, `city`, `state`, `phone`, `email`, `ordered`, `paid`) 
		VALUES ('$guest_uid', '$first_name', '$last_name', '$address', '$city', '$state', '$phone', '$email', 'yes', '0')";
		$run_query = mysqli_query($con,$sql);
		$response["query"] = $run_query;
		if($run_query){
			$sql_list = "SELECT * FROM guest_cart WHERE user_id = '$guest_uid'";
			$run_query_list = mysqli_query($con,$sql_list);
			$counter = mysqli_num_rows($run_query_list);
			if($counter > 0){
				while($row=mysqli_fetch_array($run_query_list)){
					$id = $row["id"];
					$pro_id = $row["p_id"];
					$user_id = $row["user_id"];
					$pro_name = $row["product_title"];
					$pro_image = $row["product_image"];
					$qty = $row["qty"];
					$pro_price = $row["price"]; 
					$total = $row["total_amt"];
					$sql_into = "INSERT INTO `order_list` 
					(`p_id`, `user_id`, `ip_add`, `fullname`, `product_title`, `product_image`, `qty`, `price`, `total_amt`, `paid`, `email`, `phone`, `adr`, `state`, `city`) 
					VALUES ('$pro_id', '$user_id', 'paystack', '$fullname', '$pro_name', '$pro_image', '$qty', '$pro_price', '$total', '1500', '$email', '$phone', '$address', '$state', '$city')";
					$run_query_into = mysqli_query($con,$sql_into);
					if($run_query_into){
					    $_SESSION['id'] = $email;
						$response["success"] = true;
						
					}
				}
				echo json_encode($response);
			}
	}
	}
	}
}



if(isset($_POST["submit_btc"])){
	
	
	if($_SESSION["guest_uid"]){
		$guest_uid = $_SESSION["guest_uid"];
	}
	$btc = $_POST['btc'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
	$fullname = $first_name . " " . $last_name;
	$errors = array();
	$response = array();

	if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['address']) || empty($_POST['city']) || empty($_POST['state']) || empty($_POST['country']) || empty($_POST['email']) || empty($_POST['phone'])){ 

	
		if(empty($_POST['first_name'])){
			$errors["first_name"] = "* First name is required";
		}
		
		if(empty($last_name)){
			$errors["last_name"] = "* Last name is required";
		}

		if(empty($_POST['address'])){
			$errors["address"] = "* Address is required";
		}

		if(empty($_POST['city'])){
			$errors["city"] = "* City is required";
		}

		if(empty($_POST['state'])){
			$errors["state"] = "* State is required";
		}
		
		if(empty($_POST['country'])){
			$errors["country"] = "* Country is required";
		}

		if(empty($_POST['email'])){
			$errors["email"] = "* Email is required";
		}

		if(empty($_POST['phone'])){
			$errors["phone"] = "* Phone is required";
		}
	
		$response["errors"] = $errors;

		$response["success"] = false;
		echo json_encode($response);
	}elseif(!empty($first_name) && !empty($last_name) && !empty($address) && !empty($city) && !empty($state) && !empty($country) && !empty($email) && !empty($phone)){
			
		if(isset($_SESSION["guest_uid"])){
		$sql = "INSERT INTO `orders` 
		(`user_id`, `first_name`, `last_name`, `address`, `city`, `state`, `phone`, `email`, `ordered`, `paid`) 
		VALUES ('$guest_uid', '$first_name', '$last_name', '$address', '$city', '$state', '$phone', '$email', 'yes', '0')";
		$run_query = mysqli_query($con,$sql);
		$response["query"] = $run_query;
		if($run_query){
			$sql_list = "SELECT * FROM guest_cart WHERE user_id = '$guest_uid'";
			$run_query_list = mysqli_query($con,$sql_list);
			$counter = mysqli_num_rows($run_query_list);
			if($counter > 0){
				while($row=mysqli_fetch_array($run_query_list)){
					$id = $row["id"];
					$pro_id = $row["p_id"];
					$user_id = $row["user_id"];
					$pro_name = $row["product_title"];
					$pro_image = $row["product_image"];
					$qty = $row["qty"];
					$pro_price = $row["price"]; 
					$total = $row["total_amt"];
					$sql_into = "INSERT INTO `order_list` 
					(`p_id`, `user_id`, `ip_add`, `fullname`, `product_title`, `product_image`, `qty`, `price`, `total_amt`, `paid`, `email`, `phone`, `adr`, `state`, `city`) 
					VALUES ('$pro_id', '$user_id', '$btc', '$fullname', '$pro_name', '$pro_image', '$qty', '$pro_price', '$total', '1500', '$email', '$phone', '$address', '$state', '$city')";
					$run_query_into = mysqli_query($con,$sql_into);
					if($run_query_into){
					    $_SESSION['id'] = $email;
						$response["success"] = true;
						
					}
				}
				echo json_encode($response);
			}
	}
	}
	}
}

if(isset($_POST["view_final"])){

	if(isset($_SESSION["guest_uid"])){
	$uid = $_SESSION["guest_uid"];
	$sql = "SELECT * FROM guest_cart WHERE user_id = '$uid'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
	if($count > 0){
		$total_sum = 0;
		while($row=mysqli_fetch_array($run_query)){
			$pro_name = $row["product_title"];
			$qty = $row["qty"];
			$pro_price = $row["price"];
			$total = $row["total_amt"];
			$total_sum = $total_sum + $total;
			$_SESSION['total_final'] = $total_sum; 
				echo " 
				<tr class='cart_item'>
				<td class='product-name'>
					$pro_name &nbsp;
					<strong class='product-quantity'>× $qty</strong>													
					</td>
				<td class='product-total'>
					<span class='woocommerce-Price-amount amount'><span class='woocommerce-Price-currencySymbol'>₦</span>$total_sum</span>						
					</td>
				</tr>
				"  ;
		}
	

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
            <a href='../view/view.php' class='button wc-forward'>View cart</a>
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

if(isset($_POST["removeFromOrder"])){
	$pid = $_POST["removeId"];

		if(isset($_SESSION['guest_uid'])){
			$uid = $_SESSION["guest_uid"];
			$price = $_SESSION['t_amount'];
			$sql = "SELECT * FROM guest_cart WHERE user_id = '$uid' AND id = '$pid'";
			$run_query = mysqli_query($con,$sql);
			while($row=mysqli_fetch_array($run_query)){
				$pro_price = $row["price"];
				$_SESSION['t_amount'] = $pro_price - $price;
			}
			
			$sql = "DELETE FROM guest_cart WHERE user_id = '$uid' AND id = '$pid'";
			$run_query = mysqli_query($con,$sql);

			if($run_query){
				echo "
				removed from cart
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