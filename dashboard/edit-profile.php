<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$page_title = "Edit Profile";
$page = "Profile";
$css1 = "edit-profile";
include '../config/config.php';
include '../includes/get_universities.php';
include '../includes/user/profile_functions.php';
include '../includes/user/nav.php';

$user_id = $_SESSION['user_id'];
$bank_list = getBanks();
$levels = range(100, 900, 100);

// Get user's current data
$user_data = getUserData($user_id);

// Handle form submission via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $response = array('success' => false, 'message' => '');

    // Validate unique fields
    if (!isFieldUnique('username', $_POST['username'], $user_id)) {
        $response['message'] = 'Username already exists!';
        echo json_encode($response);
        exit;
    }
    if (!isFieldUnique('email', $_POST['email'], $user_id)) {
        $response['message'] = 'Email already exists!';
        echo json_encode($response);
        exit;
    }
    if (!isFieldUnique('phone', $_POST['phone'], $user_id)) {
        $response['message'] = 'Phone number already exists!';
        echo json_encode($response);
        exit;
    }

    // Update profile
    $result = updateUserProfile($user_id, $_POST);

    if ($result) {
        $response['success'] = true;
        $response['message'] = 'Profile updated successfully!';
    } else {
        $response['message'] = 'Error updating profile!';
    }

    echo json_encode($response);
    exit;
}
?>

<main class="main-content">
    <div class="edit-profile-container">
        <div class="section-header">
            <h1><i class="fas fa-user-edit"></i> Edit Profile</h1>
            <a href="profile.php" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Profile
            </a>
        </div>

        <form id="editProfileForm" class="edit-profile-form">
            <div class="form-grid">
                <!-- Personal Information Section -->
                <div class="form-section">
                    <h2>Personal Information</h2>
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname" value="<?php echo $user_data['fullname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo $user_data['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo $user_data['phone']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" value="<?php echo $user_data['dob']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="Male" <?php echo ($user_data['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($user_data['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="form-section">
                    <h2>Location Information</h2>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" id="country" name="country" value="<?php echo $user_data['country']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" value="<?php echo $user_data['state']; ?>" required>
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="form-section">
                    <h2>Academic Information</h2>
                    <div class="form-group">
                        <label for="university">University</label>
                        <input type="text" id="university" name="university" value="<?php echo $user_data['university']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="faculty">Faculty</label>
                        <input type="text" id="faculty" name="faculty" value="<?php echo $user_data['faculty']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" id="department" name="department" value="<?php echo $user_data['department']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="matric_no">Matric Number</label>
                        <input type="text" id="matric_no" name="matric_no" value="<?php echo $user_data['matric_no']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select id="level" name="level" required>
                            <?php foreach ($levels as $level) : ?>
                                <option value="<?php echo $level; ?>" <?php echo ($user_data['level'] == $level) ? 'selected' : ''; ?>>
                                    <?php echo $level; ?> Level
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Bank Information -->
                <div class="form-section">
                    <h2>Bank Information</h2>
                    <div class="form-group">
                        <label for="bank_id">Bank</label>
                        <select id="bank_id" name="bank_id" required>
                            <option value="">Select Bank</option>
                            <?php foreach ($bank_list as $bank) : ?>
                                <option value="<?php echo $bank['BankCode']; ?>" <?php echo ($user_data['bank_id'] == $bank['BankCode']) ? 'selected' : ''; ?>>
                                    <?php echo $bank['BankName']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="account_name">Account Name</label>
                        <input type="text" id="bank_account_name" name="bank_account_name" value="<?php echo $user_data['bank_account_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="account_number">Account Number</label>
                        <input type="text" id="account_number" name="account_number" value="<?php echo $user_data['account_number']; ?>" pattern="[0-9]{10}" maxlength="10" required>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</main>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Confirm Update',
            text: 'Are you sure you want to update your profile?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData(this);

                $.ajax({
                    url: './edit-profile',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success'
                            }).then(() => {
                                window.location.href = 'profile.php';
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message,
                                icon: 'error'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while updating your profile.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
</script>

<?php
$js1 = "profile";
include '../includes/user/footer.php';
?>