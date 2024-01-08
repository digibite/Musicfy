<?php
include("./includes/classes/Account.php");
include("./includes/classes/Constants.php");

$account = new Account();

include("./includes/handlers/register-handler.php");
include("./includes/handlers/login-handler.php");

// $_POST["username"] = $_POST["username"] ?? null;
function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
        // echo $_POST;
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Worshipfy</title>

    <style>
        /* body {
            background-color: #31343f;
        } */
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
                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <label for="username">Username</label>
                <input id="username" name="username" type="text" placeholder="e.g. davidSalomon"
                    value="<?php getInputValue($_POST['username']); ?>" required>
            </p>
            <p>
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <label for="firstName">First Name</label>
                <input id="firstName" name="firstName" type="text" placeholder="e.g. David"
                    value="<?php getInputValue($_POST['firstName']); ?>" required>
            </p>
            <p>
                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <label for="lastName">Last Name</label>
                <input id="lastName" name="lastName" type="text" placeholder="e.g. Salomon"
                    value="<?php getInputValue($_POST['lastName']); ?>" required>
            </p>
            <p>
                <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="e.g. david@gmail.com"
                    value="<?php getInputValue($_POST['email']); ?>" required>
            </p>
            <p>
                <label for="email2">Confirm email</label>
                <input id="email2" name="email2" type="email" placeholder="e.g. david@gmail.com"
                    value="<?php getInputValue($_POST['email2']); ?>" required>
            </p>
            <p>
                <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                <?php echo $account->getError(Constants::$passwordsCharacters); ?>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" value="<?php getInputValue($_POST['password']); ?>"
                    required>
            </p>
            <p>
                <label for="password2">Password</label>
                <input id="password2" name="password2" type="password"
                    value="<?php getInputValue($_POST['password2']); ?>" required>
            </p>
            <button type="submit" name="registerButton">SIGN UP</button>
        </form>
    </div>

</body>

</html>