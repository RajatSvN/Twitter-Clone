
<nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
      
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          
          <li class="nav-item">
            <a class="nav-link disabled" href="#" style="text-align:center"> &copy; My Website 2018 <br>
            By : Rajat Sharma</a>
          </li>
          
        </ul>
      </div>
    </nav>



<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

<script>
  
  $("#dialogButton").click(function(){

    $.ajax({
  
    type : "POST",
    url : "actions.php?action=loginsignup",
    data : "email="+$("#email").val()+"&password="+$("#password").val()+"&status="+$("#status").val(),
    success :  function(result){
    
    if(result=="1"){
    
      window.location.assign("http://rajhosting-com.stackstaging.com/TwitCln/");
    
    }else{
    
      $("#warnings").html(result).show();
    
    }
    
    }
    
    
  
  
  })

  
  })
  
  
  
  $("#signUpLink").click(function(){
  
    if($("#status").val() == "1"){
  $(this).html("Log In!")
  $("#status").val("0")
  $("#dialogButton").html("Sign Up!")
  $("h5").html("Sign Up")
    }else{
  $(this).html("Sign Up!")
  $("#status").val("1")
  $("#dialogButton").html("Log In!")
  $("h5").html("Log In")
    }
  })
  
  
  $(".toggleFollow").click(function(e){
  
    e.preventDefault();
    
    var id = $(this).attr("data-userId");
    
    
    $.ajax({
  
    type : "POST",
    url : "actions.php?action=toggleFollow",
    data : "userId="+id,
    success :  function(result){
    
    if( result == "1" ){
    
      $("a[data-userId = '" + id + "']").html("Follow");
    
    }else if(result == "2"){
    
    $("a[data-userId = '" + id + "']").html("Unfollow");
    
    }
    
                              }
})
})
  
  $("#tweetPost").click(function(){
  
  
    $.ajax({
  
    type : "POST",
    url : "actions.php?action=postTweet",
    data : "tweetContent="+$("#tweetContent").val(),
    success :  function(result){
    
    if(result == "1"){
    
      $("#success").show();
      
      $("#fail").hide();
      
    
    }else if(result == "2" ){
    
      $("#fail").show();
      
      $("#success").hide();
    
    
    }else{
    
      $("#fail").html(result);
      
      $("#success").hide();
      
      $("#fail").show();
    
    
    
    
    }
    
                              }
})
   
  
  setTimeout(function() {
  location.reload();
}, 2500)
  
  
  })
</script>

  </body>
</html>