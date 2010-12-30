<?php  
  /**
	    * o------------------------------------------------------------------------------o
	    * | This package is licensed under the Phpguru license. A quick summary is       |
	    * | that for commercial use, there is a small one-time licensing fee to pay. For |
	    * | registered charities and educational institutes there is a reduced license   |
	    * | fee available. You can read more  at:                                        |
	    * |                                                                              |
	    * |                  http://www.phpguru.org/static/license.html                  |
	    * o------------------------------------------------------------------------------o
	    *
	    * © Copyright 2008,2009 Richard Heyes
	    */
	
	    require_once('Rmail.php');
	    
	    
	    /*
	     * Initailisation des variables
	     */
	    $from='Contact <contact@thisisradioclash.org>';
	    $sujet="test hotmail";
	    $mail_text="Un texte tout simple";
	    $mail_html="<html><head><title>Check dat rastaman</title></head><body><p style=\"color: red;\">Une texte en HTML eheh</p></body></html>";
	    $addresses = array();
	    $addresses[]="contact@thisisradioclash.org";
	    $addresses[]="divag@free.fr";
	    $addresses[]="radioclash@hotmail.fr";
	    
	    $mail = new Rmail();
	
	    /**
	    * Set the from address of the email
	    */
	    $mail->setFrom($from);
	    
	    /**
	    * Set the subject of the email
	    */
	    
	    $mail->setSubject($sujet);
	    
	    /**
	    * Set high priority for the email. This can also be:
	    * high/normal/low/1/3/5
	    */
	    $mail->setPriority('high');
	
	    /**
	    * Set the text of the Email
	    */
	    //$mail->setTextCharset("utf-8");
	    $mail->setText($mail_text);
	    
	    /**
	    * Set the HTML of the email. Any embedded images will be automatically found as long as you have added them
	    * using addEmbeddedImage() as below.
	    */
	    $mail->setHTML($mail_html);
	    	    
	    /**
	    * Set the delivery receipt of the email. This should be an email address that the receipt should be sent to.
	    * You are NOT guaranteed to receive this receipt - it is dependent on the receiver.
	    */
	    //$mail->setReceipt('webmaster@musicdestock.fr');
	    
	    /**
	    * Add an embedded image. The path is the file path to the image.
	    */
	    // $mail->addEmbeddedImage(new fileEmbeddedImage('background.gif'));
	    
	    /**
	    * Add an attachment to the email.
	    */
	    // $mail->addAttachment(new fileAttachment($fichier_xml));
	
	    /**
	    * Send the email. Pass the method an array of recipients.
	    */	  
	    $result  = $mail->send($addresses);	    	
		if($result) 
		{
			echo '<br /> '.$i.' >> Un mail a &eacute;t&eacute; envoy&eacute; &agrave; '; print_r($addresses);        
		}
 		else
 		{
 			echo '<br />'.$i.'Le mail n\'a pu &ecirc;tre envoy&eacute; &agrave; '; print_r($addresses);    
 		}
?>     