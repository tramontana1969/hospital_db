<!DOCTYPE html>
<html>
    <head>
        <title>Patients</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <?php
        include 'creds.php';
        $patient_data = "SELECT * FROM Patient;";
        $res = $db->query($patient_data);
        echo "<table><tr><th>id</th><th>name</th><th>sex</th>
            <th>date_of_birth</th>><th>home_address</th>><th>delete patient</th><th>edit patient</th></tr>";
        echo 'Patients table';
        while ($row = $res->fetch()){
            echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['sex']."</td>";
                echo "<td>".$row['date_of_birth']."</td>";
                echo "<td>".$row['home_address']."</td>";
                echo "<td><form method='post' action='delete/delete_patient.php'>
                    <input type='hidden' name='id' value='".$row['id']."'>
                    <input type='submit' value='delete'>
                </form></td>";
                echo "<td><a href='update/update_patient.php?id=".$row['id']."'><button>edit</button></a></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>

        <form method="post" action="adding_scripts/add_patient.php">
            <p>name: <input type="text" name="name"/></p>
            <p>sex:
                <select name="sex">
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
            </p>
            <p>date of birth: <input type="date"  name="date_of_birth"/></p>
            <p>home address: <input type="text" name="home_address"/></p>
            <input type="submit"/>
        </form>
    </body>
</html>