<?php
// POSTデータ取得
$bookNameSearch = $_POST['bookNameSearch'];
$bookAuthorSearch = $_POST['bookAuthorSearch'];

// 検索条件を配列にする
$params = [
  // 連想配列は「キー => 値」 の形で記述する
  'intitle'  => $bookNameSearch,  //書籍タイトル
  'inauthor' => $bookAuthorSearch       //著者
];

// 1ページあたりの取得件数
$maxResults = 10;

// ページ番号（1ページ目の情報を取得）
// ページ毎の配列のうち何番目を取得するかを書く。1ページ目は配列的には0なので0と記入。
$startIndex = 0;

// APIの基本になるURL
$base_url = 'https://www.googleapis.com/books/v1/volumes?q=';

// 配列で設定した検索条件をURLに追加
foreach ($params as $key => $value) {
  $base_url .= $key.':'.$value.'+';
}

// 末尾につく「+」をいったん削除
$params_url = substr($base_url, 0, -1);

// 件数情報を設定
$url = $params_url.'&maxResults='.$maxResults.'&startIndex='.$startIndex;

// 書籍情報を取得
$json = file_get_contents($url);

// デコード（objectに変換）
$data = json_decode($json);

// echo ('<pre>');
// var_dump($data);
// echo ('</pre>');

// 全体の件数を取得('$data'というobjectがもつ'totalItems'の情報を取得)
$total_count = $data->totalItems;
// echo $data->totalItems;

// 書籍情報を取得(ページ毎の'$data->items'に入っている配列を'$books'へと格納)
$books = $data->items;
// echo ('<pre>');
// var_dump($data->items);
// echo ('</pre>');

// 実際に取得した件数(count関数で配列の要素の数を取得)
$get_count = count($books);


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Google Books APIの検索結果</title>
<!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">

</head>
<body>
  <p class="count">検索結果<br><br>
  全<?php echo $total_count; ?>件中、<?php echo $get_count; ?>件を表示中</p>

  <!-- 1件以上取得した書籍情報がある場合 -->
  <?php if($get_count > 0): ?>
    <div class="container">
    <div class="loop_books row">

      <!-- 取得した書籍情報を順に表示 -->
      <?php foreach($books as $book):
          // タイトル
          $title = $book->volumeInfo->title;

          // サムネ画像
          If (isset($book->volumeInfo->imageLinks->thumbnail)){
            $thumbnail = $book->volumeInfo->imageLinks->thumbnail;
          }else{
            $thumbnail = "https://katsushika.uwasa-no.com/wp-content/uploads/sites/2/2015/06/default-image.png";
          }
          
          // 著者（配列なのでカンマ区切りに変更）
          $authors = implode(',', $book->volumeInfo->authors);

      ?>
        <div class="loop_books_item col-4">
          <img class="loop_books_img" src="<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>"><br />
          <p>
            <b>『<?php echo $title; ?>』</b><br />
            著者：<?php echo $authors; ?>
          </p>
        </div>
      <?php endforeach; ?>

    </div><!-- ./loop_books -->

  <!-- 書籍情報が取得されていない場合 -->
  <?php else: ?>
    <p>情報が有りません</p>

  <?php endif; ?>

</body>
</html>