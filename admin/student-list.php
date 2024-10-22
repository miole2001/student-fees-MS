<?php
include("adminHeader.php");
include("../database/connection.php");

// Handle Update Request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        // Update Request
        $id = $_POST['id'];
        $schoolId = $_POST['school_id'];
        $yearLevel = $_POST['year_level'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Update query
        $sql = "UPDATE `accounts` SET `first_name`=?, `last_name`=?, `email`=?, `password`=?, `school_id`=?, `year_level`=? WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssssi", $firstName, $lastName, $email, $password, $schoolId, $yearLevel, $id);

        if ($stmt->execute()) {
            header("Location: student-list.php");
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    } else {
        // Handle Insert Request
        $schoolId = $_POST['school_id'];
        $yearLevel = $_POST['year_level'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $profile = $_POST['profile-image'];

        // Insert query
        $sql = "INSERT INTO `accounts`(`profile_pic`, `first_name`, `last_name`, `email`, `password`, `school_id`, `year_level`, `bill_balance`, `user_type`, `date_registered`) VALUES (?, ?, ?, ?, ?, ?, '0', 'student', NOW())";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssssss", $profile, $firstName, $lastName, $email, $password, $schoolId, $yearLevel);
        if ($stmt->execute()) {
            header("Location: student-list.php");
            exit();
        } else {
            echo "Error inserting record: " . $stmt->error;
        }
    }
}
?>
<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>List of All Students</h3>
    </div>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New Student</button>
    </div>
    <div class="card mt-4">
        <div class="card-header">
            Student Lists
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Student ID</th>
                        <th>Year Level</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Date Registered</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Student ID</th>
                        <th>Year Level</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Date Registered</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    if (isset($_GET['delete_id'])) {
                        $delete_id = $_GET['delete_id'];
                        $stmt = $connection->prepare("DELETE FROM accounts WHERE id = ?");
                        $stmt->bind_param("i", $delete_id);
                        $result = $stmt->execute();

                        if ($result) {
                            echo "<script>alert('Delete Successful!'); window.location.href = 'student-list.php';</script>";
                        } else {
                            echo "<script>alert('Delete Unsuccessful. There was an error deleting the student.'); window.location.href = 'student-list.php';</script>";
                        }
                        $stmt->close();
                    }

                    // Fetch student records to display
                    $sql = "SELECT * FROM accounts WHERE user_type = 'student' ORDER BY id DESC";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                        <td>{$count}</td>
                                        <td><img src='../image/" . $row['profile_pic'] . "' alt='User Image' class='user-image' style='width: 100px; height: auto;'></td>
                                        <td>{$row['school_id']}</td>
                                        <td>{$row['year_level']}</td>
                                        <td>{$row['first_name']}</td>
                                        <td>{$row['last_name']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['password']}</td>
                                        <td>{$row['date_registered']}</td>
                                        <td>
                                            <button class='btn btn-warning' onclick='openEditModal({$row['id']}, \"{$row['school_id']}\", \"{$row['year_level']}\", \"{$row['first_name']}\", \"{$row['last_name']}\", \"{$row['email']}\", \"{$row['password']}\")'>Edit</button>
                                            <button class='btn btn-danger' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button>
                                        </td> 
                                    </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No students found.</td></tr>";
                    }

                    $connection->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Add Student Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" action="student-list.php" method="POST">
                    <div class="mb-3">
                        <label for="addFirstName" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="profile-image" name="profile-image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="addSchoolId" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="addSchoolId" name="school_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="addYearLevel" class="form-label">Year Level</label>
                        <select class="form-select" id="addYearLevel" name="year_level" required>
                            <option value="">Select Year Level</option>
                            <option value="1st">1st Year</option>
                            <option value="2nd">2nd Year</option>
                            <option value="3rd">3rd Year</option>
                            <option value="4th">4th Year</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="addFirstName" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="addLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="addLastName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="addEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="addEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="addPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="addPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Student</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="student-list.php" method="POST">
                    <input type="hidden" name="id" id="studentId">
                    <div class="mb-3">
                        <label for="editSchoolId" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="editSchoolId" name="school_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="editYearLevel" class="form-label">Year Level</label>
                        <select class="form-select" id="editYearLevel" name="year_level" required>
                            <option value="">Select Year Level</option>
                            <option value="1st">1st Year</option>
                            <option value="2nd">2nd Year</option>
                            <option value="3rd">3rd Year</option>
                            <option value="4th">4th Year</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="editFirstName" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="editLastName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="editPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Student</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this entry?')) {
            window.location.href = 'student-list.php?delete_id=' + id;
        }
    }

    function openEditModal(id, schoolId, yearLevel, firstName, lastName, email, password) {
        document.getElementById('studentId').value = id;
        document.getElementById('editSchoolId').value = schoolId;
        document.getElementById('editYearLevel').value = yearLevel;
        document.getElementById('editFirstName').value = firstName;
        document.getElementById('editLastName').value = lastName;
        document.getElementById('editEmail').value = email;
        document.getElementById('editPassword').value = password;

        var myModal = new bootstrap.Modal(document.getElementById('editModal'));
        myModal.show();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<?php include("../includes/footer.php"); ?>
<?php include("../includes/scripts.php"); ?>
