@extends('layouts.layout')

@section('content')

<?php

require_once('common.php');
$hits = array();
$query =  !empty($_GET["query"])? $_GET["query"] : "";
$sort =  !empty($_GET["sort"]) && array_key_exists($_GET["sort"], $sortOrder) ? $_GET["sort"] : "-score";
$category_id = !empty($_GET["category_id"]) && ctype_digit($_GET["category_id"]) && array_key_exists($_GET["category_id"], $categories) ? $_GET["category_id"] : 1;

if ($query != "") {
    $query4url = rawurlencode($query);
    $sort4url = rawurlencode($sort);
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch?appid=$appid&query=$query4url&category_id=$category_id&sort=$sort4url";
    $xml = simplexml_load_file($url);
    if ($xml["totalResultsReturned"] != 0) {//検索件数が0件でない場合,変数$hitsに検索結果を格納します。
        $hits = $xml->Result->Hit;
    }
}
?>

<h2 class= "title">好きな商品を検索！！</h2>
<form action="/" class="Search">
表示順序:
<select name="sort">
<?php foreach ($sortOrder as $key => $value) { ?>
<option value="<?php echo h($key); ?>" <?php if($sort == $key) echo "selected=\"selected\""; ?>><?php echo h($value);?></option>
<?php } ?>
</select>
キーワード検索：
<select name="category_id">
<?php foreach ($categories as $id => $name) { ?>
<option value="<?php echo h($id); ?>" <?php if($category_id == $id) echo "selected=\"selected\""; ?>><?php echo h($name);?></option>
<?php } ?>
</select>
<input type="text" name="query" value="<?php echo h($query); ?>"/>
<input type="submit" value="Yahooショッピングで検索"/>
</form>
<div class="main-left">
    <?php foreach ($hits as $hit) { ?>
    <div class="Item">
        <h2><a href="<?php echo h($hit->Url); ?>" target="_blank"><?php echo h($hit->Name); ?></a></h2>
        <p><a href="<?php echo h($hit->Url); ?>" target="_blank"><img src="<?php echo h($hit->Image->Medium); ?>" /></a><?php echo h($hit->Description); ?></p>
        <p class="detail">価格:<?php echo h($hit->Price); ?>円/レビュー平均:<?php echo h($hit->Review->Rate); ?>点/レビュー総数:<?php echo h($hit->Review->Count); ?>件/JANコード:<?php echo h($hit->JanCode); ?><button class="btn btn-success add-button">追加</button></p>
    </div>
    <?php } ?>
    <a href="http://developer.yahoo.co.jp/about">
    <img src="http://i.yimg.jp/images/yjdn/yjdn_attbtn2_105_17.gif" width="105" height="17" title="Webサービス by Yahoo! JAPAN" alt="Webサービス by Yahoo! JAPAN" border="0" style="margin:15px 15px 15px 15px"></a>
</div>
<div class="main-right">
    <h3>お気に入りリストに追加する商品</h3>
    <div class="table-responsive">
        <form method="post" action= "{{url('/')}}">
            @csrf
            <table class="table table-striped" id="table_id">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">商品名</th>
                    <th scope="col">リンク先</th>
                    <th scope="col">JANコード</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th></th>
                    <td><input type="submit" value="以下の商品をお気に入りに登録"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

@endsection