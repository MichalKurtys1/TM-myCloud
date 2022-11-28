<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<?php
session_start();
$subDirectory = $_GET['link'];
$target_dir = $_SESSION['user'];

$dirname = "./{$target_dir}/{$subDirectory}";

if(strpos($subDirectory, ".") !== false){
    if(!unlink($dirname)) {
        echo ("Could not remove ");
    } else {
        header('Location: showDirectory.php');
        exit();
    }
} else {
    if(count(glob("$dirname/*")) === 0) {
        if(!rmdir($dirname)) {
            echo ("Could not remove ");
        } else {
            header('Location: showDirectory.php');
            exit();
        }
    } else {
        $_SESSION['notEmpty'] = true;
        header('Location: showDirectory.php');
        exit();
    }
}
?>

</BODY>
</HTML>