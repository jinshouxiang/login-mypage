<?php
mb_internal_encoding("utf8");

session_start();

if(!isset($_POST['from_mypage']) || empty($_POST['from_mypage'])){
    header('Location: http://localhost/login_mypage/login_error.php');
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
        <div class="logout"><a href="login.php">ログアウト</a></div>
    </header>

    <main>
    <form action="mypage_update.php" method="post" enctype="multipart/form-data">
    
    <div class="confirm">
        
        <h1>会員情報</h1>
        
        <div class="hello">こんにちは <?php echo $_SESSION['name'];?> さん</div>
        
        <div class="pic">
            
            <img src="<?php echo $_SESSION['picture'];?>">
            
        </div>
        
        <div class="right">
        
        <p>氏名：
            <input type="text" class="formbox" size="40" name="name" required value="<?php echo $_SESSION['name'];?>"/>
        </p>
        <p>メール：
            <input type="text" class="formbox" size="40" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required value="<?php echo $_SESSION['mail'];?>"/>
        </p>
        <p>パスワード：
            <input type="password" class="formbox" size="40" name="password" id="password" pattern="^[a-zA-Z0-9]{6,}$" required value="<?php echo $_SESSION['password'];?>"/>
        </p>
        
        </div>
        
        <hr>
        
        <div class="comment">
            <textarea rows="5" cols="45" name="comments"><?php echo $_SESSION['comments'];?></textarea>
        </div>
        
    
        
        <div class=edit_button>
            <input type="submit" class="button" value="この内容に変更する"/>
        </div>
        
    </div>
    
    </form>
        
    </main>
    
<footer>
    ©2018 InterNous.inc.ALL rights reserved
</footer>
    
</body>

</html>