<!DOCTYPE html>
<html>
    <head>
        <title>Examine</title>
        <meta charset="utf-8" />
    </head>
    <body>
    <?php
    include "creds.php";

    $examine_data = "SELECT * FROM Examine";
    $res = $db->query($examine_data);
    echo 'Examine table';
    echo '<table><tr><th>id</th><th>diagnosis</th><th>patient</th><th>date</th><th>place</th>
            <th>symptoms</th><th>medical_prescription</th><th>doctors_name</th><th>delete examine</th><th>edit exam</th></tr>';
    while ($row = $res->fetch()) {
        echo '<tr>';
        echo '<td>'.$row['id'].'</td>';
        echo '<td>'.$row['diagnosis'].'</td>';
        echo '<td>'.$row['patient'].'</td>';
        echo '<td>'.$row['date'].'</td>';
        echo '<td>'.$row['place'].'</td>';
        echo '<td>'.$row['symptoms'].'</td>';
        echo '<td>'.$row['medical_prescription'].'</td>';
        echo '<td>'.$row['doctors_name'].'</td>';
        echo "<td><form method='post' action='delete/delete_exam.php'>
                <input type='hidden' name='id' value='".$row['id']."'>   
                <input type='submit' value='delete'>   
            </form></td>";
        echo "<td><a href='update/update_exam.php?id=".$row['id']."'><button>edit</button></a></td>";
        echo '</tr>';
    }
    echo '</table>';
    ?>

    <form method="post" action="adding_scripts/add_examine.php">
        <p>diagnosis: <input type="text" name="diagnosis"/></p>
        <p>patient:
            <?php
                $patients = $db->query("SELECT id, name FROM Patient");
                echo '<select name="patient">';
                while ($name = $patients->fetch()) {
                    echo "<option value='".$name['id']."'>".$name['name']."</option>";
                }
                echo '</select>';
            ?>
        </p>
        <p>date: <input type="date" name="date"/></p>
        <p>place:
            <select name="place">
                <option value="Hospital">Hospital</option>
                <option value="Home">Home</option>
            </select>
        </p>
        <p>symptoms: <input type="text" name="symptoms"/></p>
        <p>medical prescription: <input type="text" name="medical_prescription"/></p>
        <p>doctors name: <input type="text" name="doctors_name"/></p>
        <p><input type="submit"/></p>
    </form>
    </body>
</html>