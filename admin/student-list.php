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
    }
}
?>
<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>List of All Students</h3>
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
                                            <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['id']}' data-schoolid='{$row['school_id']}' data-yearlevel='{$row['year-level']}' data-firstname='{$row['first_name']}' data-lastname='{$row['last_name']}' data-email='{$row['email']}' data-password='{$row['password']}'>Edit</button>
                                            <button class='btn btn-danger'>Delete</button>
                                        </td> 
                                    </tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No students found.</td></tr>";
                        }

                        $connection->close();
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Modal -->
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
                <input type="text" class="form-control" id="yearLevel" name="year_level" required>
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

<?php include("../includes/footer.php"); ?>
<?php include("../includes/scripts.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
// Handle the 'Edit' button click to populate the modal with the student's data
document.addEventListener('DOMContentLoaded', function () {
    var editButtons = document.querySelectorAll('.btn-warning');
    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var id = button.getAttribute('data-id');
            var schoolId = button.getAttribute('data-schoolid');
            var yearLevel = button.getAttribute('data-yearlevel');
            var firstName = button.getAttribute('data-firstname');
            var lastName = button.getAttribute('data-lastname');
            var email = button.getAttribute('data-email');
            var password = button.getAttribute('data-password');

            document.getElementById('studentId').value = id;
            document.getElementById('schoolId').value = schoolId;
            document.getElementById('yearLevel').value = yearLevel;
            document.getElementById('firstName').value = firstName;
            document.getElementById('lastName').value = lastName;
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        });
    });
});
</script>
