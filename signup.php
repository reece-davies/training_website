<!DOCTYPE html>
<html lang="en">

<?php include ("./inc/head.inc.php"); ?>

<body>
  <div class="wrapper">
    
    <?php include ("./inc/navbar.inc.php"); ?>
    
    <!-- Main Section-->
    <div class="main app form" id="main">


      <!-- Classes Section -->
    <div class="pitch" id="classes">

      <div class="container-login100">
        <div class="wrap-login100">
          <form class="login100-form validate-form" action="php/signup.inc.php" method="post">
            <span class="login100-form-logo">
              <i class="zmdi zmdi-landscape"></i>
            </span>

            <span class="login100-form-title p-b-34 p-t-27">
              Sign up

              <?php
                if (isset($_GET['error']))
                {
                  if ($_GET['error'] == 'emptyfields')
                  {
                    echo '<p class="error-message"> Fill in all fields. </p>';
                  }
                  else if ($_GET['error'] == 'passwordcheck')
                  {
                    echo '<p class="error-message"> The passwords do not match. </p>';
                  }
                  else if ($_GET['error'] == 'emailcheck')
                  {
                    echo '<p class="error-message"> The emails do not match. </p>';
                  }
                  else if ($_GET['error'] == 'sqlerror')
                  {
                    echo '<p class="error-message"> There is an error with the database. </p>';
                  }
                  else if ($_GET['error'] == 'usertaken')
                  {
                    echo '<p class="error-message"> The username is taken. </p>';
                  }
                }
              ?>
            </span>

            

            <div class="wrap-input100 validate-input" data-validate = "Enter username">
              <input class="input100" type="text" name="uid" placeholder="Username">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Enter first name">
              <input class="input100" type="text" name="fName" placeholder="First Name">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Enter last name">
              <input class="input100" type="text" name="lName" placeholder="Last Name">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Enter email address">
              <input class="input100" type="email" name="mail" placeholder="Email Address">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "Re-enter email address">
              <input class="input100" type="email" name="conf-mail" placeholder="Confirm Email Address">
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Enter password">
              <input class="input100" type="password" name="pwd" placeholder="Password">
              <span class="focus-input100" data-placeholder="&#xf191;"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Re-enter password">
              <input class="input100" type="password" name="conf-pwd" placeholder="Confirm Password">
              <span class="focus-input100" data-placeholder="&#xf191;"></span>
            </div>

            <div class="container-login100-form-btn">
              <button class="login100-form-btn" type="submit" name="signup-submit">
                Sign up
              </button>
            </div>
          </form>
        </div>
      </div>

    </div>

    
  </div>

  <?php include ("./inc/footer.inc.php"); ?>
</body>
</html>
