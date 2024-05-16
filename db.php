<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UniversityDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    error_log("Lidhja dështoi: " . $conn->connect_error);
    die("Gabim në lidhje. Ju lutemi provoni përsëri më vonë.");
}
?>
