<?php
session_start();
$page_title = "Transactions";
$page = "Transactions";
$css1 = "transactions";
include '../includes/user/nav.php'; ?>

<body>
    <main class="main-content">
        <div class="transactions-header">
            <h1>Transactions</h1>
            <div class="filters">
                <select class="filter-dropdown" id="typeFilter">
                    <option value="all">All Types</option>
                    <option value="payment">Payments</option>
                    <option value="crowdfunding">Crowdfunding</option>
                    <option value="deposit">Deposits</option>
                </select>
                <select class="filter-dropdown" id="statusFilter">
                    <option value="all">All Status</option>
                    <option value="success">Success</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                </select>
                <input type="text" class="search-box" placeholder="Search transactions...">
            </div>
        </div>

        <div class="transactions-list">
            <!-- Payment Transaction -->
            <div class="transaction-item">
                <div class="transaction-icon payment">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="transaction-details">
                    <div class="transaction-title">School Fee Payment</div>
                    <div class="transaction-meta">
                        <span><i class="fas fa-calendar"></i> Oct 15, 2023</span>
                        <span><i class="fas fa-clock"></i> 14:30</span>
                        <span><i class="fas fa-hashtag"></i> TRX123456</span>
                    </div>
                </div>
                <div class="transaction-amount amount-negative">
                    -₦50,000
                    <span class="transaction-status status-success">Success</span>
                </div>
            </div>

            <!-- Crowdfunding Transaction -->
            <div class="transaction-item">
                <div class="transaction-icon crowdfunding">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <div class="transaction-details">
                    <div class="transaction-title">Project Funding Donation</div>
                    <div class="transaction-meta">
                        <span><i class="fas fa-calendar"></i> Oct 14, 2023</span>
                        <span><i class="fas fa-clock"></i> 09:15</span>
                        <span><i class="fas fa-hashtag"></i> TRX123455</span>
                    </div>
                </div>
                <div class="transaction-amount amount-positive">
                    +₦25,000
                    <span class="transaction-status status-success">Success</span>
                </div>
            </div>

            <!-- Deposit Transaction -->
            <div class="transaction-item">
                <div class="transaction-icon deposit">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <div class="transaction-details">
                    <div class="transaction-title">Wallet Deposit</div>
                    <div class="transaction-meta">
                        <span><i class="fas fa-calendar"></i> Oct 13, 2023</span>
                        <span><i class="fas fa-clock"></i> 16:45</span>
                        <span><i class="fas fa-hashtag"></i> TRX123454</span>
                    </div>
                </div>
                <div class="transaction-amount amount-positive">
                    +₦100,000
                    <span class="transaction-status status-pending">Pending</span>
                </div>
            </div>

            <!-- Failed Transaction -->
            <div class="transaction-item">
                <div class="transaction-icon payment">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="transaction-details">
                    <div class="transaction-title">Book Purchase</div>
                    <div class="transaction-meta">
                        <span><i class="fas fa-calendar"></i> Oct 12, 2023</span>
                        <span><i class="fas fa-clock"></i> 11:20</span>
                        <span><i class="fas fa-hashtag"></i> TRX123453</span>
                    </div>
                </div>
                <div class="transaction-amount amount-negative">
                    -₦15,000
                    <span class="transaction-status status-failed">Failed</span>
                </div>
            </div>
        </div>

        <div class="pagination">
            <button class="page-button"><i class="fas fa-chevron-left"></i></button>
            <button class="page-button active">1</button>
            <button class="page-button">2</button>
            <button class="page-button">3</button>
            <button class="page-button"><i class="fas fa-chevron-right"></i></button>
        </div>
    </main>

    <script>
        // Filter functionality
        const typeFilter = document.getElementById('typeFilter');
        const statusFilter = document.getElementById('statusFilter');
        const searchBox = document.querySelector('.search-box');
        const transactionItems = document.querySelectorAll('.transaction-item');

        function filterTransactions() {
            const typeValue = typeFilter.value;
            const statusValue = statusFilter.value;
            const searchValue = searchBox.value.toLowerCase();

            transactionItems.forEach(item => {
                const typeMatch = typeValue === 'all' || item.querySelector('.transaction-icon').classList.contains(typeValue);
                const statusMatch = statusValue === 'all' || item.querySelector('.transaction-status').classList.contains(`status-${statusValue}`);
                const searchMatch = item.querySelector('.transaction-title').textContent.toLowerCase().includes(searchValue);

                if (typeMatch && statusMatch && searchMatch) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        typeFilter.addEventListener('change', filterTransactions);
        statusFilter.addEventListener('change', filterTransactions);
        searchBox.addEventListener('input', filterTransactions);

        // Pagination functionality
        const pageButtons = document.querySelectorAll('.page-button');
        pageButtons.forEach(button => {
            button.addEventListener('click', () => {
                if (!button.classList.contains('active') && !button.querySelector('i')) {
                    document.querySelector('.page-button.active').classList.remove('active');
                    button.classList.add('active');
                    // Add pagination logic here
                }
            });
        });

        // Format numbers with commas
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // Format all transaction amounts
        document.querySelectorAll('.transaction-amount').forEach(el => {
            const amount = el.textContent.replace(/[₦+-]/g, '').trim().split(' ')[0];
            const prefix = el.textContent.includes('-') ? '-₦' : '+₦';
            el.childNodes[0].textContent = `${prefix}${formatNumber(amount)}`;
        });
    </script>
</body>

</html>