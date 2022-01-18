<!DOCTYPE html>
<html>
<head>
    <title>Edit med</title>
</head>
    <body>
    <?php
    include "../creds.php";

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM Medicine WHERE id = :id";
        $med = $db->prepare($sql);
        $med->execute(array(':id'=>$id));
        foreach ($med as $data) {
            $name = $data['name'];
            $description = $data['description'];
            $side_effect = $data['side_effect'];
        }
        echo "<form method='post'>
                <input type='hidden' name='id' value='$id'/>
                <p>name: <input type='text' name='name' value='$name'/></p>
                <p>description: <input type='text' name='description' value='$description'/></p>
                <p>side effect: <input type='text' name='side_effect' value='$side_effect'/></p>
                <p><input type='submit'></p>
            </form>";
    }
    elseif (isset($_POST['id'], $_POST['name'], $_POST['description'], $_POST['side_effect'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $side_effect = $_POST['side_effect'];

        $sql = "UPDATE Medicine SET name = :name, description = :description, side_effect = :side_effect WHERE id = :id";
        $update = $db->prepare($sql);
        $update->execute(array(':name'=>$name, ':description'=>$description, ':side_effect'=>$side_effect, ':id'=>$id));
        header('Location: ../medicine.php');
    }
    ?>
    </body>
</html>
