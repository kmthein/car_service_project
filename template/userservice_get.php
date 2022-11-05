<?php
    if (!isset($_SESSION["SESSION_EMAIL"])) {
        header("Location: index.php");
    } include 'config.php';

?>
<!-- Service Start -->
    <div class="small-container">

        <div class="row row-2">
            <h2>All Services</h2>
        </div>
    </div>
<?php

include 'config.php';

    if(isset($_GET['submit'])){
        $service_name = $_GET['sname'];
        $price = $_GET['price'];
        $user_id = $_GET['user_id'];
        $result = mysqli_query($conn, "INSERT INTO booking_log(service_name, price) 
        VALUES('$service_name','$price')");
        if($result){
        echo "<script>alert('Service Added Successfully.');</script>";
?>
        <script>window.location.href='user_booking.php';</script>"  
<?php
}    
    }
?>

        <div class="row">
        <?php

        include 'config.php';
        $stmt = $conn -> prepare("SELECT * FROM service");
        $result = mysqli_query($conn, $sql);


        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()):

        ?>  


                <div class="col-4">
                <form action="" method="GET" class="form-submit">
                    <a href=""><img src="<?= $row['service_image'] ?>"></a>
                    <h3><?= $row['service_name'] ?></h3>
                    <p><?= $row['service_desc'] ?></p>
                    <p style="color: black;"><?= number_format($row['price']) ?> kyats</p>

                    <input type="hidden" name="user_id" value="<?= $row2['id'] ?>">
                    <input type="hidden" name="sname" value="<?= $row['service_name'] ?>">
                    <input type="hidden" name="simage" value="<?= $row['service_image'] ?>">
                    <input type="hidden" name="price" value="<?= $row['price'] ?>">


                    <button name="submit" class="btn">Get Service</button>
                </div>
                </form>
                <?php endwhile; ?>


    </div>
    <!-- Service End -->

