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
                Student Logs
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include("../includes/footer.php"); ?>
<?php include("../includes/scripts.php"); ?>