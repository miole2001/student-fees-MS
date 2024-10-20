<?php
include("adminHeader.php");
include("../database/connection.php");

// Handle Update Request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $schoolId = $_POST['school_id'];
        $yearLevel = $_POST['year_level'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Update query
        $sql = "UPDATE accounts SET school_id = ?, `year-level` = ?, first_name = ?, last_name = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssssi", $schoolId, $yearLevel, $firstName, $lastName, $email, $password, $id);

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

        // Insert query
        $sql = "INSERT INTO `accounts`(`first_name`, `last_name`, `email`, `password`, `school_id`, `year-level`, `user_type`, `date_registered`) VALUES (?, ?, ?, ?, ?, ?, 'student', NOW())";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssss", $firstName, $lastName, $email, $password, $schoolId, $yearLevel);

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
                                        <td>{$row['school_id']}</td>
                                        <td>{$row['year-level']}</td>
                                        <td>{$row['first_name']}</td>
                                        <td>{$row['last_name']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['password']}</td>
                                        <td>{$row['date_registered']}</td>
                                        <td>
                                            <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editModal' 
                                            data-id='{$row['id']}' 
                                            data-schoolid='{$row['school_id']}' 
                                            data-yearlevel='{$row['year-level']}' 
                                            data-firstname='{$row['first_name']}' 
                                            data-lastname='{$row['last_name']}' 
                                            data-email='{$row['email']}' 
                                            data-password='{$row['password']}'>Edit</button>
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
                <script>
                    function confirmDelete(id) {
                        if (confirm('Are you sure you want to delete this entry?')) {
                            window.location.href = 'student-list.php?delete_id=' + id;
                        }
                    }
                </script>
            </table>
        </div>
    </div>
</main>

<!-- Edit Student Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="student-list.php" method="POST">
                    <input type="hidden" id="studentId" name="id">
                    <div class="mb-3">
                        <label for="schoolId" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="schoolId" name="school_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="yearLevel" class="form-label">Year Level</label>
                        <select class="form-select" id="yearLevel" name="year_level" required>
                            <option value="">Select Year Level</option>
                            <option value="1st">1st Year</option>
                            <option value="2nd">2nd Year</option>
                            <option value="3rd">3rd Year</option>
                            <option value="4th">4th Year</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

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

<?php include("../includes/footer.php"); ?>
<?php include("../includes/scripts.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    // Populate the Edit Modal
$('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id'); // Extract info from data-* attributes
    var schoolId = button.data('schoolid');
    var yearLevel = button.data('yearlevel');
    var firstName = button.data('firstname');
    var lastName = button.data('lastname');
    var email = button.data('email');
    var password = button.data('password');

    // Update the modal's content
    var modal = $(this);
    modal.find('#studentId').val(id);
    modal.find('#schoolId').val(schoolId);
    modal.find('#yearLevel').val(yearLevel);
    modal.find('#firstName').val(firstName);
    modal.find('#lastName').val(lastName);
    modal.find('#email').val(email);
    modal.find('#password').val(password);
});

</script>
