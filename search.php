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
      <?php
      $i = 0;
      foreach($books as $book):
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
        <div class="loop_books_item col-4" data-bs-toggle="modal" data-bs-target="#registerModal">
          <img class="loop_books_img" src="<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>"><br />
          <p class="loop_books_str">
            <b>『<?php echo $title; ?>』</b><br />
            著者：<?php echo $authors; ?>
          </p>

        </div>
      <?php $i++;
      endforeach; ?>

    </div><!-- ./loop_books -->

  <!-- 書籍情報が取得されていない場合 -->
  <?php else: ?>
    <p>情報が有りません</p>

  <?php endif; ?>










  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">本を登録する</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form method="post" action="insert.php">
        <div class="insert">
            <fieldset>
              <!-- <div class="form-group"> -->
              <div class="row">
                <div class="col-md-6">






                  <label class="normallabel">書籍名：</label>
                  <input class="form-control" type="text" name="bookName" value="aa">
                  <label class="normallabel">著者名：</label>
                  <input class="form-control" type="text" name="bookAuthor">
                  <label class="normallabel">URL：</label>
                  <input class="form-control" type="text" name="bookUrl"><br>
                  <label class="starlabel">評価：</label>
                  <div class="star-rating">
                    <input type="radio" name="bookRate" value="1"><i></i>
                    <input type="radio" name="bookRate" value="2"><i></i>
                    <input type="radio" name="bookRate" value="3"><i></i>
                    <input type="radio" name="bookRate" value="4"><i></i>
                    <input type="radio" name="bookRate" value="5"><i></i>
                  </div>
                </div>
                <div class="col-md-6 modal-img">
                  <img src="<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="normallabel">めも：</label>
                <textarea cols="50" rows="2" class="form-control" name="bookComment"></textarea>
                <div id="p1">aa</div>
















              </div>



                <!-- <div class="container-fluid">
                <form>
                    <div class="form-group">
                            <label class="normallabel" for="name">料理名</label>
                            <textarea id="name" class="form-control"></textarea>
                    </div>       
                    <div class="form-group">
                        <label class="normallabel" for="image">レシピ画像</label>
                        <input type="file" id="image" class="form-control" accept="image/*">
                        <div class="row">
                            <div class="col-3 uploadimagearea" id="uploadimage" class="form-control"></div>
                            <textarea id="base64" class="col-9 base64area" rows="6"></textarea>
                        </div>
                    <div class="form-group">
                        <label class="normallabel" for="url">URL</label>
                        <input type="url" id="url" class="form-control">
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="starlabel" for="rating1">たろう</label>
                            <div class="star-rating">
                                <input type="radio" name="rating1" value="1"><i></i>
                                <input type="radio" name="rating1" value="2"><i></i>
                                <input type="radio" name="rating1" value="3"><i></i>
                                <input type="radio" name="rating1" value="4"><i></i>
                                <input type="radio" name="rating1" value="5"><i></i>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="starlabel" for="rating2">はなこ</label>
                            <div class="star-rating">
                                <input type="radio" name="rating2" value="1"><i></i>
                                <input type="radio" name="rating2" value="2"><i></i>
                                <input type="radio" name="rating2" value="3"><i></i>
                                <input type="radio" name="rating2" value="4"><i></i>
                                <input type="radio" name="rating2" value="5"><i></i>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="starlabel" for="rating3">けん</label>
                            <div class="star-rating">
                                <input type="radio" name="rating3" value="1"><i></i>
                                <input type="radio" name="rating3" value="2"><i></i>
                                <input type="radio" name="rating3" value="3"><i></i>
                                <input type="radio" name="rating3" value="4"><i></i>
                                <input type="radio" name="rating3" value="5"><i></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="normallabel" for="memo">めも：</label>
                        <textarea id="memo" cols="50" rows="2" class="form-control"></textarea>
                    </div>
                </form>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn close-btn" data-bs-dismiss="modal">
                    閉じる
                </button>
                <button type="submit" id="save" class="btn save-btn">
                    登録
                </button>
            </div>
            </fieldset>
        </div>
    </form>

        </div>
    </div>
</div>



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/main.js">

</script>
</body>
</html>