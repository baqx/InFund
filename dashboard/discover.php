<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$page_title = "Discover Campaigns";
$page = "Discover";
$css1 = "discover";
include '../config/config.php';
include '../includes/get_universities.php';
include '../includes/user/discover_functions.php';
if (isset($_SESSION["user_id"])) {

    include '../includes/user/nav.php';
} else {
    include '../config/config.php';
    include '../config/secrets.php';
    include '../includes/user/functions.php';
}

// Get filters from URL parameters
$filters = [
    'university' => $_GET['university'] ?? '',
    'department' => $_GET['department'] ?? '',
    'search' => $_GET['search'] ?? ''
];

$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 12;
if (isset($_SESSION['myid'])) {
    $campaigns = getAllDiscoverActiveCampaigns($_SESSION['user_id'], $current_page, $per_page, $filters);
    $total_campaigns = getTotalCampaignsCount($_SESSION['user_id'], $filters);
} else {
    $campaigns = getAllDiscoverActiveCampaigns(0, $current_page, $per_page, $filters);
    $total_campaigns = getTotalCampaignsCount(0, $filters);
}
$total_pages = ceil($total_campaigns / $per_page);

// Get universities for filter
$universities = get_universities();
?>
<?php if (!isset($_SESSION['user_id'])) { ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Campaigns - INfund</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/colors.css">
    <link rel="stylesheet" href="../assets/css/user/discover.css">
    <link rel="stylesheet" href="../assets/css/landing/nav_only.css">
</head>
<!-- Navigation -->
<nav>
    <div class="nav-content">
        <div class="logo">
            <img src='../assets/images/static/logo_text.png' alt="InFund" />
        </div>
        <button class="menu-button" aria-label="Toggle menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
        <ul class="nav-links">
            <li><a href="../#home">Home</a></li>
            <li><a href="../#campaigns">Campaigns</a></li>
            <li><a href="../#features">Features</a></li>
            <li><a href="../login"><button class="btn-primary">Login</button></a></li>
        </ul>
    </div>
</nav>
<div class="overlay"></div>

<?php } ?>
<main class="main-content">
    <div class="discover-page">
        <div class="discover-header">
            <h1 class="discover-title">Discover Amazing Student Projects</h1>
            <p class="discover-description">
                Support fellow students in bringing their innovative ideas to life.
                Every contribution makes a difference in shaping the future of education.
            </p>
        </div>

        <div class="filters-section">
            <form action="" method="GET" class="filters-grid">
                <div class="filter-group">
                    <label for="search">Search</label>
                    <input type="text" id="search" name="search" class="filter-input" placeholder="Search campaigns..." value="<?php echo htmlspecialchars($filters['search']); ?>">
                </div>
                <div class="filter-group">
                    <label for="university">University</label>
                    <select id="university" name="university" class="filter-input">
                        <option value="">All Universities</option>
                        <?php foreach ($universities as $uni) : ?>
                            <option value="<?php echo htmlspecialchars($uni['abbreviation']); ?>" <?php echo $filters['university'] === $uni['abbreviation'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($uni['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="department">Department</label>
                    <input type="text" id="department" name="department" class="filter-input" placeholder="Filter by department" value="<?php echo htmlspecialchars($filters['department']); ?>">
                </div>
                <div class="filter-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="support-btn">Apply Filters</button>
                </div>
            </form>
        </div>

        <div class="discover-grid">
            <?php echo displayDiscoverPageCampaigns($campaigns); ?>
        </div>

        <?php if ($current_page < $total_pages) : ?>
            <form action="" method="GET" style="text-align: center;">
                <?php
                foreach ($filters as $key => $value) {
                    if (!empty($value)) {
                        echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                    }
                }
                ?>
                <input type="hidden" name="page" value="<?php echo $current_page + 1; ?>">
                <button type="submit" class="load-more">Load More Campaigns</button>
            </form>
        <?php endif; ?>
    </div>
</main>
<?php if (!isset($_SESSION['user_id'])) { ?>
    <script src="../assets/js/landing/nav.js"></script>
<?php } ?>
<?php
$js1 = "discover";
include '../includes/user/footer.php';
?>