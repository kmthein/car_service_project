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
        $query = "SELECT * FROM service WHERE id = $id";
        $query_run = mysqli_query($conn, $query);

        foreach($query_run as $row)
        {
?>
<!-- partial -->
<div class="main-panel">
        <div class="card">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Service</h4>
                  <br>
                  <form action="" method="POST">
                  <div class="form-group">
                    <label>Service Name</label>
                    <input type="text" name="edit_name" value="<?php echo $row['service_name'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="edit_desc" value="<?php echo $row['service_desc'] ?>" class="form-control">
                    </div>
                  <div class="form-group">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                    <label>Price</label>
                    <input type="text" name="edit_price" value="<?php echo $row['price'] ?>" class="form-control">
                    </div>
                    <a href="service_list.php" class="btn btn-danger"> Cancel</a>
                    <button class="btn btn-primary" name="updatebtn"> Update</button>
                    </form>
                <?php
    }
}
    ?>
    <?php
    if(isset($_POST['updatebtn'])){
      $id = $_POST['edit_id'];
      $edit_name = $_POST['edit_name'];
      $edit_desc = $_POST['edit_desc'];
      $edit_price = $_POST['edit_price'];
      $query = "UPDATE service SET service_name = '$edit_name', service_desc = '$edit_desc', price = '$edit_price'  WHERE id = $id";
      $query_run = mysqli_query($conn, $query);
      if($query_run){
        echo "<script>alert('Service Updated!')</script>";{
          ?>
          <script>window.location.href='service_list.php';
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
      </div>
    </div>
  </div>
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/file-upload.js"></script>
  <script src="js/jquery-3.2.1.min.js"></script>	
  <script src="js/bootstrap.js"></script>	
</body>
</html>