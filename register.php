<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_group = $_POST['blood_group'];
    $mobile_number = $_POST['mobile_number'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $last_donation_date = $_POST['last_donation_date'];
    $donation_date = date('Y-m-d');
    $status="Eligible";
$camp=$_GET['camp_name']?? '';
if(empty($last_donation_date)){
 $sql = "INSERT INTO donor 
    (full_name, age, gender, blood_group, mobile_number, city, state, last_donation_date,donation_date,status)
    VALUES 
    ('$full_name', '$age', '$gender', '$blood_group', '$mobile_number', '$city', '$state', '0000-00-00','$donation_date','$status')";
if($conn->query($sql) === TRUE)
{
    $id = $conn->insert_id;

    $donor_id = "DON" . str_pad($id, 4, "0", STR_PAD_LEFT);

    $update = "UPDATE donor
               SET donor_id='$donor_id'
               WHERE id='$id'";

    $conn->query($update);

    header("Location: success.php?donor_id=" . urlencode($donor_id));
    exit();
}
else
{
    echo "Error: " . $conn->error;
}
}
else{
$last=new DateTime($last_donation_date);
$current=new DateTime($donation_date);
$interval=$last->diff($current);
$days=$interval->days;
if ($days>=90) {
    $sql = "INSERT INTO donor 
    (full_name, age, gender, blood_group, mobile_number, city, state, last_donation_date,donation_date,status)
    VALUES 
    ('$full_name', '$age', '$gender', '$blood_group', '$mobile_number', '$city', '$state', '$last_donation_date','$donation_date','$status')";
if($conn->query($sql) === TRUE)
{
    $id = $conn->insert_id;

    $donor_id = "DON" . str_pad($id, 4, "0", STR_PAD_LEFT);

    $update = "UPDATE donor
               SET donor_id='$donor_id'
               WHERE id='$id'";

    $conn->query($update);

    header("Location: success.php?donor_id=" . urlencode($donor_id));
    exit();
}
else
{
    echo "Error: " . $conn->error;
}
}
else{
$remaining_days=90-$days;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Not Eligible</title>
<style>
body{
    margin:0;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    font-family:Arial, sans-serif;
   background: linear-gradient(to right,#FF5FA2,#87CEEB);
}

.card{
    background:white;
    width:400px;
    padding:30px;
    text-align:center;
    border-radius:60px;
  box-shadow:0 0 10px #ff1493;
    }

h1{
font-size:28px;
    color:#dc2626;
margin-bottom:40px;
}

.days{
    color:#dc2626;
    font-size:22px;
    font-weight:bold;
}
p{
font-size:18px;
}
.btn{
    display:inline-block;
    margin-top:20px;
    padding:12px 25px;
    background:#7C3AED;
    color:white;
    text-decoration:none;
    border-radius:30px;
}
.btn:hover{
transform:scale(1.05);
}
</style>
</head>

<body>

<div class="card">
    <h1>⚠️ Not Eligible to Donate</h1>

    <p>
        You are currently not eligible to donate blood.
    </p>

    <p>
        Please wait
        <span class="days">
            <?php echo $remaining_days; ?> days
        </span>
        before your next donation.
    </p>

    <a href="home.html" class="btn">Back to home</a>
</div>

</body>
</html>
<?php
}
}
$conn->close();
?>