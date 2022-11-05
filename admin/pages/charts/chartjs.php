<?php
    session_start();
    if (!isset($_SESSION["user_name"])) {
        header("Location: ../../login.php");
    } include '../../config.php';
?>
<?php
include '../../config.php';
$sql = "SELECT * FROM admin WHERE user_name='{$_SESSION["user_name"]}'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}
?>
<?php
  include '../../config.php';
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet"> 
    <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
  <!-- endinject -->
</head>
<body>
  <div class="container-scroller d-flex">
    <!-- partial:../../partials/_sidebar.html -->
<?php
  include '../sidebar_page.php';
?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_navbar.html -->                 
<?php
  include '../navbar_page.php';
?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Total Income by Service Type</h4>
                  <canvas id="lineChart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Monthly Most Service Type</h4>
                  <div id="chart-container"></div>
                  <script src="js/jquery-2.1.4.js"></script>
                  <canvas id="barChart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Yearly Income Service</h4>
                  <canvas id="areaChart"></canvas>
                </div>
              </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- End custom js for this page-->
<?php
//the SQL query to be executed
$sql = "SELECT service_name,SUM(price) as total_income FROM user_booking WHERE MONTH(date) = MONTH(CURRENT_DATE()) GROUP BY service_name ORDER BY 
COUNT(service_name) DESC" ;
//storing the result of the executed query
$result = $conn->query($sql);
//check if there is any data returned by the SQL Query
if ($result->num_rows > 0) {
    $service_name = array();
    $total_income = array();  
  //Converting the results into an associative array
  while($row = $result->fetch_assoc()) {
    $service_name[] = $row['service_name'];    
    $total_income[] = $row['total_income'];    
  } 
}
?>
<script>

const service_name =  <?php echo json_encode($service_name); ?>;

const total_income =  <?php echo json_encode($total_income); ?>;

  const data = {
  labels: service_name,
    datasets: [{
      label: 'Total Income by Service Type',
      data: total_income,
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
    }]
  };
  const config = {
    type: 'line',
    data: data,
    options: {}
  }
  const lineChart = new Chart(
    document.getElementById('lineChart'),
    config
  );  
</script>
<?php
  $sql = "SELECT service_name,COUNT(service_name) as total_booking FROM user_booking  WHERE MONTH(date) = MONTH(CURRENT_DATE()) GROUP BY service_name ORDER BY 
  COUNT(service_name) DESC" ;

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
  console.log(<?php echo json_encode($total_booking); ?>);

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
<?php
  $sql = "SELECT SUM(price) as monthly_service, MONTH(date) as month FROM user_booking GROUP BY MONTH(date), YEAR(date);" ;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $service_name = array();
    $total_booking = array(); 
  //Converting the results into an associative array
  while($row = $result->fetch_assoc()) {
    $monthly_service[] = $row['monthly_service'];    
    $month[] = $row['month'];    
  } 
}
?>
<script>
  const monthly_service = <?php echo json_encode($monthly_service); ?>;

  const month = <?php echo json_encode($month); ?>;

    const areaData = {
    labels: ['Januray','Feburary','March','April','May','June','July',
    'August','September','October','November','December',],
    datasets: [{
      label: 'Yearly Income Service',
      data: monthly_service,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: true, // 3: no fill
    }]
  };
  const areaOptions = {
    plugins: {
      filler: {
        propagate: true
      }
    }
  };
  const areaConfig = {
  type: 'line',
  data: areaData,
  options: areaOptions
  };
  const areaChart = new Chart(
    document.getElementById('areaChart'),
    areaConfig
  );
</script>
  <!-- base:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/file-upload.js"></script>
  <!-- End custom js for this page-->
</body>
</html>
