<!DOCTYPE html>
<html>
    <head>
        <title>Edit prescribed medications</title>
    </head>
    <body>
    <?php
    include "../creds.php";

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = 'SELECT * FROM Prescribed_medications WHERE id = :id';
        $pres = $db->prepare($sql);
        $pres->execute(array(':id'=>$id));
        foreach ($pres as $data) {
            $way_of_using = $data['way_of_using'];
            $medicine_id = $data['medicine_id'];
            $examine_id = $data['examine_id'];
        }
        echo "<form method='post'>";
        echo "<input type='hidden' name='id' value='$id'/></p>";
        echo "<p>way of using<input type='text' name='way_of_using' value='$way_of_using'/></p>";
        echo "<p>medicine id";

        echo "<select name='medicine_id'>";
        $current_med = $db->query("SELECT id, name FROM Medicine WHERE id = {$medicine_id}");
        while ($name = $current_med->fetch()) {
            echo "<option value='".$medicine_id."'>".$name['name']."</option>";
        }
        $all_meds = $db->query("SELECT id, name FROM Medicine WHERE id != {$medicine_id}");
        while ($name = $all_meds->fetch()) {
            echo "<option value='".$name['id']."'>".$name['name']."</<option>";
        }
        echo "</select></p>";
        echo "<p>examine id";

        echo "<select name='examine_id'>";
        $current_exam = $db->query("SELECT id, patient, diagnosis, date FROM Examine WHERE id = {$examine_id}");
        while ($row = $current_exam->fetch()) {
            $patient = $db->query("SELECT name FROM Patient WHERE id = {$row['patient']}");
            $patient_name = $patient->fetch();
            echo "<option value='".$examine_id."'>".$patient_name['name'].", ".$row['diagnosis'].", ".$row['date']."</option>";
        }

        $all_exams = $db->query("SELECT id, patient, diagnosis, date FROM Examine WHERE id != {$examine_id}");
        while ($row = $all_exams->fetch()) {
            $patient = $db->query("SELECT name FROM Patient WHERE id = {$row['patient']}");
            $patient_name = $patient->fetch();
            echo "<option value='".$row['id']."'>".$patient_name['name'].", ".$row['diagnosis'].", ".$row['date']."</option>";
        }
        echo "</select></p>";

        echo "<input type='submit'>";
        echo "</form>";
    }
    elseif (isset($_POST['id'], $_POST['way_of_using'], $_POST['medicine_id'], $_POST['examine_id'])) {
        $id = $_POST['id'];
        $way_of_using = $_POST['way_of_using'];
        $medicine_id = $_POST['medicine_id'];
        $examine_id = $_POST['examine_id'];

        $sql = "UPDATE Prescribed_medications SET way_of_using = :way_of_using, medicine_id = :medicine_id, 
                examine_id = :examine_id WHERE id = :id";
        $update = $db->prepare($sql);
        $update->execute(array(':way_of_using'=>$way_of_using, ':medicine_id'=>$medicine_id,
                                ':examine_id'=>$examine_id, ':id'=>$id));
        header("Location: ../prescribed_medications.php");
    }
    ?>
    </body>
</html>