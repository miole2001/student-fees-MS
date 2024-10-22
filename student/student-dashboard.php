<?php include("studentHeader.php"); ?>

<main class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    <div class="card" style="width: 800px;">
        <div class="card-header">
            <h3 class="text-center">Payment Form</h3>
        </div>
        <div class="card-body">
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
                        <input type="text" readonly class="form-control-plaintext font-weight-bold" id="bill" name="bill" value="₱ <?php echo $student['bill_balance']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="payment" class="col-sm-2 col-form-label">Payment:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="payment" name="payment" placeholder="Input payment amount">
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
