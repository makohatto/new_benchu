?<?php
require 'password.php';
session_start();

$db['host'] = "localhost"; //DBサーバのurl
$db['user'] = "hogeUser"; //ユーザー名
$db['pass'] = "hogehoge"; //ユーザー名のパスワード
$db['dbname'] = "loginManaagement"; //データベース名

$errorMassage = "";

if(issst($_POST["login"])) {
  if(empty($_POST["userid"])) {
    $errorMassage = 'ユーザーIDが未入力です。';
  }elseif(empty($_POST["password"])){
    $errorMassage = 'パスワードが未入力です。';
  }
  if(!empty($_POST["userid"]) && !empty($_POST["password"])){
    $userid=$_POST["userid"];

    $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
    //eroor処理
    try{
      $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      $stmt = $pdo->prepare('SELECT * FROM userData WHERE name = ?');
      $password = $_POST['password'];

      if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if(password_verify($password, $row['password'])) {
          session_regenerate_id(true);

          $id = $row['id'];
          $sql = "SELECT * FROM userData WHERE id = $id";
          $stmt = $pdo->query($spl);
          foreach ($stmt as $row){
            $row['name'];
          }
          $_SESSION['NAME']=$row['name'];
          header("Location: Main.php");
        exit();
      } else {
        $errorMassage = 'ユーザーIDあるいはパスワードに誤りがあります。';
      }
    } else {
      $errorMassage = 'ユーザーIDあるいはパスワードに誤りがあります。';
    }
  } catch (PDOException $e) {
    $errorMassage = 'データベースエラー';
  }
}
}

 ?>
 <!doctype html>
 <html lang="ja">
   <head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

     <title>login</title>
   </head>
   <body>
     <h1>ログイン画面!</h1>
     <form id="loginForm" name"loginForm" action="" method="post">
       <fieldset>
       <div><font color="#ff0000"<?php  echo htmlspecialchars($errorMassage, ENT_QUOTES); ?></font></div>

       </div>
       <legend>ログインフォーム</legend>
       <label for="password">パスワード</label><input type="password" name="password" value="">
       <label for="userid">ユーザーID</label><input type="text" id="userid" name="userid" placeholder="ユーザーIDを入力"value="<?php if(!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
       <br>
       <input type="submit" id="login" name="login" value="ログイン">
       </fieldset>
     </form>
     <br>
     <!-- Optional JavaScript -->
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   </body>
 </html>
