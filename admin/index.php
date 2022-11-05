<?php
    session_start();
    if (!isset($_SESSION["user_name"])) {
        header("Location: login.php");
    } include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" href="css/home.css">

  <!-- endinject -->
  <link rel="shortcut icon" href="" />
</head>
<body>

  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
<?php

include 'template/sidebar.php';

?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
<?php
  include 'template/navbar.php';
?>
<?php
  include 'config.php';
  $service = mysqli_query($conn, "SELECT COUNT(id) as total_service FROM service");
  $row = mysqli_fetch_array($service);
?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <div class="info-box">
                        <span class="info-box-icon bg-light elevation-1"><i class="fas fa-th-list"></i></span></div>
                        <h3 class="mb-0">Total Service Type</h3>
                          <!-- <p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                        </div>
                      </div>
                    </div><br><br>
                    <h1 class="font-weight-normal" style="padding-left: 20%;"><?php echo $row['total_service']; ?></h6>
                  </div>
                </div>
              </div>

              <?php
              include 'config.php';
              $user = mysqli_query($conn, "SELECT COUNT(id) as total_user FROM users");
              $row = mysqli_fetch_array($user);
              ?>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <div class="info-box">
                        <span class="info-box-icon bg-light elevation-1"><i class="fas fa-users"></i></span></div>
                        <h3 class="mb-0">Total Users</h3>
                          <!-- <p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                        </div>
                      </div>
                    </div><br><br>
                    <h1 class="font-weight-normal" style="padding-left: 20%;"><?php echo $row['total_user']; ?></h6>
                  </div>
                </div>
              </div>

              <?php

              include 'config.php';
              $booking = mysqli_query($conn, "SELECT COUNT(userbk_id) as total_booking FROM user_booking");
              $row = mysqli_fetch_array($booking);
              
              ?>

              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <div class="info-box">
                        <span class="info-box-icon bg-light elevation-1"><i class="fas fa-file-invoice"></i></span></div>
                        <h3 class="mb-0">Total Bookings</h3>
                          <!-- <p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                        </div>
                      </div>
                    </div><br><br>
                    <h1 class="font-weight-normal" style="padding-left: 20%;"><?php echo $row['total_booking']; ?></h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <div class="info-box">
                        <span class="info-box-icon bg-light elevation-1"><i class="fas fa-eye"></i></span></div>
                        <h3 class="mb-0">Total Visitors</h3>
                          <!-- <p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                        </div>
                      </div>
                    </div><br><br>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "car_service";
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 
                
                    $sql = "SELECT visits FROM visit_counter WHERE id = 1";
                    $result = $conn->query($sql);
                
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $visits = $row["visits"];
                        }
                    } else {
                        echo "no results";
                    }
                    
                    $conn->close();
                ?>

                    <h1 class="font-weight-normal" style="padding-left: 20%;"><?php echo $visits ?> views</h6>
                  </div>
                </div>
              </div>       
                  <div class="card" style="margin-left: 1%;">
                    <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <p class="card-title">Last 10 Bookings</p>
                      </div>
                      <div class="d-flex align-items-center flex-wrap mb-3">
                      </div>
                      </div>
                      <form action="" method="POST">
                  <div class="cart-container cart-page">
                    <table class="table">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Service</th>
                        </tr>
                        <?php
                        include 'config.php';
                        $count = 1;
                        $stmt = $conn->prepare("SELECT * FROM user_booking ORDER BY userbk_id DESC LIMIT 10");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo "$count" ?></td>
                            <td><?= $row['date'] ?></td>
                            <td><?= $row['user_name'] ?></td>
                            <td><?= $row['service_name'] ?></td>
                        </tr>
                            <?php
                            $count++;
                            }
                            ?>                       
                    </table>
                    <div class="float-right" style="margin-right: 2%; margin-bottom: 2%;">
                    <a href="pages/maintenance/booking_request.php" class="text-alert">See More <i class="fa fa-arrow-right ms-3"></i></a>
                    </div>
                  </form>
                  </div>                    
                      </div>
              <div class="col-lg-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Monthly Most Service Type</h4>
                  <div id="chart-container"></div>
                  <script src="js/jquery-2.1.4.js"></script>
                  <canvas id="barChart"></canvas>
                  <div class="float-right" style="margin: 2% 2%;">
                    <a href="pages/charts/chartjs.php" class="text-alert">See More Charts <i class="fa fa-arrow-right ms-3"></i></a>
                          </div>
                </div>               
          <!-- row end -->
        </div>
        <!-- content-wrapper ends -->       
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <?php
  include 'config.php';
  $sql = "SELECT service_name,COUNT(service_name) as total_booking FROM user_booking  WHERE date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() 
  GROUP BY service_name ORDER BY COUNT(service_name) DESC" ;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $service_name = array();
    $total_booking = array();
    
  //Converting the results into an associative array
  while($row = $result->fetch_assoc()) {
    $service_name[] = $row['service_name'];    
    $total_booking[] = $row['total_booking'];    
  } 
}
?>
<script>
  console.log(<?php echo json_encode($service_name); ?>);

  const service_name =  <?php echo json_encode($service_name); ?>;

  const total_booking =  <?php echo json_encode($total_booking); ?>;

    const data2 = {
  labels: service_name,
  datasets: [{
    label: 'Monthly Most Service Type',
    data: total_booking,
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};
const barConfig = {
  type: 'bar',
  data: data2,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};
const barChart = new Chart(
    document.getElementById('barChart'),
    barConfig
  );
</script>
</body>
</html>