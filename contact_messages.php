<?php
include "connect.php";

if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $sql = "SELECT * FROM contact_details
            WHERE name LIKE '%$search%'
            OR email LIKE '%$search%'
            OR phone LIKE '%$search%'
            ORDER BY id DESC";
}
else
{
    $sql = "SELECT * FROM contact_details ORDER BY id DESC";
}

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>

<title>Contact Messages</title>

<link rel="stylesheet" href="dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>

*{
    margin:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#eef3f9;
    display:flex;
}

/* Main Content */

.main{
    margin-left:240px;
    width:calc(100% - 240px);
    padding:20px 30px;
}

/* Header */

.top{
    display:flex;
flex-direction:column;
align-items:flex-start;
gap:20px;
margin-bottom:30px;
}

.top h1{
margin:0;
color:#273469;
font-size:34px;
font-weight:600;
}

.top h1 i{
color:#ff4d6d;
}
.top form{
    display:flex;
margin-left:25px;
}

.top input{
    width:320px;
    padding:12px;
    border:1px solid #ccc;
    border-radius:30px 0 0 30px;
    outline:none;
}

.top button{
    padding:12px 20px;
    border:none;
    background:#ff4d6d;
    color:white;
    border-radius:0 30px 30px 0;
    cursor:pointer;
    font-weight:bold;
}

.top button:hover{
    background:#e63b5d;
}
.search{
margin-top:10px;
margin-bottom:25px;
}
/* Table */

table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 6px 18px rgba(0,0,0,.15);
}

table th{
    background:#273469;
    color:#fff;
    padding:15px;
    font-size:16px;
}

table td{
    padding:14px;
    text-align:center;
    border-bottom:1px solid #eee;
}

table tr:nth-child(even){
    background:#f8f9fc;
}

table tr:hover{
    background:#eaf3ff;
}

/* View Button */

.view{
    display:inline-block;
    background:#3498db;
    color:white;
    text-decoration:none;
    padding:8px 15px;
    border-radius:6px;
    font-size:14px;
}

.view:hover{
    background:#217dbb;
}

/* Delete Button */

.delete{
    display:inline-block;
    background:#dc3545;
    color:white;
    text-decoration:none;
    padding:8px 15px;
    border-radius:6px;
    font-size:14px;
}

.delete:hover{
    background:#b02a37;
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

<h2>Blood Donation</h2>

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
            <li class="active">
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

<!-- Main -->

<div class="main">

<div class="top">

<h1><i class="fas fa-envelope-open-text"></i> Contact Messages</h1>

<form method="GET" class="search" >

<input type="text"  name="search" placeholder="Search by Name, Email or Phone">

<button type="submit" style="font-size:17px;">

<i class="fas fa-search"></i> Search</button>

</form>

</div>

<a href="add_contact_messages.php" class="add-btn">+New Contact Message</a>

<table>

<tr>

<th>ID</th>

<th>Name</th>

<th>Phone</th>

<th>Email</th>

<th>Message</th>

<th>Action</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['message']; ?></td>

<td>
<a class="view" href="edit_contact_messages.php?id=<?php echo $row['id']; ?>">
<i class="fa-solid fa-pen-to-square"></i></a>

<a class="delete"
href="delete_contact_messages.php?id=<?php echo $row['id']; ?>"
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