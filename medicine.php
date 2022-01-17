<!DOCTYPE html>
<html>
    <head>
        <title>Medicine</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        include "creds.php";

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
        ?>

        <form method="post" action="adding_scripts/add_med.php">
            <p>name: <input type="text" name="name"/></p>
            <p>description: <input type="text" name="description"/></p>
            <p>side effect: <input type="text" name="side_effect"/></p>
            <p><input type="submit"></p>
        </form>
    </body>
</html>