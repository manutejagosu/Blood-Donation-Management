<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location:admin.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="dashboard.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
*{
    margin:0;
    font-family:Arial,sans-serif;
}
</style>
</head>
<body>
<div class="container">

    <!-- Sidebar -->

    <div class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-heart-circle-plus"></i>
            <h2>Blood Donation</h2>
        </div>

        <ul>

            <li class="active">
                <a href="dashboard.php">
                    <i class="fas fa-home"></i>Admin 
                      Dashboard
                </a>
            </li>

            <li>
                <a href="manage.php">
                    <i class="fas fa-users"></i>
                    Manage Donors
                </a>
            </li>

            <li>
                <a href="bloodrequest.php">
                    <i class="fas fa-hand-holding-medical"></i>
                    Blood Requests
                </a>
            </li>

            <li>
                <a href="contact_messages.php">
                    <i class="fas fa-envelope"></i>
                    Contact Messages
                </a>
            </li>
            <li>
                <a href="blood_stock.php">
                    <i class="fas fa-flask"></i>
                    Blood Stock
                </a>
            </li>

            <li>
                <a href="profile.php">
                    <i class="fas fa-user"></i>
                    Admin Profile
                </a>
            </li>

            <li>
                <a href="change_password.php">
                    <i class="fas fa-cog"></i>
                    Website Settings
                </a>
            </li>

            <li>
                <a href="logout.php">
                    <i class="fas fa-right-from-bracket"></i>
                    Logout
                </a>
            </li>

        </ul>

    </div>


    <!-- Main Content -->

    <div class="main-content">

        <!-- Header -->

        <div class="header">

            <h1>Admin Dashboard</h1>

            <div class="admin">

                <i class="fas fa-user-circle"></i>
Welcome <?php echo $_SESSION['username']; ?>

            </div>

        </div>


        <!-- Cards -->

        <div class="cards">

            <div class="card blue">
                <i class="fas fa-users"></i>
<?php
include "connect.php";   

$sql = "SELECT COUNT(*) AS total_donors FROM donor";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$totalDonors = $row['total_donors'];
?>
               <h2><?php echo $totalDonors; ?></h2>
                <p>Total Donors</p>
            </div>
            <div class="card red">
                <i class="fas fa-tint"></i>
<?php
$sql = "SELECT SUM(units) AS total_units FROM blood_request";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$totalUnits = $row['total_units'];

if ($totalUnits == NULL) {
    $totalUnits = 0;
}
?>
                <h2><?php echo $totalUnits; ?></h2>
                <p>Units Requested</p>
            </div>
<div class="card purple">
           <i class="fas fa-hand-holding-medical"></i>
<?php 
$sql = "SELECT COUNT(*) AS total_requests FROM blood_request";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$totalRequests = $row['total_requests'];
?>
               <h2><?php echo $totalRequests; ?></h2>
                <p>Blood Requests</p>
            </div>
<div class="card orange">
<i class="fas fa-envelope"></i>
<?php
$sql = "SELECT COUNT(*) AS total_messages FROM contact_details";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$totalMessages = $row['total_messages'];
?>
    <h2><?php echo $totalMessages; ?></h2>
    <p>Contact Messages</p>
</div>
            <div class="card green">
                <i class="fas fa-hand-holding-heart"></i>
<?php
$sql = "SELECT COUNT(*) AS today_donations
        FROM donor
        WHERE donation_date = CURDATE()";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$todayDonations = $row['today_donations'];
?>
<h2><?php echo $todayDonations; ?></h2>
                <p>Today's Donations</p>
            </div>
        </div>

</div>

</body>
</html>