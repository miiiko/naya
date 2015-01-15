<?php
## PbsChat -- frame.php
## フレームページの表示
if (phpversion() >= "4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

include('set.php');
require($CFile);
if ($Free) {
	if (!empty($FTitle)) {
		if (!UF_Joincheck($JFile)) UF_FreeSet();
	}
	require($FFile);
}
include('header.php');

## 変数処理
UF_HgDel($nm);
UF_HgDel($gk);
UF_HgEsc($id);
if (empty($hc)) {
	if (empty($hcr)) {
		$hc = $HDcolor;
	} else {
		$hc = $hcr;
	}
}
if (empty($ws)) $ws = 0;
if (empty($bell)) $bell = 0;
if (empty($em)) $em = 0;

$errormsg = "";
## 名前と発言色のチェック
if (empty($nm)) $errormsg.= "<BR>名前を入力してください。";
if (!empty($hc) and !eregi("[0-9A-F]{6}", $hc)) $errormsg.= "<BR>発言色は6桁の16進数で入力してください。<BR>例：7070EE";

## パスワード処理
if ($Password) {
	if (empty($key) or !eregi("^[0-9A-Z]+$", $key)) {
		$errormsg .= "<BR>パスワードは半角英数で入力してください。";
	} else {
		if (empty($Fixkey)) {
			require($PFile);
			if (empty($Freekey)) {
				UF_Keywrite($key);
			} else if ($Freekey != $key) {
				$errormsg .= "<BR>パスワードが一致しません。";
			}
		} else {
			if ($Fixkey != $key) $errormsg .= "<BR>パスワードが一致しません。";
		}
	}
}
if (!empty($ap) && !eregi("^[0-9A-Z]+$", $ap)) $errormsg .= "<BR>パスワードは半角英数で入力してください。";
if (!empty($errormsg)) {
	echo $Header.$PBody.$PTitle."エラー：".$errormsg.'<BR><input type="button" value="戻る" onClick="history.back()"><BR><BR><HR>'.$Footer;
	exit;
}

## クッキーの送信
setcookie("Pbscckm", "$nm<>$gk<>$id<>$hc<>$bell<>$ap", time()+(30*24*60*60));
setcookie("Pbscckb", time(), time()+(30*24*60*60));

$nm = urlencode($nm);
$gk = urlencode($gk);
if (!empty($id)) $id = urlencode($id);

echo $Header."
<FRAMESET ROWS=\"180,*\">
<FRAME SRC=\"top.php?fn=$fn&nm=$nm&gk=$gk&id=$id&hc=$hc&rl=$rl&sl=$sl&ws=$ws&bell=$bell&ap=$ap\" NAME=\"top\">
<FRAME SRC=\"under.php?fn=$fn&nm=$nm&gk=$gk&id=$id&hc=$hc&rl=$rl&sl=$sl&ws=$ws&pr=1&em=$em&ap=$ap\" NAME=\"under\">
</FRAMESET>
<NOFRAMES>".$PBody."このページはフレーム対応のブラウザでご覧ください。</BODY></NOFRAMES>
</HTML>";

?>