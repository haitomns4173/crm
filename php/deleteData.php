<?php
    include 'sqlConnection.php';	
    session_start();

    if(isset($_GET['dataId'])){
        $id = $_GET['dataId'];

        $sql = "DELETE FROM `data` WHERE dataID = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>alert('Data Deleted Successfully');</script>";
            echo "<script>window.location.href='../data.php';</script>";
        }else{
            echo "<script>alert('Data Deletion Failed');</script>";
            echo "<script>window.location.href='../data.php';</script>";
        }
    }
    else{
        echo "<script>alert('Data Deletion Error.');</script>";
        echo "<script>window.location.href='../data.php';</script>";
    }
?>