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
    $view .= '<p><a href="' . h($result['bookUrl']) . '">' . h($result['bookName']) . '/' . h($result['bookComment']) . '</a></p>';
}

}
?>


