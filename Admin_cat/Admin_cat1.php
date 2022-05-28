<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
                   .home{ width: 98%;  
            color: #fff;
            margin-left: 5%;}

            table{width:70%;}

    th,td{padding: 10px; border:2px solid #000}
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
         <h2 >Category Details</h2>
                        <a href="create.php" style="background-color:lightgray; border:1px #000 solid;  border-radius:8px; padding:6px; " class="btn btn-success"><i class="fa fa-plus"></i> Add New Category</a>
                        <br><br>
                    <?php
                    // Include config file
                    include_once '../Configration/connection.php';
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM categories;";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="rwd-table">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Category Name</th>";
                                        echo "<th>Action</th>";


                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){

                                    echo "<tr>";
                                        echo "<td>" . $row['category_id'] . "</td>";
                                        echo "<td>" . $row['category_name'] . "</td>";

                                        echo "<td>";
                                            echo '<a href="update.php?category_id='. $row['category_id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a><br><br>';
                                            echo '<a href="delete.php?category_id='. $row['category_id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
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
            </div>        
        </div>
    </div>
</body>
</html>