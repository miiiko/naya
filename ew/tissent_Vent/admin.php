<?php
## PbsChat -- admin.php
## 管理用ページ
if (phpversion() >= "4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

## 設定項目　ここから↓ -------------------------------------------- #

## 管理用パスワード
$adminpass = "0401";

## 設定項目　ここまで↑ -------------------------------------------- #

## チャットルームの最大数
$rmax = "10";

include('set.php');

## ページタイトル
$Title = "管理用ページ";

## ページカラー設定
$bgcolor = "#FFFFFF";
$text = "#5555AA";
$link = "#7070EE";
$vlink = "#7070EE";
$alink = "#7070EE";

include('header.php');

## タイトルの表示
echo $Header.$PBody.'<DIV ALIGN="right"><A HREF="'.BURL.'">'.BMES.'</A></DIV>'.$PTitle;

## モード無し（ログイン画面）
if (empty($mode)) {
	if (empty($adminpass)) {
		echo 'admin.phpをテキストエディタで開き、管理用パスワードを設定してください。';
		echo '<HR>'.$Footer;
		exit;
	}
	echo '<form action="admin.php" method="POST">
管理用パスワード <input type="password" name="loginpass" size="10">
<input type="hidden" name="mode" value="menu">
<input type="submit" value="管理ログイン">
</form>';
	echo '<HR>'.$Footer;
	exit;

}
if ($adminpass == $loginpass) {
	## 管理メニュー ↓
	if($mode == "menu") {
		# 入退室履歴ファイルがあるかチェックする
		if (!file_exists($HFile)) {
			if ($fp = fopen($HFile, "w")) {
				fputs($fp, "<?php exit; /*\n");
				fclose($fp);
				chmod ($HFile, 0666);
			} else {
				echo 'データディレクトリにファイルの書き込みができません。パーミッションの設定を確認してください。';
			}
		}
		echo '<b>▽1-1．チャットルーム一覧</b><br>';
		if (file_exists($RFile)) {
			include($RFile); //ルームデータ読み込み
			if (!empty($CInfo)) {
			echo '
<TABLE BORDER>
<TR>
<TD>タイトル</TD>
<TD>チャットネーム</TD>
<TD>設定</TD>
<TD>削除</TD>
</TR>';
				foreach ($CInfo as $value) {
					list($CTitle, $CName) = split(",",$value);
					echo '
<TR>
<TD>'.$CTitle.'</A></TD>
<TD>'.$CName.'</TD>
<form action="admin.php" method="POST">
<TD><input type="submit" value="管理・設定変更"></TD>
<input type="hidden" name="ct" value="'.$CTitle.'">
<input type="hidden" name="fn" value="'.$CName.'">
<input type="hidden" name="mode" value="rset">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
</form>
<form action="admin.php" method="POST">
<TD><input type="submit" value="ルーム削除"></TD>
<input type="hidden" name="fn" value="'.$CName.'">
<input type="hidden" name="mode" value="rdel">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
</form>
</TR>';
				}
				echo '</table><br><br>';
			} else {
				echo 'チャットルームは登録されていません。<br><br><br>';
			}
		} else {
			echo 'チャットルームは登録されていません。<br><br><br>';
		}
		echo '
<hr>
<b>▽1-2．チャットルームの追加</b><br>';
		if (count($CInfo) < $rmax) {// チャットルームの上限チェック
			echo '
<table>
<form action="admin.php" method="POST">
<tr><td>タイトル</td><td><input type="text" name="ct" size="30"></td></tr>
<tr><td>チャットネーム</td><td><input type="text" name="fn" size="10" maxlength="10">（半角英数）</td></tr>
<tr><td colspan="2">既存のチャットネームを指定すると、設定が上書きされます。<br><br><input type="submit" value="追加"></td></tr>
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="radd">
</form>
</table><br><br>';
		} else {
			echo 'チャットルーム数は上限に達しています。<br><br>';
		}
		echo '
<hr>
<b>▽1-3．入退室履歴のクリア</b><br>
<form action="admin.php" method="POST">
<input type="submit" value="入退室履歴をクリアする">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="hclear">
</form>
';
		echo '
<hr>
<b>▽1-4．現在のチャット設定</b><br>
<br>
チャット設定を変更する場合は、「set.php」をテキストエディタで開き、編集してください。
<table cellpadding="3" cellspacing="3">
<tr><td bgcolor="#6666AA" colspan="2"><font color="#FFFFFF"><b>【基本設定】</b></font></td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">チャットルームからの戻り先URL</font></td><td bgcolor="#E0E0FF">'.BURL.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">戻り先URLへのリンク文字列</font></td><td bgcolor="#E0E0FF">'.BMES.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">付加情報名</font></td><td bgcolor="#E0E0FF">'.EXT.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">付加情報リンク</font></td><td bgcolor="#E0E0FF">'.ELINK.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">付加情報からのページ移動制御</font></td><td bgcolor="#E0E0FF">'.NOLINK.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">書庫ファイル編集用パスワード機能（0:使わない、1:使う）</font></td><td bgcolor="#E0E0FF">'.ARCPASS.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">IDリンク機能（0:使わない、1:使う）</font></td><td bgcolor="#E0E0FF">'.ID.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">IDリンク先</font></td><td bgcolor="#E0E0FF">'.ILINK.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">IDリンクウィンドウサイズ</font></td><td bgcolor="#E0E0FF">'.IDWIN.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">発言の色変更範囲（0:名前、1:名前＋発言）</font></td><td bgcolor="#E0E0FF">'.CAREA.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">発言のタグ許可（0:不可 1:許可）</font></td><td bgcolor="#E0E0FF">'.TALLOW.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">clear,allclearを許可するか（0:不可、1:許可）</font></td><td bgcolor="#E0E0FF">'.CLEAR.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">ベル音ファイル名（.midや.auなど）</font></td><td bgcolor="#E0E0FF">'.BELL.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">ROM禁止時の参加者表示（0:表示する、1:表示しない）</font></td><td bgcolor="#E0E0FF">'.ROMST.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">ROM時の表示行数</font></td><td bgcolor="#E0E0FF">'.ROMSL.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">チャットログ保持行数</font></td><td bgcolor="#E0E0FF">'.MAXL.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">参加履歴保持行数</font></td><td bgcolor="#E0E0FF">'.MAXHL.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">参加履歴でのIP表示（0:しない、1:する）</font></td><td bgcolor="#E0E0FF">'.IPS.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">文字コード設定</font></td><td bgcolor="#E0E0FF">'.CSET.'</td></tr>

<tr><td bgcolor="#6666AA" colspan="2"><font color="#FFFFFF"><b>【メッセージ類】</b></font></td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">発言色マーク</font></td><td bgcolor="#E0E0FF">'.HGM.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">入室メッセージ</font></td><td bgcolor="#E0E0FF">'.$EMES.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">退室メッセージ</font></td><td bgcolor="#E0E0FF">'.$OMES.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">ROM禁止メッセージ</font></td><td bgcolor="#E0E0FF">'.NOROMMES.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">固定パスワード</font></td><td bgcolor="#E0E0FF">'.FIXPMES.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">自由パスワード（空室）</font></td><td bgcolor="#E0E0FF">'.FREEPMES1.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">自由パスワード（使用中）</font></td><td bgcolor="#E0E0FF">'.FREEPMES2.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">ログクリア</font></td><td bgcolor="#E0E0FF">'.CLEARMES.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">フリー設定ルーム</font></td><td bgcolor="#E0E0FF">'.FMES.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">携帯ページからのアクセスマーク</font></td><td bgcolor="#E0E0FF">'.MOBILE.'</td></tr>

<tr><td bgcolor="#6666AA" colspan="2"><font color="#FFFFFF"><b>【その他】</b></font></td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">GMTとの時差</font></td><td bgcolor="#E0E0FF">'.GMTIME.'</td></tr>

<tr><td bgcolor="#6666AA"><font color="#FFFFFF">ファイルロック</font></td><td bgcolor="#E0E0FF">'.FILELOCK.'</td></tr>
<tr><td bgcolor="#6666AA"><font color="#FFFFFF">メソッド</font></td><td bgcolor="#E0E0FF">'.MTYPE.'</td></tr>
</table>
<br><br>
';
		echo '<HR>'.$Footer;
		exit;
	}
	## 管理メニュー ↑


	## チャットルーム追加 ↓
	if($mode == "radd") {
		if (ereg("^[_a-zA-Z0-9]+$", $fn) and !empty($ct)) {
			UF_AddRoom($ct, $fn);
			echo 'チャットルームを追加しました。
<form action="admin.php" method="POST">
<input type="submit" value="管理メニューへ戻る">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="menu">
</form>';
		} else {
			echo 'タイトルとチャットネームは必ず入力してください。チャットネームは半角英数で入力し、スペースは入れないでください。<input type="button" value="戻る" onClick="history.back()"><br><br>';
		}
		echo '<HR>'.$Footer;
		exit;
	}
	## チャットルーム追加 ↑


	## チャットルーム削除確認 ↓
	if($mode == "rdel") {
		echo '<b>▽1-5．チャットルーム削除確認</b><br>
「'.$fn.'」を削除します。ルーム設定、発言ログ、管理ログも削除されます。<br>
確認のため、管理用パスワードを入力してください。<br>
<form action="admin.php" method="POST">
管理用パスワード <input type="password" name="loginpass" size="10">
<input type="hidden" name="fn" value="'.$fn.'">
<input type="hidden" name="mode" value="delok">
<input type="submit" value="削除">
<br>
<br>
<input type="button" value="戻る" onClick="history.back()">
</form>';
		echo '<HR>'.$Footer;
		exit;
	}
	## チャットルーム削除確認 ↑


	## チャットルーム削除 ↓
	if($mode == "delok") {
		UF_DelRoom($fn);
		echo 'チャットルームを削除しました。
<form action="admin.php" method="POST">
<input type="submit" value="管理メニューへ戻る">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="menu">
</form>';
		echo '<HR>'.$Footer;
		exit;
	}
	## チャットルーム削除 ↑


	## 入退室履歴のクリア ↓
	if($mode == "hclear") {
		if ($fp = fopen($HFile, "w")) {
			fputs($fp, "<?php exit; /*\n");
			fclose($fp);
		} else {
			echo 'データディレクトリにファイルの書き込みができません。パーミッションの設定を確認してください。';
		}
		echo '入退室履歴をクリアしました。
<form action="admin.php" method="POST">
<input type="submit" value="管理メニューへ戻る">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="menu">
</form>';
		echo '<HR>'.$Footer;
		exit;
	}
	## 入退室履歴のクリア ↑


	## ルーム管理 ↓
	if($mode == "rset") {
		require($CFile);
		$on = "ON";
		$off = "OFF";
		$AdminLog<1?$AdminLog=$off:$AdminLog=$on;
		$NoRom<1?$NoRom=$off:$NoRom=$on;
		$Clear<1?$Clear=$off:$Clear=$on;
		if (empty($Dice)) {
			$Dice=$off;
		} else {
			$Dice=$on;
		}
		$Password<1?$Password=$off:$Password=$on;
		echo '<b>▽2-1．ルーム情報</b><br>
<TABLE BORDER>
<TR>
<TD>項目</TD>
<TD>設定状態</TD>
<TD>ログサイズ</TD>
</TR>
<TR><TD>チャットタイトル</TD><TD>'.$ct.'</TD><td>　</td></TR>
<TR><TD>チャットネーム（最小ログ20byte）</TD><TD>'.$fn.'</TD><TD align="right">'.filesize($LFile).' byte</TD></TR>
<TR><TD>管理用ログ（最小ログ15byte）</TD><TD>'.$AdminLog.'</TD><TD align="right">'.filesize($ALFile).' byte</TD></TR>
<TR><TD>ROM禁止</TD><TD>'.$NoRom.'</TD><td>　</td></TR>
<TR><TD>発言ログ自動クリア</TD><TD>'.$Clear.'</TD><td>　</td></TR>
<TR><TD>ダイス</TD><TD>'.$Dice.'</TD><td>　</td></TR>
<TR><TD>パスワード</TD><TD>'.$Password.'</TD><td>　</td></TR>
<TR><TD>固定パスワード</TD><TD>'.$Fixkey.'&nbsp;</TD><td>　</td></TR>
</TABLE>
<br>
<br>
<hr>
<b>▽2-2．ルーム設定変更</b><br>
<form action="admin.php" method="POST">
ルーム毎の配色・オプションの設定を行います。<br>
<br><input type="submit" value="ルーム設定"></td></tr>
<input type="hidden" name="fn" value="'.$fn.'">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="redit">
</form>
<hr>
<b>▽2-3．管理用ログ閲覧</b><br>
<form action="admin.php" method="POST" target="_blank">
管理用ログを別ウィンドウで表示します。<br>
管理用ログ設定をONにしている場合、ログは自動削除されませんので「2-5．管理用ログクリア」から定期的に削除してください。<br>
<br><input type="submit" value="管理用ログ閲覧"></td></tr>
<input type="hidden" name="fn" value="'.$fn.'">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="adminlog">
</form>
<hr>
<b>▽2-4．チャットログクリア</b><br>
<form action="admin.php" method="POST">
チャットログ・参加者情報がクリアされます。<br>
<br><input type="submit" value="チャットログをクリアする"></td></tr>
<input type="hidden" name="fn" value="'.$fn.'">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="clclear">
</form>
<hr>
<b>▽2-5．管理用ログクリア</b><br>
<form action="admin.php" method="POST">
管理用ログがクリアされます。<br>
<br><input type="submit" value="管理用ログをクリアする"></td></tr>
<input type="hidden" name="fn" value="'.$fn.'">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="alclear">
</form>
';
		echo '<HR>'.$Footer;
		exit;
	}
	## ルーム管理 ↑


	## 管理用ログ表示 ↓
	if($mode == "adminlog") {
		UF_ShowALog();
		echo '<HR>'.$Footer;
		exit;
	}
	## チャットログのクリア ↑


	## チャットログのクリア ↓
	if($mode == "clclear") {
		UF_CLClear($fn);
		echo 'チャットログをクリアしました。
<form action="admin.php" method="POST">
<input type="submit" value="管理メニューへ戻る">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="menu">
</form>';
		echo '<HR>'.$Footer;
		exit;
	}
	## チャットログのクリア ↑


	## 管理用ログのクリア ↓
	if($mode == "alclear") {
		UF_ALClear($fn);
		echo '管理用ログをクリアしました。
<form action="admin.php" method="POST">
<input type="submit" value="管理メニューへ戻る">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="menu">
</form>';
		echo '<HR>'.$Footer;
		exit;
	}
	## 管理用ログのクリア ↑


	## ルーム設定編集 ↓
	if($mode == "redit") {
		require($CFile);
		UF_HgEsc($pinup);
		UF_HgEsc($background);
		echo '<b>▽2-2-1．ルーム設定編集</b><br>'."
<SCRIPT LANGUAGE='JavaScript'>
<!--
function BGco(ccol) {
document.all.bgc.style.backgroundColor=\"#\"+ccol;
}
function Txco(ccol) {
document.all.txc.style.color=\"#\"+ccol;
}
function Lico(ccol) {
document.all.lic.style.color=\"#\"+ccol;
}
function vLico(ccol) {
document.all.vlic.style.color=\"#\"+ccol;
}
function aLico(ccol) {
document.all.alic.style.color=\"#\"+ccol;
}
function Preco() {
	BGco(document.F.cbgcolor.value);
	Txco(document.F.ctext.value);
	Lico(document.F.clink.value);
	vLico(document.F.cvlink.value);
	aLico(document.F.calink.value);
}
-->
</SCRIPT>".'
<table cellpadding="3" cellspacing="1" border>
<form action="admin.php" NAME="F" method="POST">
<tr><td>設定項目</td><td>設定内容</td><td colspan="2">記入例</td></tr>
<tr><td NOWRAP>入室メッセージ</td><td colspan="2"><input type="text" size="40" name="EMESset" value="'.$EMES.'"></td>
<td>ROOMの箇所に部屋名、,（カンマ）の箇所に名前が表示されます。設定しなければset.phpで指定したメッセージになります。'."'".'（シングルクォーテーション）は使えません。</td></tr>
<tr><td NOWRAP>退室メッセージ</td><td colspan="2"><input type="text" size="40" name="OMESset" value="'.$OMES.'"></td>
<td>ROOMの箇所に部屋名、,（カンマ）の箇所に名前が表示されます。設定しなければset.phpで指定したメッセージになります。'."'".'（シングルクォーテーション）は使えません。</td></tr>
<tr><td NOWRAP>コメント</td><td colspan="2"><input type="text" size="40" name="Comment" value="'.$Comment.'"></td>
<td>ここで記入したコメントはチャットの入室画面に表示されます。</td></tr>
<tr><td NOWRAP>ピンナップ</td><td colspan="2"><input type="text" size="40" name="pinup" value="'.$pinup.'"></td>
<td><font color="#AA5555">&lt;IMG SRC="./img/pinup.jpg" BORDER="1"&gt;</font></td></tr>
<tr><td NOWRAP>背景イメージ</td><td colspan="2"><input type="text" size="40" name="cbackground" value="'.$background.'"></td>
<td><font color="#AA5555">BACKGROUND="./img/backimage.jpg"</font><br>スタイルシートを使用し背景イメージを右下に固定する場合（例）↓<br>
<font color="#AA5555">STYLE="background-image:url(./img/backimage.jpg);background-repeat:no-repeat;background-attachment:fixed;background-position:right bottom;"</font>
</td></tr>

<tr><td NOWRAP>背景色</td><td valign="top"><input type="text" size="8" name="cbgcolor" value="'.str_replace("#","",$bgcolor).'" onFocus="this.select()" onBlur="BGco(this.value)">'."［<a href=\"javascript:WIN=window.open('colorlist.php','ColorList','width=560,height=300,scrollbars=yes,resizable=yes');WIN.focus()\">ColorList</a>］".'</td>
<td><font color="#AA5555">FFFFFF</font></td>
<td rowspan="5" align="center" ID="bgc"><span ID="txc">【見本】<br>
テキスト色</span><br>
<br>
<span ID="lic"><u>リンク色</u></span><br>
<span ID="vlic"><u>リンク済色</u></span><br>
<span ID="alic"><u>リンククリック時の色</u></span><br>
<br>
<input type="button" value="配色プレビュー" onClick="Preco()">
</td></tr>
<tr><td NOWRAP>テキスト色</td><td valign="top"><input type="text" size="8" name="ctext" value="'.str_replace("#","",$text).'" onFocus="this.select()" onBlur="Txco(this.value)"></td>
<td><font color="#AA5555">333333</font></td></tr>
<tr><td NOWRAP>リンク色</td><td valign="top"><input type="text" size="8" name="clink" value="'.str_replace("#","",$link).'" onFocus="this.select()" onBlur="Lico(this.value)"></td>
<td><font color="#AA5555">666666</font></td></tr>
<tr><td NOWRAP>リンク済色</td><td valign="top"><input type="text" size="8" name="cvlink" value="'.str_replace("#","",$vlink).'" onFocus="this.select()" onBlur="vLico(this.value)"></td>
<td><font color="#AA5555">999999</font></td></tr>
<tr><td NOWRAP>リンククリック時の色</td><td valign="top"><input type="text" size="8" name="calink" value="'.str_replace("#","",$alink).'" onFocus="this.select()" onBlur="aLico(this.value)"></td>
<td><font color="#AA5555">999999</font></td></tr>
<tr><td NOWRAP>発言色デフォルト</td><td valign="top"><input type="text" size="8" name="HDcolor" value="'.str_replace("#","",$HDcolor).'" onFocus="this.select()"></td>
<td colspan="2"><font color="#AA5555">999999</font></td></tr>
';
		$roop = count($Hcolor);
		if ($roop > 9) {
			$roop += 10;
		} else {
			$roop = 10;
		}

		for ($i = 0; $i < $roop; $i++) {
			echo '<tr><td>発言色</td><td><input type="text" size="8" name="Hcolor[]" value="'.$Hcolor[$i].'" onFocus="this.select()"></td><td colspan="2"><font color="#AA5555">CCCCCC</font></td></tr>'."\n";
		}
		echo '
<tr><td NOWRAP>管理用ログ</td>
<td valign="top"><input type="radio" name="AdminLog" value="0"'.UF_Checkoff($AdminLog).'>OFF <input type="radio" name="AdminLog" value="1"'.UF_Checkon($AdminLog).'>ON</td>
<td colspan="2"><font color="#AA5555">OFF/ON</font></td></tr>
<tr><td NOWRAP>ROM禁止</td>
<td valign="top"><input type="radio" name="NoRom" value="0"'.UF_Checkoff($NoRom).'>OFF <input type="radio" name="NoRom" value="1"'.UF_Checkon($NoRom).'>ON</td>
<td colspan="2"><font color="#AA5555">OFF/ON</font></td></tr>
<tr><td NOWRAP>自動ログクリア</td>
<td valign="top" NOWRAP><input type="radio" name="Clear" value="0"'.UF_Checkoff($Clear).'>OFF <input type="radio" name="Clear" value="1"'.UF_Checkon($Clear).'>ON</td>
<td colspan="2"><font color="#AA5555">OFF/ON</font></td></tr>
<tr><td NOWRAP>ダイス</td><td valign="top"><input type="text" size="15" name="Dice" value="'.$Dice.'"></td>
<td colspan="2">ダイス設定ファイル（標準は<font color="#AA5555">dice.php</font>）使用しない場合は0か空欄</td></tr>
<tr><td NOWRAP>フリー設定</td>
<td valign="top"><input type="radio" name="Free" value="0"'.UF_Checkoff($Free).'>OFF <input type="radio" name="Free" value="1"'.UF_Checkon($Free).'>ON</td>
<td colspan="2"><font color="#AA5555">OFF/ON</font></td></tr>
<tr><td NOWRAP>パスワード</td>
<td valign="top"><input type="radio" name="Password" value="0"'.UF_Checkoff($Password).'>OFF <input type="radio" name="Password" value="1"'.UF_Checkon($Password).'>ON</td>
<td colspan="2"><font color="#AA5555">OFF/ON</font></td></tr>
<tr><td NOWRAP>固定パスワード</td><td valign="top"><input type="text" size="10" name="Fixkey" value="'.$Fixkey.'"></td>
<td colspan="2"><font color="#AA5555">test</font>（半角英数）　パスワードがONになっている時のみ有効</td></tr>
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="fn" value="'.$fn.'">
<input type="hidden" name="mode" value="rregist">
</table>
<br>
<input type="submit" value="ルーム設定変更">
</form>
';
		echo '<HR>'.$Footer;
		exit;
	}
	## ルーム設定編集 ↑


	## ルーム設定変更 ↓
	if($mode == "rregist") {
		UF_RRegist($fn);
		echo 'チャットルームの設定を変更しました。
<form action="admin.php" method="POST">
<input type="submit" value="管理メニューへ戻る">
<input type="hidden" name="loginpass" value="'.$loginpass.'">
<input type="hidden" name="mode" value="menu">
</form>';
		echo '<HR>'.$Footer;
		exit;
	}
	## ルーム設定変更 ↑

} else {
	echo 'パスワードが一致しません。<input type="button" value="戻る" onClick="history.back()">';
}

echo '<HR>'.$Footer;


## 関数定義 ###############################################

## チャットルームを追加する
function UF_AddRoom($ct, $fn) {
global $CFile, $LFile, $ALFile, $JFile, $FFile, $PFile, $UFile, $RFile;

# ファイルのデフォルト値
$Chatsetting = "<?php
\$fn = '".$fn."';
include(\$path.\$DDir.'roomdata.php');
list(\$Title, \$CName) = split(',', \$CInfo[\$fn]);
\$Comment = '';
\$pinup = '';
\$background = '';
\$bgcolor = '#FFFFFF';
\$text = '#5555AA';
\$link = '#7070EE';
\$vlink = '#7070EE';
\$alink = '#7070EE';
\$HDcolor = '9999EE';
\$Hcolor[] = 'AF5757';
\$Hcolor[] = 'AF7C57';
\$Hcolor[] = '57AF57';
\$Hcolor[] = '5780AF';
\$Hcolor[] = '8357AF';
\$Hcolor[] = 'AF5783';
\$Hcolor[] = '999999';
\$Hcolor[] = '003675';
\$Hcolor[] = '3A0075';
\$AdminLog = 0;
\$NoRom = 0;
\$Clear = 0;
\$Dice = '';
\$Free = 0;
\$Password = 0;
\$Fixkey = '';
?>";

$Logsetting = "<?php exit; /*\n*/?>\n";
$ALogsetting = "<?php exit; /*\n";
$Freesetting = "<?php
\$Title = '';
\$Fdefault = 0;
\$bgcolor = '';
\$text = '';
\$Finfo = '';
?>";

$check = 0;
# ルームデータ追加
if (file_exists($RFile)) {
	$RData = file($RFile);
	$check = 1;
}
$fp = fopen($RFile, "w");
fputs($fp, "<?php\n");
if ($check) {
	foreach ($RData as $value) {
		list($RData1, $RData2) = explode(" = ", chop($value));
		list($CTile, $CName) = explode(",", $RData2);
		if (!empty($CName) and (substr($CName, 0, -2) != $fn)) {
			fputs($fp, $value);
		}
	}
}
fputs($fp, '$CInfo['."'$fn'".'] = "'.$ct.','.$fn.'";'."\n");
fputs($fp, "?>\n");
fclose($fp);
if (empty($check)) chmod ($RFile, 0666);

# ファイル作成
$fp = fopen($CFile, "w");
fputs($fp, $Chatsetting);
fclose($fp);
chmod ($CFile, 0666);

$fp = fopen($LFile, "w");
fputs($fp, $Logsetting);
fclose($fp);
chmod ($LFile, 0666);

$fp = fopen($ALFile, "w");
fputs($fp, $ALogsetting);
fclose($fp);
chmod ($ALFile, 0666);

$fp = fopen($JFile, "w");
fputs($fp, $Logsetting);
fclose($fp);
chmod ($JFile, 0666);

$fp = fopen($FFile, "w");
fputs($fp, $Freesetting);
fclose($fp);
chmod ($FFile, 0666);

$fp = fopen($PFile, "w");
fputs($fp, $Logsetting);
fclose($fp);
chmod ($PFile, 0666);

$fp = fopen($UFile, "w");
fputs($fp, '');
fclose($fp);
chmod ($UFile, 0666);
}


## チャットルームを削除する
function UF_DelRoom($fn) {
global $CFile, $LFile, $ALFile, $JFile, $FFile, $PFile, $UFile, $RFile;

# ルームデータ削除
$RData = file($RFile);
$fp = fopen($RFile, "w");
fputs($fp, "<?php\n");
foreach ($RData as $RList) {
	list($RList1, $RList2) = explode(" = ", chop($RList));
	list($CTile, $CName) = explode(",", $RList2);
	if (!empty($CName) and (substr($CName, 0, -2) != $fn)) {
		fputs($fp, $RList);
	}
}
fputs($fp, "?>\n");
fclose($fp);

# ファイル削除
unlink($CFile);
unlink($LFile);
unlink($ALFile);
unlink($JFile);
unlink($FFile);
unlink($PFile);
unlink($UFile);
}


## 管理ログ表示
function UF_ShowALog() {
	global $EMES, $OMES, $ALFile;

	$allLog = file($ALFile);
	foreach ($allLog as $value) {
		if ($linecount > $sl) break; //表示行数まで
		list($lhc, $lgk, $lid, $lnm, $lhg, $lwsa, $lht, $lpr) = explode('<>', chop($value)); if ($lpr == 5) $lpr = 2;
		switch ($lpr) {
			case 1: //入室
				list($Emes1, $Emes2) = explode(",", str_replace('ROOM', $lhg, $EMES));
				echo $Emes1."<FONT COLOR=\"#$lhc\"><B>";
				if (empty($lgk)) {
					echo $lnm;
				} else {
					echo '<A HREF="'.ELINK.$lgk.'" onClick="return false;" title="'.$lgk.'"><FONT COLOR="#'.$lhc.'">'.$lnm.'</FONT></A>';
				}
				echo '</B></FONT>'.$Emes2." ($lht)$lwsa<HR SIZE=1>";
				break;
			case 2: //通常発言
				if (CAREA) {
					$nmcolor = "";
					$hgcolor = "</FONT>";
				} else {
					$nmcolor = "</FONT>";
					$hgcolor = "";
				}
				echo "<FONT COLOR=\"#$lhc\">";
				if ($lgk == "") {
					echo $lnm.$nmcolor;
				} else {
					echo '<A HREF="'.ELINK.$lgk.'"'.NOLINK.' title="'.$lgk.'"><FONT COLOR="#'.$lhc.'">'.$lnm.'</FONT></A>'.$nmcolor;
				}
				if (ID and !empty($lid)) {
					echo " <a href=\"JavaScript:WIN=window.open('".ILINK.$lid."','Profile','".IDWIN."');WIN.focus()\" style=\"text-decoration:none;\"><b>&gt;</b></a> ";
				} else {
					echo " &gt; ";
				}
				echo $lhg.$hgcolor." ($lht)<HR SIZE=1>";
				break;
			case 3: //Whisper
					echo "<FONT COLOR=\"#$lhc\"><I>".$lnm."→".$lwsa." &gt; $lhg</FONT></I> ($lht)<HR SIZE=1>";
				break;
			case 4: //退室
				list($Omes1, $Omes2) = explode(",", str_replace('ROOM', $lhg, $OMES));
				echo $Omes1."<FONT COLOR=\"#$lhc\"><B>".$lnm."</B></FONT>".$Omes2." ($lht)<HR SIZE=1>";
				break;
		}
	}
}


## チャットログをクリアする
function UF_CLClear($fn) {
global $LFile, $ALFile, $JFile;

$Logsetting = "<?php exit; /*\n*/?>\n";

$fp = fopen($LFile, "w");
fputs($fp, $Logsetting);
fclose($fp);

$fp = fopen($JFile, "w");
fputs($fp, $Logsetting);
fclose($fp);
}


## 管理用ログをクリアする
function UF_ALClear($fn) {
global $ALFile;

$ALogsetting = "<?php exit; /*\n";

$fp = fopen($ALFile, "w");
fputs($fp, $ALogsetting);
fclose($fp);
}


## ルーム設定を変更する
function UF_RRegist($fn) {
global $CFile, $EMES, $EMESset, $OMES, $OMESset, $Comment, $pinup, $cbackground, $cbgcolor, $ctext, $clink, $cvlink, $calink, $HDcolor, $Hcolor, $AdminLog, $NoRom, $Clear, $Dice, $Free, $Password, $Fixkey;

UF_HgEsc($Comment);
UF_HgEsc($EMESset);
UF_HgEsc($OMESset);

if (!empty($EMESset) and ($EMESset != $EMES)) {
	$EMESset = "\$EMES = '".$EMESset."';\n";
} else {
	$EMESset = '';
}
if (!empty($OMESset) and ($OMESset != $OMES)) {
	$OMESset = "\$OMES = '".$OMESset."';\n";
} else {
	$OMESset = '';
}

$Chatsetting = "<?php
\$fn = '".$fn."';
include(\$path.\$DDir.'roomdata.php');
list(\$Title, \$CName) = split(',', \$CInfo[\$fn]);
".$EMESset.$OMESset."\$Comment = '".$Comment."';
\$pinup = '".stripslashes($pinup)."';
\$background = '".stripslashes($cbackground)."';
\$bgcolor = '#$cbgcolor';
\$text = '#$ctext';
\$link = '#$clink';
\$vlink = '#$cvlink';
\$alink = '#$calink';
\$HDcolor = '$HDcolor';
";
foreach($Hcolor as $value) {
	if (!empty($value)) {
		$Chatsetting .= "\$Hcolor[] = '$value';\n";
	}
}
$Chatsetting .= "
\$AdminLog = $AdminLog;
\$NoRom = $NoRom;
\$Clear = $Clear;
\$Dice = '$Dice';
\$Free = $Free;
\$Password = $Password;
\$Fixkey = '$Fixkey';
?>";

# ファイル変更
$fp = fopen($CFile, "w");
fputs($fp, $Chatsetting);
fclose($fp);
}

function UF_Checkoff($value) {
	if (empty($value)) {
		return(' CHECKED');
	} else {
		return('');
	}
}

function UF_Checkon($value) {
	if (!empty($value)) {
		return(' CHECKED');
	} else {
		return('');
	}
}
?>