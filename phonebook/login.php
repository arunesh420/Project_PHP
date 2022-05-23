<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['name']))
{
    header("location: welcome.Php");
    exit;
}
require_once "config.php";
$name = $password = "";
$err = "";
// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if(empty(trim($_POST['name'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter name and password";
        echo $err;
    }
    else{
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);
    }


    if(empty($err))
    {
        $sql = "SELECT id, name, password FROM users WHERE name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_name);
        $param_name = $_POST['name'];

// Try to execute this statement
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $id, $name, $hashed_password);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password))
                    {
// this means the password is correct. Allow user to login
                        session_start();
                        $_SESSION["name"] = $name;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

//Redirect user to welcome page
                        header("location: welcome.Php");

                    } else {
                        echo"error". mysqli_error($conn);
                    }
                } else{
                    echo "could not fetch stmt";
                }

            } else{
                echo "no data";
            }

        }
    }


}


?>
<?php include "header.php" ?>

<!--<h1>Php Login System</h1>-->
<!--<a href="register.php">Register</a>-->
<!--<a href="login.php">Login</a>-->
<link href="assets/css/signin.css" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-signin">
    <form action="" method="post">
        <img class="mb-4" src="assets/images/telephone.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Your name">
            <label for="floatingInput">Name</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
</main>


<!---->
<!---->
<!--<div class="container mt-4">-->
<!--    <h3>Please Login Here:</h3>-->
<!--    <hr>-->
<!---->
<!--    <form action="login.php" method="post">-->
<!--        <label for="name">name:</label>-->
<!--        <input type="text" name="name" id="email" placeholder="Enter name">-->
<!--        <label for="password">Password:</label>-->
<!--        <input type="password" name="password" id="password" placeholder="Enter Password">-->
<!--        <button type="submit" >Submit</button>-->
<!--    </form>-->
<!---->
<!--</div>-->
</body>
</html>