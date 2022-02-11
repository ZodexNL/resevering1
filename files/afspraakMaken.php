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
   <link rel="stylesheet" type="text/css" href="../css/afspraakMaken.css">
</head>

<body>

<div class="topnav">
    <a id="logo" class="logo" href="ouder.php"><img src="../media/GLRlogo_RGB.jpg" height="50" width="50"></a>
    <a class="active"><p>Welkom <?php echo $_SESSION["naam"] ?></p></a>
    <a href="afspraakMaken.php"><p>Afspraak Maken</p></a>
    <a href=""><p>Contact</p></a>
    <form method="post" id="uitloggenForm">
        <input type="submit" name="uitloggen" placeholder="uitloggen" value="Uitloggen" id="uitloggenBtn" class="uitloggen">
    </form>
</div>


<h1 class="afspraakH1">Een afspraak maken</h1>
<h2 class="afspraakH2">Beschikbare afspraken:</h2>
<?php
include 'php/database/database.php';

$query = ("SELECT * FROM tijden where bezet = '1'");

$stm = $conn->prepare($query);
$stm->execute();
$tijden = $stm->setFetchMode(PDO::FETCH_OBJ);



// dit gebeurt hier
foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $tijden) {
    echo "<div class='afspraakVak'>";
    echo "Afspraaknummer: $tijden->id <br/>";
    echo "Van: $tijden->van Tot: $tijden->tot<br/>";
    echo "Datum: $tijden->dag <br/><br/>";
    echo "</div>";
}


?>
<form method='post'>


<label class="labelAfspraak">Kies hier uw afspraaknummer</label>
<select name='afspraak'>
    <?php

        include 'php/database/database.php';

        $query = ("SELECT * FROM tijden where bezet = '1'");

        $stm = $conn->prepare($query);
        $stm->execute();
        $tijden2 = $stm->setFetchMode(PDO::FETCH_OBJ);

        foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $tijden2){
            echo "<option value='$tijden2->id'>$tijden2->id</option>";
        }

?>
</select>

<br>
    <input class="Boek" type="submit" name="boek" value="Reseveer">




<?php
include 'php/database/database.php';
try{
    if(isset($_POST['boek'])){
        $gekozenID = $_POST['afspraak'];
        $naam = $_SESSION["naam"];

        $fetchQuery = ("SELECT * FROM tijden where id = '$gekozenID'");
        $stm = $conn->prepare($fetchQuery);
        $stm->execute();
        $fetch = $stm->setFetchMode(PDO::FETCH_OBJ);

        foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $fetch){
            $tijdVan = $fetch->van;
            $tijdTot = $fetch->tot;
            $bezet = $fetch->bezet;
            $dag = $fetch->dag;
        }

        $query1 = ("INSERT INTO reseveringen (id, user_naam, tijden_van, tijden_tot, tijden_dag) 
VALUES ('$gekozenID', '$naam', '$fetch->van', '$fetch->tot', '$fetch->dag')");
        $sth = $conn->prepare($query1);
        $sth->execute();

        $query2 = ("UPDATE tijden SET bezet = 0 WHERE id = '$gekozenID' ");
        $stmt = $conn->prepare($query2);
        $stmt->execute();
    }
}catch (Exception $er){
    echo $er->getMessage();
}


?>
</form>

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
