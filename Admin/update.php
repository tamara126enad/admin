<?php
// Include config file
include_once '../Configration/connection.php';
 
// Define variables and initialize with empty values
 $fname= $sname = $lname = $dob = $phone = $email = $pass = $con_pass = "";
$fname_err = $sname_err = $lname_err = $dob_err = $phone_err = $email_err = $pass_err = $con_pass_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate first name
    $input_name = trim($_POST["First_Name"]);
    if(empty($input_name)){
        $fname_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $fname_err = "Please enter a valid name.";
    } else{
        $fname = $input_name;
    }
    
    // Validate  secound name
    $input_name2 = trim($_POST["Sec_Name"]);
    if(empty($input_name2)){
        $sname_err = "Please enter a name.";
    } elseif(!filter_var($input_name2, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $sname_err = "Please enter a valid name.";
    } else{
        $sname = $input_name2;
    }

     // Validate  Family name
     $input_name3 = trim($_POST["Last_Name"]);
     if(empty($input_name3)){
         $lname_err = "Please enter a name.";
     } elseif(!filter_var($input_name3, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
         $lname_err = "Please enter a valid name.";
     } else{
         $lname = $input_name3;
     }  


   
    // Validate Email
    $input_email = trim($_POST["Email"]);
    if(empty($input_email)){
        $email_err = "Please enter your email.";
    } elseif(!filter_var($input_email, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9][\-_\.\+\!\#\$\%\&\'\*\/\=\?\^\`\{\|]{0,1}([a-zA-Z0-9][\-_\.\+\!\#\$\%\&\'\*\/\=\?\^\`\{\|]{0,1})*[a-zA-Z0-9]@[a-zA-Z0-9][-\.]{0,1}([a-zA-Z][-\.]{0,1})*[a-zA-Z0-9]\.[a-zA-Z0-9]{1,}([\.\-]{0,1}[a-zA-Z]){0,}[a-zA-Z0-9]{0,}$/i")))){
        $email_err = "Please enter a valid Email.";
    } else{
        $email = $input_email;
    }  
   
    $input_dob = trim($_POST["DOB"]);
    if(empty($input_dob)){
        $dob_err ="Please enter your birth of date.";
    }elseif(((floor((time()-strtotime($input_dob))/31556926)))>16){
        $dob=$input_dob;
    }else{
        $dob_err ="dd/mm/yyyy";
    } 

    // Validate phone number
    $phone_regex="/^\\(?([0-9]{3})\\)?[-.\\s]?([0-9]{3})[-.\\s]?([0-9]{4})?[-.\\s]?([0-9]{4})$/";
    $input_phone = trim($_POST["Phone_Num"]);
    if(empty($input_phone)){
        $phone_err = "Please enter your phone number .";     
    }elseif(!preg_match($phone_regex,$input_phone)){
         $phone_err ="Please enter your phone number from 14 digit !.";
    }else{
        $phone = $input_phone;
    }


     // Validate Password
      $input_pass = trim($_POST["Password"]);
      if(empty($input_pass)){
          $pass_err = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
      }elseif(!filter_var($input_pass, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/")))){
          $pass_err = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
      }else{
          $pass = $input_pass;
      }  

    // Validate con Password
      $input_conpass = trim($_POST["con_Password"]);
      if(empty($input_conpass)){
          $con_pass_err = "Please Enter Your Password matche the above password !";
      }elseif($input_conpass == $pass){
        $con_pass = $input_conpass;
      }else{
        $con_pass_err = "Password Dosent Match !";

      } 
    
    // Check input errors before inserting in database
    if(empty($fname_err) && empty($sname_err) && empty($lname_err) && empty($dob_err) && empty($phone_err) && empty($pass_err) && empty($con_pass_err)){
        // Prepare an update statement
        
        $sql="UPDATE register SET First_Name='$fname', Sec_Name='$sname', Last_Name='$lname', DOB='$dob', Phone_Num='$phone',  Email='$email', Password='$pass', con_Password='$con_pass' WHERE id=$_GET[id];";
        
        if(mysqli_query($conn, $sql)){
            header("location:Admin.php");
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
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM register WHERE id = ?";
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
                    $id=$row['id'];
                    $fname = $row["First_Name"];
                    $sname = $row["Sec_Name"];
                    $lname = $row["Last_Name"];
                    $email = $row["Email"];
                    $phone = $row["Phone_Num"];
                    $dob = $row["DOB"];
                    $pass = $row["Password"];
                    $con_pass = $row["con_Password"];

                }else{
                        // URL doesn't contain valid id. Redirect to error page
                        header("location: error.php");
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
        echo "error";
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
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="First_Name" class="form-control <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>">
                            <span class="invalid-feedback"><?php echo $fname_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Secound Name</label>
                            <input type="text" name="Sec_Name" class="form-control <?php echo (!empty($sname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sname; ?>">
                            <span class="invalid-feedback"><?php echo $sname_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Family Name</label>
                            <input type="text" name="Last_Name" class="form-control <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lname; ?>">
                            <span class="invalid-feedback"><?php echo $lname_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="Date" name="DOB" class="form-control <?php echo (!empty($dob_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dob; ?>">
                            <span class="invalid-feedback"><?php echo $dob_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" name="Phone_Num" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone ; ?>">
                            <span class="invalid-feedback"><?php echo $phone_err ;?></span>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="Password" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pass; ?>">
                            <span class="invalid-feedback"><?php echo $pass_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="con_Password" class="form-control <?php echo (!empty($con_pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $con_pass; ?>">
                            <span class="invalid-feedback"><?php echo $con_pass_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn" style="background-color:#e55951"  value="Submit">
                        <a href="./Admin.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>