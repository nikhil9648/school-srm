<?php
require_once __DIR__ . '/smtp/PHPMailerAutoload.php';


// echo smtp_mailer('mauryaji2562003@gmail.com','Subject','hello harshit kaise ho website ko responsive bana lo important hai aur iss wifi wale ki gaand marni hai. Thankyou aaj ke liye itna mai bhi mayush hu.');
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.hostinger.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = true; 
	$mail->Username = "principal@srmmps.com";
	$mail->Password = "Srm@9918868227";
	$mail->SetFrom("principal@srmmps.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
}
?>