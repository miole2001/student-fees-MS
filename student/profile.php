<?php 
include("studentHeader.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $student_id = $_POST['student-id'];
    $year_level = $_POST['year-level'];
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $sql = "UPDATE accounts SET 
                school_id = '$student_id', 
                year_level = '$year_level', 
                first_name = '$first_name', 
                last_name = '$last_name', 
                email = '$email', 
                password = '$password' 
            WHERE id = $id";

    if ($connection->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Profile updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating profile: " . $connection->error . "</div>";
    }
}

// Fetch the current student data
$sql = "SELECT * FROM accounts WHERE id = $id";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
} else {
    die('Account not found.');
}
?>

<main>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row border-right">
                    <div class="col-md-4 d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" src="../image/<?php echo $student['profile_pic']; ?>">
                        <span class="font-weight-bold"><?php echo $student['first_name'] . ' ' . $student['last_name']; ?></span>
                        <span class="text-black-50"><?php echo $student['email']; ?></span>
                    </div>
                    <div class="col-md-8">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>

                            <form action="" method="post">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="labels">Student ID</label>
                                        <input type="text" class="form-control" name="student-id" value="<?php echo $student['school_id']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Year Level</label>
                                        <input type="text" class="form-control" name="year-level" value="<?php echo $student['year_level']; ?>">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="labels">First Name</label>
                                        <input type="text" class="form-control" name="first-name" value="<?php echo $student['first_name']; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="labels">Last Name</label>
                                        <input type="text" class="form-control" name="last-name" value="<?php echo $student['last_name']; ?>">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Email</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $student['email']; ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Password</label>
                                        <input type="text" class="form-control" name="password" value="<?php echo $student['password']; ?>">
                                    </div>
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include("../includes/footer.php"); ?>
<?php include("../includes/scripts.php"); ?>
