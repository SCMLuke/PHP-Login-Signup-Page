<?php
    // This code is for validating if the information entered is correct or not.
    $valid = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {    // If statement to check if the login button was clicked.

        $mysqli = require  __DIR__ . "/database.php"; // Require connection to database.

        $sql = sprintf("SELECT * FROM user WHERE email = '%s'",
                               $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($sql);
        $user = $result->fetch_assoc();

        if ($user) {
           if (password_verify($_POST["password"], $user["password_hash"])) {   // Check if password information matches.
               session_start();     // Starts a session to store user data for the time.
               session_regenerate_id();     // Protection against a session fixation attack.
               $_SESSION["user_id"] = $user["id"];
               header("Location: index.php");   // Redirect to the index / main page.
               exit;
           }
        }
        $valid = true;
    }
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

<h1>Login</h1>

<!--Calling the valid variable above to check if to show text saying invalid variable.-->
<?php if ($valid): ?>
<em>Invalid Login</em>
<?php endif; ?>

<form method ="post">
    <label for="email">email</label>
    <input type="email" name="email" id="email">

    <label for="password">password</label>
    <input type="password" name="password" id="password">

    <button>Log in</button>
</form>

</body>
</html>