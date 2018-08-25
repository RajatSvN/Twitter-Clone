<?php

include("functions.php");

include("Views/header.php");

if($_GET['page'] == 'timeline' AND isset($_GET['page']) AND isset($_SESSION['id'])){

  include("Views/timeline.php");

}else if($_GET['page'] == 'search' AND isset($_GET['page'])AND isset($_SESSION['id'])){

  include("Views/search.php");

}
else if($_GET['page'] == 'yourtweets' AND isset($_GET['page'])AND isset($_SESSION['id'])){

  include("Views/yourtweets.php");

}else if($_GET['page'] == 'publicprofiles' AND isset($_GET['page'])){

  include("Views/publicprofiles.php");

}
else{
  
  include("Views/home.php");
  
}
include("Views/footer.php");

?>