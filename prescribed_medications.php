<!DOCTYPE html>
<html>
    <head>
        <title>Prescribed medications</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        include "creds.php";

        $prescribed_data = 'SELECT * FROM Prescribed_medications';
        $res = $db->query($prescribed_data);
        echo 'Prescribed medications table';
        echo '<table><tr><th>id</th><th>way_of_using</th><th>medicine_id</th><th>examine_id</th><th>delete medication</th><th>edit medications</th></tr>';
        while($row = $res->fetch()) {
            echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['way_of_using'].'</td>';
            echo '<td>'.$row['medicine_id'].'</td>';
            echo '<td>'.$row['examine_id'].'</td>';
            echo "<td><form method='post' action='delete/delete_pres_med.php'>
                    <input type='hidden' name='id' value='".$row['id']."'/>
                    <input type='submit' value='delete'/>
                </form></td>";
            echo "<td><a href='update/update_pres_med.php?id=".$row['id']."'><button>edit</button></a></td>";
            echo '</tr>';
        }
        echo '</table>';
        ?>

        <form method="post" action="adding_scripts/add_pres_meds.php">
            <p>way of using<input type="text" name="way_of_using"></p>
            <p>medicine id
                <?php
                $meds = $db->query("SELECT id, name FROM Medicine");
                echo "<select name='medicine_id'>";
                while ($row = $meds->fetch()) {
                    echo "<option value='".$row['id']."'>".$row['name']."</<option>";
                }
                echo "</select>";
                ?>
            </p>

            <p>examine id
                <?php
                $exams = $db->query("SELECT id, patient, diagnosis, date FROM Examine ORDER BY -date");
                echo "<select name='examine_id'>";
                while ($row = $exams->fetch()) {
                    $id = $row['patient'];
                    $patient = $db->query("SELECT name FROM Patient WHERE id = {$row['patient']}");
                    $patient_name = $patient->fetch();
                    echo "<option value='".$row['id']."'>".$patient_name['name'].", ".$row['diagnosis'].", ".$row['date']."</option>";
                }
                echo "</select>";
                ?>
            </p>
            <p><input type="submit"/></p>
        </form>
    </body>
</html>