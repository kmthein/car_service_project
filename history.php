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

    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">

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
    <link href="css/status.css" rel="stylesheet">

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

        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Service History</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">History</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


    <div class="cart-container cart-page">

    <?php
                $sql = "SELECT * FROM users WHERE email='{$_SESSION["SESSION_EMAIL"]}'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                }

                ?>

                <?php

                if(isset($_GET['user_id'])){
                    $user_id = $_GET['user_id'];

                ?>
                <?php
                }
                ?>

    <table>
        <tr>
            <th>Service</th>
            <th>Date</th>
            <th>Price</th>
            <th>Status</th>
        </tr>


        <?php

        include 'config.php';

        $stmt = $conn -> prepare("SELECT * FROM user_booking ub WHERE ub.id= $row[id]");
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()):
        ?>

        <form action="" method="GET">
        <tr>
            <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
            <td><?= $row['service_name'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['price'] ?></td>
            <td>
            <?php if($row['status'] == 1): ?>
                <span class="badge badge-warning">On-progress</span>
            <?php elseif($row['status'] == 2): ?>
                <span class="badge badge-danger">Cancelled</span>
            <?php elseif($row['status'] == 3): ?>
                <span class="badge badge-primary">Confirmed</span>
            <?php elseif($row['status'] == 4): ?>
                <span class="badge badge-success">Completed</span>
            <?php endif; ?>
            </td>
        </tr>
        <?php endwhile ?>
    </table>
    </form>

    </div>
    </div>


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
