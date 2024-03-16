<?php
    class Database{
        //napojeni na databazi, prihlasovaci udaje jsou v database-log.php
        function connectDB(){
            require "database-log.php";
            $connection = "mysql:host=".$db_host.";dbname=".$db_name.";charset=utf8";
            try {
                $db=new PDO($connection,$db_user,$db_password);
                $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                return $db;
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
             
        }

        //hledani datumu a casu rezervace vraci
        function getReservationDataFromDB($connection,$date,$time){
          
            $sql="SELECT * FROM reservation 
            WHERE date_reservation = :date_reservation AND 
                    time_reservation = :time_reservation ";

            $stmt=$connection->prepare($sql);

            if($stmt){
                $stmt->bindValue("date_reservation",$date,PDO::PARAM_STR);
                $stmt->bindValue("time_reservation",$time,PDO::PARAM_STR);                
            }else{
                echo mysqli_error($connection);
            }

            try {
                if($stmt->execute()){
                  
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                  
               }else{
                   throw new Exception("chyba pri stazeni dat z db");
               }
            } catch (Exception $th) {
                echo $th->getMessage();
            }

        }
        //hledani datumu a casu rezervace vraci
        function getSeasonReservationDataFromDB($connection,$weekDay,$time,$year){
          
            $sql="SELECT * FROM reservation_season
                WHERE   week_day = :week_day AND 
                        time = :time AND
                        year = :year";

            $stmt=$connection->prepare($sql);

            if($stmt){
                $stmt->bindValue("week_day",$weekDay,PDO::PARAM_INT);
                $stmt->bindValue("time",$time,PDO::PARAM_STR);                
                $stmt->bindValue("year",$year,PDO::PARAM_INT);
            }else{
                echo mysqli_error($connection);
            }

            try {
                if($stmt->execute()){
                  
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                  
               }else{
                   throw new Exception("chyba pri stazeni dat z db");
               }
            } catch (Exception $th) {
                echo $th->getMessage();
            }

        }
   
        //pridat rezervaci do databaze  
        function addReservationToDB(
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
            ){
          
            $sql="INSERT 
                    INTO reservation(
                        name,
                        street,
                        city,
                        phone,
                        email,
                        date_reservation,
                        time_reservation,
                        waiting,
                        payment)
                    VALUES(
                        :name,
                        :street,
                        :city,
                        :phone,
                        :email,
                        :date_reservation,
                        :time_reservation,
                        :waiting,
                        :payment)";

            $stmt=$connection->prepare($sql);

            if($stmt){
                $stmt->bindValue("name",$name,PDO::PARAM_STR);
                $stmt->bindValue("street",$street,PDO::PARAM_STR);                
                $stmt->bindValue("city",$city,PDO::PARAM_STR);                
                $stmt->bindValue("phone",$phone,PDO::PARAM_STR);                
                $stmt->bindValue("email",$email,PDO::PARAM_STR);                
                $stmt->bindValue("date_reservation",$date,PDO::PARAM_STR);                
                $stmt->bindValue("time_reservation",$time,PDO::PARAM_STR);                
                $stmt->bindValue("waiting",$waiting,PDO::PARAM_STR);                
                $stmt->bindValue("payment",$payment,PDO::PARAM_INT);                
            }else{
                echo mysqli_error($connection);
            }

            try {
                if($stmt->execute()){
                  
                    return true;
                  
               }else{
                   throw new Exception("chyba pri stazeni dat z db");
               }
            } catch (Exception $th) {
                echo $th->getMessage();
            }

        }

        //pridat rezervaci do databaze  
        function addSeasonReservationToDB(
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
            ){
          
            $sql="INSERT 
                    INTO reservation_season(
                        name,
                        street,
                        city,
                        phone,
                        email,
                        week_day,
                        time,
                        year,
                        payment)
                    VALUES(
                        :name,
                        :street,
                        :city,
                        :phone,
                        :email,
                        :week_day,
                        :time,
                        :year,
                        :payment)";

            $stmt=$connection->prepare($sql);

            if($stmt){
                $stmt->bindValue("name",$name,PDO::PARAM_STR);
                $stmt->bindValue("street",$street,PDO::PARAM_STR);                
                $stmt->bindValue("city",$city,PDO::PARAM_STR);                
                $stmt->bindValue("phone",$phone,PDO::PARAM_STR);                
                $stmt->bindValue("email",$email,PDO::PARAM_STR);                
                $stmt->bindValue("week_day",$weekDay,PDO::PARAM_INT);                
                $stmt->bindValue("time",$time,PDO::PARAM_STR);                
                $stmt->bindValue("year",$year,PDO::PARAM_STR);                
                $stmt->bindValue("payment",$payment,PDO::PARAM_INT);                
            }else{
                echo mysqli_error($connection);
            }

            try {
                if($stmt->execute()){
                  
                    return true;
                  
               }else{
                   throw new Exception("chyba pri stazeni dat z db");
               }
            } catch (Exception $th) {
                echo $th->getMessage();
            }

        }

        function getAdminDataFromDb($connection, $user,$password){
            $sql="SELECT * FROM reservation_login 
            WHERE user = :user AND 
                    password = :password ";

            $stmt=$connection->prepare($sql);

            if($stmt){
                $stmt->bindValue("user",$user,PDO::PARAM_STR);
                $stmt->bindValue("password",$password,PDO::PARAM_STR);                
            }else{
                echo mysqli_error($connection);
            }

            try {
                if($stmt->execute()){
                  
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                  
               }else{
                   throw new Exception("chyba pri stazeni dat z db");
               }
            } catch (Exception $th) {
                echo $th->getMessage();
            }
        }

        function deleteReservationFromDb($connection,$id){
            $sql="DELETE FROM reservation
            WHERE id=:id";
            $stmt=$connection->prepare($sql);
            if($stmt){
                $stmt->bindValue(":id",$id,PDO::PARAM_INT);
            }else{
                echo mysqli_error($connection);
            }
            if($stmt->execute()){
                return true;
            }
        }

        function deleteSeasonReservationFromDb($connection,$id){
            $sql="DELETE FROM reservation_season
            WHERE id=:id";
            $stmt=$connection->prepare($sql);
            if($stmt){
                $stmt->bindValue(":id",$id,PDO::PARAM_INT);
            }else{
                echo mysqli_error($connection);
            }
            if($stmt->execute()){
                return true;
            }
        }

        function authorizeReservationFromDb($connection,$id,$waiting){
            $sql="UPDATE reservation SET waiting=:waiting WHERE id=:id";
            $stmt=$connection->prepare($sql);
            if($stmt){
                $stmt->bindValue(":id",$id,PDO::PARAM_INT);
                $stmt->bindValue(":waiting",$waiting,PDO::PARAM_STR);
            }else{
                echo mysqli_error($connection);
            }
            if($stmt->execute()){
                return true;
            }
        }
        
         
      
}