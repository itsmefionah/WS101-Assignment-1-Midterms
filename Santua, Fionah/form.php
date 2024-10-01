<!-- PHP -->
<?php 
session_start();


$nameError = "";
$emailError = "";
$passwordError = "";
$confirm_passwordError = "";
$genderError = "";
$countryError = "";
$skillError = "";
$biographyError = "";
$facebookError = "";
$phone_numberError = "";


$validName = "";
$validEmail = "";
$validBiography = "";
$validFacebook = "";
$validPhone_number = "";
$isFormValid = true;

function sanitize($input) {
    $input = htmlspecialchars($input);
    $input = stripslashes($input);
    $input = trim($input);
    return $input;
}

if (isset($_POST['submit'])) {

    // Validate Name
    $name = sanitize($_POST['name']);
    $namePattern = "/^[A-Za-z\s]+$/";
    if (!empty($name) && preg_match($namePattern, $name)) {
        $_SESSION['name'] = $name;
        $validName = $name;
    } else {
        $isFormValid = false;
        $nameError = "Please enter a valid name!";
    }

    // Validate Email
    $email = sanitize($_POST['email']);
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email'] = $email;
        $validEmail = $email;
    } else {
        $isFormValid = false;
        $emailError = "Please enter a valid email address!";
    }

    // Validate Password
    $password = sanitize($_POST['password']);
    $passwordPattern = "/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]+$/";
    if (!empty($password) && strlen($password) >= 8 && preg_match($passwordPattern, $password)) {
        $_SESSION['password'] = $password;
    } else {
        $isFormValid = false;
        $passwordError = "Password must be at least 8 characters and 1 uppercase letter.";
    }

    // Validate Confirm Password
    $confirmPassword = sanitize($_POST['confirm-password']);
    if ($password === $confirmPassword) {
        $_SESSION['confirm-password'] = $confirmPassword;
    } else {
        $isFormValid = false;
        $confirm_passwordError = "Passwords do not match!";
    }

    // Validate Gender
    if (isset($_POST['gender'])) {
        $_SESSION['gender'] = $_POST['gender'];
    } else {
        $isFormValid = false;
        $genderError = "Please select a gender!";
    }

    // Validate Facebook URL
    $facebook = sanitize($_POST['facebook']);
    $facebookPattern = "/^(https?:\/\/)?(www\.)?facebook\.com\/[A-Za-z0-9\.]+\/?$/";
    if (!empty($facebook) && preg_match($facebookPattern, $facebook)) {
        $_SESSION['facebook'] = $facebook;
        $validFacebook = $facebook;
    } else {
        $isFormValid = false;
        $facebookError = "Please provide a valid Facebook URL!";
    }

    // Validate Phone Number
    $phone_number = sanitize($_POST['phone_number']);
    if (!empty($phone_number) && is_numeric($phone_number)) {
        $_SESSION['phone_number'] = $phone_number;
        $validPhone_number = $phone_number;
    } else {
        $isFormValid = false;
        $phone_numberError = "Phone number must be numeric!";
    }

    // Validate Country
    if (!empty($_POST['country'])) {
        $_SESSION['country'] = $_POST['country'];
    } else {
        $isFormValid = false;
        $countryError = "Please select a country!";
    }

    // Validate Skills
    if (isset($_POST['skills'])) {
        $_SESSION['skills'] = $_POST['skills'];
    } else {
        $isFormValid = false;
        $skillError = "Select at least one skill!";
    }

    // Validate Biography
    $biography = sanitize($_POST['biography']);
    if (!empty($biography) && strlen($biography) <= 200) {
        $_SESSION['biography'] = $biography;
        $validBiography = $biography;
    } else {
        $isFormValid = false;
        $biographyError = "Must be 1-200 characters!";
    }

    if ($isFormValid) {
        header("Location: about.php");
        exit();
    }
}
?>



<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">    
    <link rel="stylesheet" href="style1.css">
    <title>Registration Form</title>
    <style>
        .error {
            color: red;
            font-size: 12px; 
        }
    </style>
</head>
<body>
    <div class="info-section">REGISTRATION FORM</div>

    <div class="form-container">
        <form action="" method="post" class="form-information">
            <!-- Name -->
            <label for="name">Name:</label> <span class="error"><?php echo $nameError; ?></span>
            <input type="text" id="name" name="name" value="<?php $validName ?>">
            
            <!-- Email -->
            <label for="email">Email:</label> <span class="error"><?php echo $emailError; ?></span>
            <input type="email" id="email" name="email" value="<?php $validEmail?>">

            <!-- Password -->
            <label for="password">Password:</label> <span class="error"><?php echo $passwordError; ?></span>
            <input type="password" id="password" name="password">

            <!-- Confirm Password -->
            <label for="confirm-password">Confirm Password:</label> <span class="error"><?php echo $confirm_passwordError; ?></span>
            <input type="password" id="confirm-password" name="confirm-password">
            
            <!-- Gender -->
            <div class="gender-group">
                <label>Gender:</label> <span class="error"><?php echo $genderError; ?></span>
                <div class="gender-options">
                    <input type="radio" id="male" name="gender" value="Male">
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="Female">
                    <label for="female">Female</label>
                </div>
            </div>

            <!-- Phone Number and Facebook URL -->
            <div class="contact_group">
                <!-- Phone Number -->
                <div class="phone_number">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" value="<?php $validPhone_number ?>">
                    <span class="error"><?php echo $phone_numberError; ?></span>
                </div>

                <!-- Facebook URL -->
                <div class="facebook">
                    <label for="facebook">Facebook URL:</label>
                    <input type="text" id="facebook" name="facebook" value="<?php $validFacebook ?>">
                    <span class="error"><?php echo $facebookError; ?></span>
                </div>
            </div>

            <!-- Country -->
            <label for="country">Country:</label> <span class="error"><?php echo $countryError; ?></span>
            <select id="country" name="country">
                <option value="" disabled selected>Select Country</option>
                <option>USA</option>
                <option>Canada</option>
                <option>UK</option>
                <option>Australia</option>
            </select>
            

            <!-- Skills -->
            <label>Skills:</label> <span class="error"><?php echo $skillError; ?></span>
            <div class="skills">
                <input type="checkbox" id="html" name="skills[]" value="HTML">
                <label for="html">HTML</label>
                <input type="checkbox" id="css" name="skills[]" value="CSS">
                <label for="css">CSS</label>
                <input type="checkbox" id="js" name="skills[]" value="JavaScript">
                <label for="js">JavaScript</label>
                <input type="checkbox" id="php" name="skills[]" value="Php">
                <label for="php">Php</label>
                <br>
                
            </div>

            <!-- Biography -->
            <label for="biography">Biography:</label> <span class="error"><?php echo $biographyError; ?></span>
            <textarea id="biography" name="biography" placeholder="Tell us about yourself..."><?php $validBiography ?></textarea>
            
            <!-- Submit Button -->
            <input type="submit" value="Register" name="submit" id="submit">
        </form>
    </div>
</body>
</html>

