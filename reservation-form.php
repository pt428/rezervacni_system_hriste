<?php
    //datum a cas rezervace ktera se ma vytvorit
    if(isset($_POST["date"]) && isset($_POST["time"])){
        $date = $_POST["date"]; 
        $time = $_POST["time"];   
        $name ="";       
        $street ="";
        $city="";
        $email="";
        $phone="";

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
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php require "nav-bar.php"?>
<div class="container">

    <form action="reservation.php" method="post" >
        <h1 class="text-centre">Rezervační fomulář</h1>
        <h4><?=$date?></h4> 
        <h4><?=$time?></h4>
        <input class="form-control" type="text" name="date" hidden value="<?=$date?>">
        <input class="form-control" type="text" name="time" hidden value="<?=$time?>">
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