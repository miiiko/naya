<?php
## PbsChat -- index.php
## 参加者の一覧表示
if (phpversion() >= "4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

include('set.php');
if (file_exists($RFile)) require($RFile);
?>
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=<?php echo CSET; ?>">
<LINK REL="stylesheet" TYPE="text/css" HREF="pbschat.css">
<TITLE>参加者情報</TITLE></HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#666666" LINK="#4884B8" VLINK="#4884B8" ALINK="#4884B8" TOPMARGIN="5" MARGINHEIGHT="5">
<DIV ALIGN="right"><A HREF="../../index.html">HOME</A></DIV>
<FONT SIZE="5" CLASS="ptitle"><B>参加者情報</B></FONT>
<HR>
<BR>

<TABLE BORDER="1">
<TR>
<TD>タイトル</TD>
<TD>最終更新時刻</TD>
<TD>参加者</TD>
</TR>

<?php
if (file_exists($RFile)) :
	if (!empty($CInfo)) :
		foreach ($CInfo as $CList) :
			list($CTitle, $CName) = split(",",$CList);
?>

<TR>
<TD><A HREF="<?php echo $SFile."?fn=".$CName; ?>"><?php echo $CTitle; ?></A></TD>
<TD><?php if ((time() - filemtime("./dat/log_$CName.php")) < 24*60*60) echo '<font color="#B84884">'; UF_Logtime($CName, "./"); if ((time() - filemtime("./dat/log_$CName.php")) < 24*60*60) echo '</font>'; ?></TD>
<TD><?php UF_Romcount($CName, "./", 1); ?><?php UF_Joinname($CName, "./"); ?>&nbsp;</TD>
</TR>

<?php
		endforeach;
	endif;
endif;
?>

</TABLE>
<br>
<br>
<A HREF="./history.php">参加履歴表示</A>　　<A HREF="./admin.php">管理用ページ</A><BR><HR>

<CENTER>::::&nbsp;<FONT SIZE="-1"><A HREF="http://pbs.darkgray.net/" TARGET="_blank">&nbsp;PbsChat v<?php echo $ver; ?> </A></FONT>&nbsp;::::</CENTER>
</BODY>
</HTML>