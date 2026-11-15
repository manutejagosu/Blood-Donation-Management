<?php
session_start();

if(isset($_SESSION['error'])){
    echo "<script>
            alert('".$_SESSION['error']."');
          </script>";

    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link rel="stylesheet" href="login.css">

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
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    background-image:url('photo.jpg');
background-repeat:no-repeat;
background-size:cover;
}

.login-container{
    width:100%;
    display:flex;
    justify-content:center;
    align-items:center;
}

.login-box{
    width:360px;
    background:#fff;
    padding:35px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.logo{
    text-align:center;
    margin-bottom:25px;
}

.logo i{
    font-size:60px;
    color:#c62828;
}

.logo h2{
    margin-top:10px;
    color:#c62828;
}

.logo p{
    color:#777;
    margin-top:10px;
}

.input-box{
    display:flex;
    align-items:center;
    border:1px solid #ccc;
    border-radius:8px;
    padding:10px;
    margin-bottom:20px;
}

.input-box i{
    color:#c62828;
    margin-right:10px;
}

.input-box input{
    border:none;
    outline:none;
    width:100%;
    font-size:16px;
}

button{
    width:100%;
    padding:12px;
    background:#c62828;
    color:#fff;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#a61b1b;
}
</style>
</head>
<body>

<div class="login-container">

    <div class="login-box">

        <div class="logo">
            <i class="fa-solid fa-droplet"></i>
            <h2>Blood Donation Management System</h2>
            <p>Admin Login</p>
        </div>

        <form action="login_process.php" method="POST">

            <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="input-box">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit">Login</button>

        </form>

    </div>

</div>

</body>
</html>