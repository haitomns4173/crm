<?php
    include 'sqlConnection.php';
    session_start();
    
    $full_name = $_POST['fullName'];
    $email = $_POST['email'];
    $phone_number = $_POST['phoneNumber'];
    $landline = $_POST['landline'];
    $street_number = $_POST['streetNumber'];
    $street_name = $_POST['streetName'];
    $suburb = $_POST['suburb'];
    $post_code = $_POST['postCode'];
    $bix_full_name = $_POST['bizFullName'];
    $abn = $_POST['abn'];
    $solar_no = $_POST['solarNo'];
    $install_date_time = $_POST['installDateTime'];
    $note = $_POST['note'];

    $staffName = $_SESSION['username'];

    if(strlen($full_name) > 512 || strlen($full_name) < 1){
        echo "<script>alert('Enter a valid Full Name.')</script>";
        echo "<script>window.history.back();</script>";
    }
    else if(strlen($phone_number) > 10){
        echo "<script>alert('Enter a valid Phone Number.')</script>";
        echo "<script>window.history.back();</script>";
    }
    else if(strlen($landline) > 10){
        echo "<script>alert('Enter a valid Landline Number.')</script>";
        echo "<script>window.history.back();</script>";
    }
    else if(strlen($street_number) > 5){
        echo "<script>alert('Enter a valid Street Number.')</script>";
        echo "<script>window.history.back();</script>";
    }
    else if(strlen($street_name) > 512){
        echo "<script>alert('Enter a valid Street Name.')</script>";
        echo "<script>window.history.back();</script>";
    }
    else if(strlen($suburb) > 512){
        echo "<script>alert('Enter a valid Suburb.')</script>";
        echo "<script>window.history.back();</script>";
    }
    else if(strlen($post_code) > 4){
        echo "<script>alert('Enter a valid Post Code.')</script>";
        echo "<script>window.history.back();</script>";
    }
    else if(strlen($bix_full_name) > 512){
        echo "<script>alert('Enter a valid Bix Full Name.')</script>";
        echo "<script>window.history.back();</script>";
    }
    else if(strlen($abn) > 11){
        echo "<script>alert('Enter a valid ABN.')</script>";
        echo "<script>window.history.back();</script>";
    }
    else if(strlen($solar_no) > 11){
        echo "<script>alert('Enter a valid Solar Number.')</script>";
        echo "<script>window.history.back();</script>";
    }
    else {
        $sql = "INSERT INTO `data`(`dataID`, `fullName`, `email`, `phoneNumber`, `landline`, `streetNumber`, `streetName`, `suburb`, `postCode`, `businessName`, `abn`, `numberOfSolar`, `installationDateTime`, `uploadedDateTime`, `staffName`, `note`, `verifierComment`, `status`) VALUES ( NULL, '$full_name', '$email', '$phone_number', '$landline', '$street_number', '$street_name', '$suburb', '$post_code', '$bix_full_name', '$abn', '$solar_no', '$install_date_time', default, '$staffName', '$note', default, '1');";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>alert('Data Added Successfully.')</script>";
            echo "<script>window.location='../data.php'</script>";
        }
        else {
            echo "<script>alert('Data Not Added.')</script>";
            echo "<script>window.history.back();</script>";
        }
    }
?>