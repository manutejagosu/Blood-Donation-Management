<?php
include "connect.php";

if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $sql = "SELECT * FROM donor
            WHERE donor_id  LIKE '%$search%'
            OR full_name LIKE '%$search%'
            OR blood_group LIKE '%$search%'
            OR city LIKE '%$search%'
            ORDER BY id DESC";
}
else
{
    $sql = "SELECT * FROM donor ORDER BY donor_id DESC";
}
$result = mysqli_query($conn,$sql);
?>
 <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
display:flex;
background:#f5f7fb;
}

/* Main */

.main{
margin-left:260px;
padding:30px;
width:100%;
}

.header{
display:flex;
flex-direction:column;
align-items:flex-start;
margin-bottom:35px;
}

.header h1{
letter-spacing:-1px;
margin-top:10px;
color:#222;
}

.search{
display:flex;
align-items:center;
gap:15px;
margin-top:25px;
}
.search input{
padding:10px;
width:260px;
border:1px solid #ccc;
margin-left:50px;
font-size:14px;
border-radius:26px;
}

.search button{
padding:10px 18px;
border:none;
background:#ff4d6d;
color:white;
font-size:16px;
border-radius:26px;
cursor:pointer;
}

.search btn{
margin-left:100px;
}
.btn:hover{
    background:#e53935;
    transform:translateY(-2px);
    box-shadow:0 8px 18px rgba(229,57,53,0.4);
}
/* Table */

table{
width:100%;
min-width:1200px;
border-collapse:collapse;
background:white;
box-shadow:0 3px 10px rgba(0,0,0,.2);
border-radius:10px;
overflow:hidden;
}

th{
background:#273469;
color:white;
padding:15px;
}

td{
padding:15px;
text-align:center;
}

tr:nth-child(even){
background:#f2f2f2;
}

tr:hover{
background:#eaf2ff;
}
fa-pen-to-square{
    color:#2196F3;
    font-size:20px;
    margin-right:20px;
    cursor:pointer;
}

.fa-trash{
    color:#E53935;
    font-size:18px;
    cursor:pointer;
}

.fa-pen-to-square:hover{
    color:#1565C0;
}

.fa-trash:hover{
    color:#B71C1C;
}
.action{
display:flex;
gap:20px;
}
.add-btn{
position:absolute;
top:50px;
right:30px;
    display:inline-block;
    background:#ff5c5c;
    color:#fff;
    text-decoration:none;
    padding:15px 20px;
    border-radius:12px;
    font-size:18px;
    transition:0.3s;
    box-shadow:0 5px 12px rgba(255,92,92,0.3);
}

.add-btn:hover{
    background:#e53935;
    transform:translateY(-2px);
    box-shadow:0 8px 18px rgba(229,57,53,0.4);
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

            <li class="active">
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
            <li>
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

<div class="main">

<div class="header">

<h1>🩸 Manage Donors</h1>

<form class="search" method="GET">

<input type="text" name="search" placeholder="Search by Donor ID,Name, Blood Group or City">

<button type="submit" class="btn">🔍 Search</button>

</form>

</div>
<a href="add_donor.php" class="add-btn">+Add New Donor</a>

<table>

<tr>

<th>Donor ID</th>

<th>Full Name</th>

<th>Age</th>

<th>Gender</th>

<th>Blood Group</th>

<th>Mobile Number</th>

<th>City</th>

<th>State</th>

<th>Last Donation</th>

<th>Registration Date</th>

<th>Status</th>

<th>Action</th>

</tr>
<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['donor_id']; ?></td>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['age']; ?></td>

<td><?php echo $row['gender']; ?></td>

<td><?php echo $row['blood_group']; ?></td>

<td><?php echo $row['mobile_number']; ?></td>

<td><?php echo $row['city']; ?></td>

<td><?php echo $row['state']; ?></td>

<td><?php echo $row['last_donation_date']; ?></td>

<td><?php echo $row['donation_date']; ?></td>

<td><?php echo $row['status']; ?></td>

<td class="action">

<a class="edit" href="edit_donor.php?id=<?php echo $row['id']; ?>">
<i class="fa-solid fa-pen-to-square"></i></a>

<a class="delete"
href="delete_donor.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this donor?')">
<i class="fa-solid fa-trash"></i>
</a>

</td>

</tr>

<?php
}

?>

</table>

</div>
</body>
</html>