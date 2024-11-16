<?php
if (!isset($_SESSION['university_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: ./login");
}
include '../config/config.php';
include '../config/secrets.php';
include '../includes/uni/functions.php';
$university_id = $_SESSION['university_id'];
$uni_details = getUniversityDetails($_SESSION["university_id"]);
$university_abbreviation = $uni_details['abbreviation'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? "Overview" ?> - INFund</title>
    <link rel="icon" href="../assets/icons/favicon.ico">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options.progressBar = true;
    </script>
    <link rel="stylesheet" href="../assets/css/colors.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user/nav.css">
    <!-- Adding dynamic css to the pages, the CSS file can be passed from the current page -->
    <?php if (isset($css1)) : ?>
        <link rel="stylesheet" href="../assets/css/user/<?= $css1 ?>.css">
    <?php endif; ?>
    <?php if (isset($css2)) : ?>
        <link rel="stylesheet" href="../assets/css/user/<?= $css2 ?>.css">
    <?php endif; ?>
    <?php if (isset($css3)) : ?>
        <link rel="stylesheet" href="../assets/css/user/<?= $css3 ?>.css">
    <?php endif; ?>
    <?php if (isset($css4)) : ?>
        <link rel="stylesheet" href="../assets/css/user/<?= $css4 ?>.css">
    <?php endif; ?>
    <?php if (isset($css5)) : ?>
        <link rel="stylesheet" href="../assets/css/user/<?= $css5 ?>.css">
    <?php endif; ?>
    <script src="../assets/js/user/nav.js" defer></script>
</head>

<body>
    <div class="container">
        <nav class="sidenav">
            <div class="logo">
                <img src="../assets/images/static/logo.png" alt="Logo">
                <span>INFund University Dashboard</span>
            </div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="./dashboard" class="nav-link <?= isset($page) && $page == 'Dashboard' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i> <!-- Dashboard icon -->
                        <span>Dashboard</span>
                    </a>
                </li>
                <!--
                <li class="nav-item">
                    <a href="./bills" class="nav-link <?= isset($page) && $page == 'Bills' ? 'active' : ''; ?>">
                        <i class="fas fa-file-invoice-dollar"></i> 
                        <span>Bills</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./campaigns" class="nav-link <?= isset($page) && $page == 'Campaigns' ? 'active' : ''; ?>">
                        <i class="fas fa-bullhorn"></i>
                        <span>Campaigns</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./transactions" class="nav-link <?= isset($page) && $page == 'Transactions' ? 'active' : ''; ?>">
                        <i class="fas fa-exchange-alt"></i> 
                        <span>Transactions</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="./students" class="nav-link <?= isset($page) && $page == 'Students' ? 'active' : ''; ?>">
                        <i class="fas fa-user-graduate"></i>
                        <span>Students</span> </a>
                </li>

                <li class="nav-item">
                    <a href="./faculties" class="nav-link <?= isset($page) && $page == 'Faculties' ? 'active' : ''; ?>">
                        <i class="fas fa-chalkboard-teacher"></i> <!-- Faculties icon -->
                        <span>Faculties</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="./administrators" class="nav-link <?= isset($page) && $page == 'Administrators' ? 'active' : ''; ?>">
                        <i class="fas fa-user-shield"></i> <!-- Administrators icon -->
                        <span>Administrators</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./logout" class="nav-link ">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="topnav">
            <button class="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-profile">
                <span><?php echo $uni_details['name']; ?></span>
                <a href="./profile">
                    <div class="avatar">
                        <i class="fas fa-university"></i>
                    </div>
                </a>

            </div>
        </div>