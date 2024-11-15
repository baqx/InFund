<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$page_title = "Payouts";
$page = "Payouts";
$css1 = "payouts";
include '../config/config.php';
include '../includes/user/nav.php';

// Fetch banks for the select box
$banks_query = $conn->query("SELECT BankCode, BankName FROM banks ORDER BY BankName ASC");
$banks = $banks_query->fetch_all(MYSQLI_ASSOC);

// Fetch user's payout history
$user_id = $_SESSION['user_id'];
$payouts_query = $conn->prepare("SELECT * FROM user_payouts WHERE uid = ? ORDER BY requested_at DESC");
$payouts_query->bind_param('i', $user_id);
$payouts_query->execute();
$payouts = $payouts_query->get_result()->fetch_all(MYSQLI_ASSOC);

// Process withdrawal request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_withdrawal'])) {
    $amount = floatval($_POST['amount']);
    $bank_code = $_POST['bank_code'];
    $account_number = $_POST['account_number'];
    $account_name = $_POST['account_name'];

    // Check if the user has enough balance
    $balance_query = $conn->prepare("SELECT balance FROM users WHERE id = ?");
    $balance_query->bind_param('i', $user_id);
    $balance_query->execute();
    $user_balance = $balance_query->get_result()->fetch_assoc()['balance'];

    if ($user_balance < $amount) {
        $_SESSION['error_message'] = "Insufficient balance.";
        header("Location: payouts.php");
        exit();
    }

    // Get bank name from bank code
    $bank_stmt = $conn->prepare("SELECT BankName FROM banks WHERE BankCode = ?");
    $bank_stmt->bind_param('s', $bank_code);
    $bank_stmt->execute();
    $bank_name = $bank_stmt->get_result()->fetch_assoc()['BankName'];

    // Generate merchant reference
    $merchant_reference = 'WD_' . time() . '_' . $user_id;

    // Call Payaza API
    $api_payload = json_encode([
        "transaction_type" => "nuban",
        "service_payload" => [
            "payout_amount" => $amount,
            "transaction_pin" => 1111, // Replace with a secure value
            "account_reference" => $account_number,
            "currency" => "NGN",
            "country" => "NGA",
            "payout_beneficiaries" => [[
                "credit_amount" => $amount,
                "account_number" => $account_number,
                "account_name" => $account_name,
                "bank_code" => $bank_code,
                "narration" => "Withdrawal Request",
                "transaction_reference" => $merchant_reference,
                "sender" => [
                    "sender_name" => "System",
                    "sender_id" => "",
                    "sender_phone_number" => "01234595",
                    "sender_address" => "123, Ace Street"
                ]
            ]]
        ]
    ]);

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.payaza.africa/live/payout-receptor/payout',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $api_payload,
        CURLOPT_HTTPHEADER => [
            "Authorization: Payaza $PAYAZA_API_KEY_ENCODED",
            'X-tenantID: test',
            'Content-Type: application/json'
        ],
    ]);

    $api_response = curl_exec($curl);

    if (curl_errno($curl)) {
        $_SESSION['error_message'] = "API Error: " . curl_error($curl);
        curl_close($curl);
        header("Location: payouts.php");
        exit();
    }
    curl_close($curl);

    $response_data = json_decode($api_response, true);

    if ($response_data['response_code'] === 200) {
        // Deduct the amount from the user's wallet
        $deduct_query = $conn->prepare("UPDATE users SET balance = balance - ? WHERE id = ?");
        $deduct_query->bind_param('di', $amount, $user_id);

        if ($deduct_query->execute()) {
            // Record the payout request
            $stmt = $conn->prepare(
                "INSERT INTO user_payouts (uid, amount, payout_method, bank_account_name, bank_account_number, bank_name, merchant_reference, status) 
                VALUES (?, ?, 'bank_transfer', ?, ?, ?, ?, 'Pending')"
            );

            $stmt->bind_param('idssss', $user_id, $amount, $account_name, $account_number, $bank_name, $merchant_reference);
            //todo: Add to transactions table
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Payout request submitted successfully!";
            } else {
                $_SESSION['error_message'] = "Error recording payout.";
            }
        } else {
            $_SESSION['error_message'] = "Error deducting balance.";
        }
    } else if ($response_data['response_code'] === 500) {
        $_SESSION['error_message'] = "Error processing payout.";
    } else {
        $_SESSION['error_message'] = "API Error: " . $response_data['response_message'];
    }

    header("Location: payouts.php");
    exit();
}
?>

<main class="main-content">
    <div class="payouts-container">
        <!-- Withdrawal Form Section -->
        <section class="withdrawal-section">
            <div class="section-header">
                <h2>Request Withdrawal</h2>
            </div>
            <form class="withdrawal-form" method="POST" action="">
                <div class="form-group">
                    <label for="amount">Amount (₦)</label>
                    <input type="number" id="amount" name="amount" min="100" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="bank_code">Select Bank</label>
                    <select id="bank_code" name="bank_code" required>
                        <option value="">Select a bank</option>
                        <?php foreach ($banks as $bank) : ?>
                            <option value="<?php echo htmlspecialchars($bank['BankCode']); ?>">
                                <?php echo htmlspecialchars($bank['BankName']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="account_number">Account Number</label>
                    <input type="text" id="account_number" name="account_number" pattern="\d{10}" maxlength="10" required>
                </div>

                <div class="form-group">
                    <label for="account_name">Account Name</label>
                    <input type="text" id="account_name" name="account_name" required>
                </div>

                <button type="submit" name="submit_withdrawal" class="submit-btn">Request Withdrawal</button>
            </form>
        </section>

        <!-- Transaction History Section -->
        <section class="history-section">
            <div class="section-header">
                <h2>Transaction History</h2>
            </div>
            <div class="transactions-table">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Bank</th>
                            <th>Account</th>
                            <th>Status</th>
                            <th>Reference</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payouts as $payout) : ?>
                            <tr>
                                <td><?php echo date('M d, Y', strtotime($payout['requested_at'])); ?></td>
                                <td>₦<?php echo number_format($payout['amount'], 2); ?></td>
                                <td><?php echo htmlspecialchars($payout['bank_name']); ?></td>
                                <td><?php echo htmlspecialchars($payout['bank_account_number']); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo strtolower($payout['status']); ?>">
                                        <?php echo $payout['status']; ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($payout['merchant_reference']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($payouts)) : ?>
                            <tr>
                                <td colspan="6" class="no-records">No transaction history found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        <?php if (isset($_SESSION['success_message'])) : ?>
            toastr.success("<?php echo $_SESSION['success_message']; ?>");
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])) : ?>
            toastr.error("<?php echo $_SESSION['error_message']; ?>");
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
    });
</script>

<?php
include '../includes/user/footer.php';
?>