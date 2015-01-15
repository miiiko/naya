<?php
## PbsChat -- colorlist.php
## 発言色一覧
?>
<html>
<head>
<title>PbsChat ColorList</title>
<SCRIPT LANGUAGE='JavaScript'>
<!--
function Cco(ccol) {
document.C.co.value=ccol.substr(1,6);
document.all.hgc1.style.color=ccol;
document.all.hgc2.style.color=ccol;
document.all.hgc3.style.color=ccol;
document.C.co.select();
}
-->
</SCRIPT>
<STYLE type="text/css">
<!--
body {
	scrollbar-3dlight-color:#F2F2F3;
	scrollbar-arrow-color:#66AAD3;
	scrollbar-darkshadow-color:#F2F2F3;
	scrollbar-face-color:#FFFFFF;
	scrollbar-highlight-color:#CCCCD1;
	scrollbar-shadow-color:#CCCCD1;
	scrollbar-track-color:#F6F6F5;
}

body,tr,td,th {
	font-size: 12px;
}

a	{ text-decoration:none; }

INPUT {
	font-size:12px;
	font-family: 'ＭＳ ゴシック';
}

-->
</STYLE>
</head>
<body BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#7070EE" VLINK="#7070EE" ALINK="#7070EE" TOPMARGIN="0" MARGINHEIGHT="0" LEFTMARGIN="3" MARGINWIDTH="3">
<table cellpadding="0" cellspacing="0">
<tr><td>
<table cellpadding="3" cellspacing="0">
<form name="C">
<tr>
<td>カラーコード</td>
<td>#<input type="text" name="co" size="8" onFocus="this.select()"></td>
</tr>
</form>
</table>
</td><td>
<table bgcolor="#000000" cellpadding="3" cellspacing="1">
<tr>
<td bgcolor="#000000"><SPAN ID="hgc1">Color</SPAN></td>
<td bgcolor="#999999"><SPAN ID="hgc2">Color</SPAN></td>
<td bgcolor="#FFFFFF"><SPAN ID="hgc3">Color</SPAN></td>
</tr>
</table>
</td>
<td>
&nbsp;表示されるカラーコードをコピー＆ペーストしてください。
</td>
</tr>
</table>

<table cellpadding="0" cellspacing="1" border=1><tr>
<td valign="top">
<a href="javascript:Cco('#000000')"><font color="#000000">■</font></a>
<a href="javascript:Cco('#333333')"><font color="#333333">■</font></a>
<a href="javascript:Cco('#666666')"><font color="#666666">■</font></a>
<a href="javascript:Cco('#999999')"><font color="#999999">■</font></a>
<a href="javascript:Cco('#CCCCCC')"><font color="#CCCCCC">■</font></a>
<a href="javascript:Cco('#FFFFFF')"><font color="#000000">□</font></a>
<a href="javascript:Cco('#FFE0E0')"><font color="#FFE0E0">■</font></a>
<a href="javascript:Cco('#FFF0E0')"><font color="#FFF0E0">■</font></a>
<a href="javascript:Cco('#FFFFE0')"><font color="#FFFFE0">■</font></a>
<a href="javascript:Cco('#F0FFE0')"><font color="#F0FFE0">■</font></a>
<a href="javascript:Cco('#E0FFE0')"><font color="#E0FFE0">■</font></a>
<a href="javascript:Cco('#E0FFF0')"><font color="#E0FFF0">■</font></a>
<a href="javascript:Cco('#E0FFFF')"><font color="#E0FFFF">■</font></a>
<a href="javascript:Cco('#E0F0FF')"><font color="#E0F0FF">■</font></a>
<a href="javascript:Cco('#E0E0FF')"><font color="#E0E0FF">■</font></a>
<a href="javascript:Cco('#F0E0FF')"><font color="#F0E0FF">■</font></a>
<a href="javascript:Cco('#FFE0FF')"><font color="#FFE0FF">■</font></a>
<a href="javascript:Cco('#FFE0F0')"><font color="#FFE0F0">■</font></a>
<a href="javascript:Cco('#E9D9D9')"><font color="#E9D9D9">■</font></a>
<a href="javascript:Cco('#E9E2D9')"><font color="#E9E2D9">■</font></a>
<a href="javascript:Cco('#E9E9D9')"><font color="#E9E9D9">■</font></a>
<a href="javascript:Cco('#E2E9D9')"><font color="#E2E9D9">■</font></a>
<a href="javascript:Cco('#D9E9D9')"><font color="#D9E9D9">■</font></a>
<a href="javascript:Cco('#D9E9E2')"><font color="#D9E9E2">■</font></a>
<a href="javascript:Cco('#D9E9E9')"><font color="#D9E9E9">■</font></a>
<a href="javascript:Cco('#D9E2E9')"><font color="#D9E2E9">■</font></a>
<a href="javascript:Cco('#D9D9E9')"><font color="#D9D9E9">■</font></a>
<a href="javascript:Cco('#E2D9E9')"><font color="#E2D9E9">■</font></a>
<a href="javascript:Cco('#E9D9E9')"><font color="#E9D9E9">■</font></a>
<a href="javascript:Cco('#E9D9E2')"><font color="#E9D9E2">■</font></a>

</td>
</tr></table>

<table cellpadding="3" cellspacing="1" border=1><tr>
<td valign="top" NOWRAP>
<a href="javascript:Cco('#FF0000')"><font color="#FF0000">■</font></a>
<a href="javascript:Cco('#FF3333')"><font color="#FF3333">■</font></a>
<a href="javascript:Cco('#FF6666')"><font color="#FF6666">■</font></a>
<a href="javascript:Cco('#FF9999')"><font color="#FF9999">■</font></a>
<a href="javascript:Cco('#FFCCCC')"><font color="#FFCCCC">■</font></a>
<br>
<a href="javascript:Cco('#CC0000')"><font color="#CC0000">■</font></a>
<a href="javascript:Cco('#CC3333')"><font color="#CC3333">■</font></a>
<a href="javascript:Cco('#CC6666')"><font color="#CC6666">■</font></a>
<a href="javascript:Cco('#CC9999')"><font color="#CC9999">■</font></a>
<br>
<a href="javascript:Cco('#990000')"><font color="#990000">■</font></a>
<a href="javascript:Cco('#993333')"><font color="#993333">■</font></a>
<a href="javascript:Cco('#996666')"><font color="#996666">■</font></a>
<br>
<a href="javascript:Cco('#660000')"><font color="#660000">■</font></a>
<a href="javascript:Cco('#663333')"><font color="#663333">■</font></a>
<br>
<a href="javascript:Cco('#330000')"><font color="#330000">■</font></a>
</td>
<td valign="top" NOWRAP>
<a href="javascript:Cco('#FF3300')"><font color="#FF3300">■</font></a>
<br>
</td>
<td valign="top" NOWRAP>
<a href="javascript:Cco('#FF6600')"><font color="#FF6600">■</font></a>
<a href="javascript:Cco('#FF6633')"><font color="#FF6633">■</font></a>
<br>
<a href="javascript:Cco('#CC3300')"><font color="#CC3300">■</font></a>
<br>
</td>
<td valign="top" NOWRAP>
<a href="javascript:Cco('#FF9900')"><font color="#FF9900">■</font></a>
<a href="javascript:Cco('#FF9933')"><font color="#FF9933">■</font></a>
<a href="javascript:Cco('#FF9966')"><font color="#FF9966">■</font></a>
<br>
<a href="javascript:Cco('#CC6600')"><font color="#CC6600">■</font></a>
<a href="javascript:Cco('#CC6633')"><font color="#CC6633">■</font></a>
<br>
<a href="javascript:Cco('#993300')"><font color="#993300">■</font></a>
<br>
</td>
<td valign="top" NOWRAP>
<a href="javascript:Cco('#FFCC00')"><font color="#FFCC00">■</font></a>
<a href="javascript:Cco('#FFCC33')"><font color="#FFCC33">■</font></a>
<a href="javascript:Cco('#FFCC66')"><font color="#FFCC66">■</font></a>
<a href="javascript:Cco('#FFCC99')"><font color="#FFCC99">■</font></a>
<br>
<a href="javascript:Cco('#CC9900')"><font color="#CC9900">■</font></a>
<a href="javascript:Cco('#CC9933')"><font color="#CC9933">■</font></a>
<a href="javascript:Cco('#CC9966')"><font color="#CC9966">■</font></a>
<br>
<a href="javascript:Cco('#996600')"><font color="#996600">■</font></a>
<a href="javascript:Cco('#996633')"><font color="#996633">■</font></a>
<br>
<a href="javascript:Cco('#663300')"><font color="#663300">■</font></a>
<br>
</td>
<td valign="top" NOWRAP>
<a href="javascript:Cco('#FFFF00')"><font color="#FFFF00">■</font></a>
<a href="javascript:Cco('#FFFF33')"><font color="#FFFF33">■</font></a>
<a href="javascript:Cco('#FFFF66')"><font color="#FFFF66">■</font></a>
<a href="javascript:Cco('#FFFF99')"><font color="#FFFF99">■</font></a>
<a href="javascript:Cco('#FFFFCC')"><font color="#FFFFCC">■</font></a>
<br>
<a href="javascript:Cco('#CCCC00')"><font color="#CCCC00">■</font></a>
<a href="javascript:Cco('#CCCC33')"><font color="#CCCC33">■</font></a>
<a href="javascript:Cco('#CCCC66')"><font color="#CCCC66">■</font></a>
<a href="javascript:Cco('#CCCC99')"><font color="#CCCC99">■</font></a>
<br>
<a href="javascript:Cco('#999900')"><font color="#999900">■</font></a>
<a href="javascript:Cco('#999933')"><font color="#999933">■</font></a>
<a href="javascript:Cco('#999966')"><font color="#999966">■</font></a>
<br>
<a href="javascript:Cco('#666600')"><font color="#666600">■</font></a>
<a href="javascript:Cco('#666633')"><font color="#666633">■</font></a>
<br>
<a href="javascript:Cco('#333300')"><font color="#333300">■</font></a>
<br>
</td>
<td valign="top" NOWRAP>
<a href="javascript:Cco('#CCFF00')"><font color="#CCFF00">■</font></a>
<a href="javascript:Cco('#CCFF33')"><font color="#CCFF33">■</font></a>
<a href="javascript:Cco('#CCFF66')"><font color="#CCFF66">■</font></a>
<a href="javascript:Cco('#CCFF99')"><font color="#CCFF99">■</font></a>
<br>
<a href="javascript:Cco('#99CC00')"><font color="#99CC00">■</font></a>
<a href="javascript:Cco('#99CC33')"><font color="#99CC33">■</font></a>
<a href="javascript:Cco('#99CC66')"><font color="#99CC66">■</font></a>
<br>
<a href="javascript:Cco('#669900')"><font color="#669900">■</font></a>
<a href="javascript:Cco('#669933')"><font color="#669933">■</font></a>
<br>
<a href="javascript:Cco('#336600')"><font color="#336600">■</font></a>
<br>
</td>
<td valign="top" NOWRAP>
<a href="javascript:Cco('#99FF00')"><font color="#99FF00">■</font></a>
<a href="javascript:Cco('#99FF33')"><font color="#99FF33">■</font></a>
<a href="javascript:Cco('#99FF66')"><font color="#99FF66">■</font></a>
<br>
<a href="javascript:Cco('#66CC00')"><font color="#66CC00">■</font></a>
<a href="javascript:Cco('#66CC33')"><font color="#66CC33">■</font></a>
<br>
<a href="javascript:Cco('#339900')"><font color="#339900">■</font></a>
<br>
</td>
<td valign="top" NOWRAP>
<a href="javascript:Cco('#66FF00')"><font color="#66FF00">■</font></a>
<a href="javascript:Cco('#66FF33')"><font color="#66FF33">■</font></a>
<br>
<a href="javascript:Cco('#33CC00')"><font color="#33CC00">■</font></a>
<br>
</td>
<td valign="top" NOWRAP>
<a href="javascript:Cco('#33FF00')"><font color="#33FF00">■</font></a>
<br>
</td>
</tr>


<tr>
<td valign="top">
<a href="javascript:Cco('#00FF00')"><font color="#00FF00">■</font></a>
<a href="javascript:Cco('#33FF33')"><font color="#33FF33">■</font></a>
<a href="javascript:Cco('#66FF66')"><font color="#66FF66">■</font></a>
<a href="javascript:Cco('#99FF99')"><font color="#99FF99">■</font></a>
<a href="javascript:Cco('#CCFFCC')"><font color="#CCFFCC">■</font></a>
<br>
<a href="javascript:Cco('#00CC00')"><font color="#00CC00">■</font></a>
<a href="javascript:Cco('#33CC33')"><font color="#33CC33">■</font></a>
<a href="javascript:Cco('#66CC66')"><font color="#66CC66">■</font></a>
<a href="javascript:Cco('#99CC99')"><font color="#99CC99">■</font></a>
<br>
<a href="javascript:Cco('#009900')"><font color="#009900">■</font></a>
<a href="javascript:Cco('#339933')"><font color="#339933">■</font></a>
<a href="javascript:Cco('#669966')"><font color="#669966">■</font></a>
<br>
<a href="javascript:Cco('#006600')"><font color="#006600">■</font></a>
<a href="javascript:Cco('#336633')"><font color="#336633">■</font></a>
<br>
<a href="javascript:Cco('#003300')"><font color="#003300">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#00FF33')"><font color="#00FF33">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#00FF66')"><font color="#00FF66">■</font></a>
<a href="javascript:Cco('#33FF66')"><font color="#33FF66">■</font></a>
<br>
<a href="javascript:Cco('#00CC33')"><font color="#00CC33">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#00FF99')"><font color="#00FF99">■</font></a>
<a href="javascript:Cco('#33FF99')"><font color="#33FF99">■</font></a>
<a href="javascript:Cco('#66FF99')"><font color="#66FF99">■</font></a>
<br>
<a href="javascript:Cco('#00CC66')"><font color="#00CC66">■</font></a>
<a href="javascript:Cco('#33CC66')"><font color="#33CC66">■</font></a>
<br>
<a href="javascript:Cco('#009933')"><font color="#009933">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#00FFCC')"><font color="#00FFCC">■</font></a>
<a href="javascript:Cco('#33FFCC')"><font color="#33FFCC">■</font></a>
<a href="javascript:Cco('#66FFCC')"><font color="#66FFCC">■</font></a>
<a href="javascript:Cco('#99FFCC')"><font color="#99FFCC">■</font></a>
<br>
<a href="javascript:Cco('#00CC99')"><font color="#00CC99">■</font></a>
<a href="javascript:Cco('#33CC99')"><font color="#33CC99">■</font></a>
<a href="javascript:Cco('#66CC99')"><font color="#66CC99">■</font></a>
<br>
<a href="javascript:Cco('#009966')"><font color="#009966">■</font></a>
<a href="javascript:Cco('#339966')"><font color="#339966">■</font></a>
<br>
<a href="javascript:Cco('#006633')"><font color="#006633">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#00FFFF')"><font color="#00FFFF">■</font></a>
<a href="javascript:Cco('#33FFFF')"><font color="#33FFFF">■</font></a>
<a href="javascript:Cco('#66FFFF')"><font color="#66FFFF">■</font></a>
<a href="javascript:Cco('#99FFFF')"><font color="#99FFFF">■</font></a>
<a href="javascript:Cco('#CCFFFF')"><font color="#CCFFFF">■</font></a>
<br>
<a href="javascript:Cco('#00CCCC')"><font color="#00CCCC">■</font></a>
<a href="javascript:Cco('#33CCCC')"><font color="#33CCCC">■</font></a>
<a href="javascript:Cco('#66CCCC')"><font color="#66CCCC">■</font></a>
<a href="javascript:Cco('#99CCCC')"><font color="#99CCCC">■</font></a>
<br>
<a href="javascript:Cco('#009999')"><font color="#009999">■</font></a>
<a href="javascript:Cco('#339999')"><font color="#339999">■</font></a>
<a href="javascript:Cco('#669999')"><font color="#669999">■</font></a>
<br>
<a href="javascript:Cco('#006666')"><font color="#006666">■</font></a>
<a href="javascript:Cco('#336666')"><font color="#336666">■</font></a>
<br>
<a href="javascript:Cco('#003333')"><font color="#003333">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#00CCFF')"><font color="#00CCFF">■</font></a>
<a href="javascript:Cco('#33CCFF')"><font color="#33CCFF">■</font></a>
<a href="javascript:Cco('#66CCFF')"><font color="#66CCFF">■</font></a>
<a href="javascript:Cco('#99CCFF')"><font color="#99CCFF">■</font></a>
<br>
<a href="javascript:Cco('#0099CC')"><font color="#0099CC">■</font></a>
<a href="javascript:Cco('#3399CC')"><font color="#3399CC">■</font></a>
<a href="javascript:Cco('#6699CC')"><font color="#6699CC">■</font></a>
<br>
<a href="javascript:Cco('#006699')"><font color="#006699">■</font></a>
<a href="javascript:Cco('#336699')"><font color="#336699">■</font></a>
<br>
<a href="javascript:Cco('#003366')"><font color="#003366">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#0099FF')"><font color="#0099FF">■</font></a>
<a href="javascript:Cco('#3399FF')"><font color="#3399FF">■</font></a>
<a href="javascript:Cco('#6699FF')"><font color="#6699FF">■</font></a>
<br>
<a href="javascript:Cco('#0066CC')"><font color="#0066CC">■</font></a>
<a href="javascript:Cco('#3366CC')"><font color="#3366CC">■</font></a>
<br>
<a href="javascript:Cco('#003399')"><font color="#003399">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#0066FF')"><font color="#0066FF">■</font></a>
<a href="javascript:Cco('#3366FF')"><font color="#3366FF">■</font></a>
<br>
<a href="javascript:Cco('#0033CC')"><font color="#0033CC">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#0033FF')"><font color="#0033FF">■</font></a>
<br>
</td>
</tr>


<tr>
<td valign="top">
<a href="javascript:Cco('#0000FF')"><font color="#0000FF">■</font></a>
<a href="javascript:Cco('#3333FF')"><font color="#3333FF">■</font></a>
<a href="javascript:Cco('#6666FF')"><font color="#6666FF">■</font></a>
<a href="javascript:Cco('#9999FF')"><font color="#9999FF">■</font></a>
<a href="javascript:Cco('#CCCCFF')"><font color="#CCCCFF">■</font></a>
<br>
<a href="javascript:Cco('#0000CC')"><font color="#0000CC">■</font></a>
<a href="javascript:Cco('#3333CC')"><font color="#3333CC">■</font></a>
<a href="javascript:Cco('#6666CC')"><font color="#6666CC">■</font></a>
<a href="javascript:Cco('#9999CC')"><font color="#9999CC">■</font></a>
<br>
<a href="javascript:Cco('#000099')"><font color="#000099">■</font></a>
<a href="javascript:Cco('#333399')"><font color="#333399">■</font></a>
<a href="javascript:Cco('#666699')"><font color="#666699">■</font></a>
<br>
<a href="javascript:Cco('#000066')"><font color="#000066">■</font></a>
<a href="javascript:Cco('#333366')"><font color="#333366">■</font></a>
<br>
<a href="javascript:Cco('#000033')"><font color="#000033">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#3300FF')"><font color="#3300FF">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#6600FF')"><font color="#6600FF">■</font></a>
<a href="javascript:Cco('#6633FF')"><font color="#6633FF">■</font></a>
<br>
<a href="javascript:Cco('#3300CC')"><font color="#3300CC">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#9900FF')"><font color="#9900FF">■</font></a>
<a href="javascript:Cco('#9933FF')"><font color="#9933FF">■</font></a>
<a href="javascript:Cco('#9966FF')"><font color="#9966FF">■</font></a>
<br>
<a href="javascript:Cco('#6600CC')"><font color="#6600CC">■</font></a>
<a href="javascript:Cco('#6633CC')"><font color="#6633CC">■</font></a>
<br>
<a href="javascript:Cco('#330099')"><font color="#330099">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#CC00FF')"><font color="#CC00FF">■</font></a>
<a href="javascript:Cco('#CC33FF')"><font color="#CC33FF">■</font></a>
<a href="javascript:Cco('#CC66FF')"><font color="#CC66FF">■</font></a>
<a href="javascript:Cco('#CC99FF')"><font color="#CC99FF">■</font></a>
<br>
<a href="javascript:Cco('#9900CC')"><font color="#9900CC">■</font></a>
<a href="javascript:Cco('#9933CC')"><font color="#9933CC">■</font></a>
<a href="javascript:Cco('#9966CC')"><font color="#9966CC">■</font></a>
<br>
<a href="javascript:Cco('#660099')"><font color="#660099">■</font></a>
<a href="javascript:Cco('#663399')"><font color="#663399">■</font></a>
<br>
<a href="javascript:Cco('#330066')"><font color="#330066">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#FF00FF')"><font color="#FF00FF">■</font></a>
<a href="javascript:Cco('#FF33FF')"><font color="#FF33FF">■</font></a>
<a href="javascript:Cco('#FF66FF')"><font color="#FF66FF">■</font></a>
<a href="javascript:Cco('#FF99FF')"><font color="#FF99FF">■</font></a>
<a href="javascript:Cco('#FFCCFF')"><font color="#FFCCFF">■</font></a>
<br>
<a href="javascript:Cco('#CC00CC')"><font color="#CC00CC">■</font></a>
<a href="javascript:Cco('#CC33CC')"><font color="#CC33CC">■</font></a>
<a href="javascript:Cco('#CC66CC')"><font color="#CC66CC">■</font></a>
<a href="javascript:Cco('#CC99CC')"><font color="#CC99CC">■</font></a>
<br>
<a href="javascript:Cco('#990099')"><font color="#990099">■</font></a>
<a href="javascript:Cco('#993399')"><font color="#993399">■</font></a>
<a href="javascript:Cco('#996699')"><font color="#996699">■</font></a>
<br>
<a href="javascript:Cco('#660066')"><font color="#660066">■</font></a>
<a href="javascript:Cco('#663366')"><font color="#663366">■</font></a>
<br>
<a href="javascript:Cco('#330033')"><font color="#330033">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#FF00CC')"><font color="#FF00CC">■</font></a>
<a href="javascript:Cco('#FF33CC')"><font color="#FF33CC">■</font></a>
<a href="javascript:Cco('#FF66CC')"><font color="#FF66CC">■</font></a>
<a href="javascript:Cco('#FF99CC')"><font color="#FF99CC">■</font></a>
<br>
<a href="javascript:Cco('#CC0099')"><font color="#CC0099">■</font></a>
<a href="javascript:Cco('#CC3399')"><font color="#CC3399">■</font></a>
<a href="javascript:Cco('#CC6699')"><font color="#CC6699">■</font></a>
<br>
<a href="javascript:Cco('#990066')"><font color="#990066">■</font></a>
<a href="javascript:Cco('#993366')"><font color="#993366">■</font></a>
<br>
<a href="javascript:Cco('#660033')"><font color="#660033">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#FF0099')"><font color="#FF0099">■</font></a>
<a href="javascript:Cco('#FF3399')"><font color="#FF3399">■</font></a>
<a href="javascript:Cco('#FF6699')"><font color="#FF6699">■</font></a>
<br>
<a href="javascript:Cco('#CC0066')"><font color="#CC0066">■</font></a>
<a href="javascript:Cco('#CC3366')"><font color="#CC3366">■</font></a>
<br>
<a href="javascript:Cco('#990033')"><font color="#990033">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#FF0066')"><font color="#FF0066">■</font></a>
<a href="javascript:Cco('#FF3366')"><font color="#FF3366">■</font></a>
<br>
<a href="javascript:Cco('#CC0033')"><font color="#CC0033">■</font></a>
<br>
</td>
<td valign="top">
<a href="javascript:Cco('#FF0033')"><font color="#FF0033">■</font></a>
<br>
</td>
</tr></table>
<div align="right">
<br>
<a href="javascript:window.close()">×ウィンドウを閉じる</a>
</div>

</body>
</html>