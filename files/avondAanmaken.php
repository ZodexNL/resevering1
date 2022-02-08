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

   include 'php/database/database.php';
    $aantalAfspraken = $_POST['aantal'];
    $tijdVan1 = $_POST['datumTijd'];


    $tijdBerekend = strtotime($tijdVan1);

    //Een array met de tijden erin
    $tijden = array();

    //Het pushen van de eerste tijd naar de array
    array_push($tijden, $tijdBerekend);


    for($i = 0; $i < $aantalAfspraken; $i++){
        // Het maken van een variable die de laatste uit de array pakt en er een kwartier bij toevoegd
       $nogEenNieuweTijd = $tijden[$i] + 900;
       //Het pushen van de nieuwe tijd
       array_push($tijden, $nogEenNieuweTijd);


        echo date('H:i', $tijden[$i]);
        echo date('Y-m-d', $tijden[$i]);

        $tijd = date('H:i', $tijden[$i]);
        $tijd2 = date('H:i', $tijden[$i + 1]);

        $datum = date('Y-m-d', $tijden[$i]);


        $query = ("INSERT INTO tijden (id, van, tot, bezet, dag)
        VALUES (0, '$tijd', '$tijd2', 1, '$datum')");
        $sth = $conn->prepare($query);
        $sth->execute();

    }




    //for($t = 0; $t < $i; $t++){


    //}
}
?>

</body>
</html>



<?php
    }

}

?>
