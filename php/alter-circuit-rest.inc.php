<?php


if (isset($_POST['alter-circuit-rest-submit']))
{
    require 'dbh.inc.php';
    
    $proId = $_POST['proId'];
    $circuitId = $_POST['circId'];      // Get from url and put into form
    $newRest = $_POST['circRest'];
    $oldRest;                          // Get from the database


    if (empty($proId) || empty($circuitId) || empty($newRest))
    {
        header("Location: ../alter-circuit-rest.php?error=emptyfields&proid=".$proId."&circid=".$circuitId);
        exit(); 
    }    
    else
    {
        // Scan database for this specific circuit
        $sql = "SELECT * FROM circuits where circuit_id=$circuitId";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../alter-circuit-rest.php?error=sqlerror&proid=".$proId."&circid=".$circuitId);
            exit();
        }
        else
        {
            mysqli_stmt_execute($stmt);            
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result))
            {
                // Get the circuit-rest
                $oldRest = $row['circuit_rest'];
            }

            // Start new database query; get MAX outdated_rest_id
            $sql = "SELECT MAX(out_rest_id) FROM out_rest";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: ../alter-circuit-rest.php?error=sqlerror&proid=".$proId."&circid=".$circuitId);
                exit();
            }
            else
            {
                mysqli_stmt_execute($stmt);            
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result))
                {
                    
                    $outId = (int)$row['MAX(out_rest_id)'];
                    $outId = $outId + 1;
                    

                    // Insert old circuit rest into out_rest table
                    $sql = "INSERT INTO out_rest (circuit_id, out_rest_id, out_rest_value) VALUES ('$circuitId', '$outId', '$oldRest')";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        header("Location: ../alter-circuit-rest.php?error=sqlerror&proid=".$proId."&circid=".$circuitId);
                        exit();
                    }
                    else
                    {
                        mysqli_stmt_execute($stmt);
                        

                        // Update circuit rest in original table
                        $sql = "UPDATE circuits SET circuit_rest = '".$newRest."' WHERE circuit_id = '".$circuitId."'";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("Location: ../alter-circuit-rest.php?error=sqlerror&proid=".$proId."&circid=".$circuitId);
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
    header("Location: ../alter-circuit-rest.php");
    exit();
}


?>