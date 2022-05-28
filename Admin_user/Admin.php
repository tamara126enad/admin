<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="table.css"> -->
    <style>
       .home{
            width: 98%;  
            color: #fff;
            margin-left: 8%;}
            table{width:80%;}
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
                <h2>Users Details</h2><br>
                   

                    <?php
                    include_once '../Configration/connection.php';
                    $sql = "SELECT * FROM register;";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                         
                            echo '<table>';
                                echo "<thead>";
                                    echo "<tr >";
                                        echo "<th> Id &emsp; </th>";
                                        echo "<th>First Name</th>";
                                        // echo "<th>Secound Name</th>";
                                        echo "<th>Family Name</th>";
                                        echo "<th>Phone Number</th>";
                                        // echo "<th>Date of Birth</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Password</th>";
                                        echo "<th>Confirm Password</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['First_Name'] . "</td>";
                                        // echo "<td>" . $row['Sec_Name'] . "</td>";
                                        echo "<td>" . $row['Last_Name'] . "</td>";
                                        echo "<td>" . $row['Phone_Num'] . "</td>";
                                        // echo "<td>" . $row['DOB'] . "</td>";
                                        echo "<td>" . $row['Email'] . "</td>";
                                        echo "<td>" . $row['Password'] . "</td>";
                                        echo "<td>" . $row['con_Password'] . "</td>";

                                       
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
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