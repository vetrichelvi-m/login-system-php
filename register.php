<?php
require_once 'dbcon.php'; // Include your database connection file
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate input
    $errors = [];
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $status= $_POST['status'];

    // print_r($status);exit();
    // Check if passwords match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // Check if username is already taken
    $sql = "SELECT * FROM users WHERE user_name = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors[] = "Username is already taken";
    }

    // If no validation errors, insert data into database
    if (empty($errors)) {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $created_date = date('Y-m-d H:i:s');
        $created_by = 1;
        // Insert user into database
        $sql = "INSERT INTO users (user_name, password,status,created_by,created_date) VALUES ('$username', '$hashed_password','$status','$created_by','$created_date')";
        if (mysqli_query($conn, $sql)) {
            echo "User registered successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-DodgerBlue">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="myForm">

                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user" id="userid" placeholder="User Name" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="confirm_password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="status" id="status" class="form-control form-control-user">
                                        <option value="0">hello</option>
                                        <option value="1">haii</option>
                                     
                                    </select>
                                    <!-- <input type="text" name="username" class="form-control form-control-user" id="userid" placeholder="User Name" required> -->
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block">

                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        //   $(document).ready(function() {
        //     $('#myForm').validate({
        //       rules: {
        //         username: {
        //           required: true,
        //           minlength: 5
        //         },
        //         password: {
        //           required: true,
        //           minlength: 6
        //         }
        //       },
        //       messages: {
        //         username: {
        //           required: "Please enter a username",
        //           minlength: "Your username must consist of at least 5 characters"
        //         },
        //         password: {
        //           required: "Please provide a password",
        //           minlength: "Your password must be at least 6 characters long"
        //         }
        //       }
        //     });
        //   });
    </script>


</body>

</html>