<div class="container">
<div class="row">
  <div class="col-8"><div class="alert alert-primary" style="margin-top:70px"> <h2>Your Tweets :</h2></div><br><?php displayTweets("personal"); ?></div>
  <div class="col-4" style="margin-top:70px">
  
    <?php searchTweet();  ?>
    
    <hr>
    
    <?php makeTweet();  ?>
  </div>
</div>
</div>