<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header('Location: auth-login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Update - Lead Express Admin Dashboard</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="assets/images/logo.svg" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                <ul class="menu">
                        <li class='sidebar-title'>Main Menu</li>

                        <?php
                        if ($_SESSION['userPermission'] == 1) {

                        echo "
                        <li class='sidebar-item'>
                            <a href='index.php' class='sidebar-link'>
                                <i data-feather='home' width='20'></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class='sidebar-item'>
                            <a href='agents.php' class='sidebar-link'>
                                <i data-feather='users' width='20'></i>
                                <span>Agents</span>
                            </a>
                        </li>

                        <li class='sidebar-item active'>
                            <a href='data.php' class='sidebar-link'>
                                <i data-feather='layers' width='20'></i>
                                <span>Data</span>
                            </a>
                        </li>

                        <li class='sidebar-item'>
                            <a href='profile.php' class='sidebar-link'>
                                <i data-feather='user' width='20'></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        ";
                        }
                        else{
                            echo "
                            <li class='sidebar-item active'>
                                <a href='data.php' class='sidebar-link'>
                                    <i data-feather='layers' width='20'></i>
                                    <span>Data</span>
                                </a>
                            </li>

                            <li class='sidebar-item'>
                                <a href='profile.php' class='sidebar-link'>
                                    <i data-feather='user' width='20'></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            ";
                        }
                        ?>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <?php
                                    $randomAlphabet = chr(rand(97, 100));
                                    echo "<img src='assets/images/avatar/avatar-$randomAlphabet.png' alt='' srcset=''>";
                                    ?>
                                </div>
                                <?php
                                echo "<div class='d-none d-md-block d-lg-inline-block'>Hi, $_SESSION[username]</div>"
                                ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="php/exitUser.php"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Data Page</h3>
                    <p class="text-subtitle text-muted">Lead Express Private Limited</p>
                </div>
                <section class="section">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Update Data Details</h4>
                                </div>
                                <?php
                                    include 'php/sqlConnection.php';

                                    if(isset($_GET['dataId'])){
                                        $dataId = $_GET['dataId'];

                                        $sql = "SELECT * FROM `data` WHERE dataID = '$dataId'";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                    }
                                ?>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="php/updateData.php?dataId=<?php echo $dataId ?>" method="post" class="form">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="full-name-column">Full Name</label>
                                                        <input type="text" id="full-name-column" class="form-control" placeholder="Customer Full Name" name="fullName" value="<?php echo $row['fullName']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="email-column">Email</label>
                                                        <input type="email" id="email-column" class="form-control" placeholder="Email" name="email" value="<?php echo $row['email']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="phone-column">Phone Number</label>
                                                        <input type="number" id="phone-column" class="form-control" placeholder="Phone Number" name="phoneNumber" value="<?php echo $row['phoneNumber']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="landline-column">Landline</label>
                                                        <input type="number" id="landline-column" class="form-control" placeholder="Landline Number" name="landline" value="<?php echo $row['landline']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="street-number-column">Street Number</label>
                                                        <input type="number" id="street-number-column" class="form-control" placeholder="Street Number" name="streetNumber" value="<?php echo $row['streetNumber']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="street-name-column">Street Name</label>
                                                        <input type="text" id="street-name-column" class="form-control" placeholder="Street Name" name="streetName" value="<?php echo $row['streetName']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="suburb-column">Suburb</label>
                                                        <input type="text" id="suburb-column" class="form-control" placeholder="Suburb" name="suburb" value="<?php echo $row['suburb']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="post-code-column">Post Code</label>
                                                        <input type="number" id="post-code-column" class="form-control" placeholder="Post Code" name="postCode" value="<?php echo $row['postCode']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="biz-name-column">Business Name</label>
                                                        <input type="text" id="biz-name-column" class="form-control" placeholder="Business Full Name" name="bizFullName" value="<?php echo $row['businessName']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="abn-column">ABN</label>
                                                        <input type="number" id="abn-column" class="form-control" placeholder="Australian Business Number" name="abn" value="<?php echo $row['abn']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="solar-column">Number of Solar</label>
                                                        <input type="number" id="solar-column" class="form-control" placeholder="Solar" name="solarNo" value="<?php echo $row['numberOfSolar']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="installation-column">Installation Date & Time</label>
                                                        <input type="datetime-local" id="installation-column" class="form-control" placeholder="Preferred Installation Date" name="installDateTime" value="<?php echo $row['uploadedDateTime']?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="note-column">Note</label>
                                                        <textarea class="form-control" id="note-column" rows="3" name="note"><?php echo $row['note']?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> &copy; Lead Express Private Limited
                    </div>
                    <div class="float-end">
                        <p>
                            Programmed with
                            <span class="text-danger"><i data-feather="heart"></i></span> by
                            <a href="https://haitomns.com">Haitomns Groups</a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/vendors/chartjs/Chart.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/pages/ui-apexchart.js"></script>

    <script src="assets/js/main.js"></script>
</body>
</html>