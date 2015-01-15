<?php
//***********************************
//bot情報設定部分
//***********************************

$username = "Birodiaru"; //botのアカウントネーム
$password = "ew_dell"; //botのパスワード
$cron = "30"; //cronの実行間隔を分単位で
$lovefile = "lovefile.txt"; //好感度リストのパス

//***********************************
//設定ここまで
//***********************************

//ライブラリを読み込む
require_once("Services/Twitter.php");
require_once('Services/Twitter/Jsphon/Error.php');
require_once("Services/Twitter/Jsphon/Decoder.php");

//Twitterからタイムラインを取得
$st =& new Services_Twitter($username, $password);
$reply = $st->getFriendsTimeline();
$json =& new Jsphon_Decoder();
$reply = $json->decode($reply);

//このままでは最新順にリプライしてしまうので、取得したタイムラインを反転する
$reply = array_reverse($reply); 

//現在の時間から取得するPOSTの幅を判定
$now = strtotime("now");
$limittime = $now - $cron * 60;

//現在から$cronで設定した分内のPOSTだけ取り出して、反応処理に飛ぶ
//その後POSTに対する反応を一個ずつ処理、全てのPOSTに対する処理が終わるまでループする
foreach($reply as $rep){ 
	if($limittime < strtotime($rep["created_at"])){
		talk($st,$username,$rep["text"],$rep["user"]["screen_name"],$rep["user"]["name"],$rep["user"]["id"],$lovefile);
		$rep_n = 1;
	}
}


//ここから反応処理
function talk($st,$username,$text,$screen_name,$twittername,$twitterid,$lovefile){

//***********************************
//！説明！
//↑の$result = talk($rep["text"]～からここに飛んできます。
//function talkに囲まれたここはサブルーチンといって、まとまった処理を行います。
//return関数を使うといつでも処理の途中から抜けて飛んできた場所に戻ってくることが出来ます。
//詳しくはPHPのリファレンスなどで調べてみてください。
//
//！説明2！
//$textにPOST内容
//$screen_nameにPOSTした人のアカウント名
//$twitternameにPOSTした人のTwitterネーム
//$twitteridにPOSTした人のTwitterID
//が、入っています。台詞内でこの変数を使うと変数の内容が台詞に埋め込まれます。
//例として、こんにちはとリプライしてきた人に返事を返すとき、
//相手のTwitterネームが「hogehoge」だった場合に
//「こんにちは、$twittername」とすると「こんにちは、hogehoge」となります。
//
//！説明3！
//このサブルーチン内の命令をいじるとbotの動きも変わります。
//各処理に簡単な説明を設けていますのでリファレンスを見ながらいじってみてください。
//（当然間違った構文を書くとエラーで動かなくなりますのでくれぐれもバックアップなどを取って慎重に！）

$love = 0; //好感度フラグデフォルト値
$lovetrue = 0; //好感度上昇フラグデフォルト値
$lovelist = file($lovefile); //好感度をファイルから変数に代入
foreach($lovelist as $loveid){ //リストを1つずつ展開
if( $loveid == $twitterid ){ //展開しているリストとPOSTしたユーザIDが一致すれば処理に移る
$love = 1; //リストに処理中ユーザが居たので好感度フラグを立てる
}
}

if( $screen_name == $username){ //POSTが自分のPOSTだった場合にサブルーチンから抜ける
return;
}if( preg_match("/\@$username/",$text)){ //POST内容に「/」で囲まれた中で書かれた文字列（この場合$username＝@botのアカウント（自分へのリプライ））を探し、あった場合に次の処理に入る。無かったら対応する括弧以降へ飛ぶ
	if( preg_match("/RT/",$text)){ //POST内に「RT」があるかどうか調べる
	return; //「RT」がPOST内にあったので、処理を中断してサブルーチンから抜ける
	}elseif( preg_match("/こんにちは/",$text)){ //同じようにPOST内容にこんにちはがあるかどうか調べ、あったら次の処理へ
		$mes = array("こんにちは","こんにちわ$twittername"); //台詞を設定。","で区切っていくつでも
		$mes_n = count($mes) - 1; //先ほど設定した台詞の数を調べる
		$mesrand = mt_rand (0,$mes_n); //台詞の数だけ反応する台詞番号をランダムに指定
	}elseif( preg_match("/テスト/",$text)){ //好感度が上がるかもしれないワード処理
		$mes = array("ありがとう","嬉しい"); //好感度が上がらなかった時の台詞
		$mes_n = count($mes) - 1; 
		$mesrand = mt_rand (0,$mes_n); 
		if( $love == 1 ){ //好感度フラグが立ってれば処理に移る
		$mes = array("ちゅっちゅ","わぁい"); //好感度が上がっていたユーザだったときの台詞
		$mes_n = count($mes) - 1; 
		$mesrand = mt_rand (0,$mes_n); 
		}else{
		$loverand = mt_rand (0,5); //0～5の乱数を作成
		if( $loverand == 1 ){ //乱数が1だったら実行
		$lovetrue = 1; //好感度が上がるフラグを立てる
		$mes = array("／／／"); //好感度が上がったときの台詞
		$mes_n = count($mes) - 1; 
		$mesrand = mt_rand (0,$mes_n); 
		}
		}
	}else{
	return; //自分が反応できるPOSTが無かったので、処理を中断してサブルーチンから抜ける
	}
}elseif( preg_match("/眠い/",$text)){ //上記で調べた自分へのリプライがなかった場合にこの処理に移る。POST内容に眠いが含まれていたら次の処理に移る
	$mes = array("寝ろ");
	$mes_n = count($mes) - 1;
	$mesrand = mt_rand (0,$mes_n);
}else{ //どちらにも引っかからなかった場合にこの処理に移る
return; //自分が反応できるPOSTが無かったので、処理を中断してサブルーチンから抜ける
}
//何かしら反応できるPOSTがあればここから先に進む

if( $lovetrue == 1 ){ //好感度上昇フラグが立っていれば処理に移る
$lovelist = file($lovefile); //好感度をファイルから変数に代入
$lovefh = fopen("$lovefile","w+"); //好感度ファイルを上書きモードで開く
fwrite($lovefh,""); //一旦好感度ファイルの中身を空にする
$lovefh = fopen("$lovefile","a+"); //好感度ファイルを追加書き込みモードで開く
foreach($lovelist as $loveid){ //リストを1つずつ展開
if( $loveid == $twitterid ){ //展開しているリストとPOSTしたユーザIDが一致すれば処理に移る
}else{ //POSTしたユーザじゃなかったら処理に移る
fwrite($lovefh,"$loveid"); //書き込みなおす
}
} //ループ処理終了
fwrite($lovefh,"$twitterid\n"); //改めて現在処理中のユーザIDを好感度リストに追加
}

$post = '@'.$screen_name.' '.$mes[$mesrand]; //リプライ文章を作成

$result = $st->setUpdate($post); //POSTを投稿

if($result){
	echo "POST成功<br>";
	echo "POST内容「{$post}」<br>";
}elseif($result){
	echo "POST失敗<br>";
	echo "POST内容「{$post}」<br>";
}


return;

}

if($rep_n){
}else{
	echo "${cron}分以内に送られたリプライはありません<br>";
}



?>