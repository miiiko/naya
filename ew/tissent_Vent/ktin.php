<?php
## PbsChat -- ktin.php
## チャット画面
if (phpversion() >= "4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

include('set.php');
require($CFile);
include('ktset.php');

UF_HgDel($nm);
UF_HgEsc($hg);
$ws = 0;

## 名前のチェック
if ($nm == "") {
	$errormsg.= "";
	echo $Header.$Title.'<hr />名前を入力してください。<a href="ktchat.php?fn='.$fn.'">戻る</a><hr />'.$Footer;
	exit;
}

$errormsg = "";
if ($Password) {
	if (empty($key) or !eregi("^[0-9a-zA-Z]+$", $key)) {
		$errormsg .= "パスワードは半角英数で入力してください。";
	} else {
		if (empty($Fixkey)) {
			require($PFile);
			if (empty($Freekey)) {
				UF_Keywrite($key);
			} else if ($Freekey != $key) {
				$errormsg .= "パスワードが一致しません。";
			}
		} else {
			if ($Fixkey != $key) $errormsg .= "パスワードが一致しません。";
		}
	}
}
if (!empty($errormsg)) {
	echo $Header.$Title.'<hr />'.$errormsg.'<a href="ktchat.php?fn='.$fn.'">戻る</a><hr />'.$Footer;
	exit;
}

if(empty($pr)){
	if(empty($hg)){
		$pr = 0;
	}else if(empty($wsa)) {
		if($di) UF_AddDice($hg,$di);
		$pr = 2;
		$Stext="$hc<>$gk<>$id<>$nm<>$hg<><>$today<>2\n";
	}
}else if($pr == 1){
	$Stext="$hc<>$gk<>$id<>$nm".MOBILE."<>$Title<><>$today<>1\n";
}

if(!empty($dl)){
	UF_DelLog($nm);
}
if($pr && ($pr!=3)){
	UF_WriteLog($Stext,$pr,$REMOTE_ADDR);
}


echo $Header.$PBody.$Title."<hr />";

echo '<form action="ktin.php" method="post">
発言<input type="text" name="hg" size="8"><br />
<input type="hidden" name="hc" value="'.$hc.'">
<input type="hidden" name="fn" value="'.$fn.'">
<input type="submit" value="発言/更新"><br />
表示<input type="text" name="sl" SIZE="2" value="'.$sl.'">行
<input type="hidden" name="nm" value="'.$nm.'">
<input type="hidden" name="key" value="'.$key.'">
<a href="ktout.php?fn='.$fn.'&nm='.$nm.'&hc='.$hc.'">退室</a></form><hr />';
UF_ShowJoin($nm,$hc,$gk,$id,$ws,2,0,0);
KT_ShowLog($sl);

?>