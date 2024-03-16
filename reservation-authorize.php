<?php
if(isset($_POST["id"])){
    require "Database.php";
    $id=$_POST["id"];
    if(isset($_POST["Schválit"])){        
        $waiting="obsazeno";
        $db = new Database();
        $connection = $db->connectDB();
        if($db->authorizeReservationFromDb($connection,$id,$waiting)){
            echo "schvaleno";
        }
    }elseif(isset($_POST["Smazat"])){
        $db = new Database();
        $connection = $db->connectDB();
        if($db->deleteReservationFromDb($connection,$id)){
            echo "smazano";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="calendar.php">kalendar</a>
season
</body>
</html>