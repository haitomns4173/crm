<?php
include 'sqlConnection.php';

session_start();

if ($stmt = $conn->prepare('SELECT userIdentity FROM `userdetails` WHERE username = ?')) {

    $stmt->bind_param('s', $_POST['usernameInput']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo '<script>alert("Username exists, Type a different username.");</script>';
    } else {
        if(strlen($_POST['usernameInput']) < 4){
            echo "<script>alert('Username must be of 4 digits.');</script>";
            echo "<script>window.history.back();</script>";	
        }
        else if(strlen($_POST['passwordInput']) < 4){
            echo "<script>alert('Password must be of 4 digits.');</script>";
            echo "<script>window.history.back();</script>";	
        }
        else if(strlen($_POST['agentNameInput']) < 2){
            echo "<script>alert('Agent Name must be of 2 digits.');</script>";
            echo "<script>window.history.back();</script>";	
        }
        else if(strcmp($_POST['userPermissionInput'], "0") == 0){
            echo "<script>alert('Select User Type.');</script>";
            echo "<script>window.history.back();</script>";
        }
        else{
            if ($stmt = $conn->prepare('INSERT INTO `userdetails`(`userIdentity`, `userPermissionNumber`, `agentName`, `username`, `password`) VALUES (null, ?, ?, ?, ?)')) {

                $passwordEncrypt = password_hash($_POST['passwordInput'], PASSWORD_DEFAULT);
    
                $stmt->bind_param('isss', $_POST['userPermissionInput'], $_POST['agentNameInput'], $_POST['usernameInput'], $passwordEncrypt);
                $stmt->execute();

                echo "<script>alert('User Registered');</script>";
                echo "<script>window.location.href='../auth-login.php';</script>";
            } else {
                echo "<script>alert('User Not Registered');</script>";
                echo "<script>window.history.back();</script>";	
            }
        }
    }
} else {
    echo "<script>alert('User Not Registered');</script>";
    echo "<script>window.history.back();</script>";	
}
$conn->close();
?>