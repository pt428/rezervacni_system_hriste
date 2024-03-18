<?php
require "Database.php";
require "email.php";
require "location.php";
$message="chyba";
    if(isset($_POST["name"])){
        
    session_start();
        $name =$_POST["name"];      
        $street =$_POST["street"]; 
        $city=$_POST["city"]; 
        $phone=$_POST["phone"]; 
        $email=$_POST["email"]; 
        $date = $_POST["date"]; 
        $time = $_POST["time"];   
        if(isset($_SESSION["admin"]) && $_SESSION["admin"]===1){
            $waiting="obsazeno";
        }else{
            $waiting="čeká na schválení";
        }
        $payment=0;
        echo $_SESSION["admin"];

        $db=new Database();
        $connection=$db->connectDB();

        if($db->addReservationToDB(
            $connection, 
            $name,     
            $street,
            $city,
            $phone,
            $email,
            $date, 
            $time,  
            $waiting,
            $payment
        )){
                $message= "vlozeno";
                if(sendEmail($name,$street,$city,$phone,$email,$date,$time)){
                    $_SESSION["email"] =  "Rezervační formulář byl úspěšně odeslán a čeká na schválení.";
                    $_SESSION["emailTheme"] =  " alert-success ";
                    header($location);
                }else{
                    $_SESSION["email"] =  "Chyba při odesílání rezervačního formuláře";
                    $_SESSION["emailTheme"] =  " alert-danger ";
                    header($location);
                   
                    exit;
                }
        }
        else{
            $message="chyba pri zapisu do db";
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
        <h2><?=$message?></h2>
        <h2><?=$_SESSION["email"]?></h2>
    </body>
    </html>
