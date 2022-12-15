$(document).on("click", ".loop_books_item", function () {
    let MyBookName = document.getElementById("bookName");
    MyBookName.value = ($(this).children('.loop_books_title')).text();
    let MyBookAuthors = document.getElementById("bookAuthors");
    MyBookAuthors.value = ($(this).children('.loop_books_authors')).text();
    let MyBookUrl = document.getElementById("bookUrl");
    MyBookUrl.value = ($(this).children('.loop_books_url')).text();
    let MyBookImg = document.getElementById("bookImg");
    MyBookImg.src = ($(this).children('.loop_books_img')).text();
});




$(function(){
    $(document).on({
        'mouseenter' : function() {
            $('.close-btn').css('backgroundColor','#4310c455');
        },
        'mouseleave' : function(){
            $('.close-btn').css('backgroundColor','#ffffff')}
        }, '.close-btn');
    })

$(function(){
    $(document).on({
        'mouseenter' : function() {
            $('.save-btn').css('backgroundColor','#4310c455');
        },
        'mouseleave' : function(){
            $('.save-btn').css('backgroundColor','#ffffff')}
        }, '.save-btn');
    })
    
$(function(){
    $(document).on({
        'mouseenter' : function() {
            $(this).css('backgroundColor','#4310c455');
        },
        'mouseleave' : function(){
            $(this).css('backgroundColor','#ffffff')}
        }, '.detail-btn');
    })

$(function(){
    $(document).on({
        'mouseenter' : function() {
            $(this).css('backgroundColor','#4310c455');
        },
        'mouseleave' : function(){
            $(this).css('backgroundColor','#ffffff')}
        }, '.presave-btn');
    })
    




// 0.保存データ表示
for (let i = 1; i < localStorage.length+1; i++) {
        
    // 表示する要素を追加
    $(".myrecipelist").prepend(
        '<div class="col-12 col-md-4 col-lg-3"><a class="url'+i+'" href="http://"><div class="myrecipe"><p class="name name'+i+'"></p><div class="row"><div class="col-6 recipe-imgarea"><img class="recipe-img recipe-img'+i+'" alt="レシピ画像"></div><div class="col-6 starimagearea"><p class="ratename">たろう</p><img class="star-img1'+i+'" alt="星"><p class="ratename">はなこ</p><img class="star-img2'+i+'" alt="星"><p class="ratename">けん</p><img class="star-img3'+i+'" alt="星"></div></div><p class="memo memo'+i+'"></p></div></a></div>'
    );

    // ローカルストレージからデータ取得
    const json_localData = localStorage.getItem(i);
    // JSON文字列 -> JavaScriptオブジェクトに変換
    const localData = JSON.parse(json_localData);
    // 画面に表示
    $(".name"+i).append(localData.name);
    $(".url"+i).attr("href", localData.url);
    $(".recipe-img"+i).attr("src", localData.base64);
    $(".memo"+i).append(localData.memo);

    if(localData.rating1==="1"){
        $(".star-img1"+i).attr("src", "img/r1.png");
    }else if(localData.rating1==="2"){
        $(".star-img1"+i).attr("src", "img/r2.png");
    }else if(localData.rating1==="3"){
        $(".star-img1"+i).attr("src", "img/r3.png");
    }else if(localData.rating1==="4"){
        $(".star-img1"+i).attr("src", "img/r4.png");
    }else{
        $(".star-img1"+i).attr("src", "img/r5.png");
    }

    if(localData.rating2==="1"){
        $(".star-img2"+i).attr("src", "img/r1.png");
    }else if(localData.rating2==="2"){
        $(".star-img2"+i).attr("src", "img/r2.png");
    }else if(localData.rating2==="3"){
        $(".star-img2"+i).attr("src", "img/r3.png");
    }else if(localData.rating2==="4"){
        $(".star-img2"+i).attr("src", "img/r4.png");
    }else{
        $(".star-img2"+i).attr("src", "img/r5.png");
    }

    console.log(localData.rating3)
    console.log(localData)

    if(localData.rating3==="1"){
        $(".star-img3"+i).attr("src", "img/r1.png");
    }else if(localData.rating3==="2"){
        $(".star-img3"+i).attr("src", "img/r2.png");
    }else if(localData.rating3==="3"){
        $(".star-img3"+i).attr("src", "img/r3.png");
    }else if(localData.rating3==="4"){
        $(".star-img3"+i).attr("src", "img/r4.png");
    }else{
        $(".star-img3"+i).attr("src", "img/r5.png");
    }
}

// 1.saveクリックイベント

$("#save").on('click', function () {


    let number = localStorage.length+1;
    let rname = $("#name").val();
    let base64 = $("#base64").val();
    let url = $("#url").val();
    let rating1 = $('input:radio[name="rating1"]:checked').val();
    let rating2 = $('input:radio[name="rating2"]:checked').val();
    let rating3 = $('input:radio[name="rating3"]:checked').val();
    let memo = $("#memo").val();

    // オブジェクトにする
    let formData = {
        name: rname,
        base64: base64,
        url: url,
        rating1: rating1,
        rating2: rating2,
        rating3: rating3,
        memo: memo
    }

    // JavaScriptオブジェクト -> JSON文字列に変換
    let json_formData = JSON.stringify(formData);
    // ローカルストレージに保存
    localStorage.setItem(number,json_formData);

    // ページ再読み込み
    window.location.reload();

});


// 1-2.レシピ画像クリックイベント


$("#image").on('change', function () {
    const image = document.querySelector('#image')
    const file = image.files[0]

    const reader = new FileReader()
    reader.onload = function (e) {
    const base64 = reader.result

    document.querySelector('#uploadimage').innerHTML = `
    <img src="${base64}">
    `    
    document.querySelector('#base64').value = base64
    $('.base64area').css("display", "block");
    }
    reader.readAsDataURL(file)
});


// 1-3.レーティングクリックイベント

$(':radio').change(
    function(){
        $('.choice').text( this.value + ' stars' );
    } 
)



//2.clear クリックイベント

$("#clear").on("click", function () {
    localStorage.clear();

    // ページ再読み込み
    window.location.reload();
});


