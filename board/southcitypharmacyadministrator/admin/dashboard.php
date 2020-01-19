<?php 

session_start();
include "../../../db.php";

if (isset($_POST["submit"])) {

    function check_input($dt)
    {
        $data = trim($dt);
        $data = stripslashes($dt);
        $data = htmlspecialchars($dt);
        return $data;
    }

    $user_login = check_input($_POST['user_login']);
    $password = check_input($_POST['password']);
    $errors = array();
    $response = array();

    if (empty($_POST['user_login']) || empty($_POST['password'])) {

        if (empty($_POST['user_login'])) {
            $errors["username"] = "* needed";
        }

        if (empty($_POST['password'])) {
            $errors["password"] = "* needed";
        }

        $response["errors"] = $errors;

        $response["success"] = false;
        echo json_encode($response);
    }
    if (!empty($_POST['user_login']) && !empty($_POST['password'])) {

        $sql1 = "SELECT * FROM users WHERE username = '$user_login'";
        $query1 = mysqli_query($con, $sql1);
        if (mysqli_num_rows($query1) > 0) {
            while ($row = mysqli_fetch_array($query1)) {
                $username = $row["username"];
                $pass_word = $row["pass_word"];
                    $_SESSION['uid'] = $username;
                    $response["success"] = true;
                
            }
        } elseif (mysqli_num_rows($query1) < 1) {

            $response["username"] = "* Doesnt exists";
            $response["invaliduser"] = true;
        }

        echo json_encode($response);
    }
}






if(isset($_POST["category"])){
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
            $cat_name = $row["cat_title"];

            echo "
            
            <tr role='row' class='' id='$cid'>
            <td class='sorting_1'>
                <input class='form-check-input' type='checkbox' value='$cid'>
            </td>
            <td>$cat_name</td>
            <td>
                <div class='form-button-action'>
                    <button eclicked='$cid' type='button' cat='$cat_name' id='ed' class='btn btn-link btn-primary btn-lg' data-toggle='modal' data-target='#addRowModal2'>
                        <i class='fa fa-edit'></i>  
                    </button>
                    <button dclicked='$cid' type='button' data-toggle='tooltip' title='' id='del' class='btn btn-link btn-danger' data-original-title='delete'>
                        <i class='fa fa-times'></i>
                    </button>
                </div>
            </td>
        </tr>
            ";
		}
	}
}



if(isset($_POST["products"])){
	$product_query = "SELECT * FROM products";
	$run_query = mysqli_query($con,$product_query) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
            $product_id = $row["product_id"];
            $product_cat = $row["product_cat"];
            $product_title = $row["product_title"];
            $product_price = $row["product_price"];
            $product_desc = $row["product_desc"];
            $product_image = $row["product_image"];
            $trimdesc = trim($product_desc);

            $category = "SELECT * FROM categories WHERE `cat_id` = '$product_cat'";
            $run_query2 = mysqli_query($con,$category) or die(mysqli_error($con));
            if(mysqli_num_rows($run_query2) > 0){
                while($row = mysqli_fetch_array($run_query2)){
                    $cid = $row["cat_id"];
                    $cat_name = $row["cat_title"];


                    echo "
            
                    <tr role='row' class=''>
                    <td class='sorting_1'>
                        <input class='form-check-input' type='checkbox' value=''>
                    </td>
                    <td><img src='../../../$product_image' width='80%'></td>
                    <td>$product_title</td>
                    <td>$cat_name</td>
                    <td>$product_price</td>
                    <td>
                        <div class='form-button-action'>
                            <button type='button' eclicked='$product_id' prod='$product_title' price='$product_price' pcat='$product_cat' id='prod-ed' class='btn btn-link btn-primary btn-lg' data-toggle='modal' data-target='#editrow' >
                                <i class='fa fa-edit'></i>
                                <p id='getproddesc' style='display:none;'>$trimdesc</p>
                            </button>
                            <button type='button' dclicked='$product_id' data-toggle='tooltip' id='prod-del' class='btn btn-link btn-danger' data-original-title='delete'>
                                <i class='fa fa-times'></i>
                            </button>
                        </div>
                    </td>
                </tr>
                    ";
                }

            }


		}
	}
}


if(isset($_POST["paystack"])){
	$p_query = "SELECT * FROM order_list";
	$r_query = mysqli_query($con,$p_query) or die(mysqli_error($con));
	if(mysqli_num_rows($r_query) > 0){
		while($row = mysqli_fetch_array($r_query)){
            $user_id = $row["user_id"];
            $fullname = $row["fullname"];
            $product_title = $row["product_title"];
            $qty = $row["qty"];
            $address = $row["adr"];
            $phone = $row["phone"];
            $email = $row["email"];
            $total_amt = $row["total_amt"];
            $state = $row["state"];
            $city = $row["city"];
            	
        echo "
        <tr>
		    <td>$fullname</td>
		    <td>$product_title</td>
		    <td>$total_amt</td>
		    <td>$qty</td>
            <td>$address</td>
            <td>$city</td>
            <td>$state</td>
            <td>$phone</td>
		    <td>$email</td>
            <td>verify</td>
		</tr>
        ";

		}
	}
}




if(isset($_POST["delete"])){
    $catitem = $_POST['catitem'];
    $response = array();
	$category_query = "DELETE FROM `categories` WHERE cat_id = '$catitem'";
	$run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
	if($run_query){
        $response["success"] = 1;
    }
    echo json_encode($response);
}



if(isset($_POST["prodelete"])){
    $product_id = $_POST['proditem'];
    $response = array();
	$product_query = "DELETE FROM `products` WHERE product_id = '$product_id'";
	$run_query = mysqli_query($con,$product_query) or die(mysqli_error($con));
	if($run_query){
        $response["success"] = 1;
    }
    echo json_encode($response);
}








if(isset($_POST["editcategory"])){
    $catinput = $_POST['catinput'];
    $catholder = $_POST['catholder'];
    $errors = array();
    $response = array();
    if(empty($_POST['catinput'])){

        if(empty($_POST['catinput'])){
         $errors["noinput"] = "* enter a category name";  
         $errors["catholder"] = $catholder;
         $errors["catinput"] = $catinput;

        }
        

        $response["errors"] = $errors;

        $response["success"] = false;
        echo json_encode($response);
        exit;
    }
    if(!empty($_POST['catinput'])){
        $category_query = "UPDATE `categories` SET `cat_title`= '$catinput' WHERE `cat_title`='$catholder'";
        $run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
        if($run_query){
            $response["success"] = 1;
        }
        echo json_encode($response);
    }
}


if(isset($_POST['cat_names'])){

    $cat_names = "SELECT * FROM categories";
    $run_query = mysqli_query($con,$cat_names) or die(mysqli_error($con));
    if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$cid = $row["cat_id"];
            $cat_name = $row["cat_title"];

            echo "<option cid='$cid' name='catselect'>$cat_name</option>";
		}
	}

}


if(isset($_POST["editproduct"])){
    header("Content-Type: application/json");
    $errors = array();
    $response = array();

    $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code=substr(str_shuffle($set), 0, 12);
    $target_dir = "../../southcitypharmacyadministrator/admin/test_upload";
    $target_file = $target_dir . basename($_FILES["filetochange"]["name"]);

    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


    

    if(empty($_FILES["filetochange"]["name"]) || empty($_POST['editname']) || empty($_POST['editprice']) || !is_numeric($_POST['editprice'])){
       
        
        if(empty($_POST['editname'])){
         $errors["name"] = "* enter product name";  
        }

        if(empty($_FILES["filetochange"]["name"])){
         $errors["image"] = "* enter image";  
        }


        if(empty($_POST['editprice'])){
         $errors["price"] = "* enter num";  
        }elseif(!is_numeric($_POST['editprice'])){
         $errors["price"] = "* enter valid num";
        }
    
        $response["errors"] = $errors;

        $response["success"] = false;
        echo json_encode($response);
        exit;
    }    
    if($imageFileType != "jpeg" && $imageFileType != "jpg" && $imageFileType != "png"){


           $errors["format"] = $imageFileType;
           $response["errors"] = $errors;
   
           $response["success"] = false;
           echo json_encode($response);
           exit;

    }
    if(!empty($_FILES["filetochange"]["name"]) || !empty($_POST['editname']) || !empty($_POST['editdesc']) || !empty($_POST['editprice']) || is_numeric($_POST['editprice'])){
        
        $thisproduct = $_POST['thisproduct'];
        $editname = $_POST['editname'];
        $editdesc = $_POST['editdesc'];
        $editprice = $_POST['editprice'];
        $pro_cat = $_POST['sel'];

        $name = pathinfo($target_file);
        $newname = $name['filename'] . $code . "." . $imageFileType;
         
    
        $image_path=$target_dir . $newname;
    
        $category_query = "UPDATE `products` SET `product_title`='$editname',`product_price`='$editprice',`product_desc`='$editdesc',`product_image`='$image_path' WHERE `product_id` = '$thisproduct'";
        $run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
        if($run_query){
            $response["cwd"] = getcwd();
            $response["doc"] = $_SERVER['PHP_SELF'];
            $response["success"] = 1;
            move_uploaded_file($_FILES["filetochange"]["tmp_name"],$target_dir . $newname);
        }
        echo json_encode($response);
        
    }
}







if(isset($_POST["addcategory"])){
    $catinput = $_POST['catinput'];
    $errors = array();
    $response = array();
    if(empty($_POST['catinput'])){

        if(empty($_POST['catinput'])){
         $errors["noinput"] = "* enter a category name"; 
        }
 
        $response["errors"] = $errors;
        $response["success"] = false;
        echo json_encode($response);
        exit;
    }
    if(!empty($_POST['catinput'])){

        $category_query = "INSERT INTO `categories`(`cat_title`) VALUES ('$catinput')";
        $run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
        if($run_query){
            $response["success"] = 1;
        }
        echo json_encode($response);

    }
}





?>