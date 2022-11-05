                <?php
                include 'config.php';
                $sql = "SELECT * FROM admin WHERE user_name='{$_SESSION["user_name"]}'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                }
                ?>
<nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="navbar-brand-wrapper">
            <h1 class="font-weight-bold mb-0 d-none d-md-block mt-1" style="padding: 10px 5px"">Brilliant Car Services</h3>
          </div>
              <?php
              include 'config.php';
              $username = $_SESSION['user_name'];
              $sql = "SELECT * FROM admin WHERE user_name = '$username' ";
              $result = mysqli_query($conn, $sql);
              $rows = mysqli_num_rows($result);
              ?>
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" style="padding-left: 10%;">Welcome back, <?= $row['admin_name']?></h4>
          <ul class="navbar-nav navbar-nav-right">
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">

        <form action="../admin/search.php" method="GET">  
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
              <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search Here..." aria-label="search" aria-describedby="search">
              </div>
            </li>
            </form>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <img src="<?= $row['image']?>" alt="profile"/>
                <span class="nav-profile-name"><?= $row['admin_name']?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a href="message.php" class="dropdown-item">
                <i class="mdi mdi-email-open text-primary"></i>                
                  Message
                </a>
                <a href="logout.php" class="dropdown-item">
                  <i class="mdi mdi-logout text-primary"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

