<?php

if ($_SERVER["REQUEST_METHOD"] === "P0ST") {

    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT *FROM user
            WHERE email = '%s'", 
            $mysqli->real_escape_string($_POST["email"]));
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            die("Login successful"); 
        }
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>

        <h1> Log In </h1>

        <form method="post">
            <label for ="email">email</label>
            <input type="email" name="email" id="email">

            <label for ="password">Password</label>
            <input type="password" name="password" id="email">

            <button>Log In</button>

        </form>
        </body>
        </html>