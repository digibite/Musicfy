<?php
include("./includes/config.php");
include("./includes/classes/Account.php");
include("./includes/classes/Constants.php");

$account = new Account($conn);

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

    <link rel="stylesheet" type="text/css" href="./assets/css/register.css">
    <script src="./assets/js/jQuery3_7_1.js"></script>
    <script src="./assets/js/register.js"></script>
</head>

<body>
    <?php
    if (isset($_POST["registerButton"])) {
        echo '<script>
                $(document).ready(function () {
                    $("#loginForm").hide();
                    $("#registerForm").show();
                });
            </script>';
    } else {
        echo '<script>
                $(document).ready(function () {
                    $("#loginForm").show();
                    $("#registerForm").hide();
                });
            </script>';
    }
    ?>
    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form id="loginForm" action="register.php" method="POST">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed); ?>
                        <label for="loginUsername">Username</label>
                        <input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. Bart Simpson"
                            required>
                    </p>

                    <p>
                        <label for="loginPassword">Password</label>
                        <input id="loginPassword" name="loginPassword" type="password" required>
                    </p>
                    <button type="submit" name="loginButton">LOG IN</button>
                    <div class="hasAccountText">
                        <span id="hideLogin">Don't have an account yet? Signup here.</span>
                    </div>
                </form>

                <form id="registerForm" action="register.php" method="POST">
                    <h2>Create your free account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$usernameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>
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
                        <?php echo $account->getError(Constants::$emailTaken); ?>
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
                        <input id="password" name="password" type="password"
                            value="<?php getInputValue($_POST['password']); ?>" required>
                    </p>
                    <p>
                        <label for="password2">Password</label>
                        <input id="password2" name="password2" type="password"
                            value="<?php getInputValue($_POST['password2']); ?>" required>
                    </p>
                    <button type="submit" name="registerButton">SIGN UP</button>

                    <div class="hasAccountText">
                        <span id="hideRegister">Already have an account? Log in here.</span>
                    </div>

                </form>
            </div>

            <div id="loginText">
                <h1>Get great music, right now</h1>
                <h2>Listen to loads of songs for free</h2>
                <ul>
                    <li>Discover music you'll fall in love with</li>
                    <li>Create your own playlist</li>
                    <li>Follow artist to keep up to date</li>
                </ul>
            </div>
        </div>

    </div>

</body>

</html>