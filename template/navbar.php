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
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Account</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="register.php" class="dropdown-item">Register</a>
                        <a href="login.php" class="dropdown-item">Login</a>
                    </div>
                </div>                
                <a href="contact.php" class="nav-item nav-link">Contact</a>
                <!-- <a href="cart.html" class="nav-item nav-link">Checkout</a> -->

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