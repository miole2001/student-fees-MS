<?php include("studentHeader.php"); ?>

<main class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    <div class="card" style="width: 800px;">
        <div class="card-header">
            <h3 class="text-center">Payment Form</h3>
        </div>
        <div class="card-body">
        <?php
            // Handle form submission
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Get the payment amount from the form
                $payment = (float) $_POST['payment'];  // Cast to float to ensure it's a number

                $studentID = $student['school_id'];
                $fname = mysqli_real_escape_string($connection, $student['first_name']);  // Escape strings to prevent SQL injection
                $lname = mysqli_real_escape_string($connection, $student['last_name']);
                $bill = (float) $student['bill_balance'];

                // Update the student's bill balance by deducting the payment
                $updatedBill = $bill - $payment;
                if ($updatedBill < 0) {
                    $updatedBill = 0;
                }

                // Build the SQL query, including quotes around strings
                $paymentSql = "INSERT INTO `payment`(`student_id`, `first_name`, `last_name`, `bill_balance`, `payment_amount`, `remaining_balance`, `payment_date`) 
                        VALUES ('$studentID', '$fname', '$lname', $bill, $payment, $updatedBill, NOW())";
                
                // Execute the query and check for errors
                if (mysqli_query($connection, $paymentSql)) {
                    echo '<div class="alert alert-success text-center">Payment has been recorded successfully.</div>';
                } else {
                    echo '<div class="alert alert-danger text-center">Error: ' . mysqli_error($connection) . '</div>';
                }

                // Update the student's bill in the database
                $updateQuery = "UPDATE accounts SET bill_balance = $updatedBill WHERE id = '$id'";
                if (mysqli_query($connection, $updateQuery)) {
                    echo '<div class="alert alert-success text-center">Bill balance updated successfully.</div>';
                } else {
                    echo '<div class="alert alert-danger text-center">Error updating bill balance: ' . mysqli_error($connection) . '</div>';
                }

                // Update the bill in the form
                $student['bill_balance'] = $updatedBill;
            }
            ?>

            <form action="" method="post">
                <div class="form-group row">
                    <label for="studentID" class="col-sm-2 col-form-label">Student ID:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext font-weight-bold" id="studentID" name="studentID" value="<?php echo $student['school_id']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="first-name" class="col-sm-2 col-form-label">First Name:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext font-weight-bold" id="first-name" name="first-name" value="<?php echo $student['first_name']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last-name" class="col-sm-2 col-form-label">Last Name:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext font-weight-bold" id="last-name" name="last-name" value="<?php echo $student['last_name']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="year-level" class="col-sm-2 col-form-label">Year Level:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext font-weight-bold" id="year-level" name="year-level" value="<?php echo $student['year_level']; ?> Year">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="bill" class="col-sm-2 col-form-label">Total Bill:</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext font-weight-bold" id="bill" name="bill" value="₱ <?php echo number_format($student['bill_balance'], 2); ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="payment" class="col-sm-2 col-form-label">Payment:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="payment" name="payment" placeholder="Input payment amount" min="0" step="0.01">
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-sm-10 text-center">
                        <button type="submit" class="btn btn-primary mt-2">Confirm Payment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include("../includes/footer.php"); ?>
<?php include("../includes/scripts.php"); ?>
