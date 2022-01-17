<?php
include "../creds.php";

if (isset($_POST['way_of_using']) && isset($_POST['medicine_id']) && isset($_POST['examine_id'])) {
    $way_of_using = $_POST['way_of_using'];
    $medicine_id = $_POST['medicine_id'];
    $examine_id = $_POST['examine_id'];

    $sql = "INSERT INTO Prescribed_medications (way_of_using, medicine_id, examine_id) VALUES (?, ?, ?)";
    $insert = $db->prepare($sql);
    $insert->execute(array($way_of_using, $medicine_id, $examine_id));
}
$referer = $_SERVER['HTTP_REFERER'];
header("Location: $referer");