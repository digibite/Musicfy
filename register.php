<?php

function sanitizeFormPassword($inputText)
{
    $inputText = strip_tags($inputText);
    return $inputText;
}

function sanitizeFormUsername($inputText)
{
    $inputText = strip_tags($inputText);
    $inputText = str_replace(' ', '', $inputText);
    return $inputText;
}

function sanitizeFormString($inputText)
{
    $inputText = strip_tags($inputText);
    $inputText = str_replace(' ', '', $inputText);
    $inputText = ucfirst(strtolower($inputText));
    return $inputText;
}
if (isset($_POST['loginButton'])) {
    //Login button was pressed
    echo "login button was pressed";
}
if (isset($_POST['registerButton'])) {
    //Register button was pressed
    $username = sanitizeFormUsername($_POST['username']);

    $firstName = sanitizeFormString($_POST['firstName']);

    $lastName = sanitizeFormString($_POST['lastName']);

    $email = sanitizeFormString($_POST['email']);

    $email2 = sanitizeFormString($_POST['email2']);

    $password = sanitizeFormPassword($_POST['password']);


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Worshipfy</title>

    <style>
        body {
            background-color: #31343f;
        }
    </style>
</head>

<body>

    <div id="inputContainer">
        <form id="loginForm" action="register.php" method="POST">
            <h2>Login to your account</h2>
            <p>
                <label for="loginUsername">Username</label>
                <input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. Bart Simpson" required>
            </p>

            <p>
                <label for="loginPassword">Password</label>
                <input id="loginPassword" name="loginPassword" type="password" required>
            </p>
            <button type="submit" name="loginButton">LOG IN</button>
        </form>

        <form id="registerForm" action="register.php" method="POST">
            <h2>Create your free account</h2>
            <p>
                <label for="username">Username</label>
                <input id="username" name="username" type="text" placeholder="e.g. davidSalomon" required>
            </p>
            <p>
                <label for="firstName">First Name</label>
                <input id="firstName" name="firstName" type="text" placeholder="e.g. David" required>
            </p>
            <p>
                <label for="lastName">Last Name</label>
                <input id="lastName" name="lastName" type="text" placeholder="e.g. Salomon" required>
            </p>
            <p>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="e.g. david@gmail.com" required>
            </p>
            <p>
                <label for="email2">Confirm email</label>
                <input id="email2" name="email2" type="email" placeholder="e.g. david@gmail.com" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>
            </p>
            <p>
                <label for="password2">Password</label>
                <input id="password2" name="password2" type="password" required>
            </p>
            <button type="submit" name="registerButton">SIGN UP</button>
        </form>
    </div>

</body>

</html>