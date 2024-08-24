<?php
session_start();


/**
 * define the number of ../ to get to the root folder
 */
define('ROOT_LEVEL', '');

/**
 * require the general functions file
 */
require(ROOT_LEVEL . 'include/functions.php');
?>

<html>
<head>
    <link rel="stylesheet" href="provided-assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <script src="provided-assets/jquery-3.4.1.js"></script>
    <script src="provided-assets/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col">
            <?php  
            if (isset($_SESSION['errors'])) {
                echo '<script>alert("' . $_SESSION['errors'] . '")</script>';
                $_SESSION['errors'] = null;
            }
            
            ?>

            <h1>Login</h1>

            <form class="form" action="scripts/login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="login" class="btn btn-primary">
                </div>
            </form>
        </div>

    </div>
</div>

</body>


</html>