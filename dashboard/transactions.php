<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - EduFund</title>
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
            --payment-color: #4CAF50;
            --crowdfunding-color: #2196F3;
            --deposit-color: #FFA000;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .transactions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .filters {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-dropdown {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            background: white;
            cursor: pointer;
        }

        .search-box {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            width: 250px;
        }

        .transactions-list {
            background: var(--card-background);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .transaction-item {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            transition: var(--transition);
        }

        .transaction-item:hover {
            background-color: #f8f9fa;
        }

        .transaction-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
        }

        .transaction-icon.payment {
            background-color: var(--payment-color);
        }

        .transaction-icon.crowdfunding {
            background-color: var(--crowdfunding-color);
        }

        .transaction-icon.deposit {
            background-color: var(--deposit-color);
        }

        .transaction-details {
            flex: 1;
        }

        .transaction-title {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .transaction-meta {
            display: flex;
            gap: 1rem;
            color: #666;
            font-size: 0.9rem;
        }

        .transaction-amount {
            font-weight: 600;
            text-align: right;
        }

        .amount-positive {
            color: var(--payment-color);
        }

        .amount-negative {
            color: #f44336;
        }

        .transaction-status {
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.85rem;
            margin-left: 1rem;
            white-space: nowrap;
        }

        .status-success {
            background-color: #E8F5E9;
            color: var(--payment-color);
        }

        .status-pending {
            background-color: #FFF3E0;
            color: var(--deposit-color);
        }

        .status-failed {
            background-color: #FFEBEE;
            color: #f44336;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .page-button {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            background: white;
            cursor: pointer;
            transition: var(--transition);
        }

        .page-button:hover {
            background-color: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }

        .page-button.active {
            background-color: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }

        @media (max-width: 768px) {
            .transactions-header {
                flex-direction: column;
                align-items: stretch;
            }

            .filters {
                flex-direction: column;
            }

            .search-box {
                width: 100%;
            }

            .transaction-meta {
                flex-direction: column;
                gap: 0.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
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
    </div>

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