<!DOCTYPE html>
<html>
<body>

<?php
session_start();


if(isset($_SESSION['link'])) {
    $target_dir = $_SESSION['user'] . "/" . $_SESSION['link'];
} else {
    $target_dir = $_SESSION['user'];
}

$target_file = $target_dir . "/". basename($_FILES["fileToUpload"]["name"]);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
{ 
    echo htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " uploaded.";
    header('Location: showDirectory.php');
    exit();
}
else { 
    echo "Error uploading file."; 
}
?>

</body>
</html>