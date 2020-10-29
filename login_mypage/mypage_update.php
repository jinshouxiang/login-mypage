<?php
mb_internal_encoding("utf8");

session_start();

try{
    //try catch分。DB接続できなければエラーメッセージを表示
    $pdo=new PDO("mysql:dbname=kanamori;host=localhost;","root","");
}catch(PDOException $e){
    die("<P>申し訳ございません。現在サーバーが混み合っており一時的にアクセス出来ません。<br>しばらくしてから再度ログインをしてください。<p>
    <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>
    ");
}

$sql="UPDATE  login_mypage SET name = ?,mail = ?, password = ?,comments = ? WHERE id = ?;";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_SESSION['id']);

$stmt->execute();

$sql = NULL;
$stmt = NULL;

$sql="select id,name,mail,password,picture,comments FROM login_mypage WHERE id = ?;";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(1,$_SESSION['id']);

$stmt->execute();

$pdo=NULL;

while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
    $_SESSION['id'] = $row[0];
    $_SESSION['name'] = $row[1];
    $_SESSION['mail'] = $row[2];
    $_SESSION['password'] = $row[3];
    $_SESSION['picture'] = $row[4];
    $_SESSION['comments'] = $row[5];
}

header('Location: http://localhost/login_mypage/mypage.php');