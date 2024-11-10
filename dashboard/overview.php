<?php
session_start();
$page_title = "Overview";
$page = "Overview";
include '../config/config.php';
include '../includes/get_universities.php';
include '../includes/user/nav.php';
$university = get_university($my_details['university']);
?>

<main class="main-content">
    <div class="server-details">
        <i class="fas fa-university"></i> <?php //fetch the university of the user from the saved cookie
                                            if (!empty($university)) {
                                                // Assuming there is at least one result, access the name
                                                $university_name = $university[0]['name'];
                                                echo $university_name;
                                            } else {
                                                echo "No university found with the abbreviation: " . $abbreviation;
                                            } ?>
        <br>
        <i class="fas fa-columns"></i> <?php echo $my_details['department']; ?> department
    </div>
    <div class="cards-grid">
        <div class="card">
            <h2>₦45,000</h2>
            <p>Outstanding Fees</p>
        </div>
        <div class="card">
            <h2>3</h2>
            <p>Active Campaigns</p>
        </div>
        <div class="card">
            <h2>2</h2>
            <p>Pending Handbooks</p>
        </div>
        <div class="card">
            <h2>₦120,000</h2>
            <p>Total Raised</p>
        </div>
    </div>

    <div class="campaigns-grid">
        <section class="feed-section">
            <div class="section-header">
                <h2>Your Campaigns</h2>
                <a href="./create" class="view-all">Create Campaign</a>
            </div>

            <div class="campaign-card">
                <div class="campaign-header">
                    <div>
                        <div class="campaign-title">Final Year Project Funding</div>
                        <div class="campaign-meta">Created 5 days ago</div>
                    </div>
                    <span class="badge badge-warning">In Progress</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 65%"></div>
                </div>
                <div class="campaign-stats">
                    <span>₦65,000 raised of ₦100,000</span>
                    <span>15 donors</span>
                </div>
            </div>

            <div class="campaign-card">
                <div class="campaign-header">
                    <div>
                        <div class="campaign-title">Second Semester Fees</div>
                        <div class="campaign-meta">Created 2 weeks ago</div>
                    </div>
                    <span class="badge badge-success">Completed</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 100%"></div>
                </div>
                <div class="campaign-stats">
                    <span>₦150,000 raised of ₦150,000</span>
                    <span>32 donors</span>
                </div>
            </div>
        </section>

        <section class="feed-section">
            <div class="section-header">
                <h2>Outstanding Payments</h2>
                <a href="#" class="view-all">View All</a>
            </div>

            <div class="campaign-card">
                <div class="campaign-header">
                    <div>
                        <div class="campaign-title">Engineering Mathematics Manual</div>
                        <div class="campaign-meta">Due in 5 days</div>
                    </div>
                    <span class="badge badge-danger">Unpaid</span>
                </div>
                <div class="campaign-meta">
                    Amount: ₦15,000
                </div>
            </div>

            <div class="campaign-card">
                <div class="campaign-header">
                    <div>
                        <div class="campaign-title">Physics Lab Manual</div>
                        <div class="campaign-meta">Due in 10 days</div>
                    </div>
                    <span class="badge badge-info">Partially Paid</span>
                </div>
                <div class="campaign-meta">
                    Amount: ₦12,000 (₦5,000 paid)
                </div>
            </div>
        </section>
    </div>
</main>
</div>

<script>
    const menuToggle = document.querySelector('.menu-toggle');
    const sidenav = document.querySelector('.sidenav');
    const menuIcon = menuToggle.querySelector('i');

    menuToggle.addEventListener('click', () => {
        sidenav.classList.toggle('open');
        menuIcon.classList.toggle('fa-bars');
        menuIcon.classList.toggle('fa-times');
    });

    // Close sidenav when clicking outside
    document.addEventListener('click', (e) => {
        if (!sidenav.contains(e.target) && !menuToggle.contains(e.target)) {
            sidenav.classList.remove('open');
            menuIcon.classList.remove('fa-times');
            menuIcon.classList.add('fa-bars');
        }
    });

    // Active nav link
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        });
    });

    // Animate progress bars on scroll
    const progressBars = document.querySelectorAll('.progress-fill');
    const animateProgressBars = () => {
        progressBars.forEach(bar => {
            const rect = bar.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;

            if (isVisible) {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100);
            }
        });
    };

    // Initial animation
    window.addEventListener('load', animateProgressBars);
    // Animate on scroll
    window.addEventListener('scroll', animateProgressBars);

    // Add smooth scrolling for mobile
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
                // Close mobile menu after clicking
                if (window.innerWidth <= 768) {
                    sidenav.classList.remove('open');
                    menuIcon.classList.remove('fa-times');
                    menuIcon.classList.add('fa-bars');
                }
            }
        });
    });
</script>
</body>

</html>