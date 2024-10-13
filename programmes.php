<!DOCTYPE html>
<html lang="en">

<?php include ("./inc/head.inc.php"); ?>

<body>
  <div class="wrapper">
    
    <?php include ("./inc/navbar.inc.php"); ?>
    
    
    <!-- Main Section-->
    <div class="main app form" id="main">

      <!-- Classes Section     style="background-color: red;" -->
      <div class="pitch" id="classes" style="padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: -20px; height: 330px;">
        <div class="hero-content text-center">
            <h1 class="wow fadeInUp" data-wow-delay="0.1s">TRAINING PROGRAMMES</h1>
            <a href="#popup1" class="btn btn-action wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">New Programme</a>
        
            <?php
              if (isset($_GET['error']))
              {
                if ($_GET['error'] == 'emptyfields')
                {
                  echo '<p style="color: red; font-size: 21px; padding: 15px;"> Fill in all fields. </p>';
                }   
                else if ($_GET['error'] == 'sqlerror' || $_GET['error'] == 'sqlerrorselect' || $_GET['error'] == 'sqlerrorinsert')
                {
                  echo '<p style="color: red; font-size: 21px; padding: 15px;""> Error with database. </p>';
                }             
              }
            ?>
            
            <!-- Popup box -->
            <div id="popup1" class="overlay">
              <div class="popup">

                <h2 style="font-size: 40px; padding: 15px;"></h2>
                <a class="close" href="#">&times;</a>

                <div class="content" style="padding: 10px;">

                <!-- Stuff goes here -->
                  
                  <div class="container-login100" style="min-height: 1vh;">
                  <div class="wrap-login100">
                    <form class="login100-form validate-form" action="php/new-programme.inc.php" method="post">
                      <span class="login100-form-title p-b-34 p-t-27"> <!-- style="color: black;" -->

                        NEW PROGRAMME

                      </span>

                      <div class="wrap-input100 validate-input" data-validate = "Enter title">
                        <input class="input100" type="text" name="pro-title" placeholder="Programme Title">
                      </div>


                      <div class="container-login100-form-btn">
                        <button class="login100-form-btn"  type="submit" name="new-programme-submit">
                          Create
                        </button>
                      </div>

                    </form>
                    </div>
                  </div>

                <!-- END OF CONTENT -->
                </div>

                
              </div>


              </div>
            </div>
        
        
        
          </div>

      <div class="container-table100" style="padding-bottom: 100px; padding-top: 0px;">
          <div class="wrap-table100" >
              <div class="table">

                <div class="row header">
                <div class="cell">
                    Programme Title
                  </div>
                <div class="cell">
                    Programme ID
                  </div>
                  <div class="cell">
                    Date Created
                  </div>
                </div>

                <?php

                  require 'php/dbh.inc.php';


                  $sql = "SELECT * FROM programmes where user_id=" . $_SESSION['userId'];
                  $stmt = mysqli_stmt_init($conn);

                  if (!mysqli_stmt_prepare($stmt, $sql))
                  {
                      header("Location: /programmes.php?error=sqlerror");
                      exit();
                  }
                  else
                  {
                      //mysqli_stmt_bind_param($stmt, s, $_SESSION['userId']);
                      mysqli_stmt_execute($stmt);

                      $result = mysqli_stmt_get_result($stmt);


                      while ($row = mysqli_fetch_assoc($result))
                      {
                        //$json_array[] = $row;
                        if ($row["date"] == null)
                        {
                          $row["date"] = "1999/01/01";
                        }

                        $proId = $row["programme_id"];

                        //echo 'SECTION-ONE:'. $row["programme_id"];
                        echo '  
                        <div class="row">
                          <div class="cell" data-title="Programme Title" onclick="viewProgramme('.  $row["programme_id"] .')">' .
                            $row["programme_title"] .
                          '</div>
                          <div class="cell" data-title="Programme ID" onclick="viewProgramme('.  $row["programme_id"] .')">' . 
                            $row["programme_id"] .
                          '</div>
                          <div class="cell" data-title="Date Created" onclick="viewProgramme('.  $row["programme_id"] .')">' . 
                            $row["date"] .
                          '</div>
                          <div class="cell edit-programme" style="color: #00aeda" onclick="changeProgramme('. $proId . ')">
                          <div class="glyphicon glyphicon-pencil" style="transform: rotate(130deg);"></div>
                            Edit
                          </div>
                        </div>
                        ';
                      }
                                            
                  }

                ?>

              </div>
          </div>
      </div>


    <?php include ("./inc/footer.inc.php"); ?>
  </body>
</html>
