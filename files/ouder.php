<?php
session_start();
if($_SESSION["ingelogd"] == false){
    echo "<script>window.alert('Je moet eerst inloggen!')</script>";
    echo "<script>window.location = 'inlog.php'</script>";
}else{
if($_SESSION["rechten"] == "ouder" || $_SESSION["rechten"] == "docent"){
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Ouder</title>
    <link rel="stylesheet" type="text/css" href="../css/ouder.css">
</head>
<body>
<div class="topnav">
    <a id="logo" class="logo" href="inlog.php"><img src="../media/GLRlogo_RGB.jpg" height="50" width="50"></a>
    <a class="active"><p>Welkom <?php echo $_SESSION["naam"] ?></p></a>
    <a href="afspraakMaken.php"><p>Afspraak Maken</p></a>
    <a href=""><p>Contact</p></a>
    <form method="post" id="uitloggenForm">
        <input type="submit" name="uitloggen" placeholder="uitloggen" value="Uitloggen" id="uitloggenBtn" class="uitloggen">
    </form>
</div>

<div class="content">

    <div class="tekstvak1">
        <h1>BERICHT VAN DE MENTOR</h1>
        <p>
        <?php
        include 'php/database/database.php';

        $stm = $conn->prepare("SELECT * FROM informatie where id = '1'");
        $stm->execute();
        $data = $stm->setFetchMode(PDO::FETCH_OBJ);



        foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $data){
            echo $data->welkom;
        }
        ?></p>

    </div>


    <div class="tekstvak2">
        <h1>HUIDIGE AFSPRAAK</h1>

        <p>
            <?php

            include 'php/database/database.php';

            $naam = $_SESSION["naam"];
            $naam2 = "test";


            $sth = $conn->prepare("SELECT * FROM reseveringen where user_naam = '$naam'");
            $sth->execute();
            $info = $sth->setFetchMode(PDO::FETCH_OBJ);

           if($sth->rowCount() > 0){
               foreach($sth->fetchAll(PDO::FETCH_OBJ) as $info){
                   echo "AfspraakID: $info->id"; echo "<br/>";
                   echo "Uw naam: $info->user_naam"; echo "<br/>";
                   echo "Tijd Van: $info->tijden_van"; echo "<br/>";
                   echo "Tijd Tot: $info->tijden_tot"; echo "<br/>";
                   echo "Datum: $info->tijden_dag"; echo "<br/>";

               }
           }else{
               echo "U heeft nog geen afspraak";
           }




            ?>
        </p>
    </div>

</div>

</body>
</html>

<?php


if(isset($_POST["uitloggen"])){
    session_unset();
    session_destroy();
    echo "<script>window.alert('Je bent succesvol uitgelogd!')</script>";
    echo "<script>window.location = 'inlog.php'</script>";
}


?>


<?php
}
}

?>

