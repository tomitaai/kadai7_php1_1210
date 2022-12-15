<?php

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}


//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table;');
$status = $stmt->execute();



//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){

    if($result['bookRate']===1){
      $starImg = "img/r1.png";
    }else if($result['bookRate']===2){
      $starImg = "img/r2.png";
    }else if($result['bookRate']===3){
      $starImg = "img/r3.png";
    }else if($result['bookRate']===4){
      $starImg = "img/r4.png";
    }else{
      $starImg = "img/r5.png";
    }
    
    $view .= '<tr><td>' . h($result['bookName']) . '</td><td>' . h($result['bookAuthors']) . '</td><td>' . h($result['bookComment']) . '</td><td>' . '<img src = "' . $starImg . '" alt="' . h($result['bookName']) . '" width="60px" height="20px"></td><td><a href="' . h($result['bookUrl']) . '" target="_blank"><button class="btn detail-btn">詳細</button></a></td></tr>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/style.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
    <table border="1" cellpadding="10"><tr>
      <th>書籍名</th>
      <th>著者</th>
      <th>コメント</th>
      <th>星</th>
      <th>詳細</th>
    </tr>
    <tr><?= $view ?></tr></div>
</div>
<!-- Main[End] -->

</body>
</html>