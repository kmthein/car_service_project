<?php
    session_start();
    if (isset($_SESSION["user_name"])) {
        header("Location: index.php");
    } include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="css/admin.css" rel="stylesheet">
</head>
<body>
<?php
    require('config.php');
    if(isset($_POST['signin'])){
        $username = stripslashes($_POST['user_name']);
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $sql = "SELECT * FROM admin WHERE user_name = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);
        if($rows == 1){
            $_SESSION['user_name'] = $username;
            header('Location: index.php');
        } else {
            echo "<script>alert('Invalid username or password, try again.');</script>";
        }
    }
?>
<div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    ADMIN LOGIN
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="text" name="user_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" name="signin" class="btn btn-outline-primary">LOGIN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
</body>
</html>