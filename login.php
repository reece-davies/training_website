<!DOCTYPE html>
<html lang="en">

<?php include ("./inc/head.inc.php"); ?>

<body>
  <div class="wrapper">
    
    <?php include ("./inc/navbar.inc.php"); ?>
    
    <!-- Main Section-->
    <div class="main app form" id="main">


      <!-- Code taken from 'Classes Section' -->
    <div class="pitch" id="classes">

      <div class="container-login100">
        <div class="wrap-login100">
          <form class="login100-form validate-form" action="php/login.inc.php" method="post">
            <span class="login100-form-logo">
              <i class="zmdi zmdi-landscape"></i>
            </span>

            <span class="login100-form-title p-b-34 p-t-27">
              Login

              <?php
                if (isset($_GET['error']))
                {
                  if ($_GET['error'] == 'emptyfields')
                  {
                    echo '<p class="error-message"> Fill in all fields. </p>';
                  }
                  else if ($_GET['error'] == 'sqlerror')
                  {
                    echo '<p class="error-message"> There is an error with the database. </p>';
                  }
                  else if ($_GET['error'] == 'wrongpwd' || $_GET['error'] == 'nouser')
                  {
                    echo '<p class="error-message"> Wrong username and/or password. </p>';
                  }
                }
              ?>

            </span>

            <div class="wrap-input100 validate-input" data-validate = "Enter username">
              <input class="input100" type="text" name="mailuid" placeholder="Email or Username">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Enter password">
              <input class="input100" type="password" name="pwd" placeholder="Password">   <!-- Make sure the names are the same -->
              <span class="focus-input100" data-placeholder="&#xf191;"></span>
            </div>

            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
              <label class="label-checkbox100" for="ckb1">
                Remember me
              </label>
            </div>

            <div class="container-login100-form-btn">
              <button class="login100-form-btn"  type="submit" name="login-submit">
                Login
              </button>
            </div>

            <div class="p-t-90"> <!-- Was class="text-center p-t-90" -->
              <a class="txt1 text-left" href="#"> <!-- Was class="txt1" -->
                Forgot Password?
              </a>

              <a class="txt1 text-right" href="signup.php" style="float: right;">
                Don't Have An Account?
              </a>

            </div>
          </form>
        </div>
      </div>

    </div>

    
  </div>

  <?php include ("./inc/footer.inc.php"); ?>
</body>
</html>
