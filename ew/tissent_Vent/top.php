<?php
## PbsChat -- top.php
## 上部の表示
if (phpversion() >= "4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

$Javas = '
<SCRIPT LANGUAGE="JavaScript">
<!--
function hgclear() {
self.document.F.dl.checked = false;
if (document.F.hg.value != "") {
	self.document.F.hg.value = "";
}
self.document.F.hg.focus();
}
//-->
</SCRIPT>';

$onload = ' onLoad="document.F.hg.focus()"';


include('set.php');
require($CFile);
if ($Free) require($FFile);
if (!empty($Dice)) require($Dice);
include('header.php');

UF_HgDel($nm);
UF_HgDel($gk);
if ($bell) $bellc = " CHECKED";

echo $Header.$PBodyT.'
<TABLE CELLPADDING="0" CELLSPACING="0">
<FORM NAME="F" ACTION="under.php" METHOD="'.MTYPE.'" TARGET="under" onSubmit="setTimeout(&quot;hgclear()&quot;,10)">
<TR><TD>



<B>名前</B> <FONT COLOR="#'.$hc.'">'.$nm.'</FONT>　||
<B>直前の発言を削除</B><INPUT TYPE="checkbox" NAME="dl" VALUE="1" CLASS="checkform">';

if ($topmode == "long") { // 長文モード
	echo '<br>
<B>発言</B> <textarea NAME="hg" rows="7" cols="80" CLASS="textform"></textarea>';
} else {
	echo '<br>
<B>発言</B> <INPUT TYPE="text" NAME="hg" SIZE="86" CLASS="textform">';
}
echo '<INPUT TYPE="submit" VALUE="発言/更新" CLASS="buttonform"><BR>';
if ($topmode != 'short') {
	echo '<B>'.EXT.'</B> <INPUT TYPE="text" NAME="gk" SIZE="86" VALUE="'.$gk.'" CLASS="textform">
<INPUT TYPE="text" NAME="wcount" SIZE="4" CLASS="textform" TABINDEX="-1" READONLY><INPUT TYPE="button" VALUE="文字カウント" TABINDEX="-1" onClick="this.form.wcount.value=this.form.hg.value.length"><BR>
<B>発言色</B> <INPUT TYPE="text" NAME="hc" SIZE="7" VALUE="'.$hc.'" MAXLENGTH="6" CLASS="textform" onFocus="this.select()">［<a href="'."javascript:WIN=window.open

('colorlist.php','ColorList','width=560,height=300,scrollbars=yes,resizable=yes');WIN.focus()".'">ColorList</a>］&nbsp;';
} else {
	echo '<INPUT TYPE="hidden" NAME="gk" VALUE="'.$gk.'"><INPUT TYPE="hidden" NAME="hc" VALUE="'.$hc.'">';
}
echo "<b>入力欄形式</b> <a href=\"top.php?fn=$fn&nm=$nm&gk=$gk&id=$id&hc=$hc&rl=$rl&sl=$sl&bell=$bell&ap=$ap&topmode=short\">シンプル</a> |
<a href=\"top.php?fn=$fn&nm=$nm&gk=$gk&id=$id&hc=$hc&rl=$rl&sl=$sl&bell=$bell&ap=$ap&topmode=\">通常</a> |
<a href=\"top.php?fn=$fn&nm=$nm&gk=$gk&id=$id&hc=$hc&rl=$rl&sl=$sl&bell=$bell&ap=$ap&topmode=long\">長文</a><br>";

echo '
<B>リロード時間（0で手動）</B> <SELECT NAME="rl" CLASS="selectform"><OPTION VALUE="'.$rl.'" SELECTED>'.$rl.'<OPTION VALUE="0">0<OPTION VALUE="20">20<OPTION VALUE="30">30<OPTION VALUE="45">45<OPTION VALUE="60">60</SELECT>&nbsp;
<B>表示行数</B> <SELECT NAME="sl" CLASS="selectform"><OPTION VALUE="'.$sl.'" SELECTED>'.$sl.'<OPTION VALUE="20">20<OPTION VALUE="50">50<OPTION VALUE="100">100<OPTION VALUE="200">200</SELECT>&nbsp;
<b>ベル</b><INPUT TYPE="checkbox" NAME="bell" VALUE="1"'.$bellc.' CLASS="checkform">
<INPUT TYPE="hidden" NAME="id" VALUE="'.$id.'">
<INPUT TYPE="hidden" NAME="nm" VALUE="'.$nm.'">
<INPUT TYPE="hidden" NAME="ap" VALUE="'.$ap.'">
<INPUT TYPE="hidden" NAME="fn" VALUE="'.$fn.'">
<INPUT TYPE="hidden" NAME="bc" value="0">
</TD></TR></FORM></TABLE>

<FORM ACTION="out.php" METHOD="'.MTYPE.'" TARGET="_top">
<INPUT TYPE="hidden" NAME="nm" VALUE="'.$nm.'">
<INPUT TYPE="hidden" NAME="hc" VALUE="'.$hc.'">
<INPUT TYPE="hidden" NAME="key" VALUE="'.$key.'">
<INPUT TYPE="hidden" NAME="fn" VALUE="'.$fn.'">
<INPUT TYPE="submit" VALUE=" 退室 " CLASS="buttonform">
</FORM>
<HR>

■HTMLタグ使用について<BR>
　　HTMLタグ使用は';
if (!TALLOW) { echo '許可されていません。<BR>';
} else { echo '許可されています。<BR>　　間違った使い方をされますと、他の方の迷惑となりますので、十分注意して利用してください。<BR>'; }
if (!(empty($ws))) { echo'<BR>
</BODY></HTML>';
}

?>