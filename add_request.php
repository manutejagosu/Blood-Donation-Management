<?php
include("connect.php");

if(isset($_POST['submit']))
{
    $blood_group = $_POST['blood_group'];
    $units = $_POST['units'];
    $required_date = $_POST['required_date'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $mobile_number = $_POST['mobile_number'];

    $sql="INSERT INTO blood_request(blood_group,units,required_date,city,state,mobile_number)
          VALUES('$blood_group','$units','$required_date','$city','$state','$mobile_number')";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
        alert('Blood Request Added Successfully');
        window.location='bloodrequest.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Blood Request</title>

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

<h2>New Blood Request</h2>

<form method="POST">

<label>Blood Group</label>

<select name="blood_group" required>
<option value="">Select Blood Group</option>
<option>A+</option>
<option>A-</option>
<option>B+</option>
<option>B-</option>
<option>AB+</option>
<option>AB-</option>
<option>O+</option>
<option>O-</option>
</select>

<label>Units Required</label>
<input type="number" name="units" placeholder="Enter units required" required>

<label>Required Date</label>
<input type="date" name="required_date" required>

<label>City</label>
<input type="text" name="city" placeholder="Enter city" required>

<label>State</label>
<input type="text" name="state" placeholder="Enter state"  required>

<label>Mobile Number</label>
<input type="text" name="mobile_number" maxlength="10"  placeholder="Enter 10-digit mobile number" required>

<button type="submit" name="submit" class="submit-btn">
Save Request
</button>

</form>

</div>

</body>
</html>