<?php
mb_internal_encoding("utf8");

session_start();
if(isset($_SESSION['id'])){
header('Location:mypage.php');
}
?>

<!DOCTYPE HTML>
<html lang="ja">
    
<head>
    <meta charset="utf-8">
    <title>マイページ登録</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
    
<body>
    
    <header>
        <img src="4eachblog_logo.jpg">
    </header>

    <main>
        <form action="mypage.php" method="post" enctype="multipart/form-data">
            <div class="confirm">
                
                <div class="error"><?php echo $_SESSION['error'];?></div>

                <div class="mail">
                    <label>メールアドレス</label><br>
                    <input type="text" class="formbox" size="40" name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                </div>
                <div class="password">
                    <label>パスワード</label><br>
                    <input type="password" class="formbox" size="40" name="password" id="password" pattern="^[a-zA-Z0-9]{6,}$" required>
                </div>
                
                <div class=confirm_button>
                        <input type="submit" class="button1" value="ログイン"/>

                </div>
            </div>
        </form>
    </main>