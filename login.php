<?php
    session_start();
    $msg='';
    if (isset($_SESSION["SESSION_EMAIL"])) {
        header("Location: welcome.php");
    }

    if (isset($_POST["signin"])) {
        include 'config.php';

        $time=time()-600;
        $ip_address=getIpAddr();
        $check_login_row=mysqli_fetch_assoc(mysqli_query($conn,"select count(*) as toal_count from
        login_log where try_time>$time and ip_address='$ip_address'"));
        $total_count=$check_login_row['toal_count'];
        if($total_count==3){
            $msg="Too many failed login attempts. <br>Please wait for 10 mins";

        }else{

            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $password = mysqli_real_escape_string($conn, md5($_POST["password"]));
            $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);

            if ($count === 1) {
                $row = mysqli_fetch_assoc($result);
                    $_SESSION["SESSION_EMAIL"] = $email;
                    header("Location: welcome.php");
                    mysqli_query($conn, "delete from login_log where ip_address='$ip_address'");
    ?>
        <?php
            }else {
                $total_count++;
                $rem_attm=3-$total_count;
                if($rem_attm==1){
                    $msg="To many failed login attempts. <br>Please wait for 10 mins";
                }else{
                    $msg="Please enter valid login details.<br/>$rem_attm attempts remaining";
                }
                $try_time=time();
                mysqli_query($conn,"insert into login_log(ip_address,try_time) values('$ip_address','$try_time')");
				$msg="Please enter valid login details.<br/>$rem_attm attempts remaining";
                }
            }
        }

                function getIpAddr(){
                if (!empty($_SERVER['HTTP_CLIENT_IP'])){
                    $ipAddr=$_SERVER['HTTP_CLIENT_IP'];
                }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                    $ipAddr=$_SERVER['HTTP_X_FORWARDED_FOR'];
                }else{
                    $ipAddr=$_SERVER['REMOTE_ADDR'];
                }return $ipAddr;
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

include 'template/topbar.php';

?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php

include 'template/navbar.php';

?>
    <!-- Navbar End -->

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Login</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Login Form Start -->
        <div class="container-xxl service py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-primary text-uppercase">// Login Account //</h6>
                </div>
            </div>
            <br>
                <div class="box">
                    <div class="col-md-5">
                        <h1>Log In Account</h1>
                    <br>
                    <form name="myform2" action="login.php" method="POST">



                        <p class="p_black">Email</p>
                        <input type="email" name="email" placeholder="Enter your email address" required="">
                        <br><br>

                        <p class="p_black">Password</p>
                        <input type="password" name="password" placeholder="Enter your password"  required="">
                        <br>
                        <input type="submit" name="signin" value="Login" class="btn">

                        <br>
                        <div id="result"><?php echo $msg?></div>


                        <br><a class="create_acc" style="color: black;" href="register.php"> If you haven't, Create New Account!</a></button>

                    </form>
                        </div>
                        </div>
                    </div>
            <!-- Login Form End -->

                        <!-- Footer Start -->
<?php

include 'template/footer.php';

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
