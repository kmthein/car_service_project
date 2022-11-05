<?php
    session_start();
    if (!isset($_SESSION["user_name"])) {
        header("Location: ../../login.php");
    } 
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
  <link rel="stylesheet" href="../../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="" />
  <link href="img/favicon.ico" rel="icon">
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
</head>
<body>
    <style>
        /* Cart */
.cart-container{
    max-width: 1400px;
    margin: auto;
    padding-left: 25px;
    padding-right: 25px;
}
.cart-page{
    margin: 80px auto;
} 
table{
    width: 100%;
    border-collapse: collapse;
}
.cart-info{
    display: flex;
    flex-wrap: wrap;
}
th{
    text-align: left;
    padding: 5px;
    color: #fff;
    background:#223e9c ;
    font-weight: normal;
}
td{
    padding: 10px 5px;
}
td input{
    width: 40px;
    height: 30px;
    padding: 5px;
}
td a{
    color: #f83f26;
    font-size: 12px;
}
td img{
    width: 80px;
    height: 80px;
    margin-right: 10px;
}
.total-price{
    display: flex;
    justify-content: flex-end;
}
.total-price table{
    border-top: 3px solid #091c47;
    width: 100%;
    max-width: 500px;
}
td:last-child{
    text-align: right;
}
th:last-child{
    text-align: right;
}

.checkout-btn{
    display: flex;
    justify-content: flex-end;
    padding-right: 14%;
    padding-bottom: 20px;
}
.card-tools {
    float: right;
    margin-right: 8%;
    background-color: #223e9c;
}
    </style>

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
   <!-- partial -->
      <div class="main-panel">
        <div class="card">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">User List</h4>
                  <form action="">
                  <div class="cart-container cart-page">
                    <table class="table">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Address</th>
                        </tr>
                        <?php

                        include '../../config.php';
                        $count = 1;
                        $result = mysqli_query($conn, "SELECT * FROM users");

                        while ($row = mysqli_fetch_array($result)){
                        
                        ?>
                        <tr>
                            <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                            <td><?php echo "$count" ?></td>
                            <td><?= $row['user_name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['mobile_no'] ?></td>
                            <td><?= $row['address'] ?></td>
                        </tr>
                            <?php
                            $count++;
                            }
                            ?>                      
                    </table>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            </div>                   
<script>
    function confirmationDelete(anchor){
        var conf = confirm('Are you sure to delete this user permanently?');
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
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/file-upload.js"></script>
</body>
</html>