<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>

<?php
session_start();
$user = $_SESSION['user'];
$name = $_POST['name'];

$dirname = "./{$user}/{$name}";
mkdir($dirname, 0777, true);

header('Location: showDirectory.php');
exit();

?>

</BODY>
</HTML>