<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">    
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="info-section">USER INFORMATION</div>

    <div class="form-container">
        <p><strong class="label">Name:</strong> <?php echo $_SESSION['name']; ?></p>
        <p><strong class="label">Email:</strong> <?php echo $_SESSION['email']; ?></p>
        <p><strong class="label">Gender:</strong> <?php echo $_SESSION['gender']; ?></p>
        <p><strong class="label">Phone Number:</strong> <?php echo $_SESSION['phone_number']; ?></p>
        <p><strong class="label">Facebook URL:</strong> <?php echo $_SESSION['facebook']; ?></a></p>
        <p><strong class="label">Country:</strong> <?php echo $_SESSION['country']; ?></p>
        <p>
        <strong class="label">Skills:</strong>
        <ul>
            <?php 
            if(isset($_SESSION['skills'])){
                foreach ($_SESSION['skills']as $skill) {
                    echo "<li>" . $skill . "</li>";
                }
            }
            ?>
        </ul>
        </p>
        <p><strong class="label">Biography:</strong> <br><?php echo $_SESSION['biography']; ?></p>
        
        <form action="logout.php" method="post">
            <input type="submit" value="Logout" name="logout" id="logout">
        </form>
    </div>
</body>
</html>