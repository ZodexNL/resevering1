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