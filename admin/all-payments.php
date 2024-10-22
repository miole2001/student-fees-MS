<?php include("adminHeader.php"); ?>
    <main>
        <div class="d-flex justify-content-center mt-4">
            <h3>List of All Payments</h3>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                PAYMENT LOGS
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Bill Balance</th>
                            <th>Payment Amount</th>
                            <th>Remaining Balance</th>
                            <th>Payment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Bill Balance</th>
                            <th>Payment Amount</th>
                            <th>Remaining Balance</th>
                            <th>Payment Date</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (isset($_GET['delete_id'])) {
                            $delete_id = $_GET['delete_id'];
                            $stmt = $connection->prepare("DELETE FROM payment WHERE id = ?");
                            $stmt->bind_param("i", $delete_id);
                            $result = $stmt->execute();

                            if ($result) {
                                echo "<script>alert('Delete Successful!'); window.location.href = 'all-payments.php';</script>";
                            } else {
                                echo "<script>alert('Delete Unsuccessful. There was an error deleting the student.'); window.location.href = 'all-payments.php';</script>";
                            }
                            $stmt->close();
                        }

                        // Fetch student records to display
                        $sql = "SELECT * FROM payment ORDER BY id DESC";
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            $count = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                            <td>{$count}</td>
                                            <td>{$row['student_id']}</td>
                                            <td>{$row['first_name']}</td>
                                            <td>{$row['last_name']}</td>
                                            <td>₱ {$row['bill_balance']}</td>
                                            <td>₱ {$row['payment_amount']}</td>
                                            <td>₱ {$row['remaining_balance']}</td>
                                            <td>{$row['payment_date']}</td>
                                            <td>
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
                                window.location.href = 'all-payments.php?delete_id=' + id;
                            }
                        }
                    </script>

                </table>
            </div>
        </div>


    </main>


<?php include("../includes/footer.php"); ?>
<?php include("../includes/scripts.php"); ?>