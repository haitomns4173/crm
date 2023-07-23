<?php
    include 'sqlConnection.php';

    if(isset($_GET['userId'])) {
        $userId = $_GET['userId'];
        $sql = "DELETE FROM `userdetails` WHERE userIdentity = $userId";
        $result = mysqli_query($conn, $sql);
        if($result) {
            echo "<script>alert('Agent deleted successfully')</script>";
            echo "<script>window.location.href='../agents.php'</script>";
        } else {
            echo "<script>alert('Agent deletion failed')</script>";
            echo "<script>window.location.href='../agents.php'</script>";
        }
    } else {
        echo "<script>alert('Agent deletion failed')</script>";
        echo "<script>window.location.href='../agents.php'</script>";
    }
