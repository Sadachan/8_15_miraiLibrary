<?php
  include('../header.php');
  //include('functions.php');

  //session_start();

  //もしログイン状態なら気になる気になるリストを取得
  $results='';
  if(!isset($_SESSION["session_id"]) || $_SESSION["session_id"]!=session_id()){
    
  }else{
    $results=getFavoriteByID();
  }


  //検索実行
  if(isset($_POST['keyword']) || isset($_GET['keyword'])){
    $keyword="";
    if(isset($_POST['keyword'])){$keyword=$_POST['keyword'];}
    if(isset($_GET['keyword'])){$keyword=$_GET['keyword'];}
    $data="https://www.googleapis.com/books/v1/volumes?country=JP&maxResults=40&q={$keyword}";
    $json=file_get_contents($data);
    $json_decode=json_decode($json);
    
    //jsonデータ内の『entry』部分を取得して、postsに格納
    $posts=$json_decode->items;
    $postsAmount=count($posts);
    $thumbnail=array();
    $title=array();
    $price=array();
    $link=array();
    $favorite_flag=array();
    forEach($posts as $post){
      //もしimageLinksがあれば
      if(isset($post->volumeInfo->imageLinks)){
        //サムネイルを取得して表示
        array_push($thumbnail,$post->volumeInfo->imageLinks->thumbnail);
      }else{
        //もしなければダミー画像なし
        array_push($thumbnail,'../img/dummy.png');
      }

      //もしlistPriceがあれば
      if(isset($price,$post->saleInfo->listPrice)){
        //値段を取得して表示
        array_push($price,$post->saleInfo->listPrice->amount);
      }else{
        //なければ不明と表示
        array_push($price,'不明');
      }

      //titleを取得
      array_push($title,$post->volumeInfo->title);

      //リンクを取得
      array_push($link,$post->volumeInfo->infoLink);

      //気になるリストがあればフラグをオンなければオフ（リンクで比較（おそらく一意なため））
      $flag='off';
      if($results!==''){
        forEach($results as $result){
          if($post->volumeInfo->title==$result['title']){
            $flag='on';
          }
        }
      }
      array_push($favorite_flag,$flag);
    }
  }
  //ログイン有無を確認
  $login_status=login_check();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <title>bookSearchEngine</title>
</head>

<html>
  <body>
    <form action="index.php" method="POST">
      <div class="search-area">
        <input type="text" class="search-box" name="keyword" value='<?php if(isset($keyword)){echo $keyword;}?>' placeholder="検索">
        <button class="submit-button" type="submit"><i class="fas fa-search"></i></button>
      </div>
    </form>
    <ul class="search-result-lists">
    <?php if(isset($_POST['keyword']) || isset($_GET['keyword'])){?>
      <?php for($i=0; $i<$postsAmount; $i++){?>
        <li class="search-result-list">
          <form action="../controller/favorite_create.php" method="POST">
            <input type="hidden" name="keyword" value="<?=$keyword?>">
            <a href=<?=$link[$i]?>> 
            <input type="hidden" name="link" value="<?=$link[$i]?>">
              <img class="image" src='<?=$thumbnail[$i]?>'>
              <input type="hidden" name="image" value="<?=$thumbnail[$i]?>">
            </a>
            <a href=<?=$link[$i]?>> 
              <p class="title"><?=$title[$i]?></p>
              <input type="hidden" name="title" value="<?=$title[$i]?>">
            </a>
            <!-- <?php if(!empty($favorite_flag)){?> -->
              <?php if($favorite_flag[$i]=='on'){?>
                <input type="text" class="favorite off" value="気になるリスト登録済み">
              <?php }else{?>
                <input type="submit" class="favorite" value="気になるリストに入れる">
              <?php }?>
            <!-- <?php }?> -->
            <p class="price">￥<?=$price[$i]?></p>
            <input type="hidden" name="price" value="<?=$price[$i]?>">
          </form> 
        </li>
      <?php }?>
    <?php }?>
    </ul>
    <script>
      $('.favorite').on('click',function(){
        let login_status='<?php echo $login_status; ?>'
        if(login_status=='on'){
          
        }else if(login_status=='off'){
          alert('気になるリストに入れるにはログインが必要です')
          return false;
        }
      })
    </script>
  </body>
</html>