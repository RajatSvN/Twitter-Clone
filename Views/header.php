<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    
	<link rel="stylesheet" href="http://rajhosting-com.stackstaging.com/TwitCln/styles.css">
    
    <title>Twitter</title>
    
    <style>
      
    </style>
    
  </head>
  <body>
    
<input type="hidden" value="1" id="status">
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" id="dialogTitle">Log In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" id="warnings" style="display:none;"></div>
        <form>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
    
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password">
  </div>
  </form>
      </div>
      <div class="modal-footer">
        <a href="#" style="padding-right: 2px" id="signUpLink">Sign Up!</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="dialogButton">Log In!</button>
        
      </div>
    </div>
  </div>
</div>
   
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="http://rajhosting-com.stackstaging.com/TwitCln/">Twitter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="?page=timeline">Your Timeline <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=yourtweets">Your Tweets</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="?page=publicprofiles">Public Profiles</a>
      </li>
      
      
    </ul>
    <div class="form-inline my-2 my-lg-0">
      <?php
      if(isset($_SESSION['id'])) {?>
      <a class="btn btn-outline-success my-2 my-sm-0" href="?function=logout">LogOut</a>
     <?php  } else { ?>
         <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#exampleModal" id="loginsignup">Login / Sign Up</button>
        <?php } ?>
    </div>
  </div>
</nav>
    
    
    