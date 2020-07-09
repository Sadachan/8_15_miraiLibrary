<?php

  include('../functions.php');

  var_dump($_POST);

  $favorite_id=$_POST['favorite_id'];

  $pdo=dbconect();
  $sql="delete from favorite where favorite_id=:favorite_id";
  $stmt=$pdo->prepare($sql);
  $stmt->bindValue(':favorite_id',$favorite_id,PDO::PARAM_INT);
  $status=$stmt->execute();

  if($status==false){
    $error=$stmt->errorInfo();
    echo json_encode(["error_msg"=>"{$error[2]}"]);
    exit();
  }else{
    //成功時処理
    header('Location:../view/favorite_list.php');
  }

  