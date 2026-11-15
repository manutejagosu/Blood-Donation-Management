<?php
include("connect.php");

$id = $_GET['id'];

$sql = "DELETE FROM donor WHERE id='$id'";

if(mysqli_query($conn,$sql))
{
    echo "<script>
    alert('Donor deleted successfully');
    window.location='manage.php';
    </script>";
}
?>