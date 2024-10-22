<?php include("adminHeader.php");

?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>

        <div class="row mt-5">
            <div class="col-xl-3 col-md-5">
                <div class="card bg-primary mb-4">
                    <div class="card-body text-center text-white">
                        <h2>Total Students</h2>
                        <?php
                            $query = "SELECT * FROM accounts WHERE user_type = 'student'";
                            $run_query = mysqli_query($connection, $query);

                            if ($run_query) {
                                $row = mysqli_num_rows($run_query);
                                echo '<h3>' . $row . '</h3>';
                            } else {
                                echo '<h3>Error: Could not retrieve data.</h3>';
                            }
                        ?>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="student-list.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-5">
                <div class="card bg-primary mb-4">
                    <div class="card-body text-center text-white">
                        <h2>Total Payment</h2>
                        <?php
                            $query = "SELECT * FROM payment";
                            $run_query = mysqli_query($connection, $query);

                            if ($run_query) {
                                $row = mysqli_num_rows($run_query);
                                echo '<h3>' . $row . '</h3>';
                            } else {
                                echo '<h3>Error: Could not retrieve data.</h3>';
                            }
                        ?>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="all-payments.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <!-- <div class="col-xl-3 col-md-5">
                <div class="card bg-primary mb-4">
                    <div class="card-body text-center text-white">
                        <h2>Total Fees</h2>
                        <h3>12</h3>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div> -->

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
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php

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

                                        </tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center'>No students found.</td></tr>";
                        }

                        $connection->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include("../includes/footer.php"); ?>
<?php include("../includes/scripts.php"); ?>