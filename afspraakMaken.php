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

</head>

<body>
<h1>Een afspraak maken</h1>
<h2>Beschikbare afspraken:</h2>
<?php
include 'database.php';

$query = ("SELECT * FROM tijden where bezet = '1'");

$stm = $conn->prepare($query);
$stm->execute();
$tijden = $stm->setFetchMode(PDO::FETCH_OBJ);



// dit gebeurt hier
foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $tijden) {
    echo "Afspraaknummer: $tijden->id <br/>";
    echo "Van: $tijden->van Tot: $tijden->tot<br/>";
    echo "Datum: $tijden->dag <br/><br/>";
}


?>
<form method='post'>


<label>Kies hier uw afspraaknummer</label>
<select name='afspraak'>
    <?php

        include 'database.php';

        $query = ("SELECT * FROM tijden where bezet = '1'");

        $stm = $conn->prepare($query);
        $stm->execute();
        $tijden2 = $stm->setFetchMode(PDO::FETCH_OBJ);

        foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $tijden2){
            echo "<option value='$tijden2->id'>$tijden2->id</option>";
        }
        var_dump($tijden2->id);


?>

</select>
</form>


</body>

</html>

<?php

    }
}
    ?>
