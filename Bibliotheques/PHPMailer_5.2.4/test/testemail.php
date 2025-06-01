<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

 require_once('../class.smtp.php');

	$to = 'L003480@ca-centreloire.fr';
	$from = 'NOREPLY@ca-centreloire.fr';
	$subject = 'PV DE REMISE PC PORTABLE';
	$body = "	<html>
					<i>Bonjour  </i><br />
					<i>Veuillez trouver en Pièce jointe le PV de remise de votre PC PORTABLE</i><br /><br />
					<i>Cordialement</i>					
				</html>";
	try 
	{		
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		$mail->CharSet = 'UTF-8';			
		$host = $mail->Host ="muz10-e1smtp-IN-CR-INT.zres.ztech:25";
		$mail->SetFrom($from, $from);
		$mailto = $mail->AddAddress($to, $to);
		//$mail->addAttachment('PDF/'.$_POST['NOM'].''.$_POST['PRENOM'].''.$_POST['MATRICULE'].'.pdf'); //Filename is optional
		$mail->Subject = $subject;
		// $mail->Body = $body; // Envoi du message direct en brut
		// Envoi du message en HTML
		$mail->MsgHTML($body);
		
		$mail->Send();
		
		echo $host;
		echo $mail->Host;
	}
	catch(Exception $e) {
		$message = 'erreur : <pre>'.var_export($e, true).'</pre>';
		echo $message;
	}
	
?>