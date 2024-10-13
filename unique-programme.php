<!DOCTYPE html>
<html lang="en">

<?php include ("./inc/head.inc.php"); ?>


<body>
  <div class="wrapper">
    
    <?php include ("./inc/navbar.inc.php"); ?>
    
    <!-- Main Section-->
    <div class="main app form" id="main">

      <!-- Classes Section     style="background-color: red;" -->
      <div class="pitch" id="classes" style="padding-top: 20px; margin-top: 0px; margin-bottom: 0px; padding-bottom: -20px; height: 240px;">
        <div class="hero-content text-center">

            <?php

              $proId = $_GET['proid'];
              $userId = $_SESSION['userId'];

              //echo '<h1 class="wow fadeInUp" data-wow-delay="0.1s">'. $proTitle . ' ('. $proId .') (' . $userId . ') </h1>';

              require 'php/dbh.inc.php';


              $sql = "SELECT * FROM programmes where user_id=" . $_SESSION['userId'] . " AND programme_id=" . $proId;
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql))
              {
                  header("Location: /programmes.php?error=sqlerror");
                  exit();
              }
              else
              {
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);

                  $noValue = FALSE;
                                   
                  while ($row = mysqli_fetch_assoc($result))
                  {
                    // echo '<h1 onclick="changeProgramme('. $proId . ')" class="wow fadeInUp" data-wow-delay="0.1s" style="cursor: pointer;">'. $row["programme_title"] . '</h1>';
                    echo '<h1 class="wow fadeInUp" data-wow-delay="0.1s">'. $row["programme_title"] . '</h1>';

                    $proTitle = $row["programme_title"];
                    $noValue = TRUE;
                  }

                  // If the value does not exist or belongs to someone else
                  if ($noValue == FALSE)
                  {
                    echo '<h1 class="wow fadeInUp" data-wow-delay="0.1s" style="color: red;"> THERE HAS BEEN AN ERROR </h1>';
                    
                    //header("Location: /programmes.php?error=sqlerror");
                    exit();
                  }                   
              }

              if (isset($_GET['error']))
              {
                if ($_GET['error'] == 'emptyfields')
                {
                  echo '<p class="error-message" style="color: red; font-size: 21px;"> Fill in all fields. </p>';
                }   
                else if ($_GET['error'] == 'sqlerror' || $_GET['error'] == 'sqlerrorselect' || $_GET['error'] == 'sqlerrorinsert')
                {
                  echo '<p class="error-message" style="color: red; font-size: 21px;"> Error with database. </p>';
                }             
              }

            ?>

            <!--
            WHERE THE POPUP BOXES ARE HIDDEN
            <a href="#popup2" class="btn btn-action wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">DELETE ME</a>
            -->

            <!-- End of page title -->
          </div>
      </div>



      <?php

              
              //$proId = $_GET['proid'];
              //$userId = $_SESSION['userId'];

              require 'php/dbh.inc.php';

              $sql = "SELECT * FROM circuits where programme_id=" . $proId;
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql))
              {
                  header("Location: /programmes.php?error=sqlerror");
                  exit();
              }
              else
              {
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);

                  // Loop through the circuits in circuits table that have: programme id = page                 
                  while ($row = mysqli_fetch_assoc($result))
                  {
                    //echo '<p>'. $row["circuit_title"] . ' </p>';
                    $circuitId = $row["circuit_id"];
                    $circuitRest = $row["circuit_rest"];
                    $circuitSets = $row["circuit_sets"];

                    echo '<div class="container-table100" style="padding-bottom: 50px; padding-top: 0px;">

                    <div class="circuit-title">  
                      <h1 class="circuit-title-text circuit-text" onclick="changeTitle('. $proId . ', ' . $circuitId .')" alter-link" data-wow-delay="0.1s">' . $row["circuit_title"] . '</h1>
                    </div>
        
                    
                    <div class="wrap-table100" >
        
                      <div class="table">
                            <div class="row header">
                                <div class="cell">
                                  Exercise Title
                                </div>
                                <div class="cell">
                                  Weight
                                </div>
                                <div class="cell">
                                  Reps
                                </div>
                              </div>
                              ';

                    
                    ///////////////////////////////////////////////////
                    // Look for all exercises relating to circuit id //
                    ///////////////////////////////////////////////////

                    $sql_two = "SELECT * FROM exercises where circuit_id=" . $circuitId;
                    $stmt_two = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt_two, $sql_two))
                    {
                        header("Location: /programmes.php?error=sqlerror");
                        exit();
                    }
                    else
                    {
                        mysqli_stmt_execute($stmt_two);
                        $result_two = mysqli_stmt_get_result($stmt_two);

                        ////////////////////////////////////////////////////////////////////////////////
                        // Loop through the circuits in circuits table that have: programme id = page //
                        ////////////////////////////////////////////////////////////////////////////////                
                        while ($row_two = mysqli_fetch_assoc($result_two))
                        {
                          
                          echo '<div class="row" onclick="changeExercise('. $proId .',' . $circuitId .',' . $row_two["exercise_id"] . ')">
                          <div class="cell" data-title="Exercise Title">
                            '. $row_two["exercise_title"] .'
                          </div>
                          <div class="cell" data-title="Weight">
                          '. $row_two["weight"] .'
                          </div>
                          <div class="cell" data-title="Reps">
                          '. $row_two["reps"] .'
                          </div>
                        </div>';
                          
                          
                        }       
                    }

                    ///////////////////
                    // Close circuit //
                    ///////////////////
                    echo '</div>
                  
                                </div>
                  
                                <div class="circuit-footer">  
                                  <h1 class="circuit-footer-left circuit-text" onclick="changeRounds('. $proId . ', ' . $circuitId .')" data-wow-delay="0.1s">Rounds: ' . $circuitSets . '</h1>
                                  <h1 class="circuit-footer-right circuit-text" onclick="changeRest('. $proId . ', ' . $circuitId .')" data-wow-delay="0.1s">Rest: ' . $circuitRest . '</h1>
                                </div>
                  
                          </div>';
                    
                    
                  }

                  echo '<div class="pitch text-center" id="classes" style="padding-top: 15px; padding-bottom: 170px;">
                  <a class="btn btn-action wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;" onclick="newCircuitPage('.  $proId .')">New Circuit</a>
                </div>';

                
                                    
              }

            ?>


   

    <?php include ("./inc/footer.inc.php"); ?>
  </body>
</html>
