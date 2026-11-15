<?php
include("connect.php");

$id = $_GET['id'];

$sql = "DELETE FROM contact_details WHERE id='$id'";

if(mysqli_query($conn,$sql))
{
    echo "<script>
    alert('Contact deleted successfully');
    window.location='contact_messages.php';
    </script>";
}
?>