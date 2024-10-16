<?php include("adminHeader.php"); ?>
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
                                            <button class='btn btn-warning'>Edit</button>
                                            <button class='btn btn-danger'>Delete</button>
                                        </td> 
                                    </tr>";
                                $count++;
                            }
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