<?php
 function sendEmail($name,$street,$city,$phone,$email,$date,$time){
    // Force PHP to use the UTF-8 charset
    header('Content-Type: text/html; charset=utf-8'); 

    // Nastavte si email, nakterý chcete, aby se vyplněný formulář odeslal - jakýkoli váš email
    $recipient = "pt75@seznam.cz, pavel.tichy@centrum.cz";
    // $recipient = "podatelna@malenovice.eu";
    // $recipient = "obec@malenovice.eu";

    // Nastavte předmět odeslaného emailu
    $subject = "Rezervace hřiště od: $name";
    $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

    // Obsah emailu, který se vám odešle
    
    $email_content = "Jméno: $name\r\n";
    $email_content .= "Adresa: $street\r\n";
    $email_content .= "Město: $city\r\n";
    $email_content .= "Telefon: $phone\r\n";
    $email_content .= "Email: $email\r\n";
    $email_content .= "Datum: $date\r\n";
    $email_content .= "Čas: $time\r\n";
    
  
    
    // Emailová hlavička
    
    $email_headers = 'MIME-Version: 1.0' . "\n";//\r\n ok na centrum
    $email_headers .= 'Content-type: text/html; charset=utf-8' . "\n";
    $email_headers .= 'Content-Transfer-Encoding: base64' . "\n";
    $email_headers .= "From:" . $name . "<" . $email . ">" . "\n";
    // header("Content-Type: text/html; charset=windows-1250");
      
    // Odeslání emailu - dáme vše dohromady
    return mail($recipient, $subject, $email_content, $email_headers);
}

?>
