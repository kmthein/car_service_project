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
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
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
  <!-- Data Table -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <!-- Customized Bootstrap Stylesheet -->
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../css/admin.css" rel="stylesheet">
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
                  <h4 class="card-title">Booking Request</h4>
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
                        include '../../config.php';
                        $count = 1;
                        $stmt = $conn->prepare("SELECT * FROM user_booking ORDER BY date DESC");
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()){
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
                                    <a class="dropdown-item"  href="edit_booking.php?id=<?php echo $row['userbk_id'] ?>">
                                        <span class="fa fa-edit text-primary"></span> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a onclick='javascript:confirmationDelete($(this));return false;' href="booking_delete.php?id=<?php echo $row['userbk_id'] ?>" 
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
    </div>
  </div>
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
=
  <script src="../../js/file-upload.js"></script>
  <!-- End custom js for this page--> 
</body>
</html>