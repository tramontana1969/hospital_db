<?php
$host = '0.0.0.0';
$port = '6033';
$dbname = 'sql_db';
$user = 'admin';
$pass = '12345';
$db = new PDO("mysql:host=$host; port=$port; dbname=$dbname", $user, $pass);

$patient_data = "SELECT * FROM Patient;";
$res = $db->query($patient_data);
echo "<table><tr><th>id</th><th>name</th><th>sex</th><th>date_of_birth</th>><th>home_address</th>></tr>";
echo 'Patients table';
while ($row = $res->fetch()){
    echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['sex']."</td>";
        echo "<td>".$row['date_of_birth']."</td>";
        echo "<td>".$row['home_address']."</td>";
    echo "</tr>";
}
echo "</table>";
echo '<br>';

$examine_data = "SELECT * FROM Examine";
$res = $db->query($examine_data);
echo 'Examine table';
echo '<table><tr><th>id</th><th>diagnosis</th><th>patient</th><th>date</th><th>place</th><th>symptoms</th><th>medical_prescription</th><th>doctors_name</th></tr>';
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
        echo '</tr>';
    }
echo '</table>';
echo '<br>';

$medicine_data  = 'SELECT * FROM Medicine';
$res = $db->query($medicine_data);
echo 'Meds table';
echo '<table><tr><th>id</th><th>name</th><th>description</th><th>side_effect</th></tr>';
    while ($row = $res->fetch()) {
        echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['name'].'</td>';
            echo '<td>'.$row['description'].'</td>';
            echo '<td>'.$row['side_effect'].'</td>';
        echo '</tr>';
    }
echo '</table>';
echo '<br>';

$prescribed_data = 'SELECT * FROM Prescribed_medications';
$res = $db->query($prescribed_data);
echo 'Prescribed medications table';
echo '<table><tr><th>id</th><th>way_of_using</th><th>medicine_id</th><th>examine_id</th></tr>';
    while($row = $res->fetch()) {
        echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['way_of_using'].'</td>';
            echo '<td>'.$row['medicine_id'].'</td>';
            echo '<td>'.$row['examine_id'].'</td>';
        echo '</tr>';
    }
echo '</table>';