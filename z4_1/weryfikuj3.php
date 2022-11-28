<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php

$user = htmlentities ($_POST['user'], ENT_QUOTES, "UTF-8");
$pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8");


$link = mysqli_connect("sql109.epizy.com", "epiz_32751615", "Wfi03PMIssbVRyB", "epiz_32751615_zadanie4_database");

if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }

mysqli_query($link, "SET NAMES 'utf8'");
$result = mysqli_query($link, "SELECT * FROM users WHERE username='$user'");
$rekord = mysqli_fetch_array($result);

if(!$rekord)
{
        mysqli_close($link);
        session_start();

        if(!isset($_SESSION["login_attempts"])) {
            $_SESSION["login_attempts"] = 0;
        }

        $_SESSION["login_attempts"] +=1;
        header('Location: index3.php');
        exit();
}
else
{
    if($rekord['password']==$pass)
    {
        echo "Logowanie Ok. User: {$rekord['username']}. Hasło: {$rekord['password']}";

        session_start();
        $_SESSION ['loggedin'] = true;
        $_SESSION ['user'] = $user;
        header('Location: index4.php');
        exit();
    }
    else
    {
        mysqli_close($link);
        header('Location: index3.php');
        exit();

    }
}
?>
</BODY>
</HTML>