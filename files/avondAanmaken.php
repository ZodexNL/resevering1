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
<h1>Nieuwe ouderavond aanmaken</h1>
<h2></h2>
<form method="post" name="forum">
    <label for="datum">Datum:</label>
    <input type="datetime-local" name="datumTijd"><br/><br/>

    <label for="aantal">Aantal</label>
    <input type="number" name="aantal">


<!--    --><?php
//    for($q = 0; $q < 10; $q++){
//
//        echo "<label> tijd van </label>";
//        echo "<input type='time' name='tijdVan[]'>";
//        echo "<label> tot </label>";
//        echo "<input type='time' name='tijdTot[]'><br/>";
//
//    }
//    ?>
    <br/>
    <input type="submit" name="submitForm" value="Verstuur">
</form>

<?php

if(isset($_POST["submitForm"])){

   // include 'php/database/database.php';
    $aantalAfspraken = $_POST['aantal'];
    $tijdVan1 = $_POST['datumTijd'];


    $tijdBerekend = strtotime($tijdVan1);

    $tijd = array();

    $array = array();

    for($i = 0; $i < $aantalAfspraken; $i++){

        array_push($tijd, $i);

        for($b = 0; $b < $tijd; $b++){
            $tijd[$b] =
        }

        $nieuwetijd = $tijdBerekend + 900;



        array_push($array, $nieuwetijd);

        //echo $array[$i];

        echo date('H:i', $array[$i]);
    }




    /*for($i = 0; $i < 10; $i++){
        $datum = $_POST['datum'];
        $tijdVan = $_POST['tijdVan'][$i];
        $tijdTot = $_POST['tijdTot'][$i];

        $query = ("INSERT INTO tijden (id, van, tot, bezet, dag)
        VALUES (0, '$tijdVan', '$tijdTot', 1, '$datum')");
        $sth = $conn->prepare($query);
        $sth->execute();
    }*/
}
?>

</body>
</html>



<?php
    }

}

?>