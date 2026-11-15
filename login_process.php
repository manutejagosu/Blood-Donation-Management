<?php
session_start();
include "connect.php";
$username=$_POST['username'];
$password=$_POST['password'];
$stmt=$conn->prepare("SELECT * FROM admin WHERE username=?");
$stmt->bind_param("s",$username);
$stmt->execute();
$result=$stmt->get_result();
if($result->num_rows==1){
$row=$result->fetch_assoc();
if(password_verify($password,$row['password'])){
$_SESSION['username']=$row['username'];
$update=$conn->prepare("UPDATE admin SET last_login = current_login, 
current_login = NOW() WHERE username= ?");
$update->bind_param("s",$username);
$update->execute();
header("Location: dashboard.php");
exit();
}
else{
echo "<script> 
alert('Incorrect Password');
window.location= 'admin.php';
</script>";
exit();
}
}
else{
echo "<script> 
alert('Username Not Found');
window.location= 'admin.php';
</script>";
exit();
}
?>