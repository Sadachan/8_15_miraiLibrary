<?php
  include('functions.php');
  session_start();
  $login_status=login_check();
  //echo $login_status;
?>

<!DOCTYPE html>
<html lang='ja'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='ie=edge'>
  <link rel='stylesheet' type='text/css' href='../css/style.css'>
  <script src='https://code.jquery.com/jquery-3.3.1.js'></script>
  <title></title>
</head>
<html>
  <body>
    <div class="app-title">未来書庫</div>
    <nav class="navi">
      <ul class="menu">
        <li class="nav-btn"><a href="index.php">本を探す</a></li>
        <li class="nav-btn"><a href="favorite_list.php" id="to-favorite-list">気になるリスト</a></li>
        
        <?php if($login_status=='off'){?>
          <li class="nav-btn regi"><a href="register.php">会員登録</a></li>
          <li class="nav-btn in"><a href="login.php">ログイン</a></li>
        <?php }?>
        <?php if($login_status=='on'){?>
          <li class="nav-btn user"><?=$_SESSION['user_name']?>さん</li>
          <li class="nav-btn out"><a href="../controller/logout.php">ログアウト</a></li>
        <?php }?>
      </ul>
    </nav>
    <hr>
  </body>
</html>


<script>
  $('#to-favorite-list').on('click',function(){
    let login_status='<?php echo $login_status; ?>'
    if(login_status=='on'){
      
    }else if(login_status=='off'){
      alert('この機能にはログインが必要です')
      return false;
    }
  })
</script>