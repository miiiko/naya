<?php
$objMailForm = new clsMailForm();
$objMailForm->sendMail();


class clsMailForm {
	private $to;
	private $subject;
	private $message;
	
	public function __construct() {
		$this->to = 'naya@clovernotes.net';
		$this->subject = 'メールフォーム祭り';
		$this->message = $_POST['message'];
		return;
	}
	
	public function sendMail() {
		$resultSendMail = null;
		$resultSendMail = mb_send_mail(
			$this->to,
			mb_convert_encoding($this->subject, 'ISO-2022-JP', 'AUTO'),
			mb_convert_encoding($this->message, 'ISO-2022-JP', 'AUTO')
		);
		
		echo '以下のメッセージを送信しました。<br />';
		echo '<br />';
		echo str_replace("\n", '<br />', $this->message);
		echo '<br /><br />';
		echo '<a href="http://clovernotes.net/naya/index.html">戻る</a>';
		
		return $resultSendMail;
	}
}
?>