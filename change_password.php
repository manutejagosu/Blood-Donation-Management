<?php
include("connect.php");

if(isset($_POST['change_password']))
{
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT password FROM admin WHERE username='Manuteja'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if(!password_verify($current_password,$row['password']))
    {
        echo "<script>alert('Current Password is Incorrect');</script>";
    }
    elseif($new_password != $confirm_password)
    {
        echo "<script>alert('New Password and Confirm Password do not match');</script>";
    }
    else
    {
$hashed_password=password_hash($new_password,PASSWORD_DEFAULT);
        $update = "UPDATE admin SET password='$hashed_password' WHERE username='Manuteja'";

        if(mysqli_query($conn, $update))
        {
            echo "<script>alert('Password Changed Successfully');</script>";
        }
        else
        {
            echo "<script>alert('Failed to Change Password');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password</title>
<link rel="stylesheet" href="dashboard.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
background-image:url('ch.jpg');
background-repeat:no-repeat;
background-size:cover;
background-attachment:fixed;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.contain{
    width:400px;
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.2);
}

.contain h2{
    text-align:center;
    color:#333;
    margin-bottom:25px;
}

.input-box{
    margin-bottom:18px;
}

.input-box label{
    display:block;
    margin-bottom:6px;
    font-weight:bold;
    color:#444;
}

.input-box input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;
    outline:none;
}

.input-box input:focus{
    border-color:#2196F3;
}

button{
margin-left:60px;
    width:220px;
    padding:12px;
    background:#2196F3;
    color:#fff;
    border:none;
    border-radius:28px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#1976D2;
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

            <li>
                <a href="profile.php">
                    <i class="fas fa-user"></i>
                    Admin Profile
                </a>
            </li>

            <li class="active">
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

<div class="contain">

<h2>Change Password</h2>

<form method="POST">

<div class="input-box">
<label>Current Password</label>
<input type="password" name="current_password" required>
</div>

<div class="input-box">
<label>New Password</label>
<input type="password" name="new_password" required>
</div>

<div class="input-box">
<label>Confirm Password</label>
<input type="password" name="confirm_password" required>
</div>

<button type="submit" name="change_password">
Change Password
</button>

</form>

</div>

</body>
</html>