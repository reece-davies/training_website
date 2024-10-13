<?php


if (isset($_POST['alter-circuit-rounds-submit']))
{
    require 'dbh.inc.php';
    
    $proId = $_POST['proId'];
    $circuitId = $_POST['circId'];      // Get from url and put into form
    $newRounds = $_POST['circRounds'];
    $oldRounds;                          // Get from the database


    if (empty($proId) || empty($circuitId) || empty($newRounds))
    {
        header("Location: ../alter-circuit-rounds.php?error=emptyfields&proid=".$proId."&circid=".$circuitId);
        exit(); 
    }    
    else
    {
        // Scan database for this specific circuit
        $sql = "SELECT * FROM circuits where circuit_id=$circuitId";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../alter-circuit-rounds.php?error=sqlerror&proid=".$proId."&circid=".$circuitId);
            exit();
        }
        else
        {
            mysqli_stmt_execute($stmt);            
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result))
            {
                // Get the circuit-sets
                $oldRounds = $row['circuit_sets'];
            }

            // Start new database query; get MAX outdated_sets_id
            $sql = "SELECT MAX(out_sets_id) FROM out_sets";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../alter-circuit-rounds.php?error=sqlerror&proid=".$proId."&circid=".$circuitId);
                exit();
            }
            else
            {
                mysqli_stmt_execute($stmt);            
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result))
                {
                    
                    $outId = (int)$row['MAX(out_sets_id)'];
                    $outId = $outId + 1;
                    

                    // Insert old circuit sets into out_sets table
                    $sql = "INSERT INTO out_sets (circuit_id, out_sets_id, out_sets_value) VALUES ('$circuitId', '$outId', '$oldRounds')";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        header("Location: ../alter-circuit-rounds.php?error=sqlerror&proid=".$proId."&circid=".$circuitId);
                        exit();
                    }
                    else
                    {
                        mysqli_stmt_execute($stmt);
                        

                        // Update circuit sets in original table
                        $sql = "UPDATE circuits SET circuit_sets = '".$newRounds."' WHERE circuit_id = '".$circuitId."'";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("Location: ../alter-circuit-rounds.php?error=sqlerror&proid=".$proId."&circid=".$circuitId);
                            exit();
                        }
                        else
                        {
                            mysqli_stmt_execute($stmt);            

                            header("Location: ../unique-programme.php?proid=".$proId);
                            exit();
                            
                            
                        } // End of db query

                    }


                }
            }

            
        } // End of db query
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else
{
    header("Location: ../alter-circuit-rounds.php");
    exit();
}


?>