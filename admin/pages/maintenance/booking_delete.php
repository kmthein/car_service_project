<?php

include '../../config.php';

if(isset($_GET['id'])){
$id = $_GET['id'];

$deletequery = "DELETE FROM user_booking WHERE userbk_id = $id ";

$query = mysqli_query($conn, $deletequery);

if($query){
    echo "<script>alert('Booking Deleted Successful!')</script>";{
        ?>
        <script>window.location.href='booking_request.php';
        </script>
    <?php
  } 
} else {
    
    echo "<script>alert('Not Deleted.');</script>";
    
  }
}      
    
?>