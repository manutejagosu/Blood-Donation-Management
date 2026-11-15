<?php
$conn = mysqli_connect("localhost","root","","blood_donation");
if(!$conn)
{
die("Connection failed");
}
$blood_group = $_REQUEST['blood_group']?? ' ';
$units = $_REQUEST['units'] ?? ' ';
$required_date=$_REQUEST['required_date'] ?? ' ';
$city = $_REQUEST['city'] ?? ' ';
$state=$_REQUEST['state']?? ' ';
$mobile_number=$_REQUEST['mobile_number'] ?? ' ';
$insert_sql = "INSERT INTO blood_request 
(blood_group, units, required_date, city, state, mobile_number)
VALUES
('$blood_group',  '$units' , '$required_date',  '$city',  '$state',  '$mobile_number')";
mysqli_query($conn, $insert_sql);
$select_sql = "SELECT * FROM donor WHERE blood_group='$blood_group' AND city='$city' AND state='$state' ";
$result = mysqli_query($conn, $select_sql);
$count = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html>
<head>
<title>Search Result</title>
<style>
body{
display:flex;
justify-content:center;
align-items:center;
font-family:Arial,sans-serif;
background:linear-gradient(to right,#a770ef,#cf8bf3);
margin-top:100px;
}
h2{
    color:red;
    font-size:30px;
    text-align:center;
}
p{
    margin-left:103px;
    font-size:19px;
}
.box{
background:white;
width:500px;
margin:auto;
padding:30px;
border-radius:80px;
box-shadow:0px 0px 10px blue;
}

.available{
color:green;
font-size:24px;
}

.notavailable{
color:red;
font-size:19px;
margin-top:5px;
}
.card{
    background:pink;
    height:30px;
    margin-top:10px;
    margin-left:190px;
    border-radius:20px;
    font-size:19px;
}
.card:hover{
    background:#od47a1;
    transform:scale(1.05);
}
</style>
</head>
<body>
<div class="box">
<h2>&#x1FA78; Blood Search Result</h2>
<?php
echo "<p>Required Blood Group: <b>$blood_group</b></p>";
echo "<p>Required Units: <b>$units</b></p>";
echo "<p>City: <b>$city</b></p>";
if($count == 1)
{
echo "<p class='available'>$count donor available</p>";
echo "<p>Please contact Admin for donor details.</p>";
echo "<p><b>Admin Contact:9871236540</b></p>";
}
elseif($count > 1)
{
echo "<p class='available'>$count donors available</p>";
echo "<p>Please contact Admin for donor details.</p>";
echo "<p><b>Admin Contact:9871236540</b></p>";
}
else
{
echo "<p class='notavailable'>Sorry! No donors available for this location.</p>";
echo "<p class='notavailable'>Please try another location.</p>";
}
?>
<a href="findblood.html">
<button class="card" onclick="window.location.href='findblood.html'">Search Again</button>
</a>
</div>
</body>
</html>