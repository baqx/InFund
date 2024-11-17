<?php
session_start();
include './config/config.php';
include './includes/index_functions.php';
include './includes/get_universities.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['university'])) {
    $university = filter_var($_POST['university'], FILTER_SANITIZE_STRING);
    setcookie('university', $university, time() + (86400 * 365), "/");
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$showModal = !isset($_COOKIE['university']);
$universities = get_universities();

$featured_campaigns = getHomepageCampaigns();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infund - University Crowdfunding Platform</title>
    <link rel="icon" href="./assets/icons/favicon.ico">
    <link rel="stylesheet" href="./assets/css/landing/styles.css">
    <link rel="stylesheet" href="./assets/css/landing/nav_only.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- University Selection Modal -->
    <?php if ($showModal) : ?>
        <div id="universityModal" class="modal">
            <div class="modal-content">
                <h2>Select Your University</h2>

                <form method="POST" action="">
                    <select name="university" id="universitySelect" required>
                        <option value="">Choose your university</option>
                        <?php foreach ($universities as $university) : ?>
                            <option value="<?php echo htmlspecialchars($university['abbreviation']); ?>"><?php echo htmlspecialchars($university['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn-primary">Continue</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- Navigation -->
    <nav>
        <div class="nav-content">
            <div class="logo">
                <img src='./assets/images/static/logo_text.png' alt="InFund" />
            </div>
            <button class="menu-button" aria-label="Toggle menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#campaigns">Campaigns</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="./uni/login">Universities</a></li>
                <li><a href="./admins/login">Administrators</a></li>
                <li><a href="./login"><button class="btn-primary">Login</button></a></li>
            </ul>
        </div>
    </nav>
    <div class="overlay"></div>
    <!-- Hero Section -->
    <div class="hero-wrapper">
        <div class="hero-shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#b36264" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
            </svg>
        </div>
        <section id="home" class="hero">
            <div class="hero-content">
                <span class="hero-badge wow fadeIn">For Universities, Lecturers and Students</span>
                <h1 class="wow fadeInUp">
                    Transform Your
                    <span class="gradient-text">Academic Dreams</span>
                    into Reality
                </h1>
                <p class="wow fadeInUp" data-wow-delay="0.2s">
                    Empowering students and institutions through innovative crowdfunding solutions.
                    Join the future of educational financing.
                </p>
                <div class="cta-buttons wow fadeInUp" data-wow-delay="0.4s">
                    <a href="./signup" class="btn-primary">Launch Your Campaign <i class="fas fa-arrow-right"></i></a>
                    <a href="./dashboard/discover" class="btn-secondary">Explore Projects</a>
                </div>
                <div class="hero-stats wow fadeInUp" data-wow-delay="0.6s">
                    <div class="stat-item">
                        <span class="stat-number">₦50M+</span>
                        <span class="stat-label">Funds Raised</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">1000+</span>
                        <span class="stat-label">Projects Funded</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">98%</span>
                        <span class="stat-label">Success Rate</span>
                    </div>
                </div>
            </div>
            <div class="hero-image wow fadeInRight">
                <div class="image-wrapper">
                    <img src="./assets/images/static/hero.png" alt="Crowdfunding Illustration">
                    <div class="floating-card card-1">
                        <i class="fas fa-hand-holding-heart"></i>
                        <span>Create Crowdfunding Campaigns</span>
                    </div>
                    <div class="floating-card card-2">
                        <i class="fas fa-money-bill"></i>
                        <span>Pay School Bills</span>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Partners Section -->
    <section class="partners">
        <div class="section-header wow fadeInUp">
            <h4>Trusted Partners</h4>
            <p>Working with leading institutions to make education accessible</p>
        </div>
        <div class="partners-grid wow fadeInUp">
            <div class="partner-card">
                <img src="./assets/images/partners/payaza.gif" height="150px" alt="Payaza">
            </div>

        </div>
    </section>


    <!-- Campaigns Section HTML -->
    <section id="campaigns" class="campaigns">
        <div class="section-header wow fadeInUp">
            <h2>Featured Campaigns</h2>
            <p>Discover innovative projects that are shaping the future of education</p>
        </div>
        <div class="campaign-grid">
            <?php foreach ($featured_campaigns as $campaign) : ?>
                <?php
                $progress = calculateProgress($campaign['amount_raised'], $campaign['goal_amount']);
                $days_left = max(0, $campaign['days_left']);
                ?>
                <div class="campaign-card wow fadeInUp">
                    <div class="campaign-banner">
                        <img src="./assets/images/campaigns/<?php echo htmlspecialchars($campaign['image1']); ?>" alt="<?php echo htmlspecialchars($campaign['title']); ?>">
                        <div class="campaign-category"><?php echo htmlspecialchars($campaign['university']); ?></div>
                    </div>
                    <div class="campaign-content">
                        <h3><?php echo htmlspecialchars($campaign['title']); ?></h3>
                        <div class="campaign-meta">
                            <span><i class="fas fa-calendar"></i> <?php echo $days_left; ?> days left</span>
                            <span><i class="fas fa-users"></i> <?php echo $campaign['donors_count']; ?> donors</span>
                        </div>
                        <div class="progress-wrapper">
                            <div class="progress-bar">
                                <div class="progress" style="width: <?php echo $progress; ?>%"></div>
                            </div>
                            <div class="progress-stats">
                                <span class="amount"><?php echo formatNaira($campaign['amount_raised']); ?></span>
                                <span class="percentage"><?php echo $progress; ?>%</span>
                            </div>
                        </div>
                        <p><?php echo htmlspecialchars($campaign['description']); ?></p>
                        <a href="./dashboard/campaign.php?id=<?php echo $campaign['id']; ?>" class="btn-primary">Support Project</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="margin: 10px;
        display:flex;justify-content:center;">
            <a href="./dashboard/discover" class="btn-primary">View More Campaigns</a>
        </div>
    </section>

    <!-- New Impact Section -->
    <section class="impact">
        <div class="impact-content">
            <div class="section-header wow fadeInUp">
                <h2>Making Real Impact</h2>
                <p>See how we're transforming education through community support</p>
            </div>
            <div class="impact-grid">
                <div class="impact-card wow fadeInUp">
                    <div class="impact-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>5,000+</h3>
                    <p>Students Supported</p>
                </div>
                <div class="impact-card wow fadeInUp" data-wow-delay="0.2s">
                    <div class="impact-icon">
                        <i class="fas fa-school"></i>
                    </div>
                    <h3>50+</h3>
                    <p>Partner Universities</p>
                </div>
                <div class="impact-card wow fadeInUp" data-wow-delay="0.4s">
                    <div class="impact-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>98%</h3>
                    <p>Project Success Rate</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <h2>Platform Features</h2>
        <div class="feature-grid">
            <!-- Feature Card 1 -->
            <div class="feature-card wow animate__animated animate__fadeInUp">
                <i class="fas fa-pencil-alt"></i>
                <h3>Create Campaigns</h3>
                <p>Effortlessly create and manage your fundraising campaigns.</p>
            </div>

            <!-- Feature Card 2 -->
            <div class="feature-card wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                <i class="fas fa-naira-sign"></i>
                <h3>Pay for Campaigns</h3>
                <p>Make secure payments for your campaigns easily.</p>
            </div>

            <!-- Feature Card 3 -->
            <div class="feature-card wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
                <i class="fas fa-list"></i>
                <h3>Collect Info from Students</h3>
                <p>Gather information from students who fund in a spreadsheet.</p>
            </div>

            <!-- Feature Card 4 -->
            <div class="feature-card wow animate__animated animate__fadeInUp">
                <i class="fas fa-share-alt"></i>
                <h3>Share Payment Links</h3>
                <p>Share payment links with parents and guardians easily.</p>
            </div>

            <!-- Feature Card 5 -->
            <div class="feature-card wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                <i class="fas fa-comments"></i>
                <h3>Donor Engagement</h3>
                <p>Keep your supporters updated and engaged throughout the campaign.</p>
            </div>

            <!-- Feature Card 6 -->
            <div class="feature-card wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
                <i class="fas fa-shield-alt"></i>
                <h3>Secure Payments</h3>
                <p>Enjoy safe and transparent donation processing.</p>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->

    <section id="benefits" class="benefits wow animate__animated animate__fadeIn">
        <h2>Mobilize Resources for</h2>
        <div class="benefits-grid">
            <div class="benefit-item">
                <i class="fas fa-check-circle"></i>
                <span>Handbooks</span>
            </div>
            <div class="benefit-item">
                <i class="fas fa-check-circle"></i>
                <span>Faculty/Department Dues</span>
            </div>
            <div class="benefit-item">
                <i class="fas fa-check-circle"></i>
                <span>Lab Equipment</span>
            </div>
            <div class="benefit-item">
                <i class="fas fa-check-circle"></i>
                <span>School Fees</span>
            </div>
            <div class="benefit-item">
                <i class="fas fa-check-circle"></i>
                <span>Transportation Help</span>
            </div>
        </div>
    </section>
    <!-- New Testimonials Section 
    <section class="testimonials">
        <div class="section-header wow fadeInUp">
            <h2>What Our Users Say</h2>
            <p>Real stories from students and institutions</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card wow fadeInUp">
                <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                <p>"Infund made it possible for our department to acquire new lab equipment. The process was seamless!"</p>
                <div class="testimonial-author">
                    <img src="/api/placeholder/40/40" alt="John Doe">
                    <div>
                        <h4>John Doe</h4>
                        <p>Department Head, Engineering</p>
                    </div>
                </div>
            </div>
        
        </div>
    </section>-->

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Infund</h3>
                <p>Empowering university projects through community funding</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Newsletter</h4>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email">
                    <button type="submit" class="btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Infund. All rights reserved.</p>
        </div>
    </footer>

    <script src="./assets/js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="./assets/js/landing/nav.js"></script>
</body>

</html>