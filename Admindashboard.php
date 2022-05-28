<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
    <!-- <link rel="stylesheet" href="dashboard.css"> -->
    <title>Admin dashboard</title>
    <style>
        body {background-color: #591213;
            background-image: linear-gradient(250deg,#537895 0%, #09203f 30%, #000 70%, #000 100%);
            background-repeat: no-repeat;
            background-size: 100% 280%;
            color: #fff;
            font-weight: bold;        }

        a { text-decoration: none;
            color: #fff;
        }

        a:visited {       color: #fff;}     
        a:active {
            color: #09203f;        }  

        li { list-style: none;
            margin-bottom: 6%;
        }

        .all { width: 98%;
            background-color: rgba(255, 255, 255, 0.200);
            margin-left: 1%;
            border-radius: 30px;
            padding-bottom: 2%;
            height: 93vh;
        }

        .head{display: flex;
          justify-content: space-between;
         align-items: center;
         width: 90%;
        margin-left: 7%;}

        .admin-frame {
            width: 99%;
            background: rgba(255, 255, 255, 0.200);
            height:82vh; 
             margin-top: 1.6%;
            border-bottom-left-radius:20px ;
            border-bottom-right-radius: 20px;
        }

        .setting{display: grid;
        grid-template-columns: 22%  78%;}


        .control-ul{background: rgba(255, 255, 255, 0.200);
        border-radius: 12px;
        width: 90%;
         margin-left: 3%;
        padding-bottom: 5%;
    }
    .titled-h3{text-align: center; background: #591213; padding-block: 1%;}

    .link-out{font-family: 'Patrick Hand', cursive;font-size: x-large; }
    .link-out:hover{color: #09203f;}

        /* .bg{border: 3px #fff solid;} */
    </style>
</head>

<body>

    <div class="all">
        <div class="head bg">
            <img src="img/logo_kids.gif" width="60px">
            <h1>A d m i n &ensp;&ensp;D a s h b o a r d</h1>
            <a href="Login/Login.php" class="link-out">Logout</a>
        </div>


        <div class="setting bg">
           
            <div class="aside-control  bg">
                <aside>
                    <div class="control-ul">
                <h3 class="titled-h3">Users</h3>
                <ul>
                    <li><a href="Admin_user/Admin.php" target="iframe"><i class="far fa-eye"></i>&ensp;
                            view User
                        </a></li>
                    <li><a href="Admin_user/Admin1.php" target="iframe"> <i class="fas fa-pencil-alt"></i>&ensp;
                           Add or Edit User
                        </a></li>
                </ul></div>

                <div class="control-ul">
                <h3 class="titled-h3">Categories</h3>
                <ul>
                    <li><a href="Admin_cat/Admin_cat.php" target="iframe"><i class="far fa-eye"></i>&ensp;
                         View Category
                        </a></li>
                    <li><a href="Admin_cat/Admin_cat1.php" target="iframe"> <i class="fas fa-pencil-alt"></i>&ensp;
                           Add or Edit Category
                        </a></li>
                </ul></div>

                <div class="control-ul">
                <h3 class="titled-h3">Products</h3>
                <ul>
                    <li><a href="Admin_pro/Admin_pro.php" target="iframe"><i class="far fa-eye"></i>&ensp;
                    view product
                        </a></li>
                    <li><a href="Admin_pro/Admin_pro1.php" target="iframe"> <i class="fas fa-pencil-alt"></i>&ensp;
                    Add or Edit product
                        </a></li>
                </ul></div>

            </aside>
            </div>
 
            <iframe src="page.html" frameborder="2px" name="iframe" class="admin-frame"></iframe>


        </div>

 </div>
</body>

<script>


    
</script>

</html>