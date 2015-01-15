<?php
## PbsChat -- out.php
## 退出処理
if (phpversion()>="4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

include('set.php'); $ref="\n<META HTTP-EQUIV=\"refresh\" CONTENT=\"3600;URL=pbschat.php?fn=$fn\">";
require($CFile);
if ($Free) require($FFile);
include('header.php');


if (!empty($nm)) {
	UF_HgEsc($nm);
	## 参加者リストから名前を削除
	$entry = 0;
	$Jdata = file($JFile);
	$fp = fopen($JFile, "w");
	if (FILELOCK) { flock($fp, LOCK_EX); }
	fputs($fp, "<?php exit; /*\n");
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
		UF_WriteLog("$hc<><><>$nm<>$Title<>$REMOTE_ADDR<>$today<>4\n",4);
		if (!UF_Joincheck($JFile)) UF_DelAllLog($LFile);
	} else if ($entry) {
		UF_WriteLog("$hc<><><>$nm<>$Title<>$REMOTE_ADDR<>$today<>4\n",4); //退室メッセージの書き込み
	}
}

## 退室画面の表示
echo $Header.$PBody.$PTitle.'退室しました。<BR><BR><A HREF="'.BURL.'">'.BMES.'</A><BR><BR>';

if ($NoRom or $Password) {//ROM禁止
	echo '<HR>'.NOROMMES.'<HR>'.$Footer;
} else {
	## 更新ボタンの表示
	echo '<FORM ACTION="out.php" METHOD="'.MTYPE.'">
<TABLE CELLPADDIN="0" CELLSPACING="0" ALIGN="right"><TR><TD VALIGN="bottom">現在時刻： '.$today.'</TD><TD>
<INPUT TYPE="hidden" NAME="fn" VALUE="'.$fn.'"><INPUT TYPE="submit" VALUE="更新" CLASS="buttonform">
</TD></TR></TABLE></FORM><BR CLEAR="all"><HR SIZE="5">';

	## ログの表示
	UF_ShowLog(30, "", 0);
}

?>