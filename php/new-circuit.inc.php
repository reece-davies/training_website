<?php

if (isset($_POST['new-circuit-submit']))
{
    require 'dbh.inc.php';
    
    $proId = $_POST['proid'];
    $title = $_POST['circTitle'];
    $rounds = $_POST['circRounds'];
    $rest = $_POST['circRest'];
    //$exercise;


    if (empty($title) || empty($rest) || empty($rounds))
    {
        //header("Location: ../new-circuit.php?proid=" . $proId . ",error=emptyfields");
        header("Location: ../new-circuit.php?error=emptyfields&proid=".$proId."&circTitle=".$title."&circRounds=".$rounds."&circRest=".$rest);
        exit(); 
    }    
    else
    {

        //////////////////////////////////
        // 1.) GET VALUES FROM DATABASE //
        //////////////////////////////////

        $sql = "SELECT MAX(circuit_id) FROM circuits";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            //header("Location: ../new-circuit.php?error=sqlerrorselect");
            header("Location: ../new-circuit.php?error=sqlerrorselect&proid=".$proId."&circTitle=".$title."&circRounds=".$rounds."&circRest=".$rest);
            exit();
        }
        else
        {
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result))
            {

                
                /////////////////////////////////////
                // 3.) INSERT VALUES INTO DATABASE //
                /////////////////////////////////////

                $circuitId = (int)$row['MAX(circuit_id)'];
                $circuitId = $circuitId + 1;
                
                //$replaceSessionUserId = $_SESSION['userId'];
                
                
                $sql = "INSERT INTO circuits (programme_id, circuit_id, circuit_title, circuit_rest, circuit_sets) VALUES ('$proId', '$circuitId', '$title', '$rest', '$rounds')";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    //header("Location: ../new-circuit.php?error=sqlerrorinsert&proid=".$replaceSessionUserId."&circTitle=".$title."&circRounds=".$rounds."&circRest=".$rest);
                    header("Location: ../new-circuit.php?error=sqlerrorinsert&proid=".$proId."&circTitle=".$title."&circRounds=".$rounds."&circRest=".$rest);
                    exit();
                }
                else
                {
                    
                    mysqli_stmt_execute($stmt);

                    ///////////////////////////////////////
                    // 3.5) INSERT EXERCISES TO DATABASE //
                    ///////////////////////////////////////

                    //$array1= array('Mathematics','Physics');
                    //array_push($array1,'Chemistry','Biology');
                    //print_r($array1);

                    $weightArray = array();
                    $repsArray = array();
                    $counter = 0;

                    foreach($_POST['circWeight'] as $weight)
                    {
                        array_push($weightArray, $weight);
                    }

                    foreach($_POST['circReps'] as $reps)
                    {
                        array_push($repsArray, $reps);
                    }

                    foreach($_POST['circEx'] as $exercise) {
                        
                        /////////////////////////
                        // Get max exercise id //
                        /////////////////////////

                        $sql = "SELECT MAX(exercise_id) FROM exercises";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            //header("Location: ../new-circuit.php?error=sqlerrorselect");
                            header("Location: ../new-circuit.php?error=sqlerrorselect&proid=".$proId."&circTitle=".$title."&circRounds=".$rounds."&circRest=".$rest);
                            exit();
                        }
                        else
                        {
                            mysqli_stmt_execute($stmt);
                            
                            $result = mysqli_stmt_get_result($stmt);

                            if ($row = mysqli_fetch_assoc($result))
                            {

                                $exerciseId = (int)$row['MAX(exercise_id)'];
                                $exerciseId = $exerciseId + 1;

                                
                                //$replaceSessionUserId = $_SESSION['userId'];

                                ///////////////////
                                // Post exercise //
                                ///////////////////

                                // LOREM IPSUM - NEED EXERCISE WEIGHT AND REPS TO POST TO DATABASE // CHECK COUNTER
                                $sql = "INSERT INTO exercises (circuit_id, exercise_id, exercise_title, weight, reps) VALUES ('$circuitId', '$exerciseId', '$exercise', '$weightArray[$counter]', '$repsArray[$counter]')";
                                $stmt = mysqli_stmt_init($conn);

                                if (!mysqli_stmt_prepare($stmt, $sql))
                                {
                                    //header("Location: ../new-circuit.php?error=sqlerrorinsert&proid=".$replaceSessionUserId."&circTitle=".$title."&circRounds=".$rounds."&circRest=".$rest);
                                    header("Location: ../new-circuit.php?error=sqlerrorinsert&proid=".$proId."&circTitle=".$title."&circRounds=".$rounds."&circRest=".$rest);
                                    exit();
                                }
                                else
                                {
                                    mysqli_stmt_execute($stmt);
                                    $counter++;
                                }

                            }
                        }
                    }

                    /////////////////////////////////////////
                    // 4.) GO TO NEW PAGE (WITH VARIABLES) //
                    /////////////////////////////////////////

                    header("Location: ../unique-programme.php?proid=".$proId);
                    exit();
                }                
            }
            else 
            {
                header("Location: ../new-circuit.php?error=sqlerror");
                exit();
            }


        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else
{
    header("Location: ../new-circuit.php");
    exit();
}


?>