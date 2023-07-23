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
    <title>Agents Update - Lead Express Admin Dashboard</title>

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

                        <li class="sidebar-item">
                            <a href="index.php" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item active">
                            <a href="agents.php" class='sidebar-link'>
                                <i data-feather="users" width="20"></i>
                                <span>Agents</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="data.php" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Data</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="profile.php" class='sidebar-link'>
                                <i data-feather="user" width="20"></i>
                                <span>Profile</span>
                            </a>
                        </li>
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
                    <h3>Profile Page</h3>
                    <p class="text-subtitle text-muted">Lead Express Private Limited</p>
                </div>
                <section class="section">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Your Profile</h4>
                                </div>
                                <?php
                                include 'php/sqlConnection.php';

                                if (isset($_GET['userId'])) {
                                    $userId = $_GET['userId'];
                                    $sql = "SELECT `userIdentity`, `userPermissionNumber`, `agentName`, `username` FROM `userdetails` WHERE userdetails.userIdentity = '$userId'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                } else {
                                    echo "<script>alert('Error while updating User'); window.location.href='agents.php';</script>";
                                }
                                ?>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="php/updateAgents.php?userID=<?php echo $userId ?>" method="post" class="form">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Agent Name</label>
                                                        <input type="text" id="first-name-column" class="form-control" placeholder="Agent Full Name" name="nameShow" value="<?php echo $row['agentName'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="username-column">Username</label>
                                                        <input type="text" id="username-column" class="form-control" placeholder="Agent Username" name="usernameShow" value="<?php echo $row['username'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="password-floating">Password</label>
                                                        <input type="password" id="password-floating" class="form-control" placeholder="Agent Password" name="passwordShow" value="Why you want to see your own password?">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="user-type">Agent Type</label>
                                                        <select name="userPermissionShow" id="user-type" class="form-control">
                                                            <?php
                                                            if ($row['userPermissionNumber'] == 1) {
                                                                echo "<option value='1' selected>Central Supervisor</option>";
                                                                echo "<option value='2'>Agent</option>";
                                                            } else {
                                                                echo "<option value='1'>Central Supervisor</option>";
                                                                echo "<option value='2' selected>Agent</option>";
                                                            }
                                                            ?>
                                                        </select>
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
                        </script> &copy; Haitomns Groups
                    </div>
                    <div class="float-end">
                        <p>
                            Programmed with
                            <span class="text-danger"><i class="bi bi-heart"></i></span> by
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