<?php
## PbsChat -- ktset.php
## 携帯用関数

## 設定項目　ここから↓ -------------------------------------------- #

## チャットルームからの戻り先URL（絶対パスまたは相対パスで指定）
$BURL = "kt.php";

## 戻り先URLへのリンク文字列
$BMES = "戻る";

## ROM表示行数
$ROMSL = 5;

## 設定項目　ここまで↑ -------------------------------------------- #

## ヘッダーの設定
$Header = '<?xml version="1.0" encoding="Shift_JIS"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">
<html><head><title>'.$Title.'</title></head><body bgcolor="'.$bgcolor.'" text="'.$text.'" link="'.$link.'" vlink="'.$vlink.'">';

## フッターの指定
$Footer = 'PbsChat2.5 for kt</body></html>';


## 関数定義

## ログ表示
function KT_ShowLog($sl) {
global $EMES, $OMES, $LFile, $Footer;

$fp = fopen($LFile, "r");
$linecount = 1;
while (!feof($fp)) {
	if ($linecount > $sl) { break; }
	if(chop($buffer) == "*/?>") { break; }
	$buffer = fgets($fp, 4096);
	list($lhc, $lgk, $lid, $lnm, $lhg, $lwsa, $lht, $lpr) = split('<>', chop($buffer));
	if ($lpr == 5) $lpr = 2;
	switch ($lpr) {
		case 1: //入室
			$EMES = str_replace('ROOM', $lhg, $EMES);
			list($Emes1, $Emes2) = split(",", $EMES);
			echo $Emes1.$lnm.$Emes2.'<hr />';
			$linecount++;
			break;
		case 2: //通常発言
			echo '<font color="'.$lhc.'">'.$lnm.'&gt;'.$lhg.'</font><hr />';
			$linecount++;
			break;
		case 3: //Whisper
			break;
		case 4: //退室
			$OMES = str_replace('ROOM', $lhg, $OMES);
			list($Omes1, $Omes2) = split(",", $OMES);
			echo $Omes1.$lnm.$Omes2.'<hr />';
			$linecount++;
			break;
	}
}
fclose($fp);
echo $Footer;
}


?>