<?php

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/database.php";
require_once __DIR__ . "/UniversityDepartment.php";

$sql = "SELECT `id`, `name` FROM `departments`;";
$result = $conn->query($sql);

$departments = [];

if($result && $result->num_rows > 0) {
    //abbiamo risultati

    while ($row = $result->fetch_assoc()) {
        $curr_department = new Department($row["id"], $row["name"]);
        $departments[] = $curr_department;
    }

} elseif ($result) {
    
} else {

    echo "Query error";
    die();
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE; ?></title>
</head>
<body>
    <h1>Lista dei dipartimenti</h1>
    <?php foreach ($departments as $department) { ?>

    <div>
        <h2><?php echo $department->name ?></h2>
        <a href="InfoDepartment.php?id=<?php echo $department->id; ?>">Vedi informazioni</a>
    </div>

    <?php } ?>
</body>
</html>
