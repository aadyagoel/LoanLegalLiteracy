<?php

if(empty($_POST["name"])) {
    die("Name is required"); /* for the event where client side js powered
    validation is bypassed */
}

if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Please make sure the email is valid");
}

if(strlen($_POST["password"]) < 8) {
    die("Password must be atleast 8 characters");
}

if (! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if (! $_POST["password"] == $_POST["password_confirmation"]) {
    die("Passwords do not match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php"; /* connected to database */

$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init(); 

if (! $stmt->prepare($sql) ) {
    die("SQL error :" . $mysqli->error);
}

$stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);

if ($stmt->execute()) {
    header("Location: student-signup-success.html");
    exit; 
}
else {

    if($mysqli->errno === 1062) {
        die("Email already registered"); 
    } else { 
        die($mysqli->error . " " . $mysqli->errno);
    }
} 

/*print_r($_POST);
var_dump($password_hash); */
 
?>