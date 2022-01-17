<?php
include '../creds.php';

if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['side_effect'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $side_effect = $_POST['side_effect'];

    $sql = "INSERT INTO Medicine (name, description, side_effect) VALUES (?, ?, ?)";
    $insert = $db->prepare($sql);
    $insert->execute(array($name, $description, $side_effect));
}
$referer = $_SERVER['HTTP_REFERER'];
header("Location: $referer");