<?php
include("connect.php");

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $query = "SELECT * FROM blood_request
              WHERE blood_group LIKE '%$search%'
                 OR city LIKE '%$search%'
                 OR mobile_number LIKE '%$search%'
              ORDER BY id DESC";
} else {
    $query = "SELECT * FROM blood_request ORDER BY id DESC";
}

$result = mysqli_query($conn, $query);
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
    font-family:Arial,sans-serif;
}
.page-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}
.page-header h2{
margin-left:9px;
align-items:center;
font-size:30px;
color:#333;
}
.add-btn{
position:absolute;
top:50px;
right:30px;
    display:inline-block;
    background:#ff5c5c;
    color:#fff;
border:none;
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
.main-content{
    margin-left:270px;
    padding:30px;
    background:#f5f7fb;
}
.table-container{
width:100%;
border-radius:12px;
overflow-x:auto;
margin-top:40px;
}
table{
width:100%;
min-width:900px;
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


/* Search Box */
.search-box{
    margin-bottom:20px;
}
.search-box input:focus{
    border-color:#ff5b5b;
    box-shadow:0 0 5px rgba(255,91,91,.4);
}
.search-box{
margin-left:15px;
margin-top:25px;
margin-bottom:20px;
}

.search-box form{
    display:flex;
    align-items:center;
    gap:10px;
}

.search-box input{
    width:350px;
    height:45px;
    padding:0 15px;
    border:2px solid #ddd;
    border-radius:25px;
    outline:none;
    font-size:13px;
    transition:0.3s;
}

.search-box input:focus{
    border-color:#ff5c5c;
    box-shadow:0 0 8px rgba(255,92,92,0.4);
}

.search-btn{
    height:45px;
    padding:0 25px;
    background:linear-gradient(135deg,#ff5c5c,#ff7b7b);
    color:#fff;
    border:none;
    border-radius:25px;
    font-size:18px;
    cursor:pointer;
    transition:0.3s;
    box-shadow:0 4px 10px rgba(255,92,92,0.3);
}

.search-btn:hover{
    background:linear-gradient(135deg,#e53935,#ff5c5c);
    transform:translateY(-2px);
    box-shadow:0 6px 15px rgba(255,92,92,0.4);
}

.search-btn:active{
    transform:scale(0.97);
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

            <li class="active">
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
<div class="main-content">
<div class="page-header">
<h2>📝Blood Requests</h2>
<a href="add_request.php"><button class="add-btn">+Add New Request</button>
</a>
</div>
<div class="search-box">
<form method="GET">
    <input type="text" name="search" placeholder="Search by Blood Group, City or Mobile Number">
<button type="submit" class="search-btn">
            🔍 Search
        </button>
</form>
</div>
<div class="table-container">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Blood Group</th>
            <th>Units</th>
            <th>Required Date</th>
            <th>City</th>
            <th>State</th>
            <th>Mobile Number</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

    <?php
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
    ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['blood_group']; ?></td>
            <td><?php echo $row['units']; ?></td>
            <td><?php echo $row['required_date']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['state']; ?></td>
            <td><?php echo $row['mobile_number']; ?></td>
<td><?php echo $row['status']; ?></td>
<td class="action">

<a class="edit" href="edit_bloodrequest.php?id=<?php echo $row['id']; ?>">
<i class="fa-solid fa-pen-to-square"></i></a>

<a class="delete"
href="delete_bloodrequest.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this donor?')">
<i class="fa-solid fa-trash"></i>
</a>

</td>

        </tr>

    <?php
        }
    }
    else
    {
        echo "<tr><td colspan='7'>No Blood Requests Found</td></tr>";
    }
    ?>

    </tbody>

</table>
</div>
</div>
</body>
</html>