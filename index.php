<?php
session_start();
if($_SESSION["ingelogd"] == false){
    echo "<script>window.alert('Je moet eerst inloggen!')</script>";
    echo "<script>window.location = 'inlog.php'</script>";
}else{
    ?>
    <html>
<head>
    <title>Test</title>
    <form method="post">
        <input type="submit" name="uitloggen" placeholder="uitloggen">
    </form>

</head>
<body>

</body>
</html>

<?php
echo "Welkom " . $_SESSION["naam"];

if(isset($_POST["uitloggen"])){
    session_unset();
    session_destroy();
    echo "<script>window.alert('Je bent succesvol uitgelogd!')</script>";
    echo "<script>window.location = 'inlog.php'</script>";
}


}

?>
