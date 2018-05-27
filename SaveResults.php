<?php
/**
 * Created by PhpStorm.
 * User: diggah
 * Date: 26.05.18
 * Time: 16:56
 */

$userName = $_POST['UserName'];
$userEmail = $_POST['UserEmail'];
$userComment = $_POST['UserComment'];

if ($userName != "" && $userEmail != "" && $userComment != "")
{
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email.";
        exit;
    }

    if (strlen($userName) > 32) {
        echo "Sorry, but your name is very long.";
        exit;
    }

    if (strlen($userEmail) > 64) {
        echo "Sorry, but your email is very long.";
        exit;
    }

    $link = mysqli_connect("localhost", "root", "password", "test_db", "3306");

    if (!$link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    $query = "INSERT INTO DBUserCredentials (user_name, user_email, user_comment) VALUES ('$userName', '$userEmail', '$userComment')";
    $result = mysqli_query($link, $query);

    if ($result)
    {
        echo "Data  was saved successfully! Check section below!";
    }
    else
    {
        echo "Strange error on server side. We will repair it as soon as possible.";
    }

    mysqli_free_result($result);
    mysqli_close($link);
} else {
    echo "Please fill all of the required fields!";
}