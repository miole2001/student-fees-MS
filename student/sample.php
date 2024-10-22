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
                $payment = $_POST['payment'];
                
                // Update the student's bill balance by deducting the payment
                $updatedBill = $student['bill_balance'] - $payment;

                // Make sure the updated bill doesn't go negative
                if ($updatedBill < 0) {
                    $updatedBill = 0;
                }

                // Display a success message
                echo '<div class="alert alert-success text-center">Payment of ₱' . number_format($payment, 2) . ' has been applied. Remaining balance is ₱' . number_format($updatedBill, 2) . '.</div>';

                // Here you would typically update the student's bill in the database
                // For example:
                $query = "UPDATE students SET bill_balance = $updatedBill WHERE id = $id";
                mysqli_query($connection, $query);

                // Update the student's bill balance in the form to reflect the deduction
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
