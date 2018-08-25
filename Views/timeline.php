<div class="container">
<div class="row">
  <div class="col-8"><h2> Your Feed </h2><br><?php displayTweets("isFollowing") ?></div>
  <div class="col-4" style="margin-top:70px">
  
    <?php searchTweet();  ?>
    
    <hr>
    
    <?php makeTweet();  ?>
  
  
  
  </div>
</div>
</div>