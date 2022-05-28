<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="table.css">
    <style>
       .home{ width: 99%;  
            color: #fff;
            margin-left: 2%;}

            table{width:98%;}

    th,td{padding: 1%; border:2px solid #000}
    thead{background: #6c3e3e57;} 

    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="home">
       <h2 >Product Details</h2>
                  
                    <?php

                    // Include config file
                    include_once '../Configration/connection.php';
                  
                    // Attempt select query execution
                    $sql = "SELECT * FROM products;";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                              echo '<table>';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th style='text-align:center'> &emsp; ID &emsp;&emsp;</th>";
                                            echo "<th style='text-align:center'>Product Name</th>";
                                            echo "<th style='text-align:center'>Description</th>";
                                            echo "<th style='text-align:center'>Price&emsp;&emsp;</th>";
                                            echo "<th style='text-align:center'>Status&emsp;&emsp;</th>";
                                            echo "<th style='text-align:center'>Category&emsp;&emsp;</th>";

                                            echo "<th style='text-align:center'>Img</th>";
                                        
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){

                                    echo "<tr>";
                                        echo "<td  >" . $row['product_id'] . "</td>";
                                        echo "<td>" . $row['product_name'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['price'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td>" . $row['category_id'] . "</td>";
                                        echo "<td><img style='width:90%' src=". $row['img'] ."></td>";



                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    }else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>

</html>