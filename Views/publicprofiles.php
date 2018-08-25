<div class="container">
<div class="row">
  <div class="col-8">
    
    <?php if(isset($_GET['userid'])) { 
  
  
  
  displayTweets($_GET['userid']) ;?>
    
    
    
     
    
    
    <?php } else {  
  
  echo "<h2> ACTIVE USERS </h2>";
  
  displayusers(); ?>
  
    
   
    <?php } ?>
  
  </div>
  <div class="col-4" style="margin-top:70px">
  
    <?php searchTweet();  ?>
    
    <hr>
    
    <?php makeTweet();  ?>
  
  </div>
</div>
</div>