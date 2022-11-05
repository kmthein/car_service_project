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