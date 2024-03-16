<?php
require "Database.php";
require "days.php";
require "location.php";

$name ="";       
$street ="";
$city="";
$email="";
$phone="";
$year = ""; 
$time = "";   
$weekDay = 0;  
    //datum a cas rezervace ktera se ma vytvorit
    if(isset($_POST["year"]) && isset($_POST["time"]) && isset($_POST["reservedWholeSeason"])){
        
        $year = $_POST["year"]; 
        $time = $_POST["time"];   
        $weekDay = $_POST["weekDay"];   
 
        echo $_POST["year"]; 
        echo "<br>";
        echo $_POST["time"];   
        echo "<br>";
        echo $_POST["weekDay"];   
        echo "zapnout";
        // var_dump($_POST["id"]) ;
        // echo "</br>";
        // $db=new Database();
        // $connection=$db->connectDB();

        // if($db->addSeasonReservationToDB(
        //     $connection, 
        //     $weekDay,
        //     $time,
        //     $year     
        //     )){
        //         echo "vlozeno";
        //     }
          
    }if(isset($_POST["year"]) && isset($_POST["time"]) && !isset($_POST["reservedWholeSeason"])){
        echo $_POST["year"]; 
        echo "<br>";
        echo $_POST["time"];   
        echo "<br>";
        echo $_POST["weekDay"];   
        echo "<br>";
       echo "id " . $_POST["id"]; 
       echo "</br>"; 
        echo "vypnout";
        echo "</br>"; 
       $id= $_POST["id"];   
        $db=new Database();
        $connection=$db->connectDB();

        if($db->deleteSeasonReservationFromDb($connection,$id)){
                echo "smazano";
                header($location);
        }
    }
    if(isset($_POST["name"])){
        $year = $_POST["year"]; 
        $time = $_POST["time"];   
        $weekDay = $_POST["weekDay"];   
 
        $name= $_POST["name"];     
        $street= $_POST["street"]; 
        $city= $_POST["city"]; 
        $phone= $_POST["phone"]; 
        $email= $_POST["email"]; 
        $weekDay= $_POST["weekDay"]; 
        $time= $_POST["time"]; 
        $year= $_POST["year"];      
        $payment= 0; 

        $db=new Database();
        $connection=$db->connectDB();

        if($db->addSeasonReservationToDB(
            $connection, 
            $name,     
            $street,
            $city,
            $phone,
            $email,
            $weekDay,
            $time,
            $year,     
            $payment
            )){
                echo "vlozeno";
            }
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
<a href="calendar.php">kalendar</a>
<div class="container">
    <form action="reservation-seasone.php" method="post" >
        <h1 class="text-centre">Rezervační fomulář na celou sezonu</h1>
        <h4><?=$days[$weekDay]?></h4>
        <h4><?=$time?></h4>
        <input class="form-control" type="text" name="weekDay" hidden value="<?=$weekDay?>">
        <input class="form-control" type="text" name="time" hidden value="<?=$time?>">
        <input class="form-control" type="text" name="year" hidden value="<?=$year?>">
        <div class='input-group input-group-lg'>
            <span class='input-group-text'>Jméno a příjmení</span>
            <input type="text"  
            class="form-control" 
            name="name" 
            aria-label="Sizing example input" 
            aria-describedby="inputGroup-sizing-lg"
            value="<?= htmlspecialchars($name)?>"
            required  
            >
        </div>    
        <div class='input-group input-group-lg'>
            <span class='input-group-text'>Ulice a č.p.</span>
            <input type="text" 
            class="form-control" 
            name="street"  
            aria-label="Sizing example input" 
            aria-describedby="inputGroup-sizing-lg"
            value="<?= htmlspecialchars($street)?>"
            required 
            >
        </div>
        <div class='input-group input-group-lg'>
            <span class='input-group-text'>Město</span>
            <input type="text" 
            class="form-control" 
            name="city" 
            aria-label="Sizing example input" 
            aria-describedby="inputGroup-sizing-lg"
            value="<?= htmlspecialchars($city)?>"
            required 
            >
        </div> 			
        <div class='input-group input-group-lg'>
            <span class='input-group-text'>Email</span>
            <input type="email" 
            class="form-control" 
            name="email" 
            aria-label="Sizing example input" 
            aria-describedby="inputGroup-sizing-lg"
            value="<?= htmlspecialchars($email)?>"
            required 
            >
        </div>
        <div class='input-group input-group-lg'>
            <span class='input-group-text'>Telefon</span>
            <input type="text" 
            class="form-control" 
            name="phone" 
            aria-label="Sizing example input" 
            aria-describedby="inputGroup-sizing-lg"
            value="<?= htmlspecialchars($phone)?>"
            required 
            >
        </div>        				   				

        <div class="d-grid gap-2"> 	
            <p>Odesláním formuláře souhlasíte, aby provozovatel těchto stránek Obec&nbsp;Malenovice zpracovávala Vaše vypsané osobní údaje dle <a href="https://www.malenovice.eu/urad/povinne-informace/?ftresult=GDPR">GDPR</a> </p>
            <button class="btn btn-success btn-lg btn-block" 
                type="submit" 
                name="submit">---- Odeslat ----
            </button>
            
            <button class="btn btn-danger btn-lg btn-block" ><a class="a-btn" href="calendar.php">Zpět do kalendáře</a></button>
        </div>
    </form>   
</div>
</body>
</html>