<?php
session_start();

// Handle university selection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['university'])) {
    $university = filter_var($_POST['university'], FILTER_SANITIZE_STRING);
    setcookie('university', $university, time() + (86400 * 365), "/"); // 1 year
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$showModal = !isset($_COOKIE['university']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infund - University Crowdfunding Platform</title>
    <link rel="icon" href="./assets/icons/favicon.ico">
    <link rel="stylesheet" href="./assets/css/landing/styles.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
                        <option value="harvard">Harvard University</option>
                        <option value="mit">MIT</option>
                        <option value="stanford">Stanford University</option>
                        <option value="yale">Yale University</option>
                        <option value="princeton">Princeton University</option>
                    </select>
                    <button type="submit">Continue</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- Navigation -->
    <nav>
        <div class="nav-content">
            <div class="logo"><img src='./assets/images/static/logo_text.png' alt="InFund" height="36px" /></div>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#campaigns">Campaigns</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#contact" class="btn-primary">Get Started</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero wow animate__animated animate__fadeIn">
        <div class="hero-content">
            <h1>Decentralized crowdfunding for universities and students</h1>
            <p>Let's make your university projects come to life with the power of community funding</p>
            <div class="cta-buttons">
                <a href="#" class="btn-primary">Get Started</a>
                <a href="#" class="btn-secondary">View Campaigns</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="./assets/images/static/hero.png" alt="Crowdfunding Illustration">
        </div>
    </section>

    <!-- Trust Badge Section -->
    <section class="trust-badges">
        <p>Our Partners</p>
        <div class="badge-container">
            <img src="./assets/images/partners/payaza.gif" height="70px" width="100px" alt="University Badge">

        </div>
    </section>

    <!-- Active Campaigns Section -->
    <section id="campaigns" class="campaigns wow fadeIn">
        <h2>Active Campaigns</h2>
        <div class="campaign-grid">
            <!-- Campaign Card 1 -->
            <div class="campaign-card wow animate__animated animate__fadeInUp">
                <img src="./assets/images/campaigns/fund.jpg" alt="Research Lab Equipment">
                <div class="campaign-content">
                    <h3>Research Lab Equipment</h3>
                    <div class="progress-bar">
                        <div class="progress" style="width: 75%"></div>
                    </div>
                    <div class="campaign-stats">
                        <span>$15,000 raised of $20,000</span>
                        <span>75%</span>
                    </div>
                    <p>Help us equip our new research laboratory with cutting-edge equipment</p>
                    <a href="#" class="btn-secondary">Support Project</a>
                </div>
            </div>

            <!-- Campaign Card 2 -->
            <div class="campaign-card wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                <img src="./assets/images/campaigns/fund.jpg" alt="Student Innovation Hub">
                <div class="campaign-content">
                    <h3>Student Innovation Hub</h3>
                    <div class="progress-bar">
                        <div class="progress" style="width: 45%"></div>
                    </div>
                    <div class="campaign-stats">
                        <span>$9,000 raised of $20,000</span>
                        <span>45%</span>
                    </div>
                    <p>Creating a collaborative space for student entrepreneurs</p>
                    <a href="#" class="btn-secondary">Support Project</a>
                </div>
            </div>

            <!-- Campaign Card 3 -->
            <div class="campaign-card wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
                <img src="./assets/images/campaigns/fund.jpg" alt="Green Campus Initiative">
                <div class="campaign-content">
                    <h3>Green Campus Initiative</h3>
                    <div class="progress-bar">
                        <div class="progress" style="width: 90%"></div>
                    </div>
                    <div class="campaign-stats">
                        <span>$18,000 raised of $20,000</span>
                        <span>90%</span>
                    </div>
                    <p>Supporting sustainability projects across campus</p>
                    <a href="#" class="btn-secondary">Support Project</a>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button class="btn-secondary view-more">View More Campaigns</button>
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
            <i class="fas fa-file-spreadsheet"></i> 
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

    <!-- Pricing Section -->
    <section id="pricing" class="pricing">
        <h2>Choose Your Plan</h2>
        <div class="pricing-grid">
            <!-- Free Plan -->
            <div class="pricing-card wow animate__animated animate__fadeInUp">
                <h3>Free</h3>
                <div class="price">$0</div>
                <ul>
                    <li><i class="fas fa-check"></i> Basic campaign tools</li>
                    <li><i class="fas fa-check"></i> Email support</li>
                    <li><i class="fas fa-check"></i> Basic analytics</li>
                    <li><i class="fas fa-check"></i> Single project</li>
                </ul>
                <button class="btn-secondary">Start Free</button>
            </div>

            <!-- Pro Plan -->
            <div class="pricing-card featured wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                <h3>Pro</h3>
                <div class="price">$8</div>
                <ul>
                    <li><i class="fas fa-check"></i> Advanced campaign tools</li>
                    <li><i class="fas fa-check"></i> Priority support</li>
                    <li><i class="fas fa-check"></i> Advanced analytics</li>
                    <li><i class="fas fa-check"></i> Multiple projects</li>
                    <li><i class="fas fa-check"></i> Custom branding</li>
                </ul>
                <button class="btn-primary">Go Pro</button>
            </div>

            <!-- Business Plan -->
            <div class="pricing-card wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
                <h3>Business</h3>
                <div class="price">$16</div>
                <ul>
                    <li><i class="fas fa-check"></i> Enterprise features</li>
                    <li><i class="fas fa-check"></i> 24/7 support</li>
                    <li><i class="fas fa-check"></i> Custom analytics</li>
                    <li><i class="fas fa-check"></i> Unlimited projects</li>
                    <li><i class="fas fa-check"></i> API access</li>
                </ul>
                <button class="btn-secondary">Contact Sales</button>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials">
        <h2>What People Are Saying</h2>
        <div class="testimonial-grid">
            <div class="testimonial-card wow animate__animated animate__fadeIn">
                <div class="testimonial-content">
                    <p>"Infund helped us raise funds for our research project in record time!"</p>
                </div>
                <div class="testimonial-author">
                    <img src="/api/placeholder/50/50" alt="User Avatar">
                    <div>
                        <h4>Jane Smith</h4>
                        <p>Biology Department</p>
                    </div>
                </div>
            </div>
            <!-- More testimonials... -->
        </div>
    </section>

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
    <script src="./assets/js/landing/scripts.js"></script>
</body>

</html>