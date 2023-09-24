<?php
$hostName = "localhost";
$dbUser = "id21190842_javascript";
$dbPassword = "Sethukishor@9944750880";
$dbName = "id21190842_javascript";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM userDetails WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Row deleted successfully";
    } else {
        echo "Error deleting row: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
