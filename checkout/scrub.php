if(isset($_SESSION["guest_uid"])){
		$sql = "INSERT INTO `orders` 
		(`user_id`, `first_name`, `last_name`, `address`, `city`, `state`, `phone`, `ordered`) 
		VALUES ('$guest_uid', '$first_name', '$last_name', '$address', '$city', '$state', '$phone', 'yes')";
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
					(`id`, `p_id`, `user_id`, `fullname`, `product_title`, `product_image`, `qty`, `price`, `total_amt`) 
					VALUES ('$id', '$pro_id', '$user_id', '$fullname', '$pro_name', '$pro_image', '$qty', '$pro_price', '$total')";
					$run_query_into = mysqli_query($con,$sql_into);
					if($run_query_into){
						$response["success"] = true;
						echo json_encode($response);
					}
				}
			}
	}
	}