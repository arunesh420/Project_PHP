<?php
// Include config file
require_once "config.php";

//Define variables and initialize with empty values
//$first_name = $last_name = $email = "";
//$first_name_err = $last_name_err = $email_err = "";
// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
// Get hidden input value
    $id = $_POST["id"];
    $temp_name = $_FILES['image']['tmp_name'];
    $filename = $_FILES['image']['name'];
    $folder = "upload/" . $filename;



        // Prepare an update statement
        if ($filename == "") {
            $sql = "UPDATE contacts SET name=?, address=?, email=?, contact= ? WHERE id=?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_address, $param_email, $param_contact,  $param_id);

                // Set parameters
                $param_name = $_POST['name'];
                echo $_POST['name'];
                echo $_POST['address'];
                $param_address = $_POST['address'];
                $param_email = $_POST['email'] ;
                $param_contact = $_POST['contact'] ;
                $param_id = $id;
            }
        } else {
            $sql = "UPDATE contacts SET name=?, address=?, email=?, contact= ? , image=? WHERE id=?";
            if ($stmt = mysqli_prepare($conn, $sql)) {

                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sssssi", $param_name, $param_address, $param_email, $param_contact, $filename,  $param_id);
                // Set parameters
                $param_name = $_POST['name'];
                $param_address = $_POST['address'];
                $param_email = $_POST['email'] ;
                $param_contact = $_POST['contact'] ;
                $filename = $_FILES['image']['name'];
                $param_id = $id;
                echo $_POST['name'];
                echo $_POST['address'];
            }
        }
        if (move_uploaded_file($temp_name, $folder)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {

            // Records updated successfully. Redirect to landing page
            header("location: retrieve.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }



// Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);
        // Prepare a select statement
        $sql = "SELECT * FROM contacts WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result);

                    // Retrieve individual field value
                    $name = $row["name"];
                    $address = $row["address"];
                    $email = $row["email"];
                    $contact = $row['contact'];
                    $image = $row["image"];

                } else {

                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conn);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<?php include "header.php"?>
<br><br>
<div class="container">
    <h1>Edit page</h1>
    <form method="post" action="" enctype="multipart/form-data">
      Name  <input type="text" class="form-control" name="name" value="<?php echo $name; ?>"<br><br>
       Contact  <input type="text" class="form-control" name="contact" value="<?php echo $contact; ?>"<br><br>
  Address      <input type="text" class="form-control" name="address" value="<?php echo $address; ?>"<br><br>
        email <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" <br><br>
        <img src="upload/<?php echo $image; ?>" width="140" height="140" alt="">
        <input type="file" class="form-control" name="image"><br><br><?php echo $image; ?><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="submit" class="btn btn-primary" value="Update">
    </form>
</div>
</body>
</html>