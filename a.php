<?php
include("connect.php");
session_start();

// Replace with your login session
$username = $_SESSION['username'] ?? 'admin';

$query = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username'");
$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Profile</title>

<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
/* Reset */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f4f6f9;
}

/* Container */

.container{
    display:flex;
}

/* Main Content */

.content{
    margin-left:270px;
    width:calc(100% - 270px);
    padding:35px;
}

/* Heading */

.content h1{
    color:#d32f2f;
    margin-bottom:30px;
    font-size:30px;
}

/* Cards */

.cards{
    display:flex;
    gap:30px;
    align-items:flex-start;
}

/* Card */

.card{
    flex:1;
    background:#fff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 8px 20px rgba(0,0,0,.12);
}

/* Profile Top */

.profile-top{
    text-align:center;
    margin-bottom:30px;
    position:relative;
}

.profile-img{
    width:150px;
    height:150px;
    border-radius:50%;
    object-fit:cover;
    border:5px solid #e53935;
}

.profile-top h2{
    margin-top:15px;
    color:#333;
}

.profile-top span{
    color:#777;
    font-size:14px;
}

/* Camera Icon */

.camera{
    position:absolute;
    right:34%;
    bottom:70px;
    width:42px;
    height:42px;
    background:#e53935;
    color:#fff;
    border-radius:50%;
    display:flex;
    justify-content:center;
    align-items:center;
    cursor:pointer;
    border:3px solid #fff;
}

.camera:hover{
    background:#c62828;
}

/* Form */

form{
    display:flex;
    flex-direction:column;
}

label{
    margin-top:15px;
    margin-bottom:6px;
    color:#444;
    font-weight:600;
}

input{
    height:48px;
    border:1px solid #ccc;
    border-radius:10px;
    padding:12px;
    font-size:15px;
}

input:focus{
    outline:none;
    border-color:#e53935;
}

/* Password */

.password-box{
    position:relative;
}

.password-box input{
    width:100%;
    padding-right:45px;
}

.toggle{
    position:absolute;
    right:15px;
    top:16px;
    cursor:pointer;
    color:#777;
}

/* Strength Bar */

.strength{
    margin-top:18px;
    width:100%;
    height:8px;
    background:#ddd;
    border-radius:10px;
    overflow:hidden;
}

.strength-bar{
    width:40%;
    height:100%;
    background:#4caf50;
}

/* Buttons */

.red-btn,
.blue-btn{
    margin-top:25px;
    height:48px;
    border:none;
    border-radius:10px;
    color:#fff;
    font-size:16px;
    cursor:pointer;
    transition:.3s;
}

.red-btn{
    background:#e53935;
}

.red-btn:hover{
    background:#c62828;
}

.blue-btn{
    background:#1976d2;
}

.blue-btn:hover{
    background:#125aa0;
}

/* Responsive */

@media(max-width:1100px){

.cards{
    flex-direction:column;
}

.content{
    margin-left:270px;
    width:calc(100% - 270px);
}

}

@media(max-width:768px){

.content{
    margin-left:0;
    width:100%;
    padding:20px;
}

.cards{
    flex-direction:column;
}

.card{
    width:100%;
}

}
</style>

</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <aside class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-heart-circle-plus"></i>
            <h2>Blood Donation</h2>
        </div>

        <ul>

            <li><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a></li>

            <li><a href="manage_donors.php"><i class="fa fa-users"></i> Manage Donors</a></li>

            <li><a href="blood_requests.php"><i class="fa fa-hand-holding-medical"></i> Blood Requests</a></li>

            <li><a href="blood_stock.php"><i class="fa fa-droplet"></i> Blood Stock</a></li>

            <li><a href="donation_history.php"><i class="fa fa-clock-rotate-left"></i> Donation History</a></li>

            <li><a href="messages.php"><i class="fa fa-envelope"></i> Contact Messages</a></li>

            <li class="active"><a href="#"><i class="fa fa-user"></i> Admin Profile</a></li>

            <li><a href="logout.php"><i class="fa fa-right-from-bracket"></i> Logout</a></li>

        </ul>

    </aside>

    <!-- Main Content -->
    <main class="content">

        <h1>Administrator Profile</h1>

        <div class="cards">

            <!-- Profile Card -->
            <div class="card">

                <div class="profile-top">

                    <img src="admin.jpeg" class="profile-img">

                    <label class="camera">

                        <i class="fa-solid fa-camera"></i>

                        <input type="file" hidden>

                    </label>

                    <h2><?php echo $row['name']; ?></h2>

                    <span>Blood Donation Management System</span>

                </div>

                <form action="update_profile.php" method="POST">

                    <label>Full Name</label>

                    <input type="text"
                    name="name"
                    value="<?php echo $row['name']; ?>">

                    <label>Email</label>

                    <input type="email"
                    name="email"
                    value="<?php echo $row['email']; ?>">

                    <label>Phone</label>

                    <input type="text"
                    name="phone"
                    value="<?php echo $row['phone']; ?>">

                    <label>Last Login</label>

                    <input type="text"
                    value="<?php echo $row['last_login']; ?>"
                    readonly>

                    <button class="red-btn">
                        Update Profile
                    </button>

                </form>

            </div>

            <!-- Password Card -->

            <div class="card">

                <h2>Change Password</h2>

                <form action="change_password.php" method="POST">

                    <label>Current Password</label>

                    <div class="password-box">

                        <input type="password"
                        id="current"
                        name="current">

                        <i class="fa fa-eye toggle"></i>

                    </div>

                    <label>New Password</label>

                    <div class="password-box">

                        <input type="password"
                        id="new"
                        name="new">

                        <i class="fa fa-eye toggle"></i>

                    </div>

                    <label>Confirm Password</label>

                    <div class="password-box">

                        <input type="password"
                        id="confirm"
                        name="confirm">

                        <i class="fa fa-eye toggle"></i>

                    </div>

                    <div class="strength">

                        <div class="strength-bar"></div>

                    </div>

                    <button class="blue-btn">

                        Change Password

                    </button>

                </form>

            </div>

        </div>

    </main>

</div>

<script src="js/profile.js"></script>

</body>

</html>