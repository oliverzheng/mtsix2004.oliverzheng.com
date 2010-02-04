<?
$in_php = true;
$page_maintitle = "Contact";
$page_subtitle = "";

require_once("./inc/core.php");

// Disable email
if(false && !empty($_GET['sent'])) {
	require_once("./inc/header.php");
?>
<h2>Contact</h2>
<p>Your message has been sent.</p>
<p><a href="/index.php">Click here to return to the home page.</a></p>
<?
///// MESSAGE SENT /////
} else {
	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
///// SEND THE EMAIL AND REDIRECT! /////
		$to = "olivereatsolives@gmail.com";
		$subject = "Message sent from mtsix.com to Oliver";
		$message = $_POST['message'];
		if(!empty($_POST['website'])) {
			$message .= "\r\n<br />Sender's website: ".$_POST['website'];
		}
		$message .= "\r\n<br />Sender's IP: ".$_SERVER['REMOTE_ADDR'];
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

		$headers .= "From: ".$_POST['name']." <".$_POST['email'].">\r\n";
		if($_POST['cc'] == 'yes') {
			$message .= "\r\n<br />The message has been CC'ed to the sender";
			$headers .= "Cc: ".$_POST['email']."\r\n";
		}
		if(isset($_SESSION['required_contact'])) {
		    unset($_SESSION['required_contact']);
			
			/*** Don't even bother emailing. this is an archive page. Spammers get to it. ***/
		    // if(mail($to, $subject, $message, $headers)) {
			header("Location: /contact/sent/");
			exit();
		    //}
		} else {
			require_once("./inc/header.php");
			echo "error sending email";
		}
	} else {
		$_SESSION['required_contact'] = 1;
      require_once("./inc/header.php");

///// SHOW THE FORM /////
?>
<h2>Contact</h2>
<p>If you have any questions or requests, please feel free to email me through the contact form below. In case you would like to email me through an email client program, please <a href="javascript:emailMe('oliver','mtsix.com');void(0);">click here</a> to email me.</p>
<p>Please keep in mind that I may not be able to reply right away.<p>

<fieldset class="contact"><legend>Contact Form</legend>

<form action="/contact/" method="post" name="contact" onSubmit="return checkContact(this.name, this.email, this.message, this.submit);">
<p><label for="name">Name: (required)</label><br />
<input type="text" name="name" id="name" class="text_required" /></p>
<p><label for="email">Email: (required)</label><br />
<input type="text" name="email" id="email" class="text_required" /></p>
<p><label for="website">Website: (optional)</label><br />
<input type="text" name="website" id="website" class="text_optional" /></p>
<p><label for="message">Message: (required)</label><br />
<textarea rows="5" cols="40" name="message" id="message" class="required"></textarea></p>
<p><input type="checkbox" name="cc" id="cc" value="yes" class="checkbox" /> <label for="cc">CC this message to yourself.</label></p>
<p>Your IP address is <?=$_SERVER['REMOTE_ADDR']; ?>. So please be nice. :)</p>
<p><input type="Submit" value="Email me!" name="submit" class="submit" /></p>
</form>
</fieldset>
<?
	}
}
$sidebar_html =<<<END_HTML
<p>Contact</p>
<ul>
	<li><a href="/contact/">Contact Form</a></li>
</ul>
END_HTML;

require_once ("./inc/footer.php");
?>
