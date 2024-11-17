<?php
// administrators.php - Frontend file
session_start();
$page = "Administrators";
include '../includes/uni/nav.php';

if (!isset($_SESSION['university_id'])) {
    header('Location: login.php');
    exit();
}

$university_id = $_SESSION['university_id'];
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

<style>
    .admin-section {
        background: var(--card-background);
        padding: 1.5rem;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
        max-width: 100%;
        width: 100%;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    .admin-form {
        display: grid;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .admin-form input,
    .admin-form select {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
        font-size: 1rem;
        width: 100%;
        box-sizing: border-box;
    }

    .admin-form button {
        padding: 0.75rem;
        background: var(--accent-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
    }

    .admin-list {
        width: 100%;
        border-collapse: collapse;
        overflow-x: auto;
        display: block;
    }

    .admin-list th {
        text-align: left;
        padding: 1rem;
        background: #f5f5f5;
        cursor: pointer;
        white-space: nowrap;
    }

    .admin-list td {
        padding: 1rem;
        border-bottom: 1px solid #eee;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-edit,
    .btn-delete {
        padding: 0.5rem 1rem;
        color: white;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-edit {
        background: var(--info-color);
    }

    .btn-delete {
        background: var(--danger-color);
    }

    .edit-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .modal-content {
        position: relative;
        margin: 2rem auto;
        background: white;
        padding: 1.5rem;
        border-radius: var(--border-radius);
        width: 90%;
        max-width: 600px;
    }

    .close-modal {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .admin-section {
            padding: 0.75rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons button {
            width: 100%;
        }
    }
</style>

<div class="main-content">
    <div class="admin-section">
        <h2>Add New Administrator</h2>
        <form id="adminForm" class="admin-form">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Phone Number" required>
            <select name="faculty_id" id="facultySelect" required>
                <option value="">Select Faculty</option>
            </select>
            <select name="department_id" id="departmentSelect" required>
                <option value="">Select Department</option>
            </select>
            <input type="number" name="balance" placeholder="Initial Balance" step="0.01" required>
            <div id="generatedPassword"></div>
            <button type="submit">Add Administrator</button>
        </form>
    </div>

    <div class="admin-section">
        <h2>Administrators List</h2>
        <div style="overflow-x: auto;">
            <table class="admin-list">
                <thead>
                    <tr>
                        <th data-sort="fullname">Full Name ↕</th>
                        <th data-sort="email">Email ↕</th>
                        <th data-sort="phone">Phone</th>
                        <th>Faculty</th>
                        <th>Department</th>
                        <th data-sort="balance">Balance ↕</th>
                        <th data-sort="created_at">Created Date ↕</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="adminTableBody">
                    <!-- Populated via AJAX -->
                </tbody>
            </table>
        </div>
        <div class="pagination" id="pagination">
            <!-- Populated via AJAX -->
        </div>
    </div>
</div>

<div class="edit-modal" id="editModal">
    <div class="modal-content">
        <button class="close-modal" onclick="closeModal()">&times;</button>
        <h2>Edit Administrator</h2>
        <form id="editForm" class="admin-form">
            <input type="hidden" name="admin_id">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Phone Number" required>
            <select name="faculty_id" id="editFacultySelect" required>
                <option value="">Select Faculty</option>
            </select>
            <select name="department_id" id="editDepartmentSelect" required>
                <option value="">Select Department</option>
            </select>
            <input type="number" name="balance" placeholder="Balance" step="0.01" required>
            <input type="password" name="new_password" placeholder="New Password (leave empty to keep current)">
            <button type="submit">Update Administrator</button>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    let currentPage = 1;
    let currentSort = 'created_at';
    let currentOrder = 'DESC';

    function generatePassword() {
        const length = 12;
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
        let password = "";
        for (let i = 0; i < length; i++) {
            password += charset.charAt(Math.floor(Math.random() * charset.length));
        }
        return password;
    }

    function loadFaculties(selectElement) {
        $.ajax({
            url: '../includes/uni/admin_actions',
            method: 'GET',
            data: {
                action: 'get_faculties'
            },
            success: function(response) {
                const data = JSON.parse(response);
                const select = $(selectElement);
                select.html('<option value="">Select Faculty</option>');
                data.faculties.forEach(faculty => {
                    select.append(`<option value="${faculty.id}">${faculty.name}</option>`);
                });
            }
        });
    }

    function loadDepartments(facultyId, selectElement) {
        $.ajax({
            url: '../includes/uni/admin_actions',
            method: 'GET',
            data: {
                action: 'get_departments',
                faculty_id: facultyId
            },
            success: function(response) {
                const data = JSON.parse(response);
                const select = $(selectElement);
                select.html('<option value="">Select Department</option>');
                data.departments.forEach(dept => {
                    select.append(`<option value="${dept.id}">${dept.name}</option>`);
                });
            }
        });
    }

    function loadAdministrators() {
        $.ajax({
            url: '../includes/uni/admin_actions',
            method: 'GET',
            data: {
                action: 'list',
                page: currentPage,
                sort: currentSort,
                order: currentOrder
            },
            success: function(response) {
                const data = JSON.parse(response);
                const tbody = $('#adminTableBody');
                tbody.empty();

                data.administrators.forEach(admin => {
                    tbody.append(`
                    <tr>
                        <td>${admin.fullname}</td>
                        <td>${admin.email}</td>
                        <td>${admin.phone}</td>
                        <td>${admin.faculty_name}</td>
                        <td>${admin.department_name}</td>
                        <td>${parseFloat(admin.balance).toLocaleString()}</td>
                        <td>${new Date(admin.created_at).toLocaleDateString()}</td>
                        <td class="action-buttons">
                            <button onclick="editAdmin(${admin.id})" class="btn-edit">Edit</button>
                            <button onclick="deleteAdmin(${admin.id})" class="btn-delete">Delete</button>
                        </td>
                    </tr>
                `);
                });

                const pagination = $('#pagination');
                pagination.empty();
                for (let i = 1; i <= data.total_pages; i++) {
                    pagination.append(`
                    <button ${i === currentPage ? 'class="active"' : ''} 
                            onclick="changePage(${i})">${i}</button>
                `);
                }
            }
        });
    }

    function editAdmin(adminId) {
        $.ajax({
            url: '../includes/uni/admin_actions',
            method: 'GET',
            data: {
                action: 'get_admin',
                admin_id: adminId
            },
            success: function(response) {
                const data = JSON.parse(response);
                const admin = data.administrator;

                $('#editForm input[name="admin_id"]').val(admin.id);
                $('#editForm input[name="fullname"]').val(admin.fullname);
                $('#editForm input[name="email"]').val(admin.email);
                $('#editForm input[name="phone"]').val(admin.phone);
                $('#editForm input[name="balance"]').val(admin.balance);

                loadFaculties('#editFacultySelect');
                setTimeout(() => {
                    $('#editFacultySelect').val(admin.faculty_id);
                    loadDepartments(admin.faculty_id, '#editDepartmentSelect');
                    setTimeout(() => {
                        $('#editDepartmentSelect').val(admin.department_id);
                    }, 500);
                }, 500);

                document.getElementById('editModal').style.display = 'block';
            }
        });
    }

    function deleteAdmin(adminId) {
        if (confirm('Are you sure you want to delete this administrator?')) {
            $.ajax({
                url: '../includes/uni/admin_actions',
                method: 'POST',
                data: {
                    action: 'delete',
                    admin_id: adminId
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        toastr.success('Administrator deleted successfully');
                        loadAdministrators();
                    } else {
                        toastr.error(data.message || 'Error deleting administrator');
                    }
                }
            });
        }
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
        $('#editForm')[0].reset();
    }

    $(document).ready(function() {
        const password = generatePassword();
        $('#generatedPassword').html(`
        <div style="margin-bottom: 1rem;">
            <strong>Generated Password:</strong> 
            <span style="font-family: monospace;">${password}</span>
            <input type="hidden" name="password" value="${password}">
        </div>
    `);

        loadFaculties('#facultySelect');
        loadAdministrators();

        $('#facultySelect').change(function() {
            loadDepartments($(this).val(), '#departmentSelect');
        });

        $('#editFacultySelect').change(function() {
            loadDepartments($(this).val(), '#editDepartmentSelect');
        });

        $('#adminForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '../includes/uni/admin_actions',
                method: 'POST',
                data: $(this).serialize() + '&action=add',
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        toastr.success('Administrator added successfully');
                        $('#adminForm')[0].reset();
                        const newPassword = generatePassword();
                        $('#generatedPassword').html(`
                        <div style="margin-bottom: 1rem;">
                            <strong>Generated Password:</strong> 
                            <span style="font-family: monospace;">${newPassword}</span>
                            <input type="hidden" name="password" value="${newPassword}">
                        </div>
                    `);
                        loadAdministrators();
                    } else {
                        toastr.error(data.message || 'Error adding administrator');
                    }
                }
            });
        });

        $('#editForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '../includes/uni/admin_actions',
                method: 'POST',
                data: $(this).serialize() + '&action=update',
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        toastr.success('Administrator updated successfully');
                        closeModal();
                        loadAdministrators();
                    } else {
                        toastr.error(data.message || 'Error updating administrator');
                    }
                }
            });
        });

        // Sort functionality
        $('.admin-list th[data-sort]').click(function() {
            const sortField = $(this).data('sort');

            // Toggle order if clicking the same column
            if (sortField === currentSort) {
                currentOrder = currentOrder === 'ASC' ? 'DESC' : 'ASC';
            } else {
                currentSort = sortField;
                currentOrder = 'ASC';
            }

            // Update sort indicators
            $('.admin-list th').each(function() {
                $(this).text($(this).text().replace(' ↑', '').replace(' ↓', ''));
            });
            $(this).text($(this).text().replace(' ↕', '') +
                (currentOrder === 'ASC' ? ' ↑' : ' ↓'));

            loadAdministrators();
        });

        // Close modal when clicking outside
        $(window).click(function(event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                closeModal();
            }
        });
    });

    function changePage(page) {
        currentPage = page;
        loadAdministrators();
    }

    // Initialize toastr options
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "1000"
    };
</script>