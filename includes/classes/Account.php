<?php
class Account
{
    private $conn;
    private $errorArray;
    public function __construct($conn)
    {
        $this->prepPostArr();
        $this->conn = $conn;
        $this->errorArray = array();
    }

    public function login($un, $pw)
    {
        $pw = md5($pw);
        $sql = "SELECT * FROM users WHERE username='$un' AND password='$pw'";

        $query = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($query) == 1) {
            return true;
        }
        array_push($this->errorArray, Constants::$loginFailed);
        return false;
    }

    public function register($un, $fn, $ln, $em, $em2, $pw, $pw2)
    {
        $this->validateUsername($un);
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pw, $pw2);
        // echo '<pre>';
        // print_r($this->errorArray);
        // echo '</pre>';
        // exit;

        if (empty($this->errorArray)) {
            // insert into db
            echo "Register function is running";
            return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
        } else {
            return false;
        }
    }

    private function insertUserDetails($un, $fn, $ln, $em, $pw)
    {
        $encryptedPw = md5($pw);
        $profilePic = "../../assets/images/profile-pics/head_emerald.png";
        $date = date("Y-m-d");
        $sql = "INSERT INTO users (username, firstName, lastName, email, password, signUpDate, profilePic)
        VALUES ('$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')";

        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    public function getError($error)
    {
        if (!in_array($error, $this->errorArray)) {
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    public function prepPostArr()
    {
        $_POST['username'] = $_POST['username'] ?? null;
        $_POST['firstName'] = $_POST['firstName'] ?? null;
        $_POST['lastName'] = $_POST['lastName'] ?? null;
        $_POST['email'] = $_POST['email'] ?? null;
        $_POST['email2'] = $_POST['email2'] ?? null;
        $_POST['password'] = $_POST['password'] ?? null;
        $_POST['password2'] = $_POST['password2'] ?? null;
    }
    private function validateUsername($un)
    {
        if (strlen($un) > 25 || strlen($un) < 5) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $checkUsernameQuery = mysqli_query($this->conn, "SELECT username FROM users WHERE username='$un'");

        if (mysqli_num_rows($checkUsernameQuery) != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
            return;
        }
    }

    private function validateFirstName($fn)
    {
        if (strlen($fn) > 25 || strlen($fn) < 2) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
            return;
        }

    }

    private function validateLastName($ln)
    {
        if (strlen($ln) > 25 || strlen($ln) < 5) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
            return;
        }
    }
    private function validateEmails($em, $em2)
    {
        if ($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDoNotMatch);
            return;
        }

        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $checkEmailQuery = mysqli_query($this->conn, "SELECT email FROM users WHERE email='$em'");
        if (mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }
    }

    private function validatePasswords($pw, $pw2)
    {
        if ($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);
            return;
        }

        if (preg_match('/[^A-Za-z0-9]/', $pw)) {
            array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
            return;
        }

        if (strlen($pw) > 30 || strlen($pw) < 5) {
            array_push($this->errorArray, Constants::$passwordsCharacters);
            return;
        }
    }
}


?>