<?php 
  require '../functions.php';
  session_start();
  //var_dump($_POST);

  $name=$_POST['name'];
  $mail=$_POST['mail'];
  $password=$_POST['password'];

  $pdo=dbconect();

  $sql=$pdo->prepare('select * from user where mail=?');
  $sql->execute([$mail]);


  if(empty($sql->fetchAll())){
    //データ登録SQL作成
    $sql="INSERT INTO user(user_id,user_name,mail,password)VALUES(Null,:name,:mail,:password)";

    //SQL準備&実行
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(':name',$name,PDO::PARAM_STR);
    $stmt->bindValue(':mail',$mail,PDO::PARAM_STR);
    $stmt->bindValue(':password',$password,PDO::PARAM_STR);
    $status=$stmt->execute();
    
    //セッションのためにセレクト文投げる
    $stmt=$pdo->prepare('select * from user where mail=? and password=?');
    $stmt->execute([$mail,$password]);


    //データ登録処理後
    if($status==false){
      //SQL実行に失敗した場合はここでエラーを出力し、以降の処理を中止する
      $error=$stmt->errorInfo();
      exit('sqlError'.$error[2]);
    }
    
    if($stmt->fetchColumn() > 0){
      $_SESSION=array();
      $_SESSION['session_id']=session_id();
      $_SESSION['id']=$val['user_id'];
      $_SESSION['user_name']=$val['user_name'];
      $_SESSION['mail']=$val['mail'];
      $_SESSION['password']=$val['password'];

      header('Location:../view/index.php');
    }

  }else{
    echo "<p>すでに登録されているユーザです．</p>";
    echo '<a href="todo_login.php">login</a>';
    exit();
  }

 