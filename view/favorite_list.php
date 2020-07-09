<?php 
  include('../header.php');

  //session_start();

  //お気に入りリストをDBから取得
  $results=getFavoriteByID();
  $title=array();
  $price=array();
  $image=array();
  $link=array();
  $category=array();
  $favorite_id=array();
  forEach($results as $result){
    array_push($title,$result['title']);
    array_push($price,$result['price']);
    array_push($image,$result['image']);
    array_push($link,$result['link']);
    array_push($category,$result['category']);
    array_push($favorite_id,$result['favorite_id']);
  }
?>
<ul class="search-result-lists favo">
<?php for($i=0; $i<count($results); $i++){?>
  <li class="search-result-list">
      <form action="../controller/favorite_delete.php" method="POST">
        <input type="hidden" name="favorite_id" value="<?=$favorite_id[$i]?>">
        <a href=<?=$link[$i]?>> 
        <input type="hidden" name="link" value="<?=$link[$i]?>">
          <img class="image" src='<?=$image[$i]?>'>
          <input type="hidden" name="image" value="<?=$image[$i]?>">
        </a>
        <a href=<?=$link[$i]?>> 
          <p class="title"><?=$title[$i]?></p>
          <input type="hidden" name="title" value="<?=$title[$i]?>">
        </a>

        <input type="submit" class="favorite delete" value="気になるリストから削除">

        <p class="price">￥<?=$price[$i]?></p>
        <input type="hidden" name="price" value="<?=$price[$i]?>">
      </form> 
  </li>
<?php }?>
</ul>