<?php

//1. POSTデータ取得
$bookName = $_POST['bookName'];
$bookAuthors = $_POST['bookAuthors'];
$bookUrl = $_POST['bookUrl'];
$bookRate = $_POST['bookRate'];
$bookComment = $_POST['bookComment'];


//2. DB接続します
try {
  //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
exit('DBConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare('INSERT INTO
                        gs_bm_table(id, bookName, bookAuthors, bookUrl, bookRate, bookComment, date)
                        VALUES(NULL, :bookName, :bookAuthors, :bookUrl, :bookRate, :bookComment, sysdate())');

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':bookName', $bookName, PDO::PARAM_STR);
$stmt->bindValue(':bookAuthors', $bookAuthors, PDO::PARAM_STR);
$stmt->bindValue(':bookUrl', $bookUrl, PDO::PARAM_STR);
$stmt->bindValue(':bookRate', $bookRate, PDO::PARAM_STR);
$stmt->bindValue(':bookComment', $bookComment, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('ErrorMessage:'.$error[2]);
}else{
  //５．index.phpへリダイレクト
    header('Location: index.php');
}
?>