<?php
## PbsChat -- ktout.php
## 退室画面
if (phpversion() >= "4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

include('set.php');
require($CFile);
include('ktset.php');

if (!empty($nm)) {
	UF_HgEsc($nm);
	## 参加者リストから名前を削除
	$entry = 0;
	$Jdata = file($JFile);
	$fp = fopen($JFile, "w");
	fputs($fp, "<?php/*\n");
	if (FILELOCK) { flock($fp, LOCK_EX); }
	foreach ($Jdata as $value) {
		list($jnm, $jhc, $jip, $jws, $jtm, $jpr) = explode('<>', $value);
		if (empty($jtm)) continue; //コメント行等をスキップ
		if ($jnm != $nm) { // 退室者の名前は書き込まない
			fputs($fp, $value);
		}
		$entry = 1;
	}
	fputs($fp, "*/?>\n");
	if (FILELOCK) { flock($fp, LOCK_UN); }
	fclose($fp);

	if ($Clear) {//全発言削除
		UF_WriteLog("$hc<><><>$nm".MOBILE."<>$Title<><>$today<>4\n",4); //退室メッセージの書き込み
		if (!UF_Joincheck($JFile)) UF_DelAllLog($LFile);
	} else if ($entry) {
		UF_WriteLog("$hc<><><>$nm".MOBILE."<>$Title<><>$today<>4\n",4); //退室メッセージの書き込み
	}
}

echo $Header.$PBody.$Title.'<hr />';
echo '退室しました。<br /><a href="kt.php">戻る</a><hr />'.$Footer;

?>