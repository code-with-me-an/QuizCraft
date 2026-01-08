<?php
include("conn.php");
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkEmail = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        $error = 'Email is already registered!';
    } else {
        mysqli_query($conn, "INSERT INTO users(name,email,password) VALUES ('$name','$email','$password')");
        echo "<script>window.alert('Register successfully');
                window.location.href='login.php';
                </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register page</title>
    <link rel="stylesheet" href="style/RegisLogin.css">
</head>

<body>
    <div class="container">
        <div class="form-box">
            <form action="register.php" method="post" onsubmit="return validate()">
                <h2>Register</h2>
                <?php echo "<p class='error-message'>$error</p>"; ?>
                <input type="text" name="name" placeholder="Name" id="name">
                <span id="nameErr"></span>
                <input type="email" name="email" placeholder="Email" id="email">
                <span id="emailErr"></span>
                <input type="password" name="password" placeholder="Password" id="password">
                <span id="passErr"></span>
                <button type="submit">Register</button>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
    <script>
        function validate() {
            let nameErr = document.getElementById('nameErr');
            let emailErr = document.getElementById('emailErr');
            let passErr = document.getElementById('passErr');

            let name = document.getElementById('name').value.trim();
            let email = document.getElementById('email').value.trim();
            let password = document.getElementById('password').value.trim();

            let validateFlag = true;
            nameErr.innerText = '';
            emailErr.innerText = '';
            passErr.innerText = '';

            if (name == '' || name == null) {
                nameErr.innerText = '*name is required';
                validateFlag = false;
            } else {
                for (let i = 0; i < name.length; i++) {
                    let ch = name[i];
                    if (!(ch >= 'A' && ch <= 'Z') && !(ch >= 'a' && ch <= 'z') && ch !== ' ') {
                        validateFlag = false;
                        nameErr.innerText = '*name only contain alphabets';
                    }
                }
                validateFlag = true;
            }

            if (email == '' || email == null) {
                emailErr.innerText = '*email is required'
                validateFlag = false;
            } else {
                validateFlag = true;
            }

            let spacial = "!@#$%^&*()";
            let spacialFlag = false;
            let alphaFlag = false;
            let lenFlag = true;

            if (password == '' || password == null) {
                passErr.innerText = '*password is required'
                validateFlag = false;
            } else {
                if (password.length < 8) {
                    lenFlag = false;
                } else {
                    for (let i = 0; i < password.length; i++) {
                        let ch = password[i];
                        if ((ch >= 'A' && ch <= 'Z')) {
                            alphaFlag = true;
                        } else if (spacial.includes(ch)) {
                            spacialFlag = true;
                        }
                    }
                }
                if (spacialFlag == false || alphaFlag == false || lenFlag == false) {
                    passErr.innerText = '*password must be 8+ char, 1 spacial & 1 Uppercase';
                    validateFlag = false;
                } else {
                    validateFlag = true;
                }
            }

            if (validateFlag == true) {
                return true;
                console.log('ho');
            } else {
                return false;
            }

        }
    </script>
</body>

</html>