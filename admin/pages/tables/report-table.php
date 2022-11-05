<?php
    session_start();
    if (!isset($_SESSION["user_name"])) {
        header("Location: ../../login.php");
    } include '../../config.php';
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
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <div class="container-scroller d-flex">
    <!-- partial:../../partials/_sidebar.html -->   
    <?php
    include '../sidebar_page.php'
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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <form action="" method="POST">
                <select name="report_type" class="form-control" style="height: 50px; font-weight:bold">
                  <option>Select Report Type</option>
                  <option value="1">Monthly Customer Booking</option>
                  <option value="2">Monthly Most Service Type</option>
                  <option value="3">Monthly Most Income Service</option>
                </select><br>
                <button type="submit" name="report" class="form-control">Report</button>
                </form>       
      <?php
        include '../../config.php';

        if(isset($_POST['report'])) {
        
          if($_POST['report_type'] == 1){
          $sql = mysqli_query($conn, "SELECT * FROM user_booking WHERE MONTH(date) = MONTH(CURRENT_DATE());");       
        ?>
            <div class="card-body">
                  <h4 class="card-title">Monthly Customer Booking</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Customer</th>
                          <th>Service Type</th>
                          <th>Price</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      while($row = mysqli_fetch_array($sql)):
                      ?>
                        <tr>
                          <td><?php echo $row['user_name']; ?></td>
                          <td><?php echo $row['service_name']; ?></td>
                          <td><?php echo $row['price']; ?></td>
                          <td><?php echo $row['date']; ?></td>
                        </tr>
                      <?php endwhile ?>                    
                      </tbody>                    
                    </table>
                  </div>
                </div>
                </div>
                </div>
        <?php
          } else if($_POST['report_type'] == 2){
            $sql = mysqli_query($conn, "SELECT service_name,COUNT(service_name) as total_booking FROM user_booking  
            WHERE MONTH(date) = MONTH(CURRENT_DATE()) GROUP BY service_name ORDER BY 
            COUNT(service_name) DESC") ;
            $count = 1;       
            ?>
                <div class="card-body">
                      <h4 class="card-title">Monthly Most Service Type</h4>
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Service Type</th>
                              <th>Total Booking</th>
                            </tr>
                          </thead>   
                          <tbody>
                          <?php
                          while($row = mysqli_fetch_array($sql)):
                          ?>
                            <tr>
                              <td><?php echo $count; ?></td>
                              <td><?php echo $row['service_name']; ?></td>
                              <td><?php echo $row['total_booking']; ?></td>
                            </tr>
                            <?php $count++ ?>
                          <?php endwhile ?>                          
                          </tbody>                     
                        </table>    
                      </div>
                    </div>
                    </div>
                    </div>
        <?php

              } else if($_POST['report_type'] == 3){
                $sql = mysqli_query($conn, "SELECT service_name,SUM(price) as total_income FROM user_booking 
                WHERE MONTH(date) = MONTH(CURRENT_DATE()) GROUP BY service_name ORDER BY 
                total_income DESC") ;
                $count = 1;            
                ?>
                    <div class="card-body">
                          <h4 class="card-title">Monthly Most Income Service</h4>
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Service Type</th>
                                  <th>Total Income</th>
                                </tr>
                              </thead>        
                              <tbody>
                              <?php
                              while($row = mysqli_fetch_array($sql)):
                              ?>
                                <tr>
                                  <td><?php echo $count; ?></td>
                                  <td><?php echo $row['service_name']; ?></td>
                                  <td><?php echo $row['total_income']; ?> kyats</td>
                                </tr>
                                <?php $count++ ?>
                              <?php endwhile ?>                             
                              </tbody>                             
                            </table>      
                          </div>
                        </div>
                        </div>
                        </div>
        <?php
           }
          }
        ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
</body>
</html>
