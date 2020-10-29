<?php
mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['id'])){
    try{
        //try catch分。DB接続できなければエラーメッセージを表示
        $pdo=new PDO("mysql:dbname=kanamori;host=localhost;","root","");
    }catch(PDOException $e){
        die("<P>申し訳ございません。現在サーバーが混み合っており一時的にアクセス出来ません。<br>しばらくしてから再度ログインをしてください。<p>
        <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>
        ");
    }

    $sql="select id,name,mail,password,picture,comments FROM login_mypage WHERE mail = ? AND password = ?;";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(1,$_POST['mail']);
    $stmt->bindValue(2,$_POST['password']);

    $stmt->execute();

    $pdo=NULL;
    
    $id = '';
    
    while ($row = $stmt->fetch())
    {
        $id = $row[0];
        $_SESSION['id'] = $row[0];
        $_SESSION['name'] = $row[1];
        $_SESSION['mail'] = $row[2];
        $_SESSION['password'] = $row[3];
        $_SESSION['picture'] = $row[4];
        $_SESSION['comments'] = $row[5];
    }

    if(empty($id)){
        $_SESSION['error']='メールアドレスまたはパスワードが間違っています。';
    header('Location: http://localhost/login_mypage/login_error.php');
    }
    if(!empty($_POST['login_keep'])){
        $_SESSION['login_keep']=$_POST['login_keep'];
    }
    
}

if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
}elseif(empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
}


?>

<!DOCTYPE HTML>
<html lang="ja">
    
<head>
    <meta charset="utf-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="mypage.css">
</head>
    
<body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="logout"><a href="log_out.php">ログアウト</a></div>
    </header>

    <main>
    <form action="mypage_hensyu.php" method="post" enctype="multipart/form-data">
    
    <div class="confirm">
        
        <h1>会員情報</h1>
        
        <div class="hello">こんにちは <?php echo $_SESSION['name'];?> さん</div>
        
        <div class="pic">
            
            <img src="<?php echo $_SESSION['picture'];?>">
            
        </div>
        
        <div class="right">
        
        <p>氏名：
            <?php echo $_SESSION['name'];?>
        </p>
        <p>メール：
            <?php echo $_SESSION['mail'];?>
        </p>
        <p>パスワード：
            <?php echo $_SESSION['password'];?>
        </p>
        
        </div>
        
        <hr>
        
        <div class="comment">
            <?php echo $_SESSION['comments'];?>
        </div>
        
        <form action="mypage_hensyu.php" method="post" class="form_center">
            <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">
            <div class="edit_button">
                <input type="submit" class="button" value="編集する"/>
            </div>
        
        </form>
        
    </div>
    
    </form>
        
    </main>
    
<footer>
    ©2018 InterNous.inc.ALL rights reserved
</footer>
</body>

</html>
