<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UniversityDB";

// Krijimi i lidhjes
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo lidhjen
if ($conn->connect_error) {
    error_log("Lidhja dështoi: " . $conn->connect_error);
    die("Gabim në lidhje. Ju lutemi provoni përsëri më vonë.");
}
?>
