<!DOCTYPE html>
<html>
<head>
    <title>Inlog pagina</title>
</head>
<body>
    <h1>Inloggen</h1>
    <form method="post">
        <input type="text" id="naam" name="naam">
        <input type="password" id="wachtwoord" name="password">
        <input type="submit" name="submit" placeholder="Submit">
    </form>

</body>
</html>

<?php

if(isset($_POST["submit"])){
    $naam = $_POST["naam"];
    $wachtwoord = $_POST["password"];

    include ("database.php");

    $query = ("SELECT * FROM users WHERE naam = '$naam' AND wachtwoord = '$wachtwoord'");
}
