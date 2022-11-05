<?php
    session_start();
    if (!isset($_SESSION["user_name"])) {
        header("Location: login.php");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
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
</head>
<body>
  <div class="container-scroller d-flex">
    <!-- partial:../../partials/_sidebar.html -->   
<?php
include '../sidebar_page.php';
?>  
<?php
include '../../config.php';
$sql = "SELECT * FROM admin WHERE user_name='{$_SESSION["user_name"]}'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}
?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_navbar.html -->
<?php
include '../navbar_page.php';
?>
<?php
  include '../../config.php';

  if(isset($_POST['submit'])){
    $service_name = $_POST['service_name'];
    $service_desc = $_POST['service_desc'];
    $service_price = $_POST['price'];
    $upload_folder = "../../../img/upload/";
    $filename = $_FILES['uploadfile']['name'];
    $tempname = $_FILES['uploadfile']['tmp_name'];
    foreach ($_FILES['uploadfile']['tmp_name'] as $key => $val){
      $tmp_name = $_FILES['uploadfile']['tmp_name'][$key];
      $name =  basename($_FILES['uploadfile']['name'][$key]);
      move_uploaded_file($tmp_name,"$upload_folder/$name");
    }
    $folder = "img/upload/" . $name;

    $result = mysqli_query($conn, "INSERT INTO `service`(`service_name`, `service_desc`, `price`, `service_image`) 
    VALUES ('$service_name','$service_desc','$service_price','$folder')");
    if($result){
      echo "<script>alert('Service added successfully');</script>";
    }
  }
?>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h1 class="card-title" style="font-size: 30px;">Service Register</h1><br>
                  <form action="" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="service_name">Service Name</label>
                      <input type="text" name="service_name" class="form-control" id="" placeholder="Service Name">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <input type="text" name="service_desc" class="form-control" id="description" placeholder="Service Description">
                    </div>
                    <div class="form-group">
                      <label>Service Image</label>
                      <input type="file" name="uploadfile[]" class="file-upload-default" value="" multiple>
                      <div class="input-group col-xs-12">
                        <input type="text" name="upload" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="price">Price</label>
                      <input type="text" name="price" class="form-control" placeholder="Service Price">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>                            
       <!-- partial -->
      </div>
    </div>
  </div>
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/file-upload.js"></script>
</body>

</html>
