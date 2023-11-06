<?php
    include 'sqlConnection.php';

    if(isset($_GET['dataId'])){
        $dataId = $_GET['dataId'];

        $verifier_comment = $_POST['comment'];
        $status = $_POST['status'];

        $sql = "UPDATE `data` SET `verifierComment`='$verifier_comment',`status`='$status' WHERE dataID = '$dataId'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Data updated successfully!')</script>";
            echo "<script>window.location.href='../data.php'</script>";
        } else {
            echo "<script>alert('Data update failed!')</script>";
            echo "<script>window.location.href='../data.php'</script>";
        }
    }
?>