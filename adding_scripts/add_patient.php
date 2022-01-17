<?php
include '../creds.php';

if (isset($_POST['name']) && isset($_POST['sex']) && isset($_POST['date_of_birth']) && isset($_POST['home_address'])) {
    $name = $_POST['name'];
    $sex = $_POST['sex'];
    $date_of_birth = $_POST['date_of_birth'];
    $home_address = $_POST['home_address'];

    $sql = "INSERT INTO Patient (name, sex, date_of_birth, home_address) VALUES (?, ?, ?, ?)";
    $insert = $db->prepare($sql);
    $insert->execute(array($name, $sex, $date_of_birth, $home_address));
}
$referer = $_SERVER['HTTP_REFERER'];
header("Location: $referer");
