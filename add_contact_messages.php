<?php
include("connect.php");

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql="INSERT INTO contact_details(name,phone,email,message)
          VALUES('$name','$phone','$email','$message')";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
        alert('Contact Message Added Successfully');
        window.location='contact_messages.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Contact Message</title>

<style>

body{
padding:0;
    margin:0;
    background-image:url('b.jpg');
background-size:cover;
background-position:center;
backgorund-repeat:no-repeat;
background-attachment:fixed;
    font-family:Arial,sans-serif;
}

.container{
    width:400px;
    margin:40px auto;
    background:rgba(255,255,255,0.96);
    padding:35px;
    border-radius:18px;
box-shadow:0 15px 40px rgba(0,30,40,0.35);
overflow-x:auto;
}

h2{
    text-align:center;
    color:#d32f2f;
    margin-bottom:25px;
}

label{
    display:block;
    font-weight:bold;
    margin-top:15px;
}

input,select{
    width:100%;
    padding:12px;
    margin-top:6px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;
    box-sizing:border-box;
}

input:focus,select:focus{
    border-color:#009688;
    outline:none;
}

.submit-btn{
    width:100%;
    margin-top:25px;
    padding:14px;
    background:#d32f2f;
    color:white;
    border:none;
    border-radius:30px;
    font-size:17px;
    cursor:pointer;
}

.submit-btn:hover{
    background:#b71c1c;
}

</style>

</head>

<body>

<div class="container">

<h2>New Contact Message</h2>

<form method="POST">

<label>Name</label>
<input type="text" name="name" placeholder="Enter name" required>

<label>Phone</label>
<input type="text" name="phone" placeholder="Enter phone"  required>

<label>Email</label>
<input type="text" name="email" placeholder="Enter email" required>

<label>Message</label>
<input type="text" name="message" placeholder="Enter message" required>

<button type="submit" name="submit" class="submit-btn">
Save Details
</button>

</form>

</div>

</body>
</html>