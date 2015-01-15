<?php
## PbsChat -- ktchat.php
## 入室フォーム表示
if (phpversion() >= "4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

include('set.php');
require($CFile);
include('ktset.php');

echo $Header.$Title.'
<a href="'.$BURL.'">'.$BMES.'</a><hr />
<form action="ktin.php" method="post">
名前<input type="text" name="nm" size="8" /><br />
発言色<select name="hc">
<option value="000000" selected>黒</option>
<option value="ff0000">赤</option>
<option value="0000ff">青</option>
<option value="009900">緑</option>
<option value="ff9933">橙</option>
<option value="9900cc">紫</option>
<option value="ff66cc">桃</option>
</select><br />
表示<select name="sl"><option value="5">5<option value="10">10<option value="20">20</select>行<br />
<input type="hidden" name="pr" value="1">
<input type="hidden" name="fn" value="'.$fn.'">';
if ($Password) {
	echo 'Pass<input type="password" name="key" size="8" maxlength="10"><br />';
}
echo '<input type="submit" value="入室"></form><hr />';

if ($Password) {
	if (empty($Fixkey)) {
		if (!UF_Joincheck($JFile)) {
			UF_Keywrite("");
		}
		require($PFile);
		if (empty($Freekey)) {
			echo FREEPMES1.'<br />';
		} else {
			echo FREEPMES2.'<br />';
		}
	} else {
		echo FIXPMES.'<br />';
	}
	echo '<hr />';
}

if ($Clear) {
	if (!UF_Joincheck($JFile)) {
		UF_LogClear($LFile);
	}
	echo CLEARMES.'<hr />';
}

## ログ表示
if ($NoRom) {
	echo NOROMMES.'<hr />'.$Footer;
} else {
	KT_ShowLog($ROMSL);
}

?>