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

    if (strcmp($password, "Why you want to see your own password?") == 0) {
        $sql = "UPDATE `userdetails` SET `userPermissionNumber`='$permission',`agentName`='$agentName',`username`='$username' WHERE userIdentity = '$_SESSION[id]'";
    } else {
        $password_encrypt = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `userdetails` SET `userPermissionNumber`='$permission',`agentName`='$agentName',`username`='$username',`password`='$password_encrypt' WHERE userIdentity = '$_SESSION[id]'";
    }

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script> alert('User Updated, Login in with updated details.'); </script>";
        session_destroy();
        echo "<script>window.location.href='../auth-login.php';</script>";
    } else {
        echo "<script> alert('Error updating user'); </script>";
        echo "<script>window.history.back();</script>";
    }
}
