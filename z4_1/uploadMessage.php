<!DOCTYPE html>
<html>
<body>

<?php
session_start();
$target_dir = $_SESSION['user'];
$recipient = $_POST['recipient'];
$post = $_POST['post'];

$target_file = $target_dir . "/". basename($_FILES["fileToUpload"]["name"]);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
{ echo htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " uploaded."; }
else { echo "Error uploading file."; }

$connection = mysqli_connect("sql109.epizy.com", "epiz_32751615", "Wfi03PMIssbVRyB", "epiz_32751615_zadanie3_database");
$random = rand();

if (!$connection)
{
echo " MySQL Connection error." . PHP_EOL;
echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
echo "Error: " . mysqli_connect_error() . PHP_EOL;
exit;
}

$result = mysqli_query($connection, "INSERT INTO messages (idk, message, user, recipient, attachment) VALUES ('$random', '$post', '$target_dir', '$recipient', '$target_file');") or die ("DB error");
mysqli_close($connection);

header ('Location: form.php');

?>

</body>
</html>