<?php
  include '../../config.php';

if(isset($_GET['id'])){
$id = $_GET['id'];
$deletequery = "DELETE FROM service WHERE id = $id ";
$query = mysqli_query($conn, $deletequery);
if($query){
    ?>
    <script>alert('Service deleted successful.');</script>
    <?php 
    header('Location: service_list.php');
  } else{
    ?>
    <script>alert('Not Deleted.');</script>
    <?php
  }
}          
?>