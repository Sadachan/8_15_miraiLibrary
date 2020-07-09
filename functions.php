<?php

function dbconect(){
  $dbn="mysql:dbname=booklife;charset=utf8;port=3306;host=localhost";
  $user="root";
  $pwd="";

  try{
    $pdo=new PDO($dbn,$user,$pwd);
  }catch(PDOException $e){
    echo json_encode(["db error"=>"{$e->getMessage()}"]);
  }
  return $pdo;
}

function session_check_id(){
  if(!isset($_SESSION['session_id']) || $_SESSION['session_id']!=session_id()){
    header('Location:login.php');
  }else{
    session_regenerate_id(true);
    $_SESSION['session_id']=session_id();
  }
}

//お気に入りリストを取得する関数
function getFavoriteByID(){
  $user_id=$_SESSION['user_id'];
  $pdo=dbconect();
  $sql="SELECT * FROM favorite WHERE user_id=:user_id";
  $stmt=$pdo->prepare($sql);
  $stmt->bindValue(':user_id',$user_id,PDO::PARAM_INT);
  $status=$stmt->execute();
  if($status==false){
    $error=$stmt->errorInfo();
    echo json_encode(["error_msg"=>"{$error[2]}"]);
    exit();
  }else{
    $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
  }  
}

function login_check(){
  //ログイン有無を確認
  $login_status='';
  if(!isset($_SESSION["session_id"]) || $_SESSION["session_id"]!=session_id()){
    $login_status='off';
  }else{
    $login_status='on'; 
  }
  // echo $login_status;
  // exit();
  return $login_status;
  
}
