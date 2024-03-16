<?php
 function sendEmail($name,$street,$city,$phone,$email,$date,$time){
    
    // Nastavte si email, nakterý chcete, aby se vyplněný formulář odeslal - jakýkoli váš email
    $recipient = "pt75@seznam.cz, pavel.tichy@centrum.cz";
    // $recipient = "podatelna@malenovice.eu";
    // $recipient = "obec@malenovice.eu";

    // Nastavte předmět odeslaného emailu
    $subject = "Rezervace hřiště od: $name";
    // $subject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
    // Obsah emailu, který se vám odešle
    
    $email_content = "Jméno: $name\n";
    $email_content .= "Adresa: $street\n";
    $email_content .= "Město: $city\n";
    $email_content .= "Telefon: $phone\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Datum:\n$date\n";
    $email_content .= "Čas:\n$time\n";
    // $email_content = '=?UTF-8?B?' . base64_encode($email_content) . '?=';
    
    // Emailová hlavička
    
    $email_headers = "From: $name <$email>";
    $email_headers = 'MIME-Version: 1.0' . "\r\n";
    $email_headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $email_headers .= "From:" . $name . "<" . $email . ">" . "\r\n";
    // header("Content-Type: text/html; charset=windows-1250");
      
    // Odeslání emailu - dáme vše dohromady
    return mail($recipient, $subject, $email_content, $email_headers);
}


?>