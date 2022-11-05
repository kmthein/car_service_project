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
      <!-- partial -->
      <div class="main-panel">
        <div class="card">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Booking Request</h4>
                  <div class="card-tools">
			        <a href="../forms/basic_elements.php" class="btn btn-flat" style="color: white;"><span class="fas fa-plus"></span>  Create New</a>
		          </div>
                  <form action="" method="POST">
                  <div class="cart-container cart-page">
                    <table id="booking_request" class="table">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                        <?php
                        include 'config.php';
                        $count = 1;
                        $find = mysqli_real_escape_string($conn, $_GET['search']);
                        $sql = "SELECT * FROM user_booking WHERE user_name like '%$find%' || service_name like '%$find%' || date like '%$find%'";
                        $res = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_array($res)){
                        ?>
                        <tbody>
                        <tr>
                            <td><?php echo "$count" ?></td>
                            <td><?= $row['date'] ?></td>
                            <td><?= $row['user_name'] ?></td>
                            <td><?= $row['service_name'] ?></td>
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
                                <input type="hidden" name="booking_id" value="<?= $row['userbk_id'] ?>">
                                <input type="hidden" name="status" value="<?= $row['status'] ?>">
                            <td>
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item"  href="pages/maintenance/edit_booking.php?id=<?php echo $row['userbk_id'] ?>">
                                        <span class="fa fa-edit text-primary"></span> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a onclick='javascript:confirmationDelete($(this));return false;' href="pages/maintenance/booking_delete.php?id=<?php echo $row['userbk_id'] ?>" 
                                class="dropdown-item delete_data" data-toggle="tooltip" data-placement="bottom" title="DELETE">
                                <span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
                            </td>
                        </tr>
                            <?php
                            $count++;
                            }
                            ?>
                      </tbody>
                    </table>
                    </form>
                    <?
                    } else {
                            echo "No data found";
                        }
                        ?>
                  </div>
                </div>
              </div>
            </div>
            </div>              
<script>
    function confirmationDelete(anchor){
        var conf = confirm('Are you sure to delete this booking?');
        if(conf)
        window.location=anchor.attr("href");
    }
</script>
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
  GROUP BY service_name ORDER BY 
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