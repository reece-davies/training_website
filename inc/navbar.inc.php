<!DOCTYPE html>
<html lang = "en">
    
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container"> 
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand page-scroll" href="index.php"><img src="images/logo.png" width="80" height="30" alt="iLand" /></a> </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                

                <?php
                    if (isset($_SESSION['userId']))
                    {
                      echo '<!-- <li><a class="page-scroll" href="#main">Home</a></li> -->
                      <li><a                     href="programmes.php">Programmes</a></li>
                      <li><form action="php/logout.inc.php" method="post">  <button href="#" class="btn btn-action" type="submit" name="logout-submit" style="padding: 13px; margin-top: 4px; margin-bottom: 15px; border-radius: 25px; font-size: 14px;"> LOGOUT </button> </form></li>';
                    }
                    else
                    {
                      echo '<!-- <li><a class="page-scroll" href="#main">Home</a></li> -->
                      <li><a class="page-scroll" href="#classes">Classes</a></li>
                      <li><a class="page-scroll" href="#features">Features</a></li>
                      <li><a class="page-scroll" href="#review">Reviews</a></li>
                      <li><a class="page-scroll" href="#pricing">Pricing</a></li>
                      <li><a class="page-scroll" href="#contact">Contact</a></li>
                      <li><a                     href="login.php">Login</a></li>
                      <li><a                     href="signup.php">Sign up</a></li>';
                    }
                ?>
            </ul>
            </div>
        </div>
        </nav>
        <!-- /.navbar-collapse --> 
    </div>
    <!-- /.container-fluid -->
    
</html>