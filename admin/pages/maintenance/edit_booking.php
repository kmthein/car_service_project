<?php
    session_start();
    include '../../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard</title>
  <!-- Required meta tags -->
  <!-- base:css -->
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="" />
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
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <!-- Template Stylesheet -->
  <link href="/css/style.css" rel="stylesheet">
  <!-- Template Stylesheet -->
</head>
<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
<?php
include '../sidebar_page.php';
?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
<?php
include '../navbar_page.php';
?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM user_booking WHERE userbk_id = $id";
        $query_run = mysqli_query($conn, $query);
    
    foreach($query_run as $row)
    {
?>

<?php
  $status = $row['status'];
?>
      <!-- partial -->
      <div class="main-panel">
        <div class="card">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Booking Request</h4>
                  <br>                
                  <form action="" method="POST">
                  <div class="form-group">
                    <label>Customer Name</label>
                    <input type="text" name="edit_name" value="<?php echo $row['user_name'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                    <label>Service</label>
                    <input type="text" name="edit_service" value="<?php echo $row['service_name'] ?>" class="form-control" readonly>
                    </div>
                  <div class="form-group">
                    <input type="hidden" name="edit_id" value="<?php echo $row['userbk_id'] ?>">
                    <label>Date</label>
                    <input type="text" name="edit_date" value="<?php echo $row['date'] ?>" class="form-control" readonly>
                    </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control" style="padding-bottom: 10px; font-weight: 600; width: auto; border-color: gray;">
                        <option value="1" <?php echo $status && $status == 1 ? "selected" : '' ?>>On-progress</option>
                        <option value="2" <?php echo $status && $status == 2 ? "selected" : '' ?>>Cancelled</option>
                        <option value="3" <?php echo $status && $status == 3 ? "selected" : '' ?>>Confirmed</option>
                        <option value="4" <?php echo $status && $status == 4 ? "selected" : '' ?>>Completed</option>
                    </select>
                </div>
                    <a href="booking_request.php" class="btn btn-danger"> Cancel</a>
                    <button class="btn btn-primary" name="updatebtn"> Update</button>
                    </form>
                <?php
    }
}
    ?>

    <?php
    if(isset($_POST['updatebtn'])){
      $id = $_POST['edit_id'];
      $status = $_POST['status'];
      
      $query = "UPDATE user_booking SET status = '$status' WHERE userbk_id = $id";
      $query_run = mysqli_query($conn, $query);

      if($query_run){
        echo "<script>alert('Booking Request Updated!')</script>";{
          ?>
          <script>window.location.href='booking_request.php';
          </script>
          <?php
        }
      }
    }
    ?>
                </div>
              </div>
            </div>
            </div>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
  </div>
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/file-upload.js"></script>
  <!-- End custom js for this page-->
</body>
</html>