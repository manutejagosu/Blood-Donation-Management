<?php

include("connect.php");

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM contact_details WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $update = "UPDATE contact_details
               SET
               name='$name',
               phone='$phone',
               email='$email',
               message='$message'
               WHERE id='$id'";

    if(mysqli_query($conn, $update))
    {
        echo "<script>
                alert('Contact Message Updated Successfully');
                window.location='contact_messages.php';
              </script>";
    }
    else
    {
        echo "<script>alert('Update Failed');</script>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Contact Messages</title>

<style>

body{
    margin:0;
    font-family:Arial,sans-serif;
    background-image:url('b.jpg');
background-size:cover;
background-repeat:no-repeat;
background-attachment:fixed;
}

.container{
    width:400px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:25px;
    box-shadow:0 15px 15px rgba(0,30,40,0.2);
}

h2{
    text-align:center;
    color:#e53935;
    margin-bottom:25px;
}

label{
    display:block;
    margin-top:15px;
    font-weight:bold;
}

input,select{
    width:100%;
    padding:12px 15px;
    margin-top:5px;
    border:1px solid #e0e0e0;
    border-radius:16px;
    box-sizing:border-box;
font-size:15px;
color:#333;
trasition:all 0.3s ease;
box-shadow:0 3px 8px rgba(0,0,0,0.08);
}
input:focus,select:focus{
outline:none;
border:1px solid #e53935;
box-shadow:0 0 15px rgba(229,57,53,0.8);
}

button{
    width:100%;
    margin-top:25px;
    padding:12px;
    background:#2196F3;
    color:white;
    border:none;
    border-radius:30px;
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

<h2>Edit Contact Messages</h2>

<form method="POST">

<label>Name</label>
<input type="text" name="name" value="<?php echo $row['name']; ?>" required>

<label>Phone</label>
<input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>

<label>Email</label>
<input type="text" name="email" value="<?php echo $row['email']; ?>" required>

<label>Message</label>
<input type="text" name="message" value="<?php echo $row['message']; ?>" required>

<button type="submit" name="update" onclick="return confirm('Edit this donor?')">Update Contact Message</button>

</form>

</div>

</body>
</html>