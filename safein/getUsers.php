<?php
$hostName = "localhost";
$dbUser = "id21190842_javascript";
$dbPassword = "Sethukishor@9944750880";
$dbName = "id21190842_javascript";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM userDetails";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td style='padding:17px;'>" . $row["email"] . "</td>";
        echo "<td style='padding:17px;'>" . $row["number"] . "</td>";
        echo "<td><button class='btn btn-danger' onclick='deleteRow(" . $row["id"] . ")'>Delete</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No data available</td></tr>";
}

mysqli_close($conn);
?>
