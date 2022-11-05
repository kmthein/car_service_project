<?php
    session_start();
    if (!isset($_SESSION["SESSION_EMAIL"])) {
        header("Location: index.php");
    } include 'config.php';

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
<?php
    include "template/topbar.php";
?>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-car me-3"></i>Brilliant Car Services</h2>
        </a>
        <!--  -->

        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="service.php" class="nav-item nav-link">Services</a>
                <?php
                $sql = "SELECT * FROM users WHERE email='{$_SESSION["SESSION_EMAIL"]}'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                }

                ?>
<?php
            "<script>alert('Booking Successful!');</script>";
?>
                
                <a href="history.php" class="nav-item nav-link">History</a>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
                <!-- <a href="cart.html" class="nav-item nav-link">Checkout</a> -->
                
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
               
            </div>
            </div>

<div class="btn-group">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Welcome, <?php echo $row["user_name"]; ?>
    </button>
    <div class="dropdown-menu">
    <a class="dropdown-item" href="logout.php">Logout</a>
    </div>
</div>
            <div class="search">
                <form action="search.php" method="get">
                    <div class="search_box pull-right">
                        <input name="find" type="text" placeholder="Search">
                        <button><i class="bi bi-search"></i></button>
                          </div>
                        </form>
            </div>        
        </div>
    </nav>
    <!-- Navbar End -->

<?php
    include "template/carousel.php";
?>
 
<?php
    include "template/about.php";
?>

                    <div class="container">
                        <div class="col text-center">
                            <h2 class="video" style="padding-bottom: 10px;">MAINTENANCE & REPAIR</h2>
                            <video src="img/Video.mkv" width="80%" height="auto" controls>
                            </video>
                        </div>
                    </div>
                    </div>

<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h6 class="text-primary text-uppercase">// Feedbacks //</h6>
            <h1 class="mb-5">Our Clients Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel position-relative">
            <div class="testimonial-item text-center">
                <img class="bg-light rounded-circle p-2 mx-auto mb-3" src="img/testimonial-1.jpg" style="width: 80px; height: 80px;">
                <h5 class="mb-0">Emily</h5>
                <div class="testimonial-text bg-light text-center p-4">
                <p class="mb-0"> Great shop! Was traveling through town and in a rush to find a good mechanic and these guys were above amazing! It’s hard to find a good honest mechanic and this is one of them! 10/10 would recommend.</p>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <img class="bg-light rounded-circle p-2 mx-auto mb-3" src="img/testimonial-2.jpg" style="width: 80px; height: 80px;">
                <h5 class="mb-0">Sarah</h5>
                <div class="testimonial-text bg-light text-center p-4">
                <p class="mb-0">My car needed a new fuel pump. Took my car in and had the repairs done in the same day. Didn’t have issues and the car has been working fine.</p>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <img class="bg-light rounded-circle p-2 mx-auto mb-3" src="img/testimonial-3.jpg" style="width: 80px; height: 80px;">
                <h5 class="mb-0">David</h5>
                <div class="testimonial-text bg-light text-center p-4">
                <p class="mb-0">Solid service. These guys are knowledgeable and professional. I will definitely come back with my Highlander</p>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <img class="bg-light rounded-circle p-2 mx-auto mb-3" src="img/testimonial-4.jpg" style="width: 80px; height: 80px;">
                <h5 class="mb-0">Austin</h5>
                <div class="testimonial-text bg-light text-center p-4">
                <p class="mb-0">A piece of our car started scraping on the pavement so we looked up a place close by and found this spot! They were super helpful and repaired it very quickly. Customer service was great and friendly!</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->

<?php
    include "template/footer.php";
?>
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