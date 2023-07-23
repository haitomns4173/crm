<?php
include 'sqlConnection.php';

session_start();

function restoreMysqlDB($filePath, $conn)
{
    $conn->query("SET FOREIGN_KEY_CHECKS=0");
    $sql = "SHOW TABLES";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_row($result)) {
        $sql = "DROP TABLE IF EXISTS $row[0]";
        mysqli_query($conn, $sql);
    }

    $sql = '';
    $error = '';
    
    if (file_exists($filePath)) {
        $lines = file($filePath);
        
        foreach ($lines as $line) {
            
            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            
            $sql .= $line;
            
            if (substr(trim($line), - 1, 1) == ';') {
                $result = mysqli_query($conn, $sql);
                if (! $result) {
                    $error .= mysqli_error($conn) . "\n";
                }
                $sql = '';
            }
        } // end foreach
        
        if ($error) {
            $response = array(
                "type" => "error",
                "message" => $error
            );
        } else {
            $response = array(
                "type" => "success",
                "message" => "Database Restore Completed Successfully."
            );
        }
    } // end if file exists
    return $response;
}

if (isset($_FILES['dbRestoreFile'])) {
    $fileName = $_FILES['dbRestoreFile']['name'];
    $fileTmpName = $_FILES['dbRestoreFile']['tmp_name'];
    $fileError = $_FILES['dbRestoreFile']['error'];
    $fileSize = $_FILES['dbRestoreFile']['size'];
    $fileType = $_FILES['dbRestoreFile']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array(
        'sql'
    );

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 100000000) {
                $fileNameNew = "dbBackup" . "." . $fileActualExt;
                $fileDestination = '../dbBackup/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $filePath = $fileDestination;

                $result = restoreMysqlDB($filePath,$conn);
                if($result['type'] == 'success'){
                    echo "<script>alert('Database Restore Completed Successfully.')</script>";
                    echo "<script>window.location.href='../profile.php'</script>";

                    $username = $_SESSION['username'];
                    $date = date("Y-m-d h:i:sa");
                }else{
                    echo "<script>alert('Database Restore Failed.')</script>";
                    echo "<script>window.location.href='../profile.php'</script>";
                }
            } else {
                echo "<script>alert('Your file is too big!')</script>";
                echo "<script>window.location.href='../profile.php'</script>";
            }
        } else {
            echo "<script>alert('There was an error uploading your file!')</script>";
            echo "<script>window.location.href='../profile.php'</script>";
        }
    } else {
        echo "<script>alert('You cannot upload files of this type!')</script>";
        echo "<script>window.location.href='../profile.php'</script>";
    }
}
else{
    echo "<script>alert('Please Select a File.')</script>";
    echo "<script>window.location.href='../profile.php'</script>";
}
