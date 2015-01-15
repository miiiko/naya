<?php
## PbsChat -- history.php
## 参加履歴表示
if (phpversion() >= "4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

include('set.php');

## ページタイトル
$Title = "参加履歴";

## ページカラー設定
$bgcolor = "#FFFFFF";
$text = "#666666";
$link = "#CCCCCC";
$vlink = "#999999";
$alink = "#CCCCCC";

include('header.php');


## タイトルの表示
echo $Header.$PBody.'<DIV ALIGN="right"><A HREF="'.BURL.'">'.BMES.'</A>';
if (!empty($single)) echo '<BR><A HREF="javascript:history.back()">前画面に戻る</A>';
echo '</DIV>'.$PTitle;

## 参加履歴表示

if (file_exists($HFile)) {
	$HData = file($HFile);
	foreach ($HData as $value) {
		list($lfn, $lTitle, $lip, $lhc, $lgk, $lid, $lnm, $lhg, $lwsa, $lht, $lpr) = split('<>', chop($value));
		switch ($lpr) {
			case 1:
				list($Emes1, $Emes2) = split(",", $EMES);
				echo "<B><A HREF=\"$SFile?fn=$lfn\">$lTitle</A> : </B><FONT COLOR=\"#$lhc\"><B>";
				if ($lgk == "") { echo $lnm;
				} else { echo '<A HREF="'.ELINK."$lgk\"><FONT COLOR=\"#$lhc\">$lnm</FONT></A>"; }
				echo "</B></FONT>".$Emes2." ($lht)";
				if (IPS) { echo $lip; }
				echo "<BR>";
				break;
			case 4:
				list($Omes1, $Omes2) = split(",", $OMES);
				echo "<B><A HREF=\"$SFile?fn=$lfn\">$lTitle</A> : </B><FONT COLOR=\"#$lhc\"><B>".$lnm."</B></FONT>".$Omes2." ($lht)";
				if (IPS) { echo $lip; }
				echo "<BR>";
				break;
		}
	}
}
echo '<HR>'.$Footer;

?>