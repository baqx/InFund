<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign Details - EduFund</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Inter");

        :root {
            --primary-color: #b36264;
            --secondary-color: #755e28;
            --accent-color: #45B7AF;
            --text-color: #2C3E50;
            --background-color: #F7F9FC;
            --card-background: #FFFFFF;
            --border-radius: 8px;
            --transition: all 0.3s ease;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 10px 15px rgba(0, 0, 0, 0.15);
            --success-color: #4CAF50;
            --warning-color: #FFA000;
            --danger-color: #f44336;
            --info-color: #2196F3;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--background-color);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidenav styles from previous code */
        .sidenav {
            width: 250px;
            background: var(--card-background);
            padding: 1rem;
            height: 100vh;
            position: fixed;
            transition: var(--transition);
            box-shadow: var(--shadow);
            z-index: 1000;
        }

        /* ... (previous sidenav styles) ... */

        /* Campaign Detail Styles */
        .campaign-header {
            background: var(--card-background);
            padding: 2rem;
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .campaign-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--accent-color);
        }

        .campaign-title {
            font-size: 2rem;
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .campaign-meta {
            display: flex;
            gap: 2rem;
            margin-bottom: 1.5rem;
            color: #666;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .progress-section {
            margin: 2rem 0;
        }

        .progress-bar {
            height: 10px;
            background: #eee;
            border-radius: 5px;
            margin: 1rem 0;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--accent-color);
            border-radius: 5px;
            transition: width 1s ease;
        }

        .progress-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 0.5rem;
            color: var(--text-color);
        }

        .donate-section {
            position: sticky;
            top: 2rem;
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        .donate-button {
            width: 100%;
            padding: 1rem;
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .donate-button:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .donation-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #eee;
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .campaign-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-top: 2rem;
        }

        .campaign-description {
            background: var(--card-background);
            padding: 2rem;
            border-radius: var(--border-radius);
        }

        .description-content {
            color: #666;
            line-height: 1.6;
        }

        .donor-list {
            margin-top: 2rem;
        }

        .donor-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .donor-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .donor-info {
            flex: 1;
        }

        .donor-name {
            font-weight: 500;
            color: var(--text-color);
        }

        .donation-amount {
            color: var(--accent-color);
            font-weight: 600;
        }

        .donation-time {
            font-size: 0.9rem;
            color: #666;
        }

        .share-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .share-button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: var(--border-radius);
            background: #eee;
            color: var(--text-color);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .share-button:hover {
            background: #e0e0e0;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1100;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--card-background);
            padding: 2rem;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 500px;
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        /* Responsive styles */
        @media (max-width: 1024px) {
            .campaign-content {
                grid-template-columns: 1fr;
            }

            .donate-section {
                position: static;
                margin-bottom: 2rem;
            }
        }

        @media (max-width: 768px) {
            .campaign-meta {
                gap: 1rem;
            }

            .meta-item {
                flex: 1;
                min-width: 150px;
            }

            .donor-card {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
            }
        }

        @media (max-width: 480px) {
            .campaign-title {
                font-size: 1.5rem;
            }

            .campaign-header,
            .campaign-description,
            .donate-section {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Previous sidenav code here -->

        <main class="main-content">
            <div class="campaign-header">
                <h1 class="campaign-title">Final Year Project Funding</h1>
                <div class="campaign-meta">
                    <div class="meta-item">
                        <i class="fas fa-user"></i>
                        <span>John Doe</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-university"></i>
                        <span>Engineering Department</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>5 days left</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-users"></i>
                        <span>15 donors</span>
                    </div>
                </div>

                <div class="progress-section">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 65%"></div>
                    </div>
                    <div class="progress-stats">
                        <span>₦65,000 raised</span>
                        <span>₦100,000 goal</span>
                    </div>
                </div>

                <div class="share-buttons">
                    <button class="share-button">
                        <i class="fas fa-share"></i>
                        Share
                    </button>
                    <button class="share-button">
                        <i class="fas fa-whatsapp"></i>
                        WhatsApp
                    </button>
                    <button class="share-button">
                        <i class="fas fa-twitter"></i>
                        Twitter
                    </button>
                </div>
            </div>

            <div class="campaign-content">
                <div class="campaign-description">
                    <h2>About This Campaign</h2>
                    <div class="description-content">
                        <p>I am a final year Engineering student working on an innovative project that aims to solve water scarcity issues in rural communities. The project involves developing a solar-powered water purification system that can be easily maintained by local communities.</p>
                        <br>
                        <p>The funds will be used for:</p>
                        <br>
                        <ul style="padding-left: 1.5rem;">
                            <li>Solar panels and batteries (₦40,000)</li>
                            <li>Filtration materials (₦25,000)</li>
                            <li>Control system components (₦20,000)</li>
                            <li>Testing and certification (₦15,000)</li>
                        </ul>
                        <br>
                        <p>Your support will help bring clean water to communities in need while helping me complete my degree. Every donation counts!</p>
                    </div>

                    <div class="donor-list">
                        <h2>Recent Donors</h2>
                        <div class="donor-card">
                            <div class="donor-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="donor-info">
                                <div class="donor-name">Anonymous</div>
                                <div class="donation-amount">₦10,000</div>
                                <div class="donation-time">1 hour ago</div>
                            </div>
                        </div>
                        <div class="donor-card">
                            <div class="donor-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="donor-info">
                                <div class="donor-name">Sarah M.</div>
                                <div class="donation-amount">₦5,000</div>
                                <div class="donation-time">3 hours ago</div>
                            </div>
                        </div>
                        <div class="donor-card">
                            <div class="donor-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="donor-info">
                                <div class="donor-name">Prof. Johnson</div>
                                <div class="donation-amount">₦20,000</div>
                                <div class="donation-time">1 day ago</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="donate-section">
                    <h2>Support This Campaign</h2>
                    <p style="margin: 1rem 0; color: #666;">Help John reach his goal by making a donation.</p>
                    <input type="number" class="donation-input" placeholder="Enter amount (₦)" min="100">
                    <button class="donate-button" onclick="openDonateModal()">Donate Now</button>
                </div>
            </div>
        </main>
    </div>

    <!-- Donation Modal -->
    <div class="modal" id="donateModal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeDonateModal()">×</button>
            <h2>Complete Your Donation</h2>
            <p style="margin: 1rem 0; color: #666;">You're supporting Final Year Project Funding</p>
            <div style="margin: 1.5rem 0;">
                <h3>Amount: <span id="modalAmount">₦0</span></h3>
            </div>
            <input type="text" class="donation-input" placeholder="Your Name (Optional)">
            <input type="email" class="donation-input" placeholder="Email Address">
            <button class="donate-button" onclick="processDonation()">Proceed to Payment</button>
        </div>
    </div>
    <script>
        // Modal functionality
        const modal = document.getElementById('donateModal');
        const amountInput = document.querySelector('.donation-input');
        const modalAmount = document.getElementById('modalAmount');

        function openDonateModal() {
            const amount = amountInput.value || 0;
            modalAmount.textContent = `₦${amount}`;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeDonateModal() {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function processDonation() {
            // Add payment processing logic here
            alert('Redirecting to payment gateway...');
            closeDonateModal();
        }

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeDonateModal();
            }
        });

        // Animate progress bar on scroll
        const progressFill = document.querySelector('.progress-fill');
        const animateProgress = () => {
            const rect = progressFill.getBoundingClientRect();
            const isVisible = (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );

            if (isVisible) {
                progressFill.style.width = '65%'; // Match the current progress
                window.removeEventListener('scroll', animateProgress);
            }
        };

        // Initialize progress bar animation
        window.addEventListener('scroll', animateProgress);
        animateProgress(); // Check initial visibility

        // Share functionality
        const shareButtons = document.querySelectorAll('.share-button');
        shareButtons.forEach(button => {
            button.addEventListener('click', async () => {
                const campaignTitle = document.querySelector('.campaign-title').textContent;
                const campaignUrl = window.location.href;
                const shareText = `Support ${campaignTitle} on EduFund: ${campaignUrl}`;

                if (button.querySelector('.fa-whatsapp')) {
                    window.open(`https://wa.me/?text=${encodeURIComponent(shareText)}`, '_blank');
                } else if (button.querySelector('.fa-twitter')) {
                    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}`, '_blank');
                } else {
                    // Generic share button
                    try {
                        await navigator.share({
                            title: campaignTitle,
                            text: 'Support my education campaign on EduFund',
                            url: campaignUrl
                        });
                    } catch (err) {
                        // Fallback for browsers that don't support Web Share API
                        prompt('Copy this link to share:', campaignUrl);
                    }
                }
            });
        });

        // Input validation for donation amount
        amountInput.addEventListener('input', (e) => {
            const value = e.target.value;
            if (value < 100) {
                amountInput.setCustomValidity('Minimum donation amount is ₦100');
            } else {
                amountInput.setCustomValidity('');
            }
        });

        // Format numbers with commas
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // Update all displayed amounts with proper formatting
        document.querySelectorAll('.donation-amount').forEach(el => {
            const amount = el.textContent.replace('₦', '').trim();
            el.textContent = `₦${formatNumber(amount)}`;
        });

        // Progress stats formatting
        document.querySelectorAll('.progress-stats span').forEach(el => {
            const amount = el.textContent.replace('₦', '').replace(' raised', '').replace(' goal', '').trim();
            const isGoal = el.textContent.includes('goal');
            const isRaised = el.textContent.includes('raised');
            el.textContent = `₦${formatNumber(amount)}${isGoal ? ' goal' : ''}${isRaised ? ' raised' : ''}`;
        });
    </script>
</body>

</html>