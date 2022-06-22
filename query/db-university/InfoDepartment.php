<?php 

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/database.php";
require_once __DIR__ . "/UniversityDepartment.php";

// $id = $_GET["id"];
// $sql = "SELECT * FROM `departments` WHERE `id` = $id;";
// $result = $conn->query($sql);
// var_dump($result);

//Statement
$stmt = $conn->prepare("SELECT * FROM `departments` WHERE `id` = ?");
$stmt->bind_param('d', $id);
$id = $_GET["id"];


$stmt->execute();
$result = $stmt->get_result();

$departments = [];

if ($result && $result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $curr_department = new Department($row["id"], $row["name"]);
        $curr_department->setContacts($row["address"], $row["phone"], $row["email"], $row["website"]);
        $curr_department->head_of_department = $row["head_of_department"];
        $departments[] = $curr_department;
    }
    
} else if($result) {
    echo "Il dipartimento non è stato trovato";
} else {
    echo "Errore nel query";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php foreach($departments as $department) { ?>
    <h1><?php echo $department->name; ?></h1>
    <p><?php echo $department->head_of_department; ?></p>

    <h2>Contatti</h2>
    <ul>
        <?php foreach($department->getContacts() as $key => $value ) { ?>
        <li><?php echo "$key: $value" ?></li>
        <?php } ?>
    </ul>

    <?php } ?>
</body>
</html>