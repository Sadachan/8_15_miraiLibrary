<?php
  session_start();

  //セッションを初期化
  $_SESSION=array();

  //Cookieに保存してあるsessionIDを過去にして破棄
  if(isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-42000,'/');
  }
  //サーバー側でのセッションIDの破棄
  session_destroy();
  
  //処理後login.phpへの遷移
  header('Location:../view/login.php');