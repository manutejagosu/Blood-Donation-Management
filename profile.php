<?php
session_start();
include("connect.php");

if(!isset($_SESSION['username']))
{
    header("Location: admin.php");
    exit();
}

$username=$_SESSION['username'];

$query=mysqli_query($conn,"SELECT * FROM admin WHERE username='$username'");
$admin=mysqli_fetch_assoc($query);

if (isset($_POST['save'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE admin
            SET name='$name',
                email='$email',
                phone='$phone'
            WHERE username='$username'";

if( mysqli_query($conn, $sql)){
echo  "<script>alert('Profile Updated Successfully');</script>";
}
else{
echo mysqli_error($conn);
}
$query=mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
$admin=mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Profile</title>

<link rel="stylesheet" href="admin_profile.css">

<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
.blue{
    background:#edf4ff;
    border:3px solid blue;
    color:#1565c0;
}

.green{
    background:#ecfff2;
    border:3px solid green;
    color:#2e7d32;
}

.yellow{
    background:#fff9e8;
    border:3px solid yellow;
    color:#d48b00;
}

.purple{
    background:#f7efff;
    border:3px solid purple;
    color:#7b1fa2;
}
.input{
font-size:20px;
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

            <li >
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

            <li class="active">
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

<!-- Main Content Starts -->

<div class="main">

<div class="topbar">

<h2>
Admin Profile
</h2>

</div>

<!-- Profile Banner -->

<div class="banner">

<div class="left">

<div class="profile-image">

<img src="admin.jpeg" alt="photo">

</div>

<div class="details">

<h2><?php echo $admin['name']; ?></h2>

<span class="role">
Super Admin
</span>

<p>
Managing the Blood Donation
Management System and ensuring
smooth operations.
</p>

</div>

</div>

<div class="right">

<div class="small-box">

<i class="fa-solid fa-envelope"></i>

<?php echo $admin['email']; ?>

</div>

<div class="small-box">

<i class="fa-solid fa-phone"></i>

<?php echo $admin['phone']; ?>

</div>

<div class="small-box">

<i class="fa-solid fa-calendar-days"></i>

Last Login :
<?php echo $admin['last_login']; ?>

</div>

</div>

</div>

<!-- End Banner -->

<!-- Content Section -->

<div class="content">

    <!-- My Profile Card -->

<form method="POST">

    <div class="profile-card">

    <h3>
        <i class="fa-solid fa-user"></i>
        My Profile
    </h3>

    <div class="profile-info">

        <div class="info-row">
            <div class="left">
                <i class="fa-solid fa-user"></i>
                <span>Full Name</span>
            </div>
            <div class="right">
<input type="text" name="name" value="<?php echo $admin['name']; ?>">
            </div>
        </div>

        <div class="info-row">
            <div class="left">
                <i class="fa-solid fa-envelope"></i>
                <span>Email Address</span>
            </div>
            <div class="right">
               <input type="text" name="email" value="<?php echo $admin['email']; ?>">
            </div>
        </div>

        <div class="info-row">
            <div class="left">
                <i class="fa-solid fa-phone"></i>
                <span>Phone Number</span>
            </div>
            <div class="right">
     <input type="text" name="phone" value="<?php echo $admin['phone']; ?>">
            </div>
        </div>

        <div class="info-row">
            <div class="left">
                <i class="fa-solid fa-clock"></i>
                <span>Last Login</span>
            </div>
            <div class="right">
                <?php echo $admin['last_login']; ?>
            </div>
        </div>

        <div class="info-row">
            <div class="left">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Current Login</span>
            </div>
            <div class="right">
                <?php echo $admin['current_login']; ?>
            </div>
        </div>

    </div>

    <button  type="submit" class="update-btn" name="save">
        <i class="fa-solid fa-pen"></i>
        Update Profile
    </button>

</div>
</form>



    <!-- Account Summary -->

    <div class="summary">

        <h3>

            <i class="fa-solid fa-chart-line"></i>

            Account Summary

        </h3>

        <div class="summary-box blue">

            <i class="fa-solid fa-user-shield"></i>

            <div>

                <small>Account Type</small>

                <h4>Super Admin</h4>

            </div>

        </div>

        <div class="summary-box green">

            <i class="fa-solid fa-calendar-check"></i>

            <div>

                <small>Current Login</small>

                <h4><?php echo $admin['current_login']; ?></h4>

            </div>

        </div>

        <div class="summary-box yellow">

            <i class="fa-solid fa-clock"></i>

            <div>

                <small>Last Login</small>

                <h4><?php echo $admin['last_login']; ?></h4>

            </div>

        </div>

        <div class="summary-box purple">

            <i class="fa-solid fa-circle-check"></i>

            <div>

                <small>Status</small>

                <h4>Active</h4>

            </div>

        </div>

    </div>

</div>



<!-- Security Notice -->

<div class="security-box">

    <i class="fa-solid fa-circle-info"></i>

    Keep your account secure. Never share your login password with anyone.

</div>

</div>

</div>

</body>

</html>