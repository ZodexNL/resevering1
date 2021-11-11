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

<form method="post">
    <label for="datum">Datum:</label>
    <input type="date" name="datum">

    <label>van </label>
    <input type="time" name="tijd1Van">
    <label> tot </label>
    <input type="time" name="tijd1Tot">

        <select id="hoeveelheid" name="hoeveelheid" onchange="<?php bepaal();?>">
            <option value="1"></option>
            <option value="2"></option>
            <option value="3"></option>
            <option value="4"></option>
            <option value="5"></option>
            <option value="6"></option>
            <option value="7"></option>
            <option value="8"></option>
            <option value="9"></option>
            <option value="10"></option>

        </select>

    <?php
    function bepaal(){
        $hoeveelheid = $_POST["hoeveelheid"];


        for($i = 0; $i < $hoeveelheid; $i++){
            echo "<label> van </label> <input type='time' name='van$i'><label> tot </label> <input type='time' name='tot$i'>";
        }
    }


    ?>



</form>

</body>
</html>



<?php
    }

}

?>
