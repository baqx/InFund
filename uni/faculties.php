<?php
session_start();
$page = "Faculties";
include '../includes/uni/nav.php';

// Verify user is logged in and has university_id
if (!isset($_SESSION['university_id'])) {
    header('Location: login.php');
    exit();
}

$university_id = $_SESSION['university_id'];
?>
<style>
    .faculty-section {
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

    .faculty-form {
        display: grid;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .faculty-form input,
    .department-form input {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: var(--border-radius);
        font-size: 1rem;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    .faculty-form button,
    .department-form button {
        padding: 0.75rem;
        background: var(--accent-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        transition: var(--transition);
    }

    .faculty-list {
        width: 100%;
        border-collapse: collapse;
        overflow-x: auto;
        display: block;
    }

    .faculty-list th {
        text-align: left;
        padding: 1rem;
        background: #f5f5f5;
        cursor: pointer;
        white-space: nowrap;
    }

    .faculty-list td {
        padding: 1rem;
        border-bottom: 1px solid #eee;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-delete {
        padding: 0.5rem 1rem;
        background: var(--danger-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-view {
        padding: 0.5rem 1rem;
        background: var(--info-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        cursor: pointer;
        white-space: nowrap;
    }

    .departments-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        overflow-y: auto;
    }

    .modal-content {
        position: relative;
        margin: 2rem auto;
        background: white;
        padding: 1.5rem;
        border-radius: var(--border-radius);
        width: 90%;
        max-width: 600px;
        box-sizing: border-box;
    }

    .departments-list {
        margin-top: 1rem;
    }

    .department-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border-bottom: 1px solid #eee;
    }

    .department-form {
        margin-bottom: 1.5rem;
        display: grid;
        gap: 1rem;
    }
    .pagination {
    display: flex;
    justify-content: center;
    margin-top: 1rem;
}

.pagination button {
    padding: 0.5rem 1rem;
    border: 1px solid #ddd;
    border-radius: var(--border-radius);
    margin: 0 0.25rem;
    background: var(--card-background);
    cursor: pointer;
    transition: background 0.3s;
}

.pagination button:hover {
    background: var(--accent-color);
    color: white;
}

.pagination button.active {
    background: var(--accent-color);
    color: white;
    border: none;
}

    @media (max-width: 768px) {
        .faculty-section {
            padding: 0.75rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons button {
            width: 100%;
        }

        .faculty-list td {
            padding: 0.5rem;
        }

        .modal-content {
            margin: 1rem;
            padding: 1rem;
            width: calc(100% - 2rem);
        }
    }

    .loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .loading::after {
        content: "";
        width: 50px;
        height: 50px;
        border: 5px solid #f3f3f3;
        border-top: 5px solid var(--accent-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0 deg);
        }
        100% {
            transform: rotate(360deg);
        }
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
</style>
</head>

<body>

<div class="main-content">
    <div class="faculty-section">
        <h2>Add New Faculty</h2>
        <form id="facultyForm" class="faculty-form">
            <input type="text" name="faculty_name" placeholder="Faculty Name" required>
            <button type="submit">Add Faculty</button>
        </form>
    </div>

    <div class="faculty-section">
        <h2>Faculty List</h2>
        <div style="overflow-x: auto;">
            <table class="faculty-list">
                <thead>
                    <tr>
                        <th data-sort="name">Faculty Name ↕</th>
                        <th data-sort="created_at">Created Date ↕</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="facultyTableBody">
                    <!-- Populated via AJAX -->
                </tbody>
            </table>
        </div>
        <div class="pagination" id="pagination">
            <!-- Populated via AJAX -->
        </div>
    </div>
</div>

<div class="departments-modal" id="departmentsModal">
    <div class="modal-content">
        <button class="close-modal" onclick="closeModal()">&times;</button>
        <h2>Departments</h2>
        <form id="departmentForm" class="department-form">
            <input type="hidden" id="currentFacultyId" name="faculty_id">
            <input type="text" name="department_name" placeholder="Department Name" required>
            <button type="submit">Add Department</button>
        </form>
        <div id="departmentsList" class="departments-list">
            <!-- Populated via AJAX -->
        </div>
    </div>
</div>

    <div class="loading" id="loading"></div>

    <div class="departments-modal" id="departmentsModal">
        <div class="modal-content">
            <h2>Departments</h2>
            <div id="departmentsList"></div>
            <button onclick="closeModal()" class="btn-view">Close</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        let currentPage = 1;
        let currentSort = 'created_at';
        let currentOrder = 'DESC';

        function showLoading() {
            document.getElementById('loading').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loading').style.display = 'none';
        }

        function loadFaculties() {
            showLoading();
            $.ajax({
                url: '../includes/uni/faculty_actions',
                method: 'GET',
                data: {
                    action: 'list',
                    page: currentPage,
                    sort: currentSort,
                    order: currentOrder
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    const tbody = $('#facultyTableBody');
                    tbody.empty();

                    data.faculties.forEach(faculty => {
                        tbody.append(`
                    <tr>
                        <td>${faculty.name}</td>
                        <td>${new Date(faculty.created_at).toLocaleDateString()}</td>
                        <td class="action-buttons">
                            <button onclick="viewDepartments(${faculty.id})" class="btn-view">View Departments</button>
                            <button onclick="deleteFaculty(${faculty.id})" class="btn-delete">Delete</button>
                        </td>
                    </tr>
                `);
                    });

                    // Update pagination
                    const pagination = $('#pagination');
                    pagination.empty();
                    for (let i = 1; i <= data.total_pages; i++) {
                        pagination.append(`
                    <button ${i === currentPage ? 'class="active"' : ''} 
                            onclick="changePage(${i})">${i}</button>
                `);
                    }
                    hideLoading();
                },
                error: function() {
                    toastr.error('Error loading faculties');
                    hideLoading();
                }
            });
        }

        function changePage(page) {
            currentPage = page;
            loadFaculties();
        }

        function changeSort(column) {
            if (currentSort === column) {
                currentOrder = currentOrder === 'ASC' ? 'DESC' : 'ASC';
            } else {
                currentSort = column;
                currentOrder = 'ASC';
            }
            loadFaculties();
        }

        function deleteFaculty(id) {
            if (confirm('Are you sure you want to delete this faculty? All departments under this faculty will also be deleted.')) {
                showLoading();
                $.ajax({
                    url: '../includes/uni/faculty_actions',
                    method: 'POST',
                    data: {
                        action: 'delete',
                        faculty_id: id
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.success) {
                            toastr.success('Faculty deleted successfully');
                            loadFaculties();
                        } else {
                            toastr.error(data.message || 'Error deleting faculty');
                        }
                        hideLoading();
                    },
                    error: function() {
                        toastr.error('Error deleting faculty');
                        hideLoading();
                    }
                });
            }
        }

        function viewDepartments(facultyId) {
            showLoading();
            $('#currentFacultyId').val(facultyId);

            $.ajax({
                url: '../includes/uni/faculty_actions',
                method: 'GET',
                data: {
                    action: 'departments',
                    faculty_id: facultyId
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    const departmentsList = $('#departmentsList');
                    departmentsList.empty();

                    if (data.departments.length > 0) {
                        data.departments.forEach(dept => {
                            departmentsList.append(`
                        <div class="department-item">
                            <span>${dept.name}</span>
                            <button onclick="deleteDepartment(${dept.id})" class="btn-delete">Delete</button>
                        </div>
                    `);
                        });
                    } else {
                        departmentsList.append('<p>No departments found</p>');
                    }

                    document.getElementById('departmentsModal').style.display = 'block';
                    hideLoading();
                },
                error: function() {
                    toastr.error('Error loading departments');
                    hideLoading();
                }
            });
        }

        function deleteDepartment(departmentId) {
            if (confirm('Are you sure you want to delete this department?')) {
                showLoading();
                $.ajax({
                    url: '../includes/uni/faculty_actions',
                    method: 'POST',
                    data: {
                        action: 'delete_department',
                        department_id: departmentId
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.success) {
                            toastr.success('Department deleted successfully');
                            viewDepartments($('#currentFacultyId').val());
                        } else {
                            toastr.error(data.message || 'Error deleting department');
                        }
                        hideLoading();
                    },
                    error: function() {
                        toastr.error('Error deleting department');
                        hideLoading();
                    }
                });
            }
        }

        function closeModal() {
            document.getElementById('departmentsModal').style.display = 'none';
            $('#departmentForm')[0].reset();
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('departmentsModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Initialize when document is ready
        $(document).ready(function() {
            // Load initial data
            loadFaculties();

            // Set up sorting
            $('.faculty-list th').click(function() {
                const column = $(this).data('sort');
                if (column) {
                    changeSort(column);
                }
            });

            // Faculty form submission
            $('#facultyForm').submit(function(e) {
                e.preventDefault();
                showLoading();

                $.ajax({
                    url: '../includes/uni/faculty_actions',
                    method: 'POST',
                    data: {
                        action: 'add',
                        name: $('input[name="faculty_name"]').val()
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.success) {
                            toastr.success('Faculty added successfully');
                            $('#facultyForm')[0].reset();
                            loadFaculties();
                        } else {
                            toastr.error(data.message || 'Error adding faculty');
                        }
                        hideLoading();
                    },
                    error: function() {
                        toastr.error('Error adding faculty');
                        hideLoading();
                    }
                });
            });

            // Department form submission
            $('#departmentForm').submit(function(e) {
                e.preventDefault();
                showLoading();

                $.ajax({
                    url: '../includes/uni/faculty_actions',
                    method: 'POST',
                    data: {
                        action: 'add_department',
                        faculty_id: $('#currentFacultyId').val(),
                        name: $('input[name="department_name"]').val()
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.success) {
                            toastr.success('Department added successfully');
                            $('#departmentForm')[0].reset();
                            viewDepartments($('#currentFacultyId').val());
                        } else {
                            toastr.error(data.message || 'Error adding department');
                        }
                        hideLoading();
                    },
                    error: function() {
                        toastr.error('Error adding department');
                        hideLoading();
                    }
                });
            });

            // Initialize toastr options
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000
            };
        });
    </script>

</body>

</html>