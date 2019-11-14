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


}

 ?>
