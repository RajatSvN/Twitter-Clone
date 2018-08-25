<?php
session_start();

$link = mysqli_connect("shareddb-h.hosting.stackcp.net","Tweetter-44414#s@2","FakePass","Tweetter-44414#s@2") ;

if(isset($_GET['function'])){

  session_unset();

}

function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'min'),
        array(1 , 'sec')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}




function displayTweets($type){

  global $link ;
  $coFollowers = 0;
  $whereClause = "" ;
  if($type == "public"){
  
    $whereClause = "";  
  
  }else if($type == "isFollowing"){
  
  $query = "SELECT * FROM isFollowing WHERE follower = ".mysqli_real_escape_string($link,$_SESSION['id']) ;
    
   
    
    $result = mysqli_query($link,$query);
    $whereClause = "" ;
    
    while($row = mysqli_fetch_assoc($result)){
    
      $coFollowers = $coFollowers +1 ;
      
      if($whereClause == ""){
      
        $whereClause = " WHERE " ;
      
      }else{
      
        $whereClause.= " OR ";
      
      }
    
      $whereClause .= " userid = ".$row['isFollowing'] ;
    
    }
  

  }else if($type == "personal"){
  
    $whereClause = "WHERE userid = ".mysqli_real_escape_string($link,$_SESSION['id']);
  
}else if($type == "search" AND isset($_GET['q'])){
  
    echo "<div class='alert alert-success'>Showing results for : ".$_GET['q']."</div>";
    
  $whereClause = "WHERE tweet LIKE '%".mysqli_real_escape_string($link,$_GET['q'])."%'";
  
  }else if(is_numeric($type)){
  
    $userQuery = "Select email from users where id = ".mysqli_real_escape_string($link,$type) ;
      $userQueryResult = mysqli_query($link,$userQuery);
      $userRes = mysqli_fetch_assoc($userQueryResult);
    
    echo "<div class='alert alert-primary' style='margin-top:70px'>Showing results for : ".$userRes['email']."</div>";
    
  $whereClause = "WHERE userid = ".mysqli_real_escape_string($link,$type);
  
  }
  
  if($type == "isFollowing" AND $coFollowers == 0 ){
  
    echo "<div class = 'alert alert-primary'>You are not following anyone!</div>";
  
  
  }else{
  
  
  
  $query = "Select * FROM tweets ".$whereClause." ORDER BY datetime DESC LIMIT 100 " ;
  
    
 
  
  $res = mysqli_query($link,$query);
    
   
    
  if(mysqli_num_rows($res)==0){
  
    echo "There are no tweets to display!";
    
  }else{
  
    while($row = mysqli_fetch_assoc($res)){
    
      $userQuery = "Select * from users where id = ".mysqli_real_escape_string($link,$row['userid']) ;
      $userQueryResult = mysqli_query($link,$userQuery);
      $userRes = mysqli_fetch_assoc($userQueryResult);
		
      
      
      echo "<div class='container' style='border : solid 1px blue; margin-bottom : 15px;'> 
      <p ><a style='overflow-wrap: break-word;' href='?page=publicprofiles&userid=".$userRes['id']."'>".$userRes['email']."</a><span style='position : relative; float: right;color : lightgrey;'>  ".time_since(time()-strtotime($row['datetime']))."  ago  </span></p>";
    
        echo "<p>".$row['tweet']."</p>";
    
      
     if(isset($_SESSION['id']))
      echo "<p><a href='' class='toggleFollow' data-userId='".$row['userid']."'>";
        
      $query = "SELECT * FROM isFollowing WHERE follower = ".mysqli_real_escape_string($link,$_SESSION['id'])." AND isFollowing = ".mysqli_real_escape_string($link,$row['userid'])." LIMIT 1 ";
      
      $result = mysqli_query($link,$query);
      
      if( mysqli_num_rows($result) > 0 ){
        
        echo "Unfollow";
        
      }else{
      
      echo "Follow";
      
      }
        
        
        echo "</a></p></div>";
      
    }
  
  
  
  }
  }
}
function searchTweet(){

 echo ' <form class="form-inline" id="searchBox">
  <input type="hidden" name="page" value="search">
  <input type="text" name = "q" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="search text here...">
  <button type="submit" class="btn btn-primary mb-2">Search</button>
</form> ' ;


}

function makeTweet(){

if(isset($_SESSION['id'])){

  echo ' <div class="alert alert-danger" style=" display : none ; " id="fail">We are having trouble posting your tweet, Please try again later!</div>
  
  		<div class="alert alert-success" style=" display : none ; " id="success">Your tweet is being posted....</div>
  
  		<div class="form" id="makeTweet">
  
  		<textarea class="form-control" rows="5" id="tweetContent"></textarea>
  
  		<center><button type="submit" id = "tweetPost" class="btn btn-primary mb-2" style="margin-top:12px;">Tweet</button></center>
        
		</div>' ;
  }
}

function displayUsers(){

  global $link ;

      $userQuery = "Select * from users ";
      $userQueryResult = mysqli_query($link,$userQuery);
     while( $userRes = mysqli_fetch_assoc($userQueryResult)){

       
       
echo "<p><a href=' ?page=publicprofiles&userid=".$userRes['id']."'>".$userRes['email']."</a></p>";


     }
}
?>