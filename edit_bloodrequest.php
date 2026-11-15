<?php
include("connect.php");

$id = $_GET['id'];

// Fetch blood request details
$query = "SELECT * FROM blood_request WHERE id='$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Update blood request
if(isset($_POST['update']))
{
    $blood_group = $_POST['blood_group'];
    $units = intval($_POST['units']);
    $required_date = $_POST['required_date'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $mobile_number = $_POST['mobile_number'];
    $status = $_POST['status'];

    // OLD values
    $old_status = $row['status'];
    $old_blood_group = $row['blood_group'];
    $old_units = intval($row['units']);


    /* CASE 1: Changing status TO ISSUED  */

    if($old_status != 'Issued' && $status == 'Issued')
    {
        // Check units
        if($units <= 0)
        {
            echo "<script>
            alert('Units must be greater than 0!');
            window.location='edit_bloodrequest.php?id=$id';
            </script>";
            exit;
        }


        // Check blood stock
        $stock_query = "SELECT units
                        FROM blood_stock
                        WHERE blood_group='$blood_group'";

        $stock_result = mysqli_query($conn, $stock_query);


        // Blood group not found
        if(mysqli_num_rows($stock_result) == 0)
        {
            echo "<script>
            alert('Blood group not available in blood stock!');
            window.location='edit_bloodrequest.php?id=$id';
            </script>";
            exit;
        }


        $stock_row = mysqli_fetch_assoc($stock_result);
        $available_units = intval($stock_row['units']);


        // Not enough blood
        if($available_units < $units)
        {
            echo "<script>
            alert('Not enough blood stock available! Available: $available_units units, Required: $units units.');
            window.location='edit_bloodrequest.php?id=$id';
            </script>";
            exit;
        }


        // Enough stock → decrease stock
        $new_stock = $available_units - $units;

        $decrease_stock = "UPDATE blood_stock
                           SET units='$new_stock'
                           WHERE blood_group='$blood_group'";

        if(!mysqli_query($conn, $decrease_stock))
        {
            echo "<script>
            alert('Unable to update blood stock!');
            window.location='edit_bloodrequest.php?id=$id';
            </script>";
            exit;
        }
    }


    /*
    CASE 2: Already ISSUED → Don't decrease again
    */

    elseif($old_status == 'Issued' && $status == 'Issued')
    {
        // Do nothing to blood stock
    }


    /*
    CASE 3: ISSUED → another status
    Add previous units back
    */

    elseif($old_status == 'Issued' && $status != 'Issued')
    {
        $restore_stock = "UPDATE blood_stock
                          SET units = units + $old_units
                          WHERE blood_group='$old_blood_group'";

        mysqli_query($conn, $restore_stock);
    }


    /*
    Finally update blood request
    */

    $update = "UPDATE blood_request SET
                blood_group='$blood_group',
                units='$units',
                required_date='$required_date',
                city='$city',
                state='$state',
                mobile_number='$mobile_number',
                status='$status'
                WHERE id='$id'";


    if(mysqli_query($conn, $update))
    {
        echo "<script>
        alert('Blood Request Updated Successfully');
        window.location='bloodrequest.php';
        </script>";
    }
    else
    {
        echo "<script>
        alert('Update Failed');
        window.location='edit_bloodrequest.php?id=$id';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Blood Request</title>

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

<h2>Edit Blood Request</h2>

<form method="POST">

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
<label>Units</label>
<input type="number" name="units" value="<?php echo $row['units']; ?>" required>

<label>Required Date</label>
<input type="date" name="required_date" value="<?php echo $row['required_date']; ?>" required>

<label>City</label>
<input type="text" name="city" value="<?php echo $row['city']; ?>" required>

<label>State</label>
<input type="text" name="state" value="<?php echo $row['state']; ?>" required>

<label>Mobile Number</label>
<input type="text" name="mobile_number" value="<?php echo $row['mobile_number']; ?>" required>

<label>Status</label>

<select name="status">
    <option value="Pending" <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>

    <option value="Approved" <?php if($row['status']=="Approved") echo "selected"; ?>>Approved</option>

    <option value="Issued" <?php if($row['status']=="Issued") echo "selected"; ?>>Issued</option>

    <option value="Rejected" <?php if($row['status']=="Rejected") echo "selected"; ?>>Rejected</option>
</select>

<button type="submit" name="update" onclick="return confirm('Edit this donor?')">Update Blood Request</button>

</form>

</div>

</body>
</html>