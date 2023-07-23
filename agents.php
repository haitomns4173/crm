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
    <title>Agents - Lead Express Admin Dashboard</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">

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
                                    //generate a random alphabet between a to d
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
                    <h3>Agents Page</h3>
                    <p class="text-subtitle text-muted">Lead Express Private Limited</p>
                    <a href="auth-register.php"><button type="button" class="btn btn-primary">Add New Agents</button></a>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Agents Table
                        </div>
                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Agent Name</th>
                                        <th>Username</th>
                                        <th>User Type</th>
                                        <th>Last Login</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include 'php/sqlConnection.php';

                                        $sql = "SELECT `userIdentity`, `userPermissionNumber`, `agentName`, `username`, `lastLogin` FROM `userdetails` WHERE userPermissionNumber = 2";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>$row[userIdentity]</td>";
                                            echo "<td>$row[agentName]</td>";
                                            echo "<td>$row[username]</td>";
                                            echo "<td>Agent</td>";
                                            echo "<td>$row[lastLogin]</td>";
                                            echo "<td>
                                                    <a href='agentsUpdate.php?userId=$row[userIdentity]'><button class='btn btn-warning'>Edit</button></a>
                                                    <a href='php/deleteUser.php?userId=$row[userIdentity]'><button class='btn btn-danger'>Delete</button></a>
                                                    </td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
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

    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="assets/js/vendors.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>


    <script src="assets/js/main.js"></script>
</body>

</html>