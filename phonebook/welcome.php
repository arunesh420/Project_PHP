 <?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.Php");
}
?>
 <?php include "head.php." ?>
 <div class="px-4 py-5 my-5 text-center">
     <img class="d-block mx-auto mb-4" src="assets/images/telephone.svg" alt="" width="72" height="57">
     <h1 class="display-5 fw-bold">Phonebook</h1>
     <div class="col-lg-6 mx-auto">
         <p class="lead mb-4">Welcome. Now you can add or view contacts. With this, make it easier to find contacts.</p>
         <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
             <a href="prepared_form.php">  <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Add</button></a>
             <a href="retrieve.php"> <button type="button" class="btn btn-outline-secondary btn-lg px-4">View</button></a>
             <a href="logout.php"> <button type="button" class="btn btn-outline-secondary btn-lg px-4">Logout</button></a>
         </div>
         </div>
     </div>
 </div>


<!-- <html >-->
<!--<head>-->
<!--    <title>PHP login system!- HOME</title><link href="header.php">-->
<!--    -->
<!--</head>-->
<!--<body>-->
<!--<a href="logout.php">Logout</a>-->
<!--<a href = "change_password.php" > Change Password</a>-->
<!---->
<!--<div class="container mt-4">-->
<!--    <h3>--><?php //echo "Welcome " . $_SESSION['name'] ?><!--! You can now use this website</h3>-->
<!--    <h1>Start your phonebook<a href="prepared_form.php">Add</a></h1>-->
<!--    <h1>View your phonebook<a href="retrieve.php">View</a></h1>-->
<!--    <hr>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->