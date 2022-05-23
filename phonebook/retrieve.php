<?php
require_once "config.php";
$sql = "SELECT * FROM contacts";
$result=mysqli_query($conn,$sql)
?>
<?php include "head.php"?>
    <html>
    <head><title>Retrieve</title><link href="header.php"></head>
    <body>
    <a href="prepared_form.php">Create</a>
    <form action="search.php" method="post">
        <input type="text" name="search_keyword" required>
        <select name="search_field" required>
            <option value="name" selected> Name</option>
            <option value="address">Last Name</option>
            <option value="email">Email</option>
            <option value="contact">Email</option>
        </select>
        <input type="submit" value="Search">
    </form>


    <div class="album py-5 bg-light">

        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

<?php foreach ($result as $row){ ?>
    <div class="card" style="width: 18rem;">
        <img src="upload/<?php echo $row['image']?> " style = "object-fit: cover; object-position: 100% 0;" height="50%" width="50%" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php  echo $row['name']?> </h5>
        </div>
        <ul class="list-group list-group-flush">
             <li class="list-group-item"><img src="assets/images/house.svg" width="20" height="20" alt=""> <?php echo $row['address']?></li>
            <li class="list-group-item"><img src="assets/images/envelope.svg" width="20" height="20" alt=""> <?php echo $row['email']?></li>
            <li class="list-group-item"><img src="assets/images/telephone.svg" width="20" height="20" alt=""> <?php echo $row['contact']?></li>
        </ul>
        <div class="card-body">
            <a href="delete_detail.php?id=<?php echo $row["id"]?>" class="card-link">Delete</a>
            <a href="update.php?id=<?php echo $row["id"]?>" class="card-link">Update</a>
        </div>
    </div>
<?php }?>
</div>
        </div>
        </div>
    </div>

    </body>
    </html>
