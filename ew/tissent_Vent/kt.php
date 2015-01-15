<?php
## PbsChat -- kt.php
## 参加者情報
if (phpversion() >= "4.1.0"){
	extract($_GET);
	extract($_POST);
	extract($_COOKIE);
	extract($_SERVER);
}

include('set.php');
if (file_exists($RFile)) require($RFile);

echo '<?xml version="1.0" encoding="Shift_JIS"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">
<html><head><title>参加者情報</title></head><body bgcolor="#ffffff">
参加者情報<br />
<hr />
(参加人数)<br />';

if (file_exists($RFile)) :
	foreach ($CInfo as $value) :
		list($CTitle, $CName) = split(",",$value);
?>

<a href="ktchat.php?fn=<?php echo $CName; ?>"><?php echo $CTitle; ?></a>
(<?php UF_Joincount($CName, "./"); ?>)<br />

<?php
	endforeach;
endif;
?>

<hr />PbsChat2.5 for kt
</body></html>