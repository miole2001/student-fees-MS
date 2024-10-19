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
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-5">
                <div class="card bg-primary mb-4">
                    <div class="card-body text-center text-white">
                        <h2>Total Paid Fees</h2>
                        <h3>12</h3>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-5">
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
            </div>

            <div class="col-xl-3 col-md-5">
                <div class="card bg-primary mb-4">
                    <div class="card-body text-center text-white">
                        <h2>All Grade Levels</h2>
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
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                All Student Fees
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Year Level</th>
                            <th>Bill</th>
                            <th>Bill</th>
                            <th>Bill</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Year Level</th>
                            <th>Bill</th>
                            <th>Bill</th>
                            <th>Bill</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>23-20001</td>
                            <td>Garrett</td>
                            <td>Winters</td>
                            <td>2nd Year</td>
                            <td>$800</td>
                            <td>$320</td>
                            <td>$480</td>
                            <td>Update/Delete</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include("../includes/footer.php"); ?>
<?php include("../includes/scripts.php"); ?>