<?php
$conn = mysqli_connect("localhost","root","","blood_donation");

$query = "SELECT * FROM blood_stock";
$result = mysqli_query($conn,$query);

$groups = [];
$units = [];

while($row = mysqli_fetch_assoc($result))
{
    $groups[] = $row['blood_group'];
    $units[] = $row['units'];
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Blood Stock Graph</title>

<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
font-family:Arial;
background:#f4f4f4;
}

.contain{
width:900px;
height:500px;
margin:60px auto;
margin-left:320px;
background:white;
padding:20px;
padding-top:10px;
border-radius:60px;
box-shadow:0 10px 30px rgba(0,0,0,0.95);
}

.contain h1{
margin-top:5px;
margin-bottom:15px;
font-size:28px;
text-align:center;
color:darkred;
}
</style>

</head>

<body>
<div class="container">

    <!-- Sidebar -->

    <div class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-heart-circle-plus"></i>
            <h2>Blood Donation</h2>
        </div>

        <ul>

            <li >
                <a href="dashboard.php">
                    <i class="fas fa-home"></i>Admin 
                      Dashboard
                </a>
            </li>

            <li>
                <a href="manage.php">
                    <i class="fas fa-users"></i>
                    Manage Donors
                </a>
            </li>

            <li>
                <a href="bloodrequest.php">
                    <i class="fas fa-hand-holding-medical"></i>
                    Blood Requests
                </a>
            </li>

            <li>
                <a href="contact_messages.php">
                    <i class="fas fa-envelope"></i>
                    Contact Messages
                </a>
            </li>
           <li class="active">
                <a href="blood_stock.php">
                    <i class="fas fa-flask"></i>
                    Blood Stock
                </a>
            </li>

            <li>
                <a href="profile.php">
                    <i class="fas fa-user"></i>
                    Admin Profile
                </a>
            </li>

            <li>
                <a href="change_password.php">
                    <i class="fas fa-cog"></i>
                    Website Settings
                </a>
            </li>

            <li>
                <a href="logout.php">
                    <i class="fas fa-right-from-bracket"></i>
                    Logout
                </a>
            </li>

        </ul>

    </div>
<div class="contain">

<h1>Blood Stock Availability</h1>

<canvas id="bloodChart"></canvas>

</div>

<script>

const ctx=document.getElementById('bloodChart');

new Chart(ctx,{

type:'bar',

data:{

labels:<?php echo json_encode($groups); ?>,

datasets:[{

label:'Available Units',

data:<?php echo json_encode($units); ?>,

backgroundColor:'red',

borderWidth:1

}]

},

options:{

responsive:true,
datasets:{
bar:{
barThickness:50
}
},
plugins:{
legend:{
display:false
}
},

scales:{
x:{
ticks:{
color:"#000000",
font:{
size:16,
weight:"bold"
}
},
grid:{
display:false
}
},
y:{
beginAtZero:true,
ticks:{
color:"#000000",
font:{
size:14,
}
}
}
}
}
});
</script>
</body>
</html>