<?php
include("connect.php");

if (isset($_POST['save'])) {

    // Get form values
    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $mobile_number = $_POST['mobile_number'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $last_donation_date = $_POST['last_donation_date'];
    $donation_date = date("Y-m-d");
    $status = "Eligible";


    // Insert donor
    $query = "INSERT INTO donor
        (full_name, age, gender, blood_group, mobile_number,
         city, state, last_donation_date, donation_date, status)
        VALUES
        ('$full_name', '$age', '$gender', '$blood_group',
         '$mobile_number', '$city', '$state',
         '$last_donation_date', '$donation_date', '$status')";


    // Check INSERT
    if (mysqli_query($conn, $query)) {

        // Get automatically generated database ID
        $id = mysqli_insert_id($conn);

        // Generate Donor ID
        // Example: DON0001
        $donor_id = "DON" . str_pad($id, 4, "0", STR_PAD_LEFT);


        // Update donor_id
        $update = "UPDATE donor
                   SET donor_id = '$donor_id'
                   WHERE id = '$id'";


        // Check UPDATE
        if (mysqli_query($conn, $update)) {

            echo "<script>
                    alert('Donor Added Successfully!\\nDonor ID: $donor_id');
                    window.location.href = 'manage.php';
                  </script>";

        } else {

            // Show actual UPDATE error
            echo "<script>
                    alert('Donor was added, but Donor ID could not be generated.\\n\\nError: "
                    . mysqli_error($conn) .
                    "');
                  </script>";
        }

    } else {

        // Show actual INSERT error
        echo "<script>
                alert('Failed to Add Donor.\\n\\nError: "
                . mysqli_error($conn) .
                "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add New Donor</title>

<style>

body{
    margin:0;
    font-family:Arial;
    background-image:url('b.jpg');
background-size:cover;
background-repeat:no-repeat;
background-attachment:fixed;
}

.container{
    width:400px;
    margin:30px auto;
    background:#fff;
    padding:30px;
    border-radius:25px;
    box-shadow:0 15px 15px rgba(0,30,40,.2);
}

h2{
    text-align:center;
    color:#e53935;
}

label{
    display:block;
    margin-top:15px;
    font-weight:bold;
}

input,select{
    width:100%;
    padding:12px;
    margin-top:6px;
    border:1px solid #ccc;
    border-radius:10px;
    box-sizing:border-box;
    font-size:15px;
}

input:focus,
select:focus{
    outline:none;
    border:2px solid #e53935;
    box-shadow:0 0 10px rgba(229,57,53,.5);
}

button{
    width:100%;
    margin-top:25px;
    padding:12px;
    background:#e53935;
    color:white;
    border:none;
    border-radius:30px;
    font-size:17px;
    cursor:pointer;
}

button:hover{
    background:#c62828;
}

</style>

</head>

<body>

<div class="container">

<h2>🩸 Add New Donor</h2>

<form method="POST">

<label>Full Name</label>
<input type="text" name="full_name" placeholder="Enter full name" required>

<label>Age</label>
<input type="number" name="age" min="18" max="65" placeholder="Enter age" required>

<label>Gender</label>
<select name="gender" required>
<option value="">Select Gender</option>
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>

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

<label>Mobile Number</label>
<input type="text" name="mobile_number" maxlength="10" placeholder="Enter mobile number" required>

<label>City</label>
<input type="text" name="city" placeholder="Enter city" required>

<label>State</label>
<input type="text" name="state" placeholder="Enter state"required>

<label>Last Donation Date</label>
<input type="date" name="last_donation_date" >

<button type="submit" name="save">Save Donor</button>

</form>

</div>

</body>
</html>