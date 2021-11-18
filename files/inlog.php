<!DOCTYPE html>
<html>
<head>
    <title>Inlog pagina</title>
    <link rel="stylesheet" type="text/css" href="../css/inlog.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div class="vak">
    <h1 style="font-family: schoolFontDik;">INLOGGEN</h1>
    <form method="post" class="velden">
        <input type="text" id="naam" name="naam" placeholder="voer hier uw gebruikersnaam in...">
        <br>
        <input type="password" id="wachtwoord" name="password" placeholder="voer hier uw wachtwoord in...">
        <input type="submit" name="login" placeholder="Submit" value="Login" class="Submit">
    </form>
</div>

</body>
</html>

<?php

if(isset($_POST['login'])){
    include("php/database/database.php");


    $name = $_POST['naam'];
    $pass = $_POST['password'];


    $sth = $conn->prepare("SELECT * FROM users");
    $sth->execute();
    $info = $sth->setFetchMode(PDO::FETCH_OBJ);



    try{
        foreach ($sth->fetchAll(PDO::FETCH_OBJ) as $info){

            if ($name == $info->naam && $pass == $info->wachtwoord){
                session_start();
                $_SESSION["naam"] = $name;
                $_SESSION["ingelogd"] = true;
                $_SESSION["rechten"] = $info->rechten;
                echo "Succesvol ingelogd";

                echo "<script>window.location = '../files/tussen.php'</script>";

            }else {
                echo "het gaat niet goed";
            }
        }
    }catch (Exception $er){
        echo $er->getMessage();
    }


}

?>

