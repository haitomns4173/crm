<?php
include 'sqlConnection.php';

session_start();

$agentName = $_POST['nameShow'];
$username = $_POST['usernameShow'];
$password = $_POST['passwordShow'];
$permission = $_POST['userPermissionShow'];

if ($agentName == "" || $username == "" || $password == "" || $permission == "") {
    echo "<script> alert('Please fill in all the fields'); </script>";
    echo "<script>window.history.back();</script>";
    exit();
} else {
    if(isset($_GET['userID'])){
        $userID = $_GET['userID'];
    
        if (strcmp($password, "Why you want to see your own password?")) {
            $sql = "UPDATE `userdetails` SET `userPermissionNumber`='$permission',`agentName`='$agentName',`username`='$username' WHERE userIdentity = '$userID'";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE `userdetails` SET `userPermissionNumber`='$permission',`agentName`='$agentName',`username`='$username',`password`='$password' WHERE userIdentity = '$userID'";
        }

        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script> alert('User updated successfully'); </script>";
            echo "<script> window.location.href='../agents.php'; </script>";
        } else {
            echo "<script> alert('Error updating user'); </script>";
            echo "<script>window.history.back();</script>";
        }
    } else {
    echo "<script> alert('Error updating user'); </script>";
    echo "<script>window.history.back();</script>";
    }
}