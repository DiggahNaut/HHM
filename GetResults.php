<?php
/**
 * Created by PhpStorm.
 * User: diggah
 * Date: 26.05.18
 * Time: 17:13
 */

$link = mysqli_connect("localhost", "root", "password", "test_db", "3306");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$query = "SELECT * FROM DBUserCredentials";
$result = mysqli_query($link, $query);

$data = [];
$temp = [];

while ($row = mysqli_fetch_row($result)) {
    $temp["username"] = $row[1];
    $temp["useremail"] = $row[2];
    $temp["usercomment"] = $row[3];
    $data[] = $temp;
}

mysqli_free_result($result);
mysqli_close($link);

echo json_encode($data, JSON_NUMERIC_CHECK);

