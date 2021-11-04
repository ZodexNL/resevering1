<?php
session_start();

if($_SESSION["ingelogd"] == false){
    echo "<script>window.alert('Je moet eerst inloggen!')</script>";
    echo "<script>window.location = 'inlog.php'</script>";
}else{
    if($_SESSION["rechten"] == "docent"){
        echo "<script>window.location = 'docent.php'</script>";
    }elseif ($_SESSION["rechten"] == "ouder"){
        echo "<script>window.location = 'ouder.php'</script>";
    }else{
        echo "<script>window.location = 'login.php'</script>";
    }

}





