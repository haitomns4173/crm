<?php
include 'sqlConnection.php';

session_start();

if (!isset($_POST['usernameInput'], $_POST['passwordInput'])) {
    exit('Please fill both the username and password fields!');
} else {
    if ($stmt = $conn->prepare('SELECT `userIdentity`, `userPermissionNumber`, `agentName`, `password` FROM `userdetails` WHERE username = ?')) {

        $stmt->bind_param('s', $_POST['usernameInput']);
        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId, $userPermission, $username, $password);
            $stmt->fetch();

            if (password_verify($_POST['passwordInput'], $password)) {

                session_start();
                session_regenerate_id();

                $_SESSION['loggedIn'] = TRUE;
                $_SESSION['id'] = $userId;
                $_SESSION['username'] = $username;
                $_SESSION['userPermission'] = $userPermission;

                $sql_login = "UPDATE `userdetails` SET `lastLogin`= CURRENT_TIMESTAMP WHERE `userIdentity` = $userId";
                $result_login = mysqli_query($conn, $sql_login);

                if($userPermission == 1){
                    header('Location: ../index.php');
                }
                else{
                    header('Location: ../data.php');
                }
                
            } else {
                echo '<script>alert("Incorrect Username or Password");</script>';
                echo '<script>window.location="../auth-login.php"</script>';
            }
        } else {
            echo '<script>alert("Incorrect Username or Password");</script>';
            echo '<script>window.location="../auth-login.php"</script>';
        }

        $stmt->close();
    }
}
