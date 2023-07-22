<?php
    include 'sqlConnection.php';

    session_start();

    session_destroy();
    $conn->close();
    header('Location: ../auth-login.php');
?>