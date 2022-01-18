<!DOCTYPE html>
<html>
    <head>
        <title>Edit exam</title>
    </head>
    <body>
    <?php
    include "../creds.php";

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Examine WHERE id = :id";
        $examine = $db->prepare($sql);
        $examine->execute(array(':id'=>$id));
        foreach ($examine as $data) {
            $diagnosis = $data['diagnosis'];
            $patient = $data['patient'];
            $date = $data['date'];
            $place = $data['place'];
            $symptoms = $data['symptoms'];
            $medical_prescription = $data['medical_prescription'];
            $doctors_name = $data['doctors_name'];
        }

        echo "<form method='post'>";
        echo "<input type='hidden' name='id' value='$id'/></p>";
        echo "<p>diagnosis: <input type='text' name='diagnosis' value='$diagnosis'/></p>";
        echo "<p>patient:";
        echo "<select name='patient'>";

        $current_patient = $db->query("SELECT id, name FROM Patient WHERE id = {$patient}");
        while ($name = $current_patient->fetch()){
            echo "<option value='".$patient."'>".$name['name']."</option>";
        }

        $all_patients = $db->query("SELECT id, name FROM Patient WHERE id != {$patient}");
        while ($name = $all_patients->fetch()) {
            echo "<option value='".$name['id']."'>".$name['name']."</option>";
        }

        echo '</select></p>';
        echo "<p>date: <input type='date' name='date' value='$date'/></p>";
        echo "<p>place:";
        echo "<select name='place'>";

        if ($place == 'Hospital') {
            echo "<option value='Hospital' selected>Hospital</option>
                  <option value='Home'>Home</option>";
        }
        elseif ($place == 'Home') {
            echo "<option value='Hospital'>Hospital</option>
                  <option value='Home' selected>Home</option>";
        }

        echo "</select></p>";
        echo "<p>symptoms: <input type='text' name='symptoms' value='$symptoms'/></p>";
        echo "<p>medical prescription: <input type='text' name='medical_prescription' value='$medical_prescription'/></p>";
        echo "<p>doctors name: <input type='text' name='doctors_name' value='$doctors_name'/></p>";
        echo "<p><input type='submit'/></p>";
        echo "</form>";
    }

    elseif (isset($_POST['id'], $_POST['diagnosis'], $_POST['patient'], $_POST['date'],
        $_POST['place'], $_POST['symptoms'], $_POST['medical_prescription'],$_POST['doctors_name'])) {
        $id = $_POST['id'];
        $diagnosis = $_POST['diagnosis'];
        $patient = $_POST['patient'];
        $date = $_POST['date'];
        $place = $_POST['place'];
        $symptoms = $_POST['symptoms'];
        $medical_prescription = $_POST['medical_prescription'];
        $doctors_name = $_POST['doctors_name'];

        $sql = "UPDATE Examine SET diagnosis = :diagnosis, patient = :patient, date = :date, place = :place, 
                   symptoms = :symptoms, medical_prescription = :medical_prescription, doctors_name = :doctors_name
                   WHERE id = :id";
        $update = $db->prepare($sql);
        $update->execute(array(':diagnosis'=>$diagnosis, ':patient'=>$patient, ':date'=>$date, ':place'=>$place,
            ':symptoms'=>$symptoms, ':medical_prescription'=>$medical_prescription, ':doctors_name'=>$doctors_name,
            ':id'=>$id));
        header('Location: ../examine.php');
    }
    ?>
    </body>
</html>