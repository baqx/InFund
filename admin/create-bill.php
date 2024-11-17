<?php
session_start();
$page_title = "Create Bill";
$page = "Bills";
$css1 = "create-bill";
include '../includes/admin/nav.php';
?>

<main class="main-content">
    <form class="form-card" id="billForm">
        <div class="form-header">
            <h1 class="form-title">Create a New Bill</h1>
            <p class="form-subtitle">Set up payment requirements for students</p>
        </div>

        <div class="form-group">
            <label class="form-label" for="name">Bill Name*</label>
            <input type="text" id="name" name="name" class="form-input" required maxlength="255" placeholder="Enter bill name (e.g., First Semester Fees 2024)">
            <div class="error-message"></div>
        </div>

        <div class="form-group">
            <label class="form-label" for="university">University*</label>
            <select id="university" name="university" class="form-input" required>
                <option value="">Select University</option>
                <?php
                $query = "SELECT id, abbreviation, name FROM universities ORDER BY name";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['abbreviation']} - {$row['name']}</option>";
                }
                ?>
            </select>
            <div class="error-message"></div>
        </div>

        <div class="form-group">
            <label class="form-label" for="faculty">Faculty*</label>
            <select id="faculty" name="faculty" class="form-input" required disabled>
                <option value="">Select Faculty</option>
            </select>
            <div class="error-message"></div>
        </div>

        <div class="form-group">
            <label class="form-label" for="department">Department*</label>
            <select id="department" name="department" class="form-input" required disabled>
                <option value="">Select Department</option>
            </select>
            <div class="error-message"></div>
        </div>

        <div class="form-group">
            <label class="form-label" for="level">Level*</label>
            <select id="level" name="level" class="form-input" required>
                <option value="">Select Level</option>
                <option value="100">100 Level</option>
                <option value="200">200 Level</option>
                <option value="300">300 Level</option>
                <option value="400">400 Level</option>
                <option value="500">500 Level</option>
                <option value="600">600 Level</option>
            </select>
            <div class="error-message"></div>
        </div>

        <div class="form-group">
            <label class="form-label" for="price">Price*</label>
            <div class="input-addon">
                <span class="input-addon-text">₦</span>
                <input type="number" id="price" name="price" class="form-input" required min="100" step="100" placeholder="Enter amount">
            </div>
            <div class="form-hint">Minimum amount is ₦100</div>
            <div class="error-message"></div>
        </div>

        <div class="form-group">
            <label class="form-label" for="start_date">Start Date*</label>
            <input type="date" id="start_date" name="start_date" class="form-input" required>
            <div class="error-message"></div>
        </div>

        <div class="form-group">
            <label class="form-label" for="end_date">End Date*</label>
            <input type="date" id="end_date" name="end_date" class="form-input" required>
            <div class="error-message"></div>
        </div>

        <div class="form-buttons">
            <button type="submit" class="form-button button-primary" id="submitButton">Create Bill</button>
        </div>
    </form>
</main>

<div id="loadingSpinner" class="loading-spinner" style="display: none;">
    <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('billForm');
        const universitySelect = document.getElementById('university');
        const facultySelect = document.getElementById('faculty');
        const departmentSelect = document.getElementById('department');
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        // Set minimum date as today for start_date
        const today = new Date().toISOString().split('T')[0];
        startDateInput.min = today;

        // Update end_date minimum when start_date changes
        startDateInput.addEventListener('change', function() {
            endDateInput.min = this.value;
            if (endDateInput.value && endDateInput.value < this.value) {
                endDateInput.value = this.value;
            }
        });

        // Rest of the existing JavaScript code remains the same
        universitySelect.addEventListener('change', function() {
            const universityId = this.value;
            facultySelect.disabled = !universityId;
            departmentSelect.disabled = true;

            facultySelect.innerHTML = '<option value="">Select Faculty</option>';
            departmentSelect.innerHTML = '<option value="">Select Department</option>';

            if (universityId) {
                $.ajax({
                    url: '../includes/admin/get_faculties.php',
                    method: 'GET',
                    data: { university_id: universityId },
                    dataType: 'json',
                    success: function(faculties) {
                        faculties.forEach(faculty => {
                            const option = document.createElement('option');
                            option.value = faculty.id;
                            option.textContent = faculty.name;
                            facultySelect.appendChild(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching faculties:', error);
                    }
                });
            }
        });

        facultySelect.addEventListener('change', function() {
            const facultyId = this.value;
            const universityId = universitySelect.value;
            departmentSelect.disabled = !facultyId;

            departmentSelect.innerHTML = '<option value="">Select Department</option>';

            if (facultyId && universityId) {
                $.ajax({
                    url: '../includes/admin/get_departments.php',
                    method: 'GET',
                    data: {
                        university_id: universityId,
                        faculty_id: facultyId
                    },
                    dataType: 'json',
                    success: function(departments) {
                        departments.forEach(dept => {
                            const option = document.createElement('option');
                            option.value = dept.id;
                            option.textContent = dept.name;
                            departmentSelect.appendChild(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching departments:', error);
                    }
                });
            }
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const loadingSpinner = document.getElementById('loadingSpinner');
            loadingSpinner.style.display = 'block';

            $.ajax({
                url: '../includes/admin/create_bill',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(result) {
                    if (result.success) {
                        alert('Bill created successfully!');
                        window.location.href = 'bills.php';
                    } else {
                        alert(result.message || 'Error creating bill');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while creating the bill');
                },
                complete: function() {
                    loadingSpinner.style.display = 'none';
                }
            });
        });
    });
</script>

<?php include '../includes/user/footer.php'; ?>