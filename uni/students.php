<?php
// students.php
session_start();
$page = "Students";
include '../includes/uni/nav.php';

// Verify user is logged in and has university_id
if (!isset($_SESSION['university_id'])) {
    header('Location: login.php');
    exit();
}

$university_id = $_SESSION['university_id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <style>
        .student-section {
            background: var(--card-background);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
            width: 100%;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .filters {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .filters select, .filters input {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            width: 100%;
        }

        .student-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .student-table th {
            text-align: left;
            padding: 1rem;
            background: #f5f5f5;
            cursor: pointer;
            white-space: nowrap;
        }

        .student-table td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            color: white;
        }

        .btn-edit {
            background: var(--accent-color);
        }

        .btn-delete {
            background: var(--danger-color);
        }

        .modal {
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
            background: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 600px;
            margin: 2rem auto;
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

        .form-grid {
            display: grid;
            gap: 1rem;
            margin-top: 1rem;
        }

        .form-group {
            display: grid;
            gap: 0.5rem;
        }

        .form-group input, .form-group select {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            width: 100%;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .pagination button {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            background: white;
            cursor: pointer;
        }

        .pagination button.active {
            background: var(--accent-color);
            color: white;
            border: none;
        }

        @media (max-width: 768px) {
            .filters {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .modal-content {
                margin: 1rem;
                padding: 1rem;
                width: calc(100% - 2rem);
            }
        }
    </style>
</head>
<body>

<div class="main-content">
    <div class="student-section">
        <h2>Students Management</h2>
        
        <div class="filters">
            <input type="text" id="searchInput" placeholder="Search students...">
            <select id="facultyFilter">
                <option value="">All Faculties</option>
            </select>
            <select id="departmentFilter">
                <option value="">All Departments</option>
            </select>
            <select id="levelFilter">
                <option value="">All Levels</option>
                <option value="100">100 Level</option>
                <option value="200">200 Level</option>
                <option value="300">300 Level</option>
                <option value="400">400 Level</option>
                <option value="500">500 Level</option>
            </select>
        </div>

        <div style="overflow-x: auto;">
            <table class="student-table">
                <thead>
                    <tr>
                        <th data-sort="fullname">Full Name ↕</th>
                        <th data-sort="matric_no">Matric No ↕</th>
                        <th data-sort="faculty">Faculty ↕</th>
                        <th data-sort="department">Department ↕</th>
                        <th data-sort="level">Level ↕</th>
                        <th data-sort="email">Email ↕</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <!-- Populated via AJAX -->
                </tbody>
            </table>
        </div>
        <div class="pagination" id="pagination">
            <!-- Populated via AJAX -->
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <button class="close-modal" onclick="closeModal()">&times;</button>
        <h2>Edit Student</h2>
        <form id="editStudentForm" class="form-grid">
            <input type="hidden" name="id" id="editId">
            <div class="form-group">
                <label for="editFullname">Full Name</label>
                <input type="text" id="editFullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="editEmail">Email</label>
                <input type="email" id="editEmail" name="email" required>
            </div>
            <div class="form-group">
                <label for="editPhone">Phone</label>
                <input type="tel" id="editPhone" name="phone">
            </div>
            <div class="form-group">
                <label for="editFaculty">Faculty</label>
                <select id="editFaculty" name="faculty" required>
                    <!-- Populated via AJAX -->
                </select>
            </div>
            <div class="form-group">
                <label for="editDepartment">Department</label>
                <select id="editDepartment" name="department" required>
                    <!-- Populated via AJAX -->
                </select>
            </div>
            <div class="form-group">
                <label for="editLevel">Level</label>
                <select id="editLevel" name="level" required>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="400">400</option>
                    <option value="500">500</option>
                </select>
            </div>
            <div class="form-group">
                <label for="editPassword">New Password (leave blank to keep current)</label>
                <input type="password" id="editPassword" name="password">
            </div>
            <button type="submit" class="btn btn-edit">Update Student</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let currentSort = 'fullname';
let sortDirection = 'asc';
let currentPage = 1;
let searchTerm = '';
let facultyFilter = '';
let departmentFilter = '';
let levelFilter = '';

$(document).ready(function() {
    loadStudents();
    loadFaculties();
    
    // Search input handler
    $('#searchInput').on('input', function() {
        searchTerm = $(this).val();
        currentPage = 1;
        loadStudents();
    });

    // Filter handlers
    $('#facultyFilter, #departmentFilter, #levelFilter').on('change', function() {
        facultyFilter = $('#facultyFilter').val();
        departmentFilter = $('#departmentFilter').val();
        levelFilter = $('#levelFilter').val();
        currentPage = 1;
        loadStudents();
    });

    // Sort handlers
    $('.student-table th[data-sort]').on('click', function() {
        const newSort = $(this).data('sort');
        if (currentSort === newSort) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            currentSort = newSort;
            sortDirection = 'asc';
        }
        loadStudents();
    });

    // Edit form submission
    $('#editStudentForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        $.ajax({
            url: '../includes/uni/update_student.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    alert('Student updated successfully');
                    closeModal();
                    loadStudents();
                } else {
                    alert('Error updating student: ' + response.message);
                }
            },
            error: function() {
                alert('Error updating student');
            }
        });
    });

    // Faculty change handler for department dropdown
    $('#editFaculty').on('change', function() {
        const facultyId = $(this).val();
        loadDepartments(facultyId);
    });
});

function loadStudents() {
    $.ajax({
        url: '../includes/uni/get_students.php',
        type: 'GET',
        data: {
            page: currentPage,
            sort: currentSort,
            direction: sortDirection,
            search: searchTerm,
            faculty: facultyFilter,
            department: departmentFilter,
            level: levelFilter
        },
        success: function(response) {
            $('#studentTableBody').empty();
            response.students.forEach(function(student) {
                $('#studentTableBody').append(`
                    <tr>
                        <td>${student.fullname}</td>
                        <td>${student.matric_no}</td>
                        <td>${student.faculty}</td>
                        <td>${student.department}</td>
                        <td>${student.level}</td>
                        <td>${student.email}</td>
                        <td class="action-buttons">
                            <button class="btn btn-edit" onclick="editStudent(${student.id})">Edit</button>
                            <button class="btn btn-delete" onclick="deleteStudent(${student.id})">Delete</button>
                        </td>
                    </tr>
                `);
            });

            // Update pagination
            updatePagination(response.totalPages);
        },
        error: function() {
            alert('Error loading students');
        }
    });
}

function loadFaculties() {
    $.ajax({
        url: '../includes/uni/get_faculties.php',
        type: 'GET',
        success: function(response) {
            $('#facultyFilter, #editFaculty').empty();
            $('#facultyFilter').append('<option value="">All Faculties</option>');
            response.faculties.forEach(function(faculty) {
                $('#facultyFilter, #editFaculty').append(`
                    <option value="${faculty.id}">${faculty.name}</option>
                `);
            });
        }
    });
}

function loadDepartments(facultyId) {
    $.ajax({
        url: '../includes/uni/get_departments.php',
        type: 'GET',
        data: { faculty_id: facultyId },
        success: function(response) {
            $('#departmentFilter, #editDepartment').empty();
            $('#departmentFilter').append('<option value="">All Departments</option>');
            response.departments.forEach(function(department) {
                $('#departmentFilter, #editDepartment').append(`
                    <option value="${department.id}">${department.name}</option>
                `);
            });
        }
    });
}

function editStudent(id) {
    $.ajax({
        url: '../includes/uni/get_student.php',
        type: 'GET',
        data: { id: id },
        success: function(response) {
            $('#editId').val(response.id);
            $('#editFullname').val(response.fullname);
            $('#editEmail').val(response.email);
            $('#editPhone').val(response.phone);
            $('#editFaculty').val(response.faculty_id);
            loadDepartments(response.faculty_id);
            $('#editDepartment').val(response.department_id);
            $('#editLevel').val(response.level);
            $('#editModal').show();
        }
    });
}

function deleteStudent(id) {
    if (confirm('Are you sure you want to delete this student?')) {
        $.ajax({
            url: '../includes/uni/delete_student.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if (response.success) {
                    alert('Student deleted successfully');
                    loadStudents();
                } else {
                    alert('Error deleting student: ' + response.message);
                }
            },
            error: function() {
                alert('Error deleting student');
            }
        });
    }
}

function closeModal() {
    $('#editModal').hide();
    $('#editStudentForm')[0].reset();
}

function updatePagination(totalPages) {
    $('#pagination').empty();
    
    // Previous button
    if (currentPage > 1) {
        $('#pagination').append(`
            <button onclick="changePage(${currentPage - 1})">Previous</button>
        `);
    }
    
    // Page numbers
    for (let i = 1; i <= totalPages; i++) {
        $('#pagination').append(`
            <button onclick="changePage(${i})" 
                    class="${currentPage === i ? 'active' : ''}">${i}</button>
        `);
    }
    
    // Next button
    if (currentPage < totalPages) {
        $('#pagination').append(`
            <button onclick="changePage(${currentPage + 1})">Next</button>
        `);
    }
}

function changePage(page) {
    currentPage = page;
    loadStudents();
}
</script>
</body>
</html>