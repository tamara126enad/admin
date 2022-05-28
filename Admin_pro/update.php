<?php
session_start();
// Include config file
include_once '../Configration/connection.php';
 
// Define variables and initialize with empty values
$product_name  =$price = $description= $status = $img=  "";
$productname_err = $description_err = $price_err = $status_err =$img_err= "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    $input_name = trim($_POST["product_name"]);
    if(empty($input_name)){
        $productname_err = "Please Enter an Update a Product Name.";
    }elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^([a-zA-Z' ]+)$/")))){
        $productname_err = "Please enter a valid Update Product Name.";
    }else{
        $product_name = $input_name;
    }



    $input_descip = trim($_POST["description"]);
    if(empty($input_descip)){
        $description_err = "Please Enter  a Product desciption.";
    }else{
        $description = $input_descip;
    }



    $input_name1 = trim($_POST["price"]);
    if(empty($input_name1)){
        $price_err = "Please Enter an Update a Product Price.";
    }elseif(!filter_var($input_name1, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/[0-9]/")))){
        $price_err = "Please enter a valid Update Product Price.";
    }else{
        $price = $input_name1;
    }
    
    $input_name2 = trim($_POST["status"]);
    $_SESSION['status']=$input_name2;
    echo $input_name2;
    if(empty($input_name2)){
        $status_err = "Please Enter an Update a Product status.";
    }elseif((($input_name2 != 0)&&($input_name2 != 1))){
        $status_err = "Please enter a valid Update Product status.";
    }else{
        $status = $input_name2;
    }

    $input3 = trim($_POST["img"]);
    if(empty($input3)){
        $img_err = "Please Enter path for Product img : ../img/example.png";
    }{
        $img = $input3;
    }
    
    // Check input errors before inserting in database
    if(empty($productname_err) &&  empty($description_err) && empty($price_err) && empty($img_err) && empty($status_err)){
        // Prepare an update statement
        
        $sql="UPDATE products SET product_name='$product_name', description='$description' , price='$price' ,img='$img', status='$status'  WHERE product_id=$_GET[product_id];";
        
        if(mysqli_query($conn, $sql)){
            header("location:Admin_pro.php");
        }else{
            echo "Eroor: ". $sql."<br>". mysqli_error($conn);}}
    else{
            echo '<script language="javascript">';
            echo 'alert("Oops! Something went wrong. Please try again later")';
            echo '</script>';
          } 
    // Close connection
    mysqli_close($conn);
        
}else{
    // Check existence of id parameter before processing further
if(isset($_GET["product_id"]) && !empty(trim($_GET["product_id"]))){
    // Get URL parameter
    $id =  trim($_GET["product_id"]);
    
    // Prepare a select statement
    $sql = "SELECT * FROM products WHERE product_id=?";
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = $id;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                // Retrieve individual field value
                $id=$row['product_id'];
                $product_name = $row["product_name"];
                $description = $row["description"];
                $price = $row["price"];
                $status = $row["status"];
                $img=$row['img'];

        }else{
                    // URL doesn't contain valid id. Redirect to error page
                    // header("location: error.php");
                    echo "welcome error ";
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        // header("location: error.php");
        echo "welcome error ";

        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the Category record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">


                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control <?php echo (!empty($productname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_name; ?>">
                            <span class="invalid-feedback"><?php echo $productname_err ;?></span>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
                            <span class="invalid-feedback"><?php echo $description_err ;?></span>
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $price_err ;?></span>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            
                            <input type="number" name="status" class="form-control <?php echo (!empty($status_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $status; ?>">
                            <span class="invalid-feedback"><?php echo $status_err ;?></span>
                        </div>

                       <div class="form-group">
                            <label>img</label>
                            <input type="text" name="img" class="form-control <?php echo (!empty($img_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $img; ?>">
                            <span class="invalid-feedback"><?php echo $img_err ;?></span>
                        </div>


                        <input type="hidden" name="product_id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="Admin_pro.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>