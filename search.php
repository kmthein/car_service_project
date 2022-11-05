<?php
    session_start();
    include 'config.php'; 
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
  if (!isset($_SESSION["SESSION_EMAIL"])) {
    
include 'template/navbar.php';  
    } else {
    include 'template/login_navbar.php';
}

?>

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-2.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Search</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Search</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
<!-- Service Start -->
    <div class="small-container">

        <div class="row row-2">
            <h2></h2>
        </div>
    </div>

    <?php

include 'config.php';

    if(isset($_GET['submit'])){
        $service_name = $_GET['sname'];
        $price = $_GET['price'];
        $result = mysqli_query($conn, "INSERT INTO booking_log(service_name, price) 
        VALUES('$service_name','$price')");
        if($result){
        echo "<script>alert('Service Added Successfully.');</script>";
?>
        <script>window.location.href='user_booking.php';</script>"  
<?php
}    
    } 
?>

    <div class="row">
    <?php

        $conn = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($conn,'car_service');

        $find = mysqli_real_escape_string($conn, $_GET['find']);
        $sql = "SELECT * FROM service WHERE service_name like '%$find%' ";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res)>0){
            while($row = mysqli_fetch_array($res))
            {
    ?>

<div class="col-4">
                <form action="" method="GET" class="form-submit">
                    <a href=""><img src="<?= $row['service_image'] ?>"></a>
                    <h3><?= $row['service_name'] ?></h3>
                    <p><?= $row['service_desc'] ?></p>
                    <p style="color: black;"><?= number_format($row['price']) ?> kyats</p>

                    <input type="hidden" name="sname" value="<?= $row['service_name'] ?>">
                    <input type="hidden" name="simage" value="<?= $row['service_image'] ?>">
                    <input type="hidden" name="price" value="<?= $row['price'] ?>">


                    <button name="submit" class="btn">Get Service</button>
                </div>
                </form>
        <?php
    }
} else {
    echo "No data found";
}

?>
                

</div>

</div>
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