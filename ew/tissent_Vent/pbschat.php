<?php
## PbsChat -- pbschat.php
## 入室画面
if (phpversion()>="4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

# IE＆Windowsの場合に色閲覧スクリプトを使う
if (stristr($HTTP_USER_AGENT, 'MSIE') and stristr($HTTP_USER_AGENT, 'Windows')) {
$Javas = "
<SCRIPT LANGUAGE='JavaScript1.1'>
<!--
function rcol(ccol) {
document.F.hc.value=ccol;
document.all.hgc.style.color=\"#\"+ccol;
}
-->
</SCRIPT>\n";
$onload = ' onLoad="rcol(document.F.hc.value)"';
}
include('set.php'); //メイン設定ファイルの読み込み
if (!file_exists($CFile)) { echo 'ご指定のチャットネームのチャットルームは存在しません。'; exit; }
require($CFile); //ルーム情報ファイルの読み込み
if (!file_exists($UFile)) {
	$fp = fopen($UFile, "w");
	fputs($fp, '');
	fclose($fp);
	chmod ($UFile, 0666);
	$Logupdate=0;
}
require($UFile); //ログファイル更新時刻の取得

if($rl>0){
	$ref="\n<META HTTP-EQUIV=\"refresh\" CONTENT=\"$rl;URL=$SFile?fn=$fn&rl=$rl&bell=$bell&lkt=$rtm\">";
}
if ($Free) {
	if (!UF_Joincheck($JFile)) {
		UF_FreeClear();
	}
	require($FFile);
}
include('header.php'); //ヘッダーファイルの読み込み



## クッキー取得
if (empty($Pbscckm)) { $Pbscckm = "<><><>".$HDcolor."<>0<>"; }
if (get_magic_quotes_gpc()) { $Pbscckm = stripslashes($Pbscckm); }
list($cnm, $cgk, $cid, $chc, $cbell, $cap) = explode('<>', $Pbscckm);
if (!empty($cbell)) $cbellc = " CHECKED"; //Cookieのベルチェック

## 発言色一覧
$HcList = "";
foreach ($Hcolor as $value) {
	$HcList .= '<INPUT TYPE="radio" NAME="hcl" VALUE="'.$value.'" ';
	if (stristr ($HTTP_USER_AGENT, 'MSIE') and stristr($HTTP_USER_AGENT, 'Windows')) {
		$HcList .= 'onClick="rcol(this.value)"';
	} else {
		$HcList .= 'onClick="document.F.hc.value=this.value"';
	}
	$HcList .= ' CLASS="checkform"><FONT COLOR="#'.$value.'">'.HGM.'</FONT>'."\n";
}


## HTML部分（タイトル・フォーム）の表示
echo $Header.$PBody.'<DIV ALIGN="right"><A HREF="'.BURL.'">'.BMES.'</A>';
if (!empty($single)) echo '<BR><A HREF="history.php?single=1">参加者履歴</A>';
echo '</DIV>'.$PTitle.'
<TABLE CELLPADDING="5" CELLSPACING="0">
<FORM NAME="F" ACTION="frame.php" METHOD="'.MTYPE.'">
<TR>
<TD VALIGN="top">'.$pinup.'</TD>
<TD VALIGN="top">';
if (!empty($Comment)) echo '<B>'.$Comment.'</B><HR>';
if ($Free) {
	echo '【部屋説明】'.$Finfo.'<br>';
	if ($Fdefault) {
		echo '
<b>部屋名　</b> <INPUT TYPE="text" SIZE="20" NAME="FTitle" VALUE="'.$Title.'"><br>
<b>部屋説明</b><INPUT TYPE="text" SIZE="80" NAME="Finfo" VALUE="'.$Finfo.'"><br>
<b>背景色　</b> <INPUT TYPE="text" SIZE="9" NAME="Fbgcolor" VALUE="'.$bgcolor.'">　<b>テキスト色</b> <INPUT TYPE="text" SIZE="9" NAME="Ftext" VALUE="'.$text.'"><br>';
	}
	echo '<hr>';
}
echo '
<B>名前</B> <INPUT TYPE="text" NAME="nm" SIZE="16" VALUE="'.$cnm.'" CLASS="textform"><BR>
<B>'.EXT.'</B> <INPUT TYPE="text" NAME="gk" SIZE="80" VALUE="'.$cgk.'" CLASS="textform">&nbsp;';
if (ID) { //ID入力フォーム
	echo ' <B>ID</B> <INPUT TYPE="text" NAME="id" SIZE="4" VALUE="'.$cid.'" CLASS="textform">&nbsp;&quot;&gt;&quot;にリンク';
}
echo '<BR>
<B><SPAN ID="hgc">発言色（#無し）</SPAN></B> <INPUT TYPE="text" NAME="hc" SIZE="7" VALUE="'.$chc.'" MAXLENGTH="6" onFocus="this.select()" onChange="if(this.value.match(/^[0-9a-fA-F]{6}$/)){co='."'#'".'+this.value;document.all.hgc.style.color=co}" CLASS="textform">［<a href="'."javascript:WIN=window.open('colorlist.php','ColorList','width=560,height=300,scrollbars=yes,resizable=yes');WIN.focus()".'">ColorList</a>］
'.$HcList.'<BR>
<B>リロード時間（0で手動）</B> <SELECT NAME="rl" CLASS="selectform"><OPTION VALUE="0">0<OPTION VALUE="20">20<OPTION VALUE="30" SELECTED>30<OPTION VALUE="45">45<OPTION VALUE="60">60</SELECT>&nbsp;
<B>表示行数</B> <SELECT NAME="sl" CLASS="selectform"><OPTION VALUE="20">20<OPTION VALUE="50" SELECTED>50<OPTION VALUE="100">100<OPTION VALUE="200">200</SELECT>&nbsp;
<B>Whisper</B> <INPUT TYPE="checkbox" NAME="ws" VALUE="1" CHECKED CLASS="checkform">OK　
<B>ベル</B> <INPUT TYPE="checkbox" NAME="bell" VALUE="1"'.$cbellc.' CLASS="checkform">';
if ($Password) { //パスワード入力フォーム
	echo '<BR><B>入室パスワード</B> <INPUT TYPE="password" NAME="key" size="10" maxlength="20" CLASS="textform">';
}if (ARCPASS) echo '<br><b>書庫ファイル編集用パスワード</b> <input type="password" name="ap" size="10" maxlength="20" value="'.$cap.'" class="textform">';
echo '<BR>
<INPUT TYPE="hidden" NAME="fn" VALUE="'.$fn.'">
<INPUT TYPE="submit" VALUE=" 入室 " CLASS="buttonform">
入室ログを表示しない<INPUT TYPE="checkbox" NAME="em" VALUE="1" CLASS="checkform">（入退室履歴は残ります）
</TD></TR>
</FORM>
</TABLE>';

if ($Password) {
	if (empty($Fixkey)) {
		if (!UF_Joincheck($JFile)) {
			UF_Keywrite("");
		}
		require($PFile); //パスワードファイル読み込み
		if (empty($Freekey)) {
			echo FREEPMES1.'<br>';
		} else {
			echo FREEPMES2.'<br>';
		}
	} else {
		echo FIXPMES.'<br>';
	}
}
if ($Clear) {
	if (!UF_Joincheck($JFile) and (filesize($LFile)>20)) {
		UF_LogClear($LFile);
	}
	echo CLEARMES.'<br>';
}

## ログ表示
if ($NoRom) {
	echo '<HR>'.NOROMMES.'<HR>'.$Footer;
} else {
	echo '
<TABLE CELLPADDING="0" CELLSPACING="0" ALIGN="right">
<FORM ACTION="'.$SFile.'" METHOD="'.MTYPE.'">
<TR><TD>';
	if ($rl>0) echo '【自動ROMモード：ON】&nbsp;';
	if (empty($rl)) $rl = 60;
	if ($bell) $abellc = " CHECKED";
	echo '
<B>ベル</B> <INPUT TYPE="checkbox" NAME="bell" VALUE="1"'.$abellc.' CLASS="checkform">
<B>リロード</B> <SELECT NAME="rl" CLASS="selectform"><OPTION VALUE="'.$rl.'" SELECTED>'.$rl.'<OPTION VALUE="120">120<OPTION VALUE="180">180<OPTION VALUE="300">300</SELECT>
<INPUT TYPE="hidden" NAME="fn" VALUE="'.$fn.'">
<INPUT TYPE="submit" VALUE="自動ROMモード" CLASS="buttonform">
</TD></TR>
</FORM>
</TABLE>';
	## 参加者の取得
	UF_ShowJoin("", $HDcolor, '', '', 0, 0, 1, $bell);
	echo '<BR CLEAR="all"><HR>';

	if (empty($sl)) { $sl = ROMSL; }
	UF_ShowLog($sl, "");
}
?>