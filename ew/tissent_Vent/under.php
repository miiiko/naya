<?php
## PbsChat -- under.php
## 下部の表示
if (phpversion() >= "4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

include('set.php');

UF_HgEsc($nm);
UF_HgEsc($gk);
UF_HgEsc($hg); $hg = str_replace("\n", " ", $hg); $hg = str_replace("\r", " ", $hg);

$nm_en=urlencode($nm);
if($rl>0){
	$ref="\n<META HTTP-EQUIV=\"refresh\" CONTENT=\"$rl;URL=under.php?fn=$fn&sl=$sl&rl=$rl&hc=$hc&ws=$ws&nm=$nm_en&bell=$bell\">";
} else {
	$ref="";
}

require($UFile);
require($CFile);
if ($Free) require($FFile);
if (!empty($Dice)) require($Dice);
include('header.php');

if(!empty($hc) && !(eregi("[0-9A-F]{6}",$hc))){
	echo $Header.$PBodyU.'<BR>発言色は6桁の16進数で入力してください。<BR>例：7070EE<BR><BR>発言内容：　'.UF_HgEsc($hg).'<BR><BR><HR>'.$Footer;
	exit;
}

if(empty($nm)){
	echo $Header.$PBodyU.$Footer;
	exit;
}

## URL自動リンク
$hg = preg_replace("/(http\:\/\/[\w\.\~\-\/\?\&\+\=\:\@\%\;\#\%]+)/","<A HREF=\"$1\" TARGET=\"_blank\">$1</a>", $hg);

#clearコマンド処理
if (CLEAR) {
	if($hg == 'clear'){
		UF_DelLog($LFile, $nm, 0);
		$hg="";
		$di=0;
	}
	if($hg == 'allclear'){
		UF_DelAllLog($LFile);
		$hg="";
		$di=0;
	}
}

if(empty($pr)){
	if(empty($hg)){
		$pr = 0;
		if($di) UF_AddDice($hg,$di); if($di2) UF_AddDice2($hg,$di2); if($di3) UF_AddDice3($hg,$di3); if($di4) UF_AddDice4($hg,$di4); if($di5) UF_AddDice5($hg,$di5); //発言がなくてもダイス処理
		if (!empty($hg)) {
			$pr = 2;
			$Stext="$hc<>$gk<>$id<>$nm<>$hg<><>$today<>5<>$ap<>".microtime()."\n"; //ダイスはpr5
		}
	}else if(empty($wsa)) { //Whisperかどうかの判定
		$pr = 2; $diceflag = 0;
		if($di) { UF_AddDice($hg,$di); $diceflag = 1;}
		if($di2) { UF_AddDice2($hg,$di2); $diceflag = 1;} if($di3) { UF_AddDice3($hg,$di3); $diceflag = 1;}
		if($di4) { UF_AddDice4($hg,$di4); $diceflag = 1;} if($di5) { UF_AddDice5($hg,$di5); $diceflag = 1;}
		if (!empty($diceflag) and empty($dpr)) { //$dprが1だった場合は通常発言として扱う
			$Stext="$hc<>$gk<>$id<>$nm<>$hg<><>$today<>5<>$ap<>".microtime()."\n"; //ダイスが有効だった場合
		} else { $Stext="$hc<>$gk<>$id<>$nm<>$hg<><>$today<>2<>$ap<>".microtime()."\n"; } //通常発言
	}else{
		$pr = 3;
		UF_HgEsc($wsa);
	}
}else if($pr == 1){
	$Stext="$hc<>$gk<>$id<>$nm<>$Title<>$REMOTE_ADDR<>$today<>1<>$ap<>".microtime()."\n";
}

#発言削除
if(!empty($dl)){
	UF_DelLog($LFile, $nm, 1);
}

#ログ書き込み
if($pr && ($pr!=3)){
	UF_WriteLog($Stext,$pr);
}

echo $Header.$PBodyU.'
<TABLE ALIGN="right"><TR><TD>現在時刻： '.$today."　<A HREF=\"under.php?fn=$fn&sl=$sl&rl=$rl&hc=$hc&ws=$ws&nm=$nm_en&bell=$bell&key=$key\">更新</A></TR></TABLE>";

#ログ表示
if($pr!=3){
	UF_ShowJoin($nm,$hc,$gk,$id,$ws,1,1,$bell);
	echo '<BR CLEAR="all"><HR>';
	UF_ShowLog($sl,$nm);
	exit;
} else {
	UF_ShowJoin($nm,$hc,$gk,$id,$ws,3,1,$bell);
	echo '<BR CLEAR="all"><HR>';
}

#Whisper
if($wsallow==1){ #if(($wsallow==1) or ($wsa == 'ALL')){ //全員相手のWhisを許可する場合は#までを削除する
	if($di) UF_AddDice($hg,$di); if($di2) UF_AddDice2($hg,$di2); if($di3) UF_AddDice3($hg,$di3); if($di4) UF_AddDice4($hg,$di4); if($di5) UF_AddDice5($hg,$di5);
	UF_WriteLog("$hc<><><>$nm<>$hg<>$wsa<>$today<>3<>$ap<>".microtime()."\n",3);
	UF_ShowLog($sl,$nm);
}else{
	if($wsallow){
		$wsae='入力されたWhisper相手「'.$wsa.'」は現在参加者におりません。';
	}else{
		$wsae='「'.$wsa.'」さんへのWhisper発言は許可されていません。';
	}
	echo $wsae.'<BR>発言内容：　'.$hg.'<BR><HR>'.$Footer;
}
?>