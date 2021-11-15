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
    <title>Test</title>


</head>

<header>
    <h1 id="welkomTxt">Welkom <?php echo $_SESSION["naam"] ?></h1>

</header>

<body>


</div>
<form method="post" id="uitloggenForm">
    <input type="submit" name="uitloggen" placeholder="uitloggen" value="Uitloggen" id="uitloggenBtn">
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


<div class="welkomBericht">
    <?php
    include 'database.php';

    $stm = $conn->prepare("SELECT * FROM informatie where id = '1'");
    $stm->execute();
    $data = $stm->setFetchMode(PDO::FETCH_OBJ);



    foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $data){
        echo $data->welkom;
    }
    ?>
</div>

    <button onclick="window.location = 'afspraakMaken.php'">Een afspraak maken</button>


<?php
}
}

?>

