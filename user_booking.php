<?php
    session_start();
    if (!isset($_SESSION["SESSION_EMAIL"])) {
        header('Location: booking.php');
    }     include 'config.php'; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Brilliant Car Services</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <style>
        .lead {
        font-size: 1.25rem;
        font-weight: 300;
        color: white;
        }
        .h6, h6 {
            font-size: 1rem;
        }
        @media (min-width: 1400px){
        .container, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
    max-width: 1400px;
        }
    }   
        @media (max-width: 992px){
        .container, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
    max-width: 1000px;
        }
    }
        @media (max-width: 768px){
        .container, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
    max-width: 1000px;
        }
    }
        @media (max-width: 576px){
        .container, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
    max-width: 500px;
        }
    }
        
    </style>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex 
    align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
<?php
    include "template/topbar.php";
?>
    <!-- Topbar End -->
   <!-- Navbar Start -->
<?php
  if (!isset($_SESSION["SESSION_EMAIL"])) {    
include 'template/navbar.php';  
    } else {
    include 'template/login_navbar.php';
}
?>
   <?php
    include 'config.php';

    if(isset($_POST['book'])){
        $service_name = $_POST['service_name'];
        $price = $_POST['price'];
        $user_name = $_POST['user_name'];
        $car_name = $_POST['car_name'];
        $car_no = $_POST['car_no'];
        $ph_no = $_POST['ph_no'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $req_type = $_POST['req_type'];
        $service_date = $_POST['service_date'];
        $request = $_POST['request'];
        $status = $_POST['status'];
        $user_id = $_POST['user_id'];
        $checkbox = $_POST['checkbox'];
        $pay_method = implode(",",$checkbox);
        $upload_folder = "upload/";
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        foreach ($_FILES["uploadfile"]["tmp_name"] as $key => $val){
            $tmp_name = $_FILES["uploadfile"]["tmp_name"][$key];
            $name = basename($_FILES['uploadfile']['name'][$key]);
            move_uploaded_file($tmp_name,"$upload_folder/$name");
            }
        
        $folder = $upload_folder . $name;        
        
        $result = mysqli_query($conn, "INSERT INTO `user_booking`(`service_name`, `price`, `user_name`, `car_name`, 
        `car_no`, `ph_no`, `email`, `address`, `req_type`, `date`, `request`,  `status`, `payment_method`, `payment_src`, `id`) 
        VALUES ('$service_name','$price','$user_name','$car_name','$car_no','$ph_no','$email','$address','$req_type',
        '$service_date','$request','$status', '$pay_method', '$folder','$user_id')" );
        
        if($result){
            echo "<script>alert('Booking Successful!');</script>";{
            
    ?>
        <script>window.location.href='welcome.php';
        </script>"
        
        <?php
                }
            } 
        }             
    ?>
    <!-- Booking Start -->
        <div class="container">
                <div>
                    <div class="h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s"
                    style="background-image: url(img/booking_img.jpg); ">
                        <h1 class="text-white mb-4">Confirm Your Service Booking</h1>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <?php
                                require 'config.php';
                                $stmt = $conn->prepare('SELECT * FROM booking_log Order By service_id DESC');
                                $stmt -> execute();
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc(); 

                                $sql = "SELECT * FROM users WHERE email='{$_SESSION["SESSION_EMAIL"]}'";
                                $res = mysqli_query($conn, $sql);
                        
                                if (mysqli_num_rows($res) > 0) {
                                    $row2 = mysqli_fetch_assoc($res);
                                }
                                ?>                                
                                    <h6 class="lead">Service : <?= $row['service_name'] ?></h6>
                                    <input type="hidden" name="service_name" value="<?= $row['service_name'] ?>">
                                    
                                    <h6 class="lead">Price : <?= $row['price'] ?> kyats</h6>
                                    <input type="hidden" name="price" value="<?= $row['price'] ?>">

                                <div class="col-12 col-sm-6">
                                    <input type="text" name="user_name" class="form-control border-0" placeholder="<?= $row2['user_name'] ?>" 
                                    style="height: 55px; font-weight:bolder; background-color:lightgray;" readonly>
                                    <input type="hidden" name="user_name" value="<?= $row2['user_name'] ?>">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" name="email" class="form-control border-0" placeholder="<?= $row2['email'] ?>" 
                                    style="height: 55px; font-weight:bolder; background-color:lightgray;" readonly>
                                    <input type="hidden" name="email" value="<?= $row2['email'] ?>">
                                </div>
                                    <input type="hidden" name="user_id" value="<?= $row2['id'] ?>">

                                <div class="col-12 col-sm-6">
                                    <input type="text" name="car_name" class="form-control border-0" placeholder="Your Car Name" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="car_no" class="form-control border-0" placeholder="Your Car License Number" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="ph_no" class="form-control border-0" placeholder="Your Phone Number" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="address" class="form-control border-0" placeholder="Your Address" style="height: 55px;" required>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <select class="form-select border-0" name="req_type" style="height: 55px;" required>
                                        <option>Request Type</option>
                                        <option value="Drop-off">Drop-off</option>
                                        <option value="Pick-up">Pick-up</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="date" class="form-control border-0 datetimepicker-input" name="service_date"
                                        placeholder="Service Date" style="height: 55px;" required>
                                    </div>
                                </div>                                  
                                
                                <div class="col-12">
                                    <textarea type="text" class="form-control border-0" name="request" placeholder="Special Request"></textarea>
                                </div>
                                <input type="hidden" name="status" value= 1>

                                <div class="col-lg-6 px-4 pb-4" style="width: 100%; background-color: white;">
                                <h4 style="color: #596277;">Select Payment Method</h4>
                                <input type="radio" name="checkbox[]" id="KBZcheckbox" value="KBZPay" />
                                <label class="form-check-label">KBZPay</label>
                                <script type="text/javascript">
                                $('#KBZcheckbox').change(function() {
                                    $('#KBZPay,#upload').show();
                                    $('#AYAPay,#KBZMB,#AYAMB').hide();
                                });
                                </script>          
                                <input type="radio" name="checkbox[]" id="AYAcheckbox" value="AYAPay" />
                                <label class="form-check-label">AYAPay</label>
                                <script type="text/javascript">
                                $('#AYAcheckbox').change(function() {
                                    $('#AYAPay,#upload').show();
                                    $('#KBZPay,#KBZMB,#AYAMB').hide();

                                });
                                </script>
                                <input type="radio" name="checkbox[]" id="KBZMBcheckbox" value="KBZ mBanking" />
                                <label class="form-check-label">KBZ Mobile Banking</label>
                                <script type="text/javascript">
                                $('#KBZMBcheckbox').change(function() {
                                    $('#KBZMB,#upload').show();
                                    $('#KBZPay,#AYAPay,#AYAMB').hide();
                                });
                                </script>
                                <input type="radio" name="checkbox[]" id="AYAMBcheckbox" value="AYA mBanking" />
                                <label class="form-check-label">AYA Mobile Banking</label>
                                <script type="text/javascript">
                                $('#AYAMBcheckbox').change(function() {
                                    $('#AYAMB,#upload').show();
                                    $('#KBZPay,#AYAPay,#KBZMB').hide();
                                });
                                </script>
                                <input type="radio" name="checkbox[]" id="cash_on" value="Cash On Service" />
                                <label class="form-check-label">Cash On Service</label>
                                <script type="text/javascript">
                                $('#cash_on').change(function() {
                                    $('#KBZPay,#AYAPay,#KBZMB,#AYAMB,#upload').hide();
                                });
                                </script>                              
                                <div id="col-md-5" style="border-style:ridge;">
                                <div id="KBZPay" style="display:none">
                                <h5>Payment Information</h5>
                                    <p><strong>KBZPay Account Number - 0977772840</strong></p>
                                </div>
                                <div id="AYAPay" style="display:none">
                                <h5>Payment Information</h5>
                                    <p><strong>AYAPay Account Number - 0977772840</strong></p>
                                </div>
                                <div id="KBZMB" style="display:none">
                                <h5>Payment Information</h5>
                                    <p><strong>KBZ Mobile Banking Account Number - 41621931331</strong></p>
                                </div>
                                <div id="AYAMB" style="display:none">
                                <h5>Payment Information</h5>
                                    <p><strong>AYA Mobile Banking Account Number - 1532320013</strong></p>
                                </div>
                                <div id="upload" style="display: none; margin-bottom: 20px;">
                                <div style="margin-left:10%;">
                                <strong>Upload your payment screenshot</strong> 
                                    <input type="file" name="uploadfile[]" class="file-upload-default" multiple value="">
                                    </span>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                            </div>
                                <div class="col-12">
                                    <button class="btn btn-secondary w-100 py-3" name="book" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->
    <!-- Footer Start -->
<?php
    include 'template/footer.php';
?>
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>