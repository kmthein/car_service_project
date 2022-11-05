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
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/service_list.css">
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
      <!-- partial -->
      <div class="main-panel">
        <div class="card">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Service List</h4>
                  <div class="card-tools">
			        <a href="../forms/basic_elements.php" class="btn btn-flat" style="color: white;"><span class="fas fa-plus"></span>  Create New</a>
		          </div>
                  <form action="">
                  <div class="cart-container cart-page">
                    <table class="table">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        include '../../config.php';
                        $count = 1;
                        $stmt = $conn->prepare("SELECT * FROM service");
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()){
                        ?>
                        <tr>
                            <input type="hidden" name="service_id" value="<?= $row['id'] ?>">
                            <td><?php echo "$count" ?></td>
                            <td><?= $row['service_name'] ?></td>
                            <td><?= $row['service_desc'] ?></td>
                            <td><?= $row['price'] ?></td>
                            <td>
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a href="edit_service.php?id=<?php echo $row['id'] ?>" class="dropdown-item">
                                <span class="fa fa-edit text-primary"></span> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a onclick='javascript:confirmationDelete($(this));return false;' href="service_delete.php?id=<?php echo $row['id'] ?>" 
                                class="dropdown-item delete_data" data-toggle="tooltip" data-placement="bottom" title="DELETE">
                                <span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
                            </td>
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
        var conf = confirm('Are you sure to delete this service permanently?');
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
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/file-upload.js"></script>
</body>
</html>