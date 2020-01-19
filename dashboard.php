<?php 

session_start();
include "db.php";



if(isset($_POST["editproduct"])){
    header("Content-Type: application/json");
    $errors = array();
    $response = array();

    $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code=substr(str_shuffle($set), 0, 12);
    $target_dir = "wp-content/uploads/products/products/imgboard/";
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
        $response["editdesc"] = $_POST['editdesc'].PHP_EOL;
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
        $category = "SELECT * FROM categories WHERE `cat_title` = '$pro_cat'";
        $cat_query = mysqli_query($con,$category) or die(mysqli_error($con));
        if($cat_query){
            while($row = mysqli_fetch_array($cat_query)){
                $cid = $row["cat_id"];
                $cat_name = $row["cat_title"];
                $pronum = $cid;
            }
        }

        $response["prod"] = $pronum;
        $category_query = "UPDATE `products` SET `product_cat` = '$pronum', `product_title`='$editname',`product_price`='$editprice',`product_desc`='$editdesc',`product_image`='$image_path' WHERE `product_id` = '$thisproduct'";
        $run_query = mysqli_query($con,$category_query) or die(mysqli_error($con));
        if($run_query){
            $response["success"] = 1;
            move_uploaded_file($_FILES["filetochange"]["tmp_name"],$target_dir . $newname);
        }
        echo json_encode($response);
        
    }
}



if(isset($_POST["addproduct"])){
    header("Content-Type: application/json");
    $errors = array();
    $response = array();

    $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code=substr(str_shuffle($set), 0, 12);
    $target_dir = "wp-content/uploads/products/products/imgboard/";
    $target_file = $target_dir . basename($_FILES["addfile"]["name"]);

    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


    

    if(empty($_FILES["addfile"]["name"]) || empty($_POST['addname']) || empty($_POST['addprice']) || !is_numeric($_POST['addprice'])){
       
        
        if(empty($_POST['addname'])){
         $errors["name"] = "* enter product name";  
        }

        if(empty($_FILES["addfile"]["name"])){
         $errors["image"] = "* enter image";  
        }


        if(empty($_POST['addprice'])){
         $errors["price"] = "* enter num";  
        }elseif(!is_numeric($_POST['addprice'])){
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
    if(!empty($_FILES["addfile"]["name"]) || !empty($_POST['addname']) || !empty($_POST['addprice']) ||  is_numeric($_POST['addprice'])){
        
        
        $addname = $_POST['addname'];
        $adddesc = strip_tags($_POST['adddesc']);
        $adddesc = nl2br($adddesc);
        $addprice = $_POST['addprice'];
        $pro_cat = $_POST['addselection'];

        $name = pathinfo($target_file);
        $newname = $name['filename'] . $code . "." . $imageFileType;
        
    
        $image_path=$target_dir . $newname;
        $image_path=$target_dir . $newname;
        $category = "SELECT * FROM categories WHERE `cat_title` = '$pro_cat' LIMIT 1";
        $cat_query = mysqli_query($con,$category) or die(mysqli_error($con));
        if($cat_query){
            while($row = mysqli_fetch_array($cat_query)){
                $cid = $row["cat_id"];
                $cat_name = $row["cat_title"];
                $pronum = $cid;
            }
        }
   

        $response["prod"] = $image_path;
     $product_query = "INSERT INTO `products` (`product_brand`,`product_cat`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_style`, `product_keywords`) VALUES (1,'$pronum','$addname','$addprice','$adddesc','$image_path','','')";
        $run_query = mysqli_query($con,$product_query) or die(mysqli_error($con));
       if($run_query){
            $response["success"] = 1;
            move_uploaded_file($_FILES["addfile"]["tmp_name"],$target_dir . $newname);
        } 
        echo json_encode($response);
        
    }
}




if(isset($_POST["bottoml"])){
    header("Content-Type: application/json");
    $errors = array();
    $response = array();

    $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code=substr(str_shuffle($set), 0, 12);
    $target_dir = "wp-content/uploads/products/products/imgboard/";
    $target_file = $target_dir . basename($_FILES["bottomleft"]["name"]);

    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


    

    if(empty($_FILES["bottomleft"]["name"])){
       
        if(empty($_FILES["bottomleft"]["name"])){
         $errors["image"] = "* enter image";  
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
    if(!empty($_FILES["bottomleft"]["name"])){

        $name = pathinfo($target_file);
        $newname = $name['filename'] . $code . "." . $imageFileType;
        
    
        $image_path=$target_dir . $newname;
        $product_query = "UPDATE `bottomleft` SET `link` = '$image_path'";
        $run_query = mysqli_query($con,$product_query) or die(mysqli_error($con));
        if($run_query){
            $response["success"] = 1;
            move_uploaded_file($_FILES["bottomleft"]["tmp_name"],$target_dir . $newname);
        }
        echo json_encode($response);
        
    }
}




if(isset($_POST["bottomr"])){
    header("Content-Type: application/json");
    $errors = array();
    $response = array();

    $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code=substr(str_shuffle($set), 0, 12);
    $target_dir = "wp-content/uploads/products/products/imgboard/";
    $target_file = $target_dir . basename($_FILES["bottomright"]["name"]);

    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


    

    if(empty($_FILES["bottomright"]["name"])){
       
        if(empty($_FILES["bottomright"]["name"])){
         $errors["image"] = "* enter image";  
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
    if(!empty($_FILES["bottomright"]["name"])){

        $name = pathinfo($target_file);
        $newname = $name['filename'] . $code . "." . $imageFileType;
        
    
        $image_path=$target_dir . $newname;
        $product_query = "UPDATE `bottomright` SET `link` = '$image_path'";
        $run_query = mysqli_query($con,$product_query) or die(mysqli_error($con));
        if($run_query){
            $response["success"] = 1;
            move_uploaded_file($_FILES["bottomright"]["tmp_name"],$target_dir . $newname);
        }
        echo json_encode($response);
        
    }
}




if(isset($_POST["btr1"])){
    header("Content-Type: application/json");
    $errors = array();
    $response = array();

    $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code=substr(str_shuffle($set), 0, 12);
    $target_dir = "wp-content/uploads/products/products/imgboard/";
    $target_file = $target_dir . basename($_FILES["bt1"]["name"]);

    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


    

    if(empty($_FILES["bt1"]["name"])){
       
        if(empty($_FILES["bt1"]["name"])){
         $errors["image"] = "* enter image";  
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
    if(!empty($_FILES["bt1"]["name"])){

        $name = pathinfo($target_file);
        $newname = $name['filename'] . $code . "." . $imageFileType;
        
    
        $image_path=$target_dir . $newname;
        $product_query = "UPDATE `topbanner1` SET `link` = '$image_path'";
        $run_query = mysqli_query($con,$product_query) or die(mysqli_error($con));
        if($run_query){
            $response["success"] = 1;
            move_uploaded_file($_FILES["bottomright"]["tmp_name"],$target_dir . $newname);
        }
        echo json_encode($response);
        
    }
}
?>