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
        <input type="submit" name="login" placeholder="Submit" value="Login">
    </form>

</body>
</html>

<?php

if(isset($_POST['login'])){
    include ("database.php");


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

                echo "<script>window.location = 'tussen.php'</script>";

            }else {
                echo "het gaat niet goed";
            }
        }
    }catch (Exception $er){
        echo $er->getMessage();
    }


}

?>

