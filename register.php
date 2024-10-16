<?php include('./database/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $email = $_POST["email"];
    $school_id = $_POST["student-id"];
    $year_level = $_POST["year-level"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];
    $user_type = $_POST["type"];

    if ($password === $confirm_password) {

        $register = "INSERT INTO `accounts`(`first_name`, `last_name`, `email`, `password`, `school_id`, `year-level`, `user_type`)
                              VALUES ('$first_name', '$last_name', '$email', '$password', '$school_id', '$year_level', '$user_type')";

        $result = mysqli_query($connection, $register);

        header("Location: index.php");
    } else {

        echo " <script> alert('password does not match'); </script> ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - SFMS</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="first-name" name="first-name" type="text" placeholder="Enter your first name" />
                                                        <label for="first-name">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="last-name" name="last-name" type="text" placeholder="Enter your last name" />
                                                        <label for="last-name">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" />
                                                <label for="email">Email address</label>
                                            </div>
                    
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="student-id" name="student-id" type="text" placeholder="name@example.com" />
                                                        <label for="student-id">Student ID</label>
                                                    </div>
                                            
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="year-level" name="year-level" type="text" placeholder="name@example.com" />
                                                        <label for="year-level">Year Level</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="password" name="password" type="password" placeholder="Create a password" />
                                                        <label for="password">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="confirm-password" name="confirm-password" type="password" placeholder="Confirm password" />
                                                        <label for="confirm-password">Confirm Password</label>
                                                    </div>
                                                </div>

                                                <input type="hidden" id="type" name="type" value="student">


                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                <button class="btn btn-primary btn-block" type="submit">Register</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="large"><a href="index.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; School Fees Management System</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
