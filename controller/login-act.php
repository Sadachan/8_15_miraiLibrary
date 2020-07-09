<?php
  include('../functions.php');
  session_start();
  

  $pdo=dbconect();
  $stmt=$pdo->prepare('select * from user where mail=? and password=?');
  $status=$stmt->execute([$_POST['mail'],$_POST['password']]);

  
  if($status==false){
    $error=$stmt->errorInfo();
    echo json_encode(["error_msg"=>"{$error[2]}"]);
    exit();
  }else{
    $val=$stmt->fetch(PDO::FETCH_ASSOC);
  }
  
  if(!$val){
    echo "<p>ログイン情報に誤りがあります</p>";
    echo "<a href='../view/login.php'>戻る</a>";
  }else{
    $_SESSION=array();
    $_SESSION["session_id"]=session_id();
    $_SESSION["user_id"]=$val["user_id"];
    $_SESSION["user_name"]=$val["user_name"];
    $_SESSION["mail"]=$val["mail"];
    $_SESSION["password"]=$val["password"];
    header('Location:../view/index.php');
  }
  
?>

  