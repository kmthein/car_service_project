<?php

include '../../config.php';

if(isset($_GET['id'])){
$id = $_GET['id'];

$deletequery = "DELETE FROM user WHERE id = $id ";

$query = mysqli_query($conn, $deletequery);

if($query){
    ?>
    <script>alert('User deleted successful.');</script>
    <?php 
    header('Location: user_list.php');
  } else{
    ?>
    <script>alert('Not Deleted.');</script>
    <?php
  }
}      
    
?>