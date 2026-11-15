<?php
include("connect.php");

$id = $_GET['id'];

// Fetch donor details
$query = "SELECT * FROM donor WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

//Update donor
if(isset($_POST['update']))
{
    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $mobile_number = $_POST['mobile_number'];
    $city = $_POST['city'];
    $last_donation_date = $_POST['last_donation_date'];
    $status = $_POST['status'];

    // Get OLD status and OLD blood group before updating

    $old_status = $row['status'];
    $old_blood_group = $row['blood_group'];

    $update = "UPDATE donor SET
                full_name='$full_name',
                age='$age',
                gender='$gender',
                blood_group='$blood_group',
                mobile_number='$mobile_number',
                city='$city',
                last_donation_date='$last_donation_date',
                status='$status'
                WHERE id='$id'";

    if(mysqli_query($conn, $update))
    {
       
        // 1. Eligible -> Donated
        // Increase blood stock by 1

        if($old_status != 'Donated' && $status == 'Donated')
        {
            $stock = "UPDATE blood_stock
                      SET units = units + 1
                      WHERE blood_group='$blood_group'";

            mysqli_query($conn, $stock);
        }

        // 2. Donated -> Eligible/Rejected
        // Decrease stock by 1

        elseif($old_status == 'Donated' && $status != 'Donated')
        {
            $stock = "UPDATE blood_stock
                      SET units = units - 1
                      WHERE blood_group='$old_blood_group'
                      AND units > 0";

            mysqli_query($conn, $stock);
        }

        echo "<script>
        alert('Donor Updated Successfully');
        window.location='manage.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Donor</title>

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

<h2>Edit Donor</h2>

<form method="POST">

<label>Full Name</label>
<input type="text" name="full_name" value="<?php echo $row['full_name']; ?>" required>

<label>Age</label>
<input type="number" name="age" value="<?php echo $row['age']; ?>" required>

<label>Gender</label>
<select name="gender" required>
    <option value="Male" <?php if($row['gender']=="Male") echo "selected"; ?>>Male</option>
    <option value="Female" <?php if($row['gender']=="Female") echo "selected"; ?>>Female</option>
    <option value="Other" <?php if($row['gender']=="Other") echo "selected"; ?>>Other</option>
</select>

<label>Blood Group</label>
<select name="blood_group" required>
    <option <?php if($row['blood_group']=="A+") echo "selected"; ?>>A+</option>
    <option <?php if($row['blood_group']=="A-") echo "selected"; ?>>A-</option>
    <option <?php if($row['blood_group']=="B+") echo "selected"; ?>>B+</option>
    <option <?php if($row['blood_group']=="B-") echo "selected"; ?>>B-</option>
    <option <?php if($row['blood_group']=="AB+") echo "selected"; ?>>AB+</option>
    <option <?php if($row['blood_group']=="AB-") echo "selected"; ?>>AB-</option>
    <option <?php if($row['blood_group']=="O+") echo "selected"; ?>>O+</option>
    <option <?php if($row['blood_group']=="O-") echo "selected"; ?>>O-</option>
</select>

<label>Mobile Number</label>
<input type="text" name="mobile_number" value="<?php echo $row['mobile_number']; ?>" required>

<label>City</label>
<input type="text" name="city" value="<?php echo $row['city']; ?>" required>

<label>Last Donation Date</label>
<input type="date" name="last_donation_date" value="<?php echo $row['last_donation_date']; ?>">

<label>Status</label>

<select name="status">
    <option value="Eligible" <?php if($row['status']=="Eligible") echo "selected"; ?>>Eligible</option>

    <option value="Donated" <?php if($row['status']=="Donated") echo "selected"; ?>>Donated</option>

    <option value="Rejected" <?php if($row['status']=="Rejected") echo "selected"; ?>>Rejected</option>
</select>

<button type="submit" name="update" onclick="return confirm('Edit this donor?')">Update Donor</button>

</form>

</div>

</body>
</html>