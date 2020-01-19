<?php

//sending email verification
		$to = $email;
			$subject = "AIRHCO Intensive Web development Bootcamp";
			$message = "Your Account:
					Email: ".$email."
					Password: ".$_POST['password']."
				";
			//dont forget to include content-type on header if your sending html
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: noreply@airhco.org". "\r\n" ;

		mail($to,$subject,$message,$headers);
		
?>