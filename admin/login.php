
<?php
$value = 'Teletime';
//setcookie("name", $value, time()+3600);
//header("Location: dashboard.php");
?>


<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_COOKIE["a_name"])){
    header("location: dashboard.php");
    exit;
}


/* Attempt to connect to MySQL database */
$link = mysqli_connect('den1.mysql3.gear.host', 'branet', 'Sonypsp26@', 'branet');

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, name, password FROM admin WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $name, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        $hash = password_hash($hashed_password, PASSWORD_DEFAULT);
                        if(password_verify($password, $hash)){
                            // Password is correct, so start a new session
                            //session_start();

                            // Store data in session variables
                            //$_SESSION["loggedin"] = true;
                            //$_SESSION["id"] = $id;
                            //$_SESSION["username"] = $username;
                            setcookie("a_username", $username, time()+3600);
                            setcookie("a_name", $name, time()+3600);
//header("Location: dashboard.php");

                            // Redirect user to welcome page
                            header("location: dashboard.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Branet</title>
    <link rel="stylesheet" href="../public/css/bootstrap.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="public/js/bootstrap.bundle.js"></script>
    <script src="https://kit.fontawesome.com/4ba6be508b.js" crossorigin="anonymous"></script>
    <script src="../app/app.js"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Muli">
    <style>
        .login-form {
            width: 340px;
            margin: 50px auto;
            font-size: 15px;
        }
        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="login-form">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="text-center mb-3"><img class=" d-none d-md-inline" src="../public/images/logo.png" ></div>
        <div>Admin Login</div>
        <div class="form-group" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>>
            <input type="text" name="username" class="form-control" placeholder="Username" required="required">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
            <input type="password" name="password" class="form-control" placeholder="Password" required="required">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn brand-button btn-block">Log in</button>
        </div>
    </form>
</div>
</body>
</html>
