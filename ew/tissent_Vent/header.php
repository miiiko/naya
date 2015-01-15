<?php
## PbsChat -- header.php
## 関数定義

## ヘッダーの設定
$Header = '<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset='.CSET.'">'.$ref.'
<TITLE>'.$Title.'</TITLE>
<LINK REL="stylesheet" TYPE="text/css" HREF="pbschat.css">
'.$Javas.'</HEAD>';

## BODYの設定
$PBody = "\n".'<BODY '.$background.' BGCOLOR="'.$bgcolor.'" TEXT="'.$text.'" LINK="'.$link.'" VLINK="'.$vlink.'" ALINK="'.$alink.'" TOPMARGIN="5" MARGINHEIGHT="5"'.$onload.">\n";

## BODYの設定（フレーム上）
$PBodyT = "\n".'<BODY '.$background.' BGCOLOR="'.$bgcolor.'" TEXT="'.$text.'" LINK="'.$link.'" VLINK="'.$vlink.'" ALINK="'.$alink.'" TOPMARGIN="1" MARGINHEIGHT="1"'.$onload.">\n";

## BODYの設定（フレーム下）
$PBodyU = "\n".'<BODY BGCOLOR="'.$bgcolor.'" TEXT="'.$text.'" LINK="'.$link.'" VLINK="'.$vlink.'" ALINK="'.$alink.'" TOPMARGIN="5" MARGINHEIGHT="5">'."\n";

## タイトル部分の設定
$PTitle = '<FONT SIZE="5" CLASS="ptitle"><B>'.$Title.'</B></FONT><HR>';

## フッターの指定
$Footer = '<CENTER>::::&nbsp;<FONT SIZE="-1"><A HREF="http://pbs.darkgray.net/" TARGET="_blank">&nbsp;PbsChat v'.$ver.' </A></FONT>&nbsp;::::</CENTER></BODY></HTML>';

?>