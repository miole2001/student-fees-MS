<?php include("adminHeader.php"); ?>
<main>
    <div class="d-flex justify-content-center mt-4">
        <h3>List of All Students</h3>
    </div>
    <div class="card mt-5">
            <div class="card-header">
                Second Year Fees
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
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
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Remaining Balance</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        // Fetch student records to display
                        $sql = "SELECT * FROM student_bills WHERE year_level = '2nd' ORDER BY id DESC";
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            $count = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$count}</td>
                                        <td>{$row['student_id']}</td>
                                        <td>{$row['first_name']}</td>
                                        <td>{$row['last_name']}</td>
                                        <td> $ {$row['remaining_balance']}</td>
                                        <td>
                                            <button class='btn btn-warning' >Edit</button>
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

<?php include("../includes/footer.php"); ?>
<?php include("../includes/scripts.php"); ?>