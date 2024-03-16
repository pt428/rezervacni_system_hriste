<?php  
$msg="";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if(isset($_POST)){
    require "Database.php";
    $user=$_POST["user"];
    $password=$_POST["password"];

    $db=new Database();
    $connection = $db->connectDB();
    $logData=$db->getAdminDataFromDb($connection,$user,$password);

 
    if($logData && $_POST["user"]===$logData["user"] and $_POST["password"]===$logData["password"]){
        session_start();
        $_SESSION["admin"]=1;
        header("Location:./calendar.php ");
       


    }else{
        $msg=  "<div class='alert alert-danger'>Špatné přihlašovací údaje</div>";
        
    }

}  
}


?>
<!doctype html>
<html lang="cs">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Rezervace</title>
	<link rel="icon" type="image/x-icon" href="/img/favicon.ico">
  
 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 
    <link rel="stylesheet" href="css/style.css">
  </head>
 
  <body>    
 
    <div class="container">
    <div class="col-md-6 offset-md-3">
    			<form action="" method="post" >
        				<h1 class="text-centre">Přihlášení do administratorského účtu</h1>
                        <?php echo (isset($msg)?$msg:"") ;?> 

                        <div class='input-group input-group-lg'>
                                <span class='input-group-text'>Login</span>
        					      <input type="text"  
                            class="form-control" 
                            name="user"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                            required  >
        				        </div>    

                        <div class='input-group input-group-lg'>
                                <span class='input-group-text'>Heslo</span>
        					      <input type="password" 
                            class="form-control" 
                            name="password"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                            required  >
        				      </div>
                      <div class="d-grid gap-2">
        				      <button class="btn btn-success btn-lg btn-block" 
                            type="submit" 
                            name="submit">---- Odeslat ----
                      </button>        				
                      <a class="btn btn-danger btn-lg btn-block" href="calendar.php">Zpět do kalendáře</a>
                      </div>
    			</form>    			
    			
 


  
          </div>
    </div>
  </body>
</html>