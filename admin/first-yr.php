<?php include("adminHeader.php"); ?>
<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>List of All Students</h3>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            First Year Fees
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Remaining Balance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Remaining Balance</th>
                        <th>Actions</th>
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
                            echo "<script>alert('Delete Successful!'); window.location.href = 'first-yr.php';</script>";
                        } else {
                            echo "<script>alert('Delete Unsuccessful. There was an error deleting the student.'); window.location.href = 'first-yr.php';</script>";
                        }
                        $stmt->close();
                    }

                    // Fetch student records to display
                    $sql = "SELECT * FROM accounts WHERE year_level = '1st' ORDER BY id DESC";
                    $result = $connection->query($sql);

                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                        <td>{$count}</td>
                                        <td><img src='../image/" . $row['profile_pic'] . "' alt='User Image' class='user-image' style='width: 100px; height: auto;'></td>      
                                        <td>{$row['school_id']}</td>
                                        <td>{$row['first_name']}</td>
                                        <td>{$row['last_name']}</td>
                                        <td>₱ {$row['bill_balance']}</td>
                                        <td>
                                            <button class='btn btn-warning' onclick='openEditModal({$row['id']}, \"{$row['school_id']}\", \"{$row['first_name']}\", \"{$row['last_name']}\", {$row['bill_balance']})'>Edit</button>
                                            <button class='btn btn-danger' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button>
                                        </td> 
                                    </tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No students found.</td></tr>";
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $id = $_POST['id'];
                        $school_id = $_POST['school_id'];
                        $first_name = $_POST['first_name'];
                        $last_name = $_POST['last_name'];
                        $bill_balance = $_POST['bill_balance'];

                        // Prepare the SQL statement
                        $stmt = $connection->prepare("UPDATE accounts SET school_id = ?, first_name = ?, last_name = ?, bill_balance = ? WHERE id = ?");
                        $stmt->bind_param("ssssi", $school_id, $first_name, $last_name, $bill_balance, $id);

                        // Execute the statement and check for errors
                        if ($stmt->execute()) {
                            echo "<script>alert('Update Successful!'); window.location.href = 'first-yr.php';</script>";
                        } else {
                            echo "<script>alert('Update Unsuccessful. Error: " . $stmt->error . "'); window.location.href = 'first-yr.php';</script>";
                        }

                        $stmt->close();
                        $connection->close();
                    }

                    $connection->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="">
                        <input type="hidden" name="id" id="studentId">
                        <div class="mb-3">
                            <label for="schoolId" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="schoolId" name="school_id" required>
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
                            <label for="balance" class="form-label">Remaining Balance</label>
                            <input type="number" class="form-control" id="balance" name="bill_balance" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this entry?')) {
                window.location.href = 'first-yr.php?delete_id=' + id;
            }
        }

        function openEditModal(id, schoolId, firstName, lastName, balance) {
            document.getElementById('studentId').value = id;
            document.getElementById('schoolId').value = schoolId;
            document.getElementById('firstName').value = firstName;
            document.getElementById('lastName').value = lastName;
            document.getElementById('balance').value = balance;

            var myModal = new bootstrap.Modal(document.getElementById('editModal'));
            myModal.show();
        }
    </script>
</main>

<?php include("../includes/footer.php"); ?>
<?php include("../includes/scripts.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>