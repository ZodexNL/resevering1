<?php
session_start();

if($_SESSION["ingelogd"] == false){
    echo "<script>window.alert('Je moet eerst inloggen!')</script>";
    echo "<script>window.location = 'inlog.php'</script>";
}else{
    if($_SESSION["rechten"] != "docent"){
        echo "<script>window.alert('Je hebt niet voldoende rechten om deze pagina te bekijken.')";
        echo "<script>window.location = 'inlog.php'";
    }else{

        ?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/docent.css">
</head>
<body>

 <div class="topnav">
    <a id="logo" class="logo" href="docent.php"><img src="../media/GLRlogo_RGB.jpg" height="50" width="50"></a>
    <a class="active"><p>Welkom <?php echo $_SESSION["naam"] ?></p></a>
    <a href="afspraakMaken.php"><p>Afspraak Maken</p></a>
    <a href=""><p>Contact</p></a>
    <form method="post" id="uitloggenForm">
        <input type="submit" name="uitloggen" placeholder="uitloggen" value="Uitloggen" id="uitloggenBtn" class="uitloggen">
    </form>
</div>
  
  <h1 class="welkom">Welkom Mentor</h1>

<form method="post">
<div class="welkomBericht">
    <?php
    include 'php/database/database.php';

    $stm = $conn->prepare("SELECT * FROM informatie where id = '1'");
    $stm->execute();
    $data = $stm->setFetchMode(PDO::FETCH_OBJ);



    foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $data){
        echo "<textarea rows='6' cols='50' name='welkom' style='width: 80%'>$data->welkom</textarea>";
    }
    ?>

    <br>

    <input class="send" type="submit" name="update">
</form>

<br>

<button class="verstuur"><a href="avondAanmaken.php" style="text-decoration: none; color: #8fe507;">Maak een open dag aan</a></button>
</div>
</body>
</html>

<?php
if(isset($_POST["update"])){
    include 'php/database/database.php';
    $nieuweInfo = $_POST["welkom"];

    $query = ("UPDATE informatie SET welkom = '$nieuweInfo' WHERE id = 1");
    $sth = $conn->prepare($query);
    $sth->execute();

    echo "<script>window.location = 'docent.php'</script>";
}
?>
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


