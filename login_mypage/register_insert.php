<?php
mb_internal_encoding("utf8");



//DB接続
$pdo=new PDO("mysql:dbname=kanamori;host=localhost;","root","");

//prepared statement(プリペアードステートメント)でSQL分の型を作る
//$pdo->exec("insert into login_mypage(name,mail,password,picture,comments)
//values('".$_POST['name']."','".$_POST['mail']."','".$_POST['password']."','".$_POST['picture']."','".$_POST['comments']."');");

$stmt = $pdo->prepare("insert into login_mypage(name,mail,password,picture,comments)
values(?,?,?,?,?);");

//bindValueメソッドでパラメータをセット
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['picture']);
$stmt->bindValue(5,$_POST['comments']);

//excuteでクエリを実行
$stmt->execute();
$pdo=NULL;

header('Location:after_register.html');
?>