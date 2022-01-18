<!DOCTYPE html>
<html>
    <head>
        <title>Edit patient</title>
    </head>
    <body>
        <?php
        include "../creds.php";
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM Patient WHERE id = :id";
            $patient = $db->prepare($sql);
            $patient->execute(array(':id' => $id));
            foreach ($patient as $data) {
                $name = $data['name'];
                $sex = $data['sex'];
                $date_of_birth = $data['date_of_birth'];
                $home_address = $data['home_address'];
            }

            function sex_choice($val) {
                if ($val == 'M') {
                    return "<option selected value='M'>M</option>
                            <option value='F'>F</option>";
                }
                elseif ($val == 'F') {
                    return "<option value='M'>M</option>
                            <option selected value='F'>F</option>";
                }
            }

            $choice = sex_choice($sex);
            echo "<form method='post'>
            <input type='hidden' name='id' value='$id'/></p>
            <p>name: <input type='text' name='name' value='$name'/></p>
            <p>sex:
                <select name='sex'>$choice</select>
            </p>
            <p>date of birth: <input type='date'  name='date_of_birth' value='$date_of_birth'/></p>
            <p>home address: <input type='text' name='home_address' value='$home_address'/></p>
            <input type='submit'/>
            </form>";
        }
        elseif (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['sex']) &&
            isset($_POST['date_of_birth']) && isset($_POST['home_address'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $date_of_birth = $_POST['date_of_birth'];
            $home_address = $_POST['home_address'];

            $sql = "UPDATE Patient SET name = :name, sex = :sex,  
                   date_of_birth = :date_of_birth, home_address = :home_address
                   WHERE id = :id";
            $update = $db->prepare($sql);
            $update->execute(array(':name'=>$name, ':sex'=>$sex, ':date_of_birth'=>$date_of_birth, ':home_address'=>$home_address, ':id'=>$id));
            header("Location: ../patient.php");
        }
        ?>
    </body>
</html>