<?php
include("connect.php");

$id = $_GET['id'];

$sql = "DELETE FROM blood_request WHERE id='$id'";

if(mysqli_query($conn,$sql))
{
    echo "<script>
    alert('Blood Request deleted successfully');
    window.location='bloodrequest.php';
    </script>";
}
?>