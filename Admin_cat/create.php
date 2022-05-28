<?php
// Include config file
include_once '../Configration/connection.php';
 
// Define variables and initialize with empty values
$Cat_name = "";
$CatName_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate first name
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
        // Prepare an insert statement
        $sql =" INSERT INTO categories(category_name) VALUES ('$Cat_name');";
         
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
        }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        body{background-color: none;}
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add Category record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="category_name" class="form-control <?php echo (!empty($CatName_err )) ? 'is-invalid' : ''; ?>" value="<?php echo $Cat_name; ?>">
                            <span class="invalid-feedback"><?php echo $CatName_err ;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="Admin_cat.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>