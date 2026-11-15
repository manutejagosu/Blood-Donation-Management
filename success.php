<?php
echo " ";
$donor_id=$_GET['donor_id'] ?? ' ';
?>
<!DOCTYPE html>
<html>
<head>
<title>Registration Successful</title>
<style>
body{
    font-family: Arial, sans-serif;
    background: linear-gradient(to right,#FF5FA2,#87CEEB);
    justify-content:center;
    align-items:center;
    display:flex;
    text-align: center;
    padding: 200px;
    height:20vh;
}

.box{
    background: white;
    width: 400px;
    margin: auto;
    padding: 40px;
    border-radius: 70px;
    box-shadow:0 0 10px #ff1493;
}

h2{
font-size:26px;
    color: green;
}

a{
    display:inline-block;
    text-decoration: none;
    background: #2196f3;
    color: white;
    padding: 12px 20px;
    border-radius: 20px;
}

a:hover{
    transform:scale(1.05);
}
p{
line-height:30px;
}
b{
font-size:20px;
}
</style>

</head>

<body>

<div class='box'>
<h2>✔ Registration Successful</h2>
<p>Your registration has been received.Final eligibility will be confirmed by medical staff before donation.</p>
<b><p>Your Donor ID is: <?php echo $donor_id; ?></p></b>
<a href="home.html">Back to home</a>
</div>
</body>
</html>