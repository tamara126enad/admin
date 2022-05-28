<?php
// Include config file
include_once '../Configration/connection.php';
 
// Define variables and initialize with empty values
$Cat_name = "";
$CatName_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    $input_name = trim($_POST["category_name"]);
    if(empty($input_name)){
        $CatName_err = "Please Enter a Category Name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^([a-zA-Z' ]+)$/")))){
        $CatName_err = "Please enter a valid Category Name.";
    } else{
        $Cat_name = $input_name;
    }
    
    // Check input errors before inserting in database
    if(empty($CatName_err)){
        // Prepare an update statement
        
        $sql="UPDATE categories SET category_name='$Cat_name' WHERE category_id=$_GET[category_id];";
        
        if(mysqli_query($conn, $sql)){
            header("location:Admin_cat.php");
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
if(isset($_GET["category_id"]) && !empty(trim($_GET["category_id"]))){
    // Get URL parameter
    $id =  trim($_GET["category_id"]);
    
    // Prepare a select statement
    $sql = "SELECT * FROM categories WHERE category_id=?";
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
                $id=$row['category_id'];
                $Cat_name = $row["category_name"];

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
                            <label>Category Name</label>
                            <input type="text" name="category_name" class="form-control <?php echo (!empty($CatName_err )) ? 'is-invalid' : ''; ?>" value="<?php echo $Cat_name; ?>">
                            <span class="invalid-feedback"><?php echo $CatName_err ;?></span>
                        </div>

                        <input type="hidden" name="category_id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="Admin_cat.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>