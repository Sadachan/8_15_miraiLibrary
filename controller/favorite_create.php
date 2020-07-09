<?php

include('../functions.php');

session_start();

$title=$_POST['title'];
$price=$_POST['price'];
$image=$_POST['image'];
$link=$_POST['link'];
$keyword=$_POST['keyword'];
$user_id=$_SESSION["user_id"];

//DB接続
$pdo=dbconect();

$sql='INSERT INTO favorite(favorite_id,title,price,image,link,category,user_id)VALUES(NULL,:title,:price,:image,:link,"未分類",:user_id)';
$stmt=$pdo->prepare($sql);
$stmt->bindValue(':title',$title,PDO::PARAM_STR);
$stmt->bindValue(':price',$price,PDO::PARAM_STR);
$stmt->bindValue(':image',$image,PDO::PARAM_STR);
$stmt->bindValue(':link',$link,PDO::PARAM_STR);
$stmt->bindValue(':user_id',$user_id,PDO::PARAM_INT);
$status=$stmt->execute();

if($status==false){
  $error=$stmt->errorInfo();
  echo json_encode(["error_msg"=>"{$error[2]}"]);
  exit();
}else{
  $stmt->fetch(PDO::FETCH_ASSOC);
  $url="../view/index.php?keyword=" . $keyword;
  header("Location:" . $url);
}

