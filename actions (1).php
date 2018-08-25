<?php

include("functions.php");

$query="";

if($_GET['action'] == 'loginsignup'){
  
  $error = "";
  
  
  
  if($_POST['email'] == ""){
    $error .= "E-mail field is empty!<br>";
    }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $error .= "E-mail is invalid!<br>";
    
    }
    
    if($_POST['password'] == ""){
      $error .= "Password field is empty!<br>";
      
    }
    
    if($error == ""){
    if($_POST['status'] == "1"){
  
    if(mysqli_connect_error()){
    
      die("DATABASE CONNECTION ERROR!");
    
    }
  $email = $_POST['email'];
  $pass = $_POST['password'];
  
  $query = "SELECT * from users where email = '".mysqli_real_escape_string($link,$_POST['email'])."'";    
      
   $res = mysqli_query($link,$query)  ; 
  
      if(mysqli_num_rows($res) == 1){
      
        $row = mysqli_fetch_array($res);
        
        if(password_verify($pass,$row['password'])){
        $_SESSION['id'] = $row['id'];
           echo "1";
          
        
        }else{
        
        $error .= "Wrong Password!";
          echo $error ;
        
        }
       
    
    }else{
      
        $error .= "E-mail address does not exsists!<br>";
        echo $error ;
      }
      
  
  }else{
  
    if(mysqli_connect_error()){
    
      die("DATABASE CONNECTION ERROR!");
    
    }
  $query = "SELECT * from users where email = '".mysqli_real_escape_string($link,$_POST['email'])."'";
    
      
  $res = mysqli_query($link,$query)  ;
    
    if(mysqli_num_rows($res) > 0){
      
       $error .= "E-mail Address Already exsists!<br>";
    echo $error ;
    }else{
    
      
       $query = "Insert into users (email,password) values ('".mysqli_real_escape_string($link,$_POST['email'])."',"."'".mysqli_real_escape_string($link,$_POST['password'])."')";
      if(mysqli_query($link,$query)){
      
        $hashedPass = password_hash($_POST['password'],PASSWORD_DEFAULT);
        
        $query = "Update users set password ='".$hashedPass."' where password = '".$_POST['password']."'";
        
        $id = mysqli_insert_id($link);
        if(mysqli_query($link,$query)){
        $_SESSION['id'] = $id ;
        echo "1";
        
        }
      
      }else{
      
      $error.= "It seems like we can't sign you up for the moment. Please try again later!<br>";
      echo $error ;
      }
    
    
    }
  
  
  }
    }else{
    echo $error;
      
    }
}

	if($_GET['action']=='toggleFollow'){
    
    $query = "SELECT * FROM isFollowing WHERE follower = ".mysqli_real_escape_string($link,$_SESSION['id'])." AND isFollowing = ".mysqli_real_escape_string($link,$_POST['userId'])." LIMIT 1 ";
      
      
      
      $result = mysqli_query($link,$query);
      
      if( mysqli_num_rows($result) > 0  ){
      // Unfollowing 
        $row = mysqli_fetch_assoc($result);
        
        mysqli_query($link , "DELETE FROM  isFollowing WHERE id = ".mysqli_real_escape_string($link,$row['id'])." LIMIT 1 ");
        
    
        echo "1";
      	
      
      }else {
      
        mysqli_query($link , "INSERT INTO isFollowing (follower , isFollowing) VALUES ( ".mysqli_real_escape_string($link,$_SESSION['id']).", ".mysqli_real_escape_string($link,$_POST['userId']).")");
        
   
        echo "2";
      	
        
      
        
      }
   }
   
	
	if($_GET['action'] == "postTweet" ){
    
      if(!$_POST['tweetContent']){
      
      echo "Your tweet was empty!" ;
      
      }else if(strlen($_POST['tweetContent'])>140){
      
      echo "Your tweet was too long!";
      
      }else{
      
      $query = "INSERT into tweets (tweet,userid,datetime) VALUES('".mysqli_real_escape_string($link,$_POST['tweetContent'])."' ,".mysqli_real_escape_string($link,$_SESSION['id']).", NOW() ) " ;
      
        if(mysqli_query($link,$query)){
        
          echo "1";
          
        }else{
        
        echo "2";
        
        }
      
      }
    
    
    
    
    }
?>