
<?php

$msg='';

include 'config.php';

error_reporting(0);   

    if (isset($_POST["signup"])) {

        $uname = mysqli_real_escape_string($conn, $_POST["signup_user_name"]);
        $email = mysqli_real_escape_string($conn, $_POST["signup_email"]);
        $mobile_no = mysqli_real_escape_string($conn, $_POST["signup_mobile_no"]);
        $address = mysqli_real_escape_string($conn, $_POST["signup_address"]);
        $password = mysqli_real_escape_string($conn, md5($_POST["signup_password"]));
        $cpassword = mysqli_real_escape_string($conn, md5($_POST["signup_cpassword"]));

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            echo "<script>alert('{$email} - This email has already taken.');</script>";
        }else {
            if ($password !== $cpassword) {
                echo "<script>alert('Password did not match.');</script>";
              } else {
                $sql = "INSERT INTO users (user_name, email, mobile_no, address, password) 
                VALUE ('$uname', '$email', '$mobile_no', '$address', '$password')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                  $_POST["signup_user_name"] = "";
                  $_POST["signup_email"] = "";
                  $_POST["signup_mobile_no"] = "";
                  $_POST["signup_address"] = "";
                  $_POST["signup_password"] = "";
                  $_POST["signup_cpassword"] = "";
            
                  echo "<script>alert('User registration successfully.');</script>";{

?>  
                <script>window.location.href='login.php';
                </script>"  

<?php
                  }

                } else "<script>alert('User registration failed.');</script>";
              }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Brilliant Car Services</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
<?php

include "template/topbar.php";

?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
<?php

include "template/navbar.php";

?>
    <!-- Navbar End -->

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Register</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Register</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <div class="container-xxl service py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-primary text-uppercase">// Create Account //</h6>
                </div>
            </div>
            <br>
                <div class="box">
                    <div class="col-md-5">
                        <h1>Register Here</h1>
                    <br>
                            <form name="register" action="register.php" method="POST">
                            <p class="p_black">Username</p>
                            <input type="text" name="signup_user_name" placeholder=" Username" 
                            id="username" value="<?php echo $_POST["signup_user_name"]; ?>" required="">
                            <br><br>
                            <p class="p_black">Email</p>
                            <input type="text" name="signup_email" placeholder=" Email Address" 
                            id="email" value="<?php echo $_POST["signup_email"]; ?>" required="">
                            <br><br>
                            <p class="p_black">Mobile Number</p>
                            <input type="number" name="signup_mobile_no" placeholder=" Enter your mobile number"
                            id="number" value="<?php echo $_POST["signup_mobile_no"]; ?>" required="">
                            <br><br>
                            <p class="p_black">Address</p>
                            <input type="text" name="signup_address" placeholder=" Enter your current address" 
                            id="address" value="<?php echo $_POST["signup_address"]; ?>" required="">
                            <br><br>
                            <p class="p_black">Password</p>
                            <input type="password" name="signup_password" placeholder=" Enter a new password" 
                            id="password" value="<?php echo $_POST["signup_password"]; ?>" required="">
                            <br><br>
                            <p class="p_black">Confirm Password</p>
                            <input type="password" name="signup_cpassword" placeholder=" Retype your password"
                            id="con_password" value="<?php echo $_POST["signup_cpassword"]; ?>" required="">
                            <br>
                            <input type="submit" name="signup" value="Register" class="btn">
                            <br>
                            <a class="create_acc" href="login.php" style="color: black;">Already have an account, login!</a></button>
                        </form>

                        </div>
                        </div>
                    </div>
                    
                        <!-- Footer Start -->
<?php

include "template/footer.php";

?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
                                    

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>