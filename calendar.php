 <?php
    require "days.php";
    require "Database.php";
    session_start();
     isset($_SESSION["admin"])?:$_SESSION["admin"]=0;
    $db=new Database();
    $connection = $db->connectDB();
    //dnesni datum
    $today=date ("d.m.Y",mktime(0, 0, 0,  date("m") ,date("d"),  date("Y")));
    //cislo dne dnesnihp datumu 0-pondeli,....
    $weekDay= date (" N",mktime(0, 0, 0,  date("m") ,date("d"),  date("Y")))-1 ;   
    $year = date("Y");

    //kliknuto na predchozi dalsi tyden nebo aktualni tyden
    if(isset($_POST["previous"])){
        $week=$_POST["previous"]-7;//tento tyden - 7 dni posune kalendar na predchozi tyden
    }elseif(isset($_POST["next"])){
        $week=$_POST["next"]+7;//tento tyden + 7 dni posune kalendar na dalsi tyden
    }else{
        $week=0; //aktualni tyden
    }

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Rezervační systém</title>
</head>
<body>
    <?php require "nav-bar.php"?>
    
    <div class="container">
        <a href="login.php">login</a>
        <div class="calendarBody">
            <?= $_SESSION["admin"]?"<h1>Administrátor</h1>":"<h1>Rezervační systém</h1>"?>
          
            <?php
                if(isset($_SESSION["email"])){
                     
            ?>
                    <div class="alert <?= $_SESSION["emailTheme"] ?> text-center" role="alert">
                        <?=$_SESSION["email"]?>
                    </div>
            <?php unset($_SESSION["email"]);} ?>
                     
            <div class="tooltip">Hover over me
                    <span class="tooltiptext">Tooltip text</span>
            </div>
            <!-- posun po tydnech -->
            <form class="buttons" action="" method="post">
                <button 
                class="btn btn-success form-btn" 
                type="submit" 
                name="previous" 
                value=<?=$week?>
                >Předchozí týden</button>
                <button 
                class="btn btn-success form-btn" 
                type="submit" name="today"  
                >DNES</button>
                <button 
                class="btn btn-success form-btn"
                type="submit" 
                name="next" 
                value=<?=$week?>>
                Další týden</button>
                        
            </form>
            <!-- telo kalendare -->
            <table class="table table-striped  table-bordered">
                <?php for($i=0;$i<7;$i++):?>
                    <?php 
                    $date  =date ("d.m.Y",mktime(0, 0, 0,  date("m") ,date("d")+$i-$weekDay+$week,date("Y")));
                    $day= date (" N",mktime(0, 0, 0,  date("m") ,date("d")+$i,  date("Y")))-1;  
                    $progressValue=0;             
                    ?>            
                    <tr>
                        <!-- den v tydnu cesky -->
                        <th  style="<?= $today===$date?"color:red":"" ?>" >
                            <h4><?=$days[$i]?></h4>
                        </th>
                        <!-- datum dne -->
                        <td   style="<?= $today===$date?"color:red":"" ?>">
                            <h4><?=$date?></h4>
                        </td>
                        <td>
                                <!-- seznam s casy //////////////////////////////// -->
                                <div class="btn-group">
                                    <!-- talcitko pro rozbaleni seznamu s casy -->
                                    <button 
                                    type="button" 
                                    class="btn btn-success dropdown-toggle" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false"
                                    >Obsazenost</button>
                                    <!-- seznam s casy -->
 
                                    <ul class="dropdown-menu">
                                        
                                        <?php for($hodina=9;$hodina<=20;$hodina++):;

                                            $time=($hodina<11?"0":"") . $hodina-1 .":00 - ".($hodina<10?"0":"") .  $hodina . ":00";
                                            $available=$db->getReservationDataFromDB($connection,$date,$time);
                                            $availableSeason=$db->getSeasonReservationDataFromDB($connection,$i,$time,$year);
                                            $seasonCheck="";

                                            if($available && $available["waiting"]==="čeká na schválení"){
                                                    $colorTheme= "background-color:#ffe507; color:black ";//ceka na schvaleni
                                            }elseif($available && $available["waiting"]==="obsazeno"){
                                                    $colorTheme= "background-color:red; color:white  ";//obsazeno
                                            }else{
                                                    $colorTheme= "background-color:#016401; color:white; ";//volno
                                            }

                                            if($availableSeason){
                                                $colorTheme= "background-color:red; color:white  ";
                                            }    
                                            ?>

                                            <!-- admin tooltip text nad rozvhem s casy -->
                                            <div class="tooltip-times">
                                                
                                                    <?php if($_SESSION["admin"] && $available){ ?>
                                                        <span class="tooltip-text">
                                                    <?php 
                                                        echo $available["date_reservation"] . " / "  ;
                                                        echo $available["time_reservation"] . "<br>" ;
                                                        echo "<hr>";
                                                        echo $available["name"] . "<br>" ;
                                                        echo $available["street"] . "<br>"  ;
                                                        echo $available["city"] . "<br>"  ;
                                                        echo $available["phone"] . "<br>"  ;
                                                        echo $available["email"] ;
                                                         
                                                    ?>
                                                        </span>

                                                    <?php       }

                                                     ?>
                                                     <!-- admin tooltip text nad rozvhem s casy pro cela sezona -->
                                                    <?php if($_SESSION["admin"] && $availableSeason){ ?>
                                                        <span class="tooltip-text">
                                                    <?php 
                                                        echo $availableSeason["name"] . "<br>" ;
                                                        echo $availableSeason["street"] . "<br>"  ;
                                                        echo $availableSeason["city"] . "<br>"  ;
                                                        echo $availableSeason["phone"] . "<br>"  ;
                                                        echo $availableSeason["email"] ;
                                                         
                                                    ?>
                                                        </span>

                                                    <?php       }
                                                     ?>
                                                
                                                <!-- jedna polozka seznamu s casy -->
                                            <li style="<?=$colorTheme?>"  >
                                                <?=$time?> 
                                                <?php 
                                                    if($availableSeason){
                                                        echo "obsazeno ! ....................";
                                                        $seasonCheck="checked";
                                                        $progressValue++;
                                                    }elseif($available){
                                                            echo $available["waiting"]; 
                                                            $progressValue++;
                                                    }else{
                                                            echo " volno ";                     
                                                    }
                                                ?> 
                                                
                                                    <!-- zobrazit tlacitko rezervovat pokud neexistuje v DB zaznam -->
                                                    <?php 
                                                        if(!$available && !$availableSeason){ 
                                                    ?>
                                                        <form action="reservation-form.php" method="post">
                                                            <input type="text" name="date" value="<?= $date ?>" hidden>
                                                            <input type="text" name="time" value="<?= $time ?>" hidden>
                                                            <input class="btn btn-input btn-primary" type="submit" value="Rezervovat">
                                                        </form>
                                                    <!-- v admin uctu zobrazit tlacitko smazat a schvalit -->
                                                    <?php 
                                                        }elseif($_SESSION["admin"] && $available){ 
                                                    ?> 
                                                        <form action="reservation-authorize.php" method="post">
                                                            <input type="number" name="id" value="<?= $available["id"]?>" hidden>
                                                            <?php 
                                                                if($available["waiting"]!="obsazeno"){
                                                            ?>
                                                                <input class="btn btn-input btn-secondary" name="Schválit" type="submit" value="Schválit"> 
                                                            <?php
                                                                 } 
                                                                 
                                                            ?>            
                                                                <input class="btn btn-input btn-danger" name="Smazat" type="submit" value="Smazat">                  
                                                        </form>
                                                    <?php 
                                                        } 
                                                    ?>  

                                                    <!-- v admin uctu zobrazit checkbox cela sezona -->
                                                <?php 
                                                    if($_SESSION["admin"]){ 
                                                ?>
                                                        <form action="reservation-seasone.php" method="post">
                                                            <input type="text" name="year" value="<?= $year ?>" hidden>
                                                            <input type="text" name="time" value="<?= $time ?>" hidden>
                                                            <input type="number" name="weekDay" value="<?= $i ?>" hidden>
                                                            <input type="number" name="id" value="<?= $availableSeason?$availableSeason["id"]:"" ?>" hidden>
                                                            <?php 
                                                            // pokud neni zaznam o rezervaci tak zobraz admin check box cela sezona
                                                            if(!$available){
                                                                ?>
                                                                <div class="form-check form-switch">
                                                                <input 
                                                                name="reservedWholeSeason"
                                                                class="form-check-input" 
                                                                type="checkbox" 
                                                                role="switch" 
                                                                id="seasone"
                                                                onChange='submit();'
                                                                action="reservation-seasone.php"
                                                                value="<?= $availableSeason ?>" 
                                                                <?= $seasonCheck ?>>
                                                                <label 
                                                                class="form-check-label" 
                                                                for="seasone"
                                                                
                                                                >celá sezona</label>
                                                                </div>
                                                  
                                                            <?php 
                                                                } 
                                                            ?>  
                                                        </form> 
                                                <?php 
                                                    } 
                                                ?> 


                                            </li>
                                            </div>
                                        <?php  endfor ?>
                                    </ul>
                                </div>
                                <!-- progres bar obsazenosti -->
                                <div class="progrBar">
                                    <progress  class="available" value="<?=$progressValue?>" max="12">  
                                </progress>   
                            </div> 
                        </td>
                    </tr>   
                <?php endfor ?>
            </table>
        </div>
    </div>
    <!-- style="background-color:<?=$available?"red":"green"?>"    -->
    <script>
        let progress = document.querySelectorAll("progress");
        let btn = document.querySelectorAll("button")
        // console.log(btn);
        for(let i=3;i<9;i++){
            if(progress[i-3].value==12){
                // console.log(progress[i].value);
                btn[i].style.backgroundColor="red";
                btn[i].textContent="Obsazeno !";

            }
        }
    </script>

</body>
</html>