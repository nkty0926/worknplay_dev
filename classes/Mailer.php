<?php

require_once 'libraries/PHPMailer/PHPMailerAutoload.php';

/**
 * Mailer
 */
class Mailer {

	// Mailer instance
	public $mail;

	/**
	 * Constructor
	 */
	public function __construct() {

		// Create a new PHPMailer instance
		$this->mail = new PHPMailer();
		$this->mail->isHTML(true);
		$this->mail->CharSet = 'UTF-8';
		$this->mail->Encoding = 'base64';

		// Tell PHPMailer to use SMTP
		$this->mail->isSMTP();
		// Set the SMTP port number - likely to be 25, 465 or 587
		$this->mail->Port = 465;
		// Set the encryption system to use - ssl (deprecated) or tls
		$this->mail->SMTPSecure = 'ssl';
		// Whether to use SMTP authentication
		$this->mail->SMTPAuth = true;

		// Custom connection options
		$this->mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_depth' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		/* GOOGLE */
		$this->mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$this->mail->Username = 'worknplayads@gmail.com'; // Username to use for SMTP authentication
		$this->mail->Password = 'worknplay19'; // Password to use for SMTP authentication
		$this->mail->setFrom('worknplayads@gmail.com', 'WorknPlay'); // Set who the message is to be sent from
		$this->mail->addReplyTo('worknplayads@gmail.com', 'WorknPlay'); // Set an alternative reply-to address

		/* NAVER */
		// $this->mail->Host = 'smtp.naver.com';
		// $this->mail->Username = 'jbj0728@naver.com';
		// $this->mail->Password = '';
		// $this->mail->setFrom('jbj0728@naver.com', 'WorknPlay');
		// $this->mail->addReplyTo('jbj0728@naver.com', 'WorknPlay');
	}

	/**
	 * Send Mail
	 *
	 * @param string $address
	 * @param string $name
	 * @param string $subject
	 * @param string $body
	 */
	public function send($address, $name, $subject, $body) {
		if (!isset($address) || empty($address)) {
			if ($_SESSION['DEBUG_MODE']) {
				$address = "jbj0728@naver.com";
			} else {
				$address = "worknplayads@gmail.com";
			}
		}
		$this->mail->addAddress($address, $name); // Set who the message is to be sent to
		$this->mail->Subject = $subject; // Set the subject line
		$this->mail->Body = $body; // Replace the plain text body with one created manually
		$this->mail->send(); // send the message, check for errors
	}

	/**
	 * Test Mail
	 *
	 * @param string $address
	 * @param string $name
	 * @param string $subject
	 * @param string $body
	 */
	public function test($address, $name, $subject, $body) {
		if (!isset($address) || empty($address)) {
			if ($_SESSION['DEBUG_MODE']) {
				$address = "jbj0728@naver.com";
			} else {
				$address = "worknplayads@gmail.com";
			}
		}

		echo $body;

		echo "<p>" . date('Y-m-d H:i:s') . " : start</p>";

		// Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$this->mail->SMTPDebug = 2;

		// Ask for HTML-friendly debug output
		$this->mail->Debugoutput = 'html';

		$this->mail->addAddress($address, $name);
		$this->mail->Subject = $subject;
		$this->mail->Body = $body;
		if ($this->mail->send()) {
			echo "<p>Message sent!</p>";
		} else {
			echo "<p>Mailer Error: " . $this->mail->ErrorInfo . '</p>';
		}

		echo "<p>" . date('Y-m-d H:i:s') . " : done</p>";
	}
}
