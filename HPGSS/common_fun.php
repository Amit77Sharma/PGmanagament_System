<?php
function generateNumericOTP($n) {
      
    $generator = "1357902468";
  
    $result = "";
  
    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }

    return $result;
}

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

include("PHPMailer_5.2.0/class.phpmailer.php");
function smtpmailer($to, $from, $from_name, $subject, $body) { 
 global $error;
 $mail = new PHPMailer();  // create a new object
 $mail->IsSMTP(); // enable SMTP
 $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
 $mail->SMTPAuth = true;  // authentication enabled
 $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
 $mail->Host = 'smtp.gmail.com';
 $mail->Port = 465; 
 $mail->Username = 'ajtechnicalworks@gmail.com';  
 $mail->Password = 'I Love Myself';           
 $mail->SetFrom($from, $from_name);
 $mail->IsHTML(true);
 $mail->Subject = $subject;
 $mail->Body = $body;
 $mail->AddAddress($to);
 if(!$mail->Send()) {
 $error = 'Mail error: '.$mail->ErrorInfo; 
 return false;
 } else {
 $error = 'Message sent!';
 return true;
 }
}


?>