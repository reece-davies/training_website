<?php


if (isset($_POST['alter-circuit-exercise-submit']))
{
    require 'dbh.inc.php';
    
    $proId = $_POST['proId'];
    $circuitId = $_POST['circId'];      // Get from url and put into form
    $exerciseId = $_POST['exId'];
    $newTitle = $_POST['exTitle'];
    $newWeight = $_POST['exWeight'];
    $newReps = $_POST['exReps'];
    $oldWeight;
    $oldReps;


    if (empty($circuitId) || empty($exerciseId) || empty($proId) || empty($newTitle) || empty($newWeight) || empty($newReps))
    {
        header("Location: ../alter-circuit-exercise.php?error=emptyfields&proid=".$proId."&circid=".$circuitId."&exid=".$exerciseId);
        exit(); 
    }    
    else
    {
        // Scan database for this specific circuit
        $sql = "SELECT * FROM exercises where exercise_id=$exerciseId";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../alter-circuit-exercise.php?error=sqlerror&proid=".$proId."&circid=".$circuitId."&exid=".$exerciseId);
            exit();
        }
        else
        {
            mysqli_stmt_execute($stmt);            
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result))
            {
                // Get the old exercise weight and reps
                $oldWeight = $row['weight'];
                $oldReps = $row['reps'];
            }

            // Posting to out weight
            $sql = "SELECT MAX(out_weight_id) FROM out_weight";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../alter-circuit-exercise.php?error=sqlerror&proid=".$proId."&circid=".$circuitId."&exid=".$exerciseId);
                exit();
            }
            else
            {
                mysqli_stmt_execute($stmt);            
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result))
                {
                    
                    $outWeightId = (int)$row['MAX(out_weight_id)'];
                    $outWeightId = $outWeightId + 1;
                    

                    // Insert old exercise weight into out_weight table
                    $sql = "INSERT INTO out_weight (exercise_id, out_weight_id, out_weight_value) VALUES ('$exerciseId', '$outWeightId', '$oldWeight')";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        header("Location: ../alter-circuit-exercise.php?error=sqlerror&proid=".$proId."&circid=".$circuitId."&exid=".$exerciseId);
                        exit();
                    }
                    else
                    {
                        mysqli_stmt_execute($stmt);
                        
                    }

                }
            }

            // Posting to out reps
            $sql = "SELECT MAX(out_reps_id) FROM out_reps";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../alter-circuit-exercise.php?error=sqlerror&circid=".$circuitId."&exid=".$exerciseId);
                exit();
            }
            else
            {
                mysqli_stmt_execute($stmt);            
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result))
                {
                    
                    $outRepsId = (int)$row['MAX(out_reps_id)'];
                    $outRepsId = $outRepsId + 1;
                    

                    // Insert old exercise reps into out_reps table
                    $sql = "INSERT INTO out_reps (exercise_id, out_reps_id, out_reps_value) VALUES ('$exerciseId', '$outRepsId', '$oldReps')";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        header("Location: ../alter-circuit-exercise.php?error=sqlerror&circid=".$circuitId."&exid=".$exerciseId);
                        exit();
                    }
                    else
                    {
                        mysqli_stmt_execute($stmt);
                        
                    }

                }
            }



            // Update exercise values in original table
            $sql = "UPDATE exercises SET exercise_title = '".$newTitle."', weight = '".$newWeight."', reps = '".$newReps."' WHERE exercise_id = '".$exerciseId."'";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../alter-circuit-exercise.php?error=sqlerror&circid=".$circuitId."&exid=".$exerciseId);
                exit();
            }
            else
            {
                mysqli_stmt_execute($stmt);            
                
                header("Location: ../unique-programme.php?proid=".$proId); 
                
                exit();
                
                
            } // End of UPDATE db query
            
        } // End of db query
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else
{
    header("Location: ../alter-circuit-exercise.php");
    exit();
}


?>