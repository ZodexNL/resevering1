<?php
session_start();
if($_SESSION["ingelogd"] == false){
    echo "<script>window.alert('Je moet eerst inloggen!')</script>";
    echo "<script>window.location = 'inlog.php'</script>";
}else{
    echo "Welkom " . $_SESSION["naam"];
    ?>
    <html>
<head>
    <title>Test</title>
    <form method="post">
        <input type="submit" name="uitloggen" placeholder="uitloggen" value="Uitloggen">
    </form>

</head>
<body>

</body>
</html>

<?php


if(isset($_POST["uitloggen"])){
    session_unset();
    session_destroy();
    echo "<script>window.alert('Je bent succesvol uitgelogd!')</script>";
    echo "<script>window.location = 'inlog.php'</script>";
}


}

?>
