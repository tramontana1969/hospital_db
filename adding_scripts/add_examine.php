<?php
include "../creds.php";

if (
    isset($_POST['diagnosis']) && isset($_POST['patient']) && isset($_POST['date']) &&
    isset($_POST['place']) && isset($_POST['symptoms']) && isset($_POST['medical_prescription']) &&
    isset($_POST['doctors_name'])) {
    $diagnosis = $_POST['diagnosis'];
    $patient = $_POST['patient'];
    $date = $_POST['date'];
    $place = $_POST['place'];
    $symptoms = $_POST['symptoms'];
    $medical_prescription = $_POST['medical_prescription'];
    $doctors_name = $_POST['doctors_name'];

    $sql = "INSERT INTO Examine (
                     diagnosis, patient, date, place, 
                     symptoms, medical_prescription, doctors_name
                     ) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $insert = $db->prepare($sql);
    $insert->execute(array($diagnosis, $patient, $date, $place, $symptoms, $medical_prescription, $doctors_name));
}
$referer = $_SERVER['HTTP_REFERER'];
header("Location: $referer");