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

</head>
<body>
<form method="post">
<div class="welkomBericht">
    <?php
    include 'database.php';

    $stm = $conn->prepare("SELECT * FROM informatie where id = '1'");
    $stm->execute();
    $data = $stm->setFetchMode(PDO::FETCH_OBJ);



    foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $data){
        echo "<textarea rows='6' cols='50' name='welkom'>$data->welkom</textarea>";
    }
    ?>
</div>
    <input type="submit" name="update">
</form>
</body>
</html>

<?php
if(isset($_POST["update"])){
    include 'database.php';
    $nieuweInfo = $_POST["welkom"];

    $query = ("UPDATE informatie SET welkom = '$nieuweInfo' WHERE id = 1");
    $sth = $conn->prepare($query);
    $sth->execute();

    echo "<script>window.location = 'docent.php'</script>";
}
?>

<?php

    }
}
        ?>
