<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <style>
     .home{ width: 95%;  
            color: #fff;
            margin-left: 8%;}
            table{width:70%;}
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
           <h2>Category Details</h2><br>
                   
                    <?php
                    // Include config file
                    include_once '../Configration/connection.php';
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM categories;";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){

                            echo '<table>';
                                echo "<thead>";
                                    echo "<tr>";
                                    echo "<th> Id &emsp;&emsp; </th>";
                                        echo "<th>Category Name</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){

                                    echo "<tr>";
                                        echo "<td style='width:20px'>" . $row['category_id'] . "</td>";
                                        echo "<td>" . $row['category_name'] . "</td>";

                                        // echo "<td>";
                                        //     echo '<a href="update.php?category_id='. $row['category_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                        //     echo '<a href="delete.php?category_id='. $row['category_id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        // echo "</td>";
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
</body>
</html>