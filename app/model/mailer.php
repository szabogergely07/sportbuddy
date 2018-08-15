<?php

namespace app\model;

use phpmailer\PHPMailer;
use phpmailer\Exception;

class mailer {

	public function __construct($email, $name, $subject, $body) {
		// Send registration confirmation email
		$mail = new PHPMailer();    
		// Passing `true` enables exceptions

	    //Server settings
	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
	    $mail->isSMTP(true);                                      // Set mailer to use SMTP
	    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = 'szabogergely07@gmail.com';                 // SMTP username
	    $mail->Password = GMAIL_PASS;                           // SMTP password
	    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 465;                                    // TCP port to connect to

	    $mail->setFrom('sportbuddy@sportbuddy.com', 'SportBuddy');
	    $mail->addAddress($email, $name);
	    $mail->addBCC('szabogergely07@gmail.com', 'Greg');          // Add a recipient
	    $mail->addReplyTo('szabogergely07@gmail.com', 'Information');
	    
	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = $subject;
	    $mail->Body    = $body;
	    $mail->AltBody = $body;

	    $mail->send();
	}




}