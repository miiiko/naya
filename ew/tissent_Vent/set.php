<?php
##----------------------------##
// PbScript -- PbsChat v2.5.1
// Scripting by Shin Mikami
// http://pbs.darkgray.net/
// 2006-11-27
##----------------------------##

## 【設定項目　ここから】↓ -------------------------------------------- #

## チャットルームからの戻り先URL（絶対パスまたは相対パスで指定）
define("BURL", "../index.html");

## 戻り先URLへのリンク文字列
define("BMES", "トップページへ");

## 付加情報の名称・付加情報からのページ移動制御
define("EXT", "URL");
define("ELINK", " ");
define("NOLINK", ' ');

## 書庫ファイル編集用パスワード機能（0:使わない、1:使う）（archive用）
define("ARCPASS", 0);

## IDリンク機能（0:使わない、1:使う）
define("ID", 0);
define("ILINK", "./profile.php?mode=show&no="); //プロフィールツールのURL（絶対パスor相対パス）
define("IDWIN", "width=450,height=450,scrollbars=yes"); //開くウィンドウのサイズ設定

## 発言の色変更範囲（0:名前のみ、1:名前＋発言）
define("CAREA", 1);

## 発言のタグ許可（0:不可、1:許可　許可の場合、タグの閉じ忘れはチェックしません）
define("TALLOW", 1);

## clear,allclearを許可するか（0:不可、1:許可）
define("CLEAR", 0);

## ベル音ファイル名（.midや.auなど）
define("BELL", 'bell.au');

## ROM禁止時の参加者表示（0:表示する、1:表示しない）
define("ROMST", 1);

## ROM時の表示行数
define("ROMSL", 100);

## 最大ログ保持行数
define("MAXL", 1000); // チャットログ（100以上にするのはお勧めしません）
define("MAXHL", 200); // 参加履歴

## 参加履歴でのIP表示（0:しない、1:する）
define("IPS", 0);

## 文字コード設定（"Shift_JIS" or "EUC-JP"）
define("CSET", "Shift_JIS");


## 【メッセージ類】 ---------------------------------------------------- #

## 発言色マーク
define("HGM","■");

## 入室・退室メッセージ（ROOMの箇所に部屋名、,の箇所に名前が表示されます）
$EMES = "ご案内：「ROOM」に,さんが現れました。";
$OMES = "ご案内：「ROOM」から,さんが去りました。";

## ROM禁止メッセージ
define("NOROMMES", "ROMはできません。入退室履歴は残りません。");

## 固定パスワードメッセージ
define("FIXPMES", "●この部屋には固定パスワードが設定されています。");

## 自由パスワードメッセージ
define("FREEPMES1", "●最初に入室する人が自由にパスワードを設定できます。");
define("FREEPMES2", "●現在使用中です。入室している人と同じパスワードを入力してください。");

## ログクリアメッセージ
define("CLEARMES", "●退室時、または15分間リロード・発言がなければ自動的にログがクリアされます。");

## フリー設定メッセージ
define("FMES", "フリー設定ルームです。最初に入室する人が部屋の設定を自由に設定できます。");

## 携帯ページからのアクセスマーク
define("MOBILE","(携)");


## 【以下は変更しなくても問題がない場合はそのままで】 ------------------ #

## GMTとの時差（秒単位で調整。時差が無い場合は0のまま）
define("GMTIME", 0);




## ファイルロック
define("FILELOCK", 1);

## メソッド
define("MTYPE", "POST");

## 【設定項目　ここまで】↑ -------------------------------------------- #


## スクリプトファイル名
$SFile = "./pbschat.php";

## ログファイル名
$DDir = "dat/"; //データファイルのパス
if (ereg("^[_a-zA-Z0-9]+$", $fn)) {
	$CFile = $DDir."$fn.php"; //チャット設定
	$LFile = $DDir."log_$fn.php"; // 発言ログ
	$ALFile = $DDir."alog_$fn.php"; // 管理用発言ログ
	$JFile = $DDir."join_$fn.php"; // 参加者情報
	$PFile = $DDir."pass_$fn.php"; //入室パスワード
	$FFile = $DDir."free_$fn.php"; //フリー設定
	$UFile = $DDir."update_$fn.php"; //ログファイル更新時刻
}
$HFile = $DDir."historylog.php"; // 参加履歴
$RFile = $DDir."roomdata.php"; //ルーム設定

# バージョン
$ver = "2.5.1";

## 現在の時刻を取得
$rtm = time() + GMTIME;
$today = date("m/d-H:i:s", $rtm);


## 特殊文字を削除する
function UF_HgDel(&$charf) {
	if (get_magic_quotes_gpc()) { $charf = stripslashes($charf); }
	$charf = ereg_replace("[&<>\"]", "", $charf);
}

## 特殊文字をエスケープする
function UF_HgEsc(&$charf) {
	if (get_magic_quotes_gpc()) { $charf = stripslashes($charf); }
	$charf = ereg_replace("&", "&amp;", $charf);
	$charf = ereg_replace("<>", "&lt;&gt;", $charf);
	if (!TALLOW) {
		$charf = ereg_replace("<", "&lt;", $charf);
		$charf = ereg_replace(">", "&gt;", $charf);
		$charf = ereg_replace("\"", "&quot;", $charf);
	}
}


## ログ書き込み
function UF_WriteLog($Stext,$pr) {
	global $LFile, $ALFile, $HFile, $CFile, $FFile, $UFile, $rtm, $fn, $Title, $em, $AdminLog, $NoRom, $REMOTE_ADDR;

	if (empty($em)) {
		$allLog = file($LFile);
		$fp = fopen ($LFile,"w");
		if (FILELOCK) { flock($fp, LOCK_EX); }
		fputs($fp, "<?php exit; /*\n");
		fputs($fp,$Stext);
		for ($i = 1; $i < count($allLog); $i++) {
			if ($i >= MAXL) {
				fputs($fp, "*/?>\n");
				break;
			}
			fputs($fp,chop($allLog[$i])."\n");
		}
		if (FILELOCK) { flock($fp, LOCK_UN); }
		fclose($fp);
	}
	# 管理ログ書き込み
	if ($AdminLog) {
		$fp = fopen ($ALFile,"a");
		if (FILELOCK) { flock($fp, LOCK_EX); }
		fputs($fp,$Stext);
		if (FILELOCK) { flock($fp, LOCK_UN); }
		fclose($fp);
	}
	#include('archive.php'); //全てのログを保存する場合、ここの行頭の#を削る
	#if (!$NoRom and ($pr != 3)) include('archive.php'); //ROM禁止の部屋及びWhisper発言を保存しない場合、ここの行頭の#を削る
	# 参加履歴書き込み
	if ((($pr == 1) or ($pr == 4)) and !$NoRom) {
		$allLog = file($HFile);
		$fp = fopen ($HFile,"w");
		if (FILELOCK) { flock($fp, LOCK_EX); }
		fputs($fp, "<?php exit; /*\n");
		fputs($fp, $fn.'<>'.$Title.'<>'.$REMOTE_ADDR.'<>'.$Stext);
		for ($i = 1; $i < MAXHL; $i++) {
			fputs($fp, chop($allLog[$i])."\n");
		}
		if (FILELOCK) { flock($fp, LOCK_UN); }
		fclose($fp);
	}

	# ログ更新時刻書き込み
	$fp = fopen ($UFile,"w");
	if (FILELOCK) { flock($fp, LOCK_EX); }
	fputs($fp,'<?php $Logupdate='.$rtm.'; ?>');
	if (FILELOCK) { flock($fp, LOCK_UN); }
	fclose($fp);
}


## 発言削除
function UF_DelLog($LFile, $nm, $dc) {
	$allLog = file($LFile);
	$fp = fopen($LFile,"w");
	if (FILELOCK) { flock($fp, LOCK_EX); }
	$DelFlag = 1; //消したかどうかのフラグ。0で終了
	$DelCK = 0; //消すためのチェック。1だと消す
	foreach ($allLog as $value) {
		list($lhc, $lgk, $lid, $lnm, $lhg, $lwsa, $lht, $lpr) = explode('<>', chop($value));
		if ($DelFlag && ($lnm == $nm)) {
			if (($lpr == 2) or ($lpr == 3)) {
				$DelCK = 1;
			} else if(($lpr == 1) or ($lpr == 4) or ($lpr == 5)) { //退室メッセージより前は消えない
				$DelFlag -= $dc; //消すのが１つだけの場合はここで0になる
				if ($DelFlag) $DelCK = 1;
			}
		}
		if ($DelCK) {
			$DelFlag -= $dc;
			$DelCK = 0;
		} else {
			fputs($fp,chop($value)."\n");
		}
	}
	if (FILELOCK) { flock($fp, LOCK_UN); }
	fclose($fp);
}


## 全発言削除
function UF_DelAllLog($LFile) {
	$allLog = file($LFile);
	$fp = fopen($LFile,"w");
	if (FILELOCK) { flock($fp, LOCK_EX); }
	fputs($fp, "<?php exit; /*\n*/?>\n");
	if (FILELOCK) { flock($fp, LOCK_UN); }
	fclose($fp);
}


## ログクリア
function UF_LogClear($LFile) {
	$fp = fopen($LFile,"w");
	if (FILELOCK) { flock($fp, LOCK_EX); }
	fputs($fp,"<?php exit; /*\n*/?>\n");
	if (FILELOCK) { flock($fp, LOCK_UN); }
	fclose($fp);
}


## パスワード書き込み
function UF_Keywrite($key) {
	global $PFile;

	$fp = fopen($PFile,"w");
	if (FILELOCK) { flock($fp, LOCK_EX); }
	fputs($fp,"<?php\n\$Freekey='$key';\n?>\n");
	if (FILELOCK) { flock($fp, LOCK_UN); }
	fclose($fp);
}

## ログ表示
function UF_ShowLog($sl, $nm) {
	global $EMES, $OMES, $LFile, $Logupdate, $Footer;

	$allLog = file($LFile);
	$linecount = 1;
	foreach ($allLog as $value) {
		if ($linecount > $sl) break; //表示行数まで
		list($lhc, $lgk, $lid, $lnm, $lhg, $lwsa, $lht, $lpr) = explode('<>', chop($value));
		if ($lpr == 5) $lpr = 2;
		switch ($lpr) {
			case 1: //入室
				list($Emes1, $Emes2) = explode(",", str_replace('ROOM', $lhg, $EMES));
				echo $Emes1."<FONT COLOR=\"#$lhc\"><B>";
				if (empty($lgk)) {
					echo $lnm;
				} else {
					echo '<A HREF="'.ELINK.$lgk.'" onClick="return false;" title="'.$lgk.'"><FONT COLOR="#'.$lhc.'">'.$lnm.'</FONT></A>';
				}
				echo '</B></FONT>'.$Emes2." ($lht)<HR SIZE=1>";
				$linecount++;
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
				$linecount++;
				break;
			case 3: //Whisper
				if (($lnm == $nm) or ($lwsa == $nm) or (!empty($nm) and ($lwsa == 'ALL'))) {
					echo "<FONT COLOR=\"#$lhc\"><I>".$lnm."→".$lwsa." &gt; $lhg</FONT></I> ($lht)<HR SIZE=1>";
					$linecount++;
				}
				break;
			case 4: //退室
				list($Omes1, $Omes2) = explode(",", str_replace('ROOM', $lhg, $OMES));
				echo $Omes1."<FONT COLOR=\"#$lhc\"><B>".$lnm."</B></FONT>".$Omes2." ($lht)<HR SIZE=1>";
				$linecount++;
				break;
		}
	}
	echo $Footer;
}


## 参加者表示
function UF_ShowJoin($nm, $hc, $gk, $id, $ws, $pr, $show, $bellon) {
	global $JFile, $REMOTE_ADDR, $wsa, $wsallow, $Clear, $Password, $rtm, $Logupdate, $lkt;

	$entry = 0; // 自データがあったかどうかの判定
	$Jnow = ""; $Jcount = 0; // 参加者記録
	$Rom = 0; // ROMカウント
	$wsallow = "2"; //2は相手がいなかった場合。0はWIS拒否・1は許可

	$Jdata = file($JFile);
	$fp = fopen($JFile, "w");
	if (FILELOCK) { flock($fp, LOCK_EX); }
	fputs($fp, "<?php exit; /*\n");
	foreach ($Jdata as $value) {
		$mobile = "";
		list($jnm, $jhc, $jgk, $jid, $jip, $jws, $jtm, $jpr) = explode('<>', chop($value));
		if (empty($jtm)) continue; //コメント行等をスキップ
		# 入室者
		if ($pr and (($jnm == $nm) or empty($jnm)) and ($jip == $REMOTE_ADDR) and !$entry) {
			$lkt = $jtm;
			$jnm = $nm;
			$jhc = $hc; if (!empty($gk)) { $jgk = $gk; } if (!empty($id)) { $jid = $id; }
			$jws = $ws;
			$jtm = $rtm;
			$jpr = $pr;
			$entry = 1;
		}
		# ROM
		if (empty($pr) and ($jip == $REMOTE_ADDR) and !$entry) {
			$lkt = $jtm;
			$jtm = $rtm;
			$entry = 1;
		}
		if (empty($jpr)) { // ROMと参加者で削除の秒数を変える
			$dsec = 45;
		} else {
			$dsec = 70;
			if ($Clear or $Password or ($jpr == 2)) $dsec = 900;
		}
		if (($rtm - $jtm) < $dsec) {
			fputs($fp, "$jnm<>$jhc<>$jgk<>$jid<>$jip<>$jws<>$jtm<>$jpr\n");
			if ($jpr) {
				if ($jpr == 2) $mobile = MOBILE; $Jcount++;
				if (!empty($jid)) {  $Jnow.="<a href=\"JavaScript:WIN=window.open('".ILINK.$jid."','Profile','".IDWIN."');WIN.focus()\">□</a>"; } if (!empty($jgk)) { $Jnow.= '<a href="'.ELINK.$jgk.'"'.NOLINK.' title="'.$jgk.'"><FONT COLOR="#'.$jhc.'">'.$jnm.'</FONT></a>　'; } else { $Jnow.= '<FONT COLOR="#'.$jhc.'">'.$jnm.'</FONT>'.$mobile.'　'; }
			} else {
				$Rom++;
			}
			if (!empty($wsa) and ($jnm == $wsa)) { //WIS相手がいたら相手のWIS許可情報を入れる
				$wsallow = $jws;
			}
		}
	}
	if (empty($entry)) { // 参加情報内に自データが無かった場合追加する
		fputs($fp, "$nm<>$hc<>$gk<>$id<>$REMOTE_ADDR<>$ws<>".$rtm."<>$pr\n");
		if ($pr) {
			if ($jpr == 2) $mobile = MOBILE;
			$Jnow .= "<FONT COLOR=\"#$hc\">$nm</FONT>".$mobile;
		} else {
			$Rom++;
		}
	}
	fputs($fp, "*/?>\n");
	if (FILELOCK) { flock($fp, LOCK_UN); }
	fclose($fp);
	if ($show) {
		echo '参加者('.$Jcount.')： ';
		if ($Rom > 0) {
			echo "ROM(".$Rom.")　";
		}
		echo $Jnow;
	}
	if ($bellon and ($Logupdate > $lkt)) {
		echo '<font size="1">（bell<EMBED SRC="'.BELL.'" WIDTH=1 HEIGHT=1 AUTOSTART=TRUE REPEAT=TRUE></EMBED>）</font>';
	} else {
	}
}


## ログ更新時刻の取得
function UF_Logtime($fn, $path) {
	global $DDir;
	$UTime = date("Y/m/d-H:i:s",filemtime($path.$DDir."log_$fn.php")+GMTIME);
	echo $UTime;
}


## 参加者人数の取得
function UF_Joincount($fn, $path) {
	global $DDir, $rtm;
	require($path.$DDir.$fn.".php"); //$Passwordと$Clearを取得するため$CFileを読み込み
	$Jnow = 0;
	if (filesize($path.$DDir."join_$fn.php") > 20) {
		$Jdata = file($path.$DDir."join_$fn.php");
		$fp = fopen($path.$DDir."join_$fn.php", "w");
		if (FILELOCK) { flock($fp, LOCK_EX); }
		fputs($fp, "<?php exit; /*\n");
		foreach ($Jdata as $value) {
			list($jnm, $jhc, $jgk, $jid, $jip, $jws, $jtm, $jpr) = explode('<>', chop($value));
			if (empty($jtm)) continue; //コメント行等をスキップ
			if (empty($jpr)) { // ROMと参加者で削除の秒数を変える
				$dsec = 45;
			} else {
				$dsec = 70;
				if ($Clear or $Password or ($jpr == 2)) $dsec = 900;
			}
			if (($rtm - $jtm) < $dsec) {
				fputs($fp, $value);
				if ($jpr) {
					$Jnow++;
				}
			}
		}
		fputs($fp, "*/?>\n");
		if (FILELOCK) { flock($fp, LOCK_UN); }
		fclose($fp);
	}
	if ($NoRom and ROMST) {
		if (empty($Jnow)) {
			echo "-";
		} else {
			echo "x";
		}
	} else {
		echo $Jnow;
	}
}

## ROM人数の取得
function UF_Romcount($fn, $path, $format) {
	global $DDir, $rtm;
	require($path.$DDir.$fn.".php"); //$Passwordと$Clearを取得するため$CFileを読み込み
	$Jnow = 0;
	if (filesize($path.$DDir."join_$fn.php") > 20) {
		$Jdata = file($path.$DDir."join_$fn.php");
		$fp = fopen($path.$DDir."join_$fn.php", "w");
		if (FILELOCK) { flock($fp, LOCK_EX); }
		fputs($fp, "<?php exit; /*\n");
		foreach ($Jdata as $value) {
			list($jnm, $jhc, $jgk, $jid, $jip, $jws, $jtm, $jpr) = explode('<>', chop($value));
			if (empty($jtm)) continue; //コメント行等をスキップ
			if (empty($jpr)) { // ROMと参加者で削除の秒数を変える
				$dsec = 45;
			} else {
				$dsec = 70;
				if ($Clear or $Password or ($jpr == 2)) $dsec = 900;
			}
			if (($rtm - $jtm) < $dsec) {
				fputs($fp, $value);
				if ($jpr == 0) {
					$Jnow++;
				}
			}
		}
		fputs($fp, "*/?>\n");
		if (FILELOCK) { flock($fp, LOCK_UN); }
		fclose($fp);
	}
	if ($format) {
		if ($Jnow > 0) {
			echo "ROM(".$Jnow.")　";
		}
	} else {
		echo $Jnow;
	}
}

## 参加者名の取得
function UF_Joinname($fn, $path) {
	global $DDir, $rtm;
	require($path.$DDir.$fn.".php"); //$Passwordと$Clearを取得するため$CFileを読み込み
	$Jnow = ""; // 参加者記録
	if (filesize($path.$DDir."join_$fn.php") > 20) {
		$Jdata = file($path.$DDir."join_$fn.php");
		$fp = fopen($path.$DDir."join_$fn.php", "w");
		if (FILELOCK) { flock($fp, LOCK_EX); }
		fputs($fp, "<?php exit; /*\n");
		foreach ($Jdata as $value) {
			list($jnm, $jhc, $jgk, $jid, $jip, $jws, $jtm, $jpr) = explode('<>', chop($value));
			if (empty($jtm)) continue; //コメント行等をスキップ
			if (empty($jpr)) { // ROMと参加者で削除の秒数を変える
				$dsec = 45;
			} else {
				$dsec = 70;
				if ($Clear or $Password or ($jpr == 2)) $dsec = 900;
			}
			if (($rtm - $jtm) < $dsec) {
				fputs($fp, $value);
				if ($jpr) {
					if (!empty($Jnow)) $Jnow.= "　";
					$Jnow.= '<font color="#'.$jhc.'">'.$jnm.'</font>';
				}
			}
		}
		fputs($fp, "*/?>\n");
		if (FILELOCK) { flock($fp, LOCK_UN); }
		fclose($fp);
	}
	if ($NoRom and ROMST) {
		if (empty($Jnow)) {
			echo "-";
		} else {
			echo "BLIND";
		}
	} else {
		echo $Jnow;
	}
}


## 参加者有無チェック
function UF_Joincheck($JFile) {
	global $rtm;
	$Jnow = 0;
	if (filesize($JFile) > 20) {
		$Jdata = file($JFile);
		$fp = fopen($JFile, "w");
		if (FILELOCK) { flock($fp, LOCK_EX); }
		fputs($fp, "<?php exit; /*\n");
		foreach($Jdata as $value) {
			list($jnm, $jhc, $jgk, $jid, $jip, $jws, $jtm, $jpr) = explode('<>', chop($value));
			if (empty($jtm)) continue; //コメント行等をスキップ
			// ROMと参加者で削除の秒数を変える
			empty($jpr) ? $dsec = 45 : $dsec = 900; //自動削除用なので15分
			if (($rtm - $jtm) < $dsec) {
				fputs($fp, $value);
				if ($jpr) $Jnow = 1; //参加者($jpr=1)がいれば1
			}
		}
		fputs($fp, "*/?>\n");
		if (FILELOCK) { flock($fp, LOCK_UN); }
		fclose($fp);
	}
	return($Jnow);
}


## フリー設定記録
function UF_FreeSet() {
	global $FFile, $FTitle, $Fbgcolor, $Ftext, $Finfo;
	if (phpversion() >= "5"){ $FTitle = addslashes($FTitle); $Finfo = addslashes($Finfo); }
	$Freesetting = "<?php
\$Title = '$FTitle';
\$Fdefault = 0;
\$bgcolor = '$Fbgcolor';
\$text = '$Ftext';
\$Finfo = '$Finfo';
?>";

	$fp = fopen($FFile,"w");
	if (FILELOCK) { flock($fp, LOCK_EX); }
	fputs($fp,$Freesetting);
	if (FILELOCK) { flock($fp, LOCK_UN); }
	fclose($fp);
}


## フリー設定クリア
function UF_FreeClear() {
	global $FFile, $Title, $bgcolor, $text;

	$Freesetting = "<?php
\$Title = '$Title';
\$Fdefault = 1;
\$bgcolor = '$bgcolor';
\$text = '$text';
\$Finfo = '".FMES."';
?>";

	$fp = fopen($FFile,"w");
	if (FILELOCK) { flock($fp, LOCK_EX); }
	fputs($fp,$Freesetting);
	if (FILELOCK) { flock($fp, LOCK_UN); }
	fclose($fp);
}
?>