<?php
session_start();
$page_title = "Transactions";
$page = "Transactions";
$css1 = "transactions";
include '../includes/admin/nav.php';
?>


<main class="main-content">
    <div class="transactions-header">
        <h1>Transactions</h1>
        <div class="filters">
            <select class="filter-dropdown" id="typeFilter">
                <option value="all">All Types</option>
                <option value="bill-payment">Bill Payments</option>
                <option value="donate">Donations</option>
                <option value="received-donation">Received Donations</option>
                <option value="bill-funded">Funded Bills</option>
            </select>
            <select class="filter-dropdown" id="statusFilter">
                <option value="all">All Status</option>
                <option value="success">Success</option>
                <option value="pending">Pending</option>
                <option value="failed">Failed</option>
                <option value="reversed">Reversed</option>
            </select>
            <input type="text" class="search-box" id="searchBox" placeholder="Search transactions...">
        </div>
    </div>

    <div class="loader">
        <div class="loader-spinner"></div>
    </div>

    <div class="transactions-list" id="transactionsList">
        <!-- Transactions will be loaded here -->
    </div>

    <div class="pagination" id="pagination">
        <!-- Pagination will be loaded here -->
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let currentPage = 1;
    let totalPages = 1;

    function loadTransactions(page = 1) {
        const type = $('#typeFilter').val();
        const status = $('#statusFilter').val();
        const search = $('#searchBox').val();

        $('.loader').show();

        $.ajax({
            url: '../includes/admin/get_transactions',
            type: 'GET',
            data: {
                page: page,
                type: type,
                status: status,
                search: search
            },
            success: function(response) {
                const data = JSON.parse(response);
                $('#transactionsList').html(data.transactions);
                $('#pagination').html(data.pagination);
                currentPage = page;
                totalPages = data.total_pages;
            },
            complete: function() {
                $('.loader').hide();
            }
        });
    }

    // Event listeners
    $('#typeFilter, #statusFilter').on('change', function() {
        currentPage = 1;
        loadTransactions(1);
    });

    $('#searchBox').on('input', function() {
        currentPage = 1;
        loadTransactions(1);
    });

    $(document).on('click', '.page-button', function() {
        if (!$(this).hasClass('active')) {
            const page = $(this).data('page');
            if (page) {
                loadTransactions(page);
            }
        }
    });

    // Initial load
    $(document).ready(function() {
        loadTransactions(1);
    });
</script>
</body>

</html>