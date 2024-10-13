<?php


if (isset($_POST['alter-circuit-title-submit']))
{
    require 'dbh.inc.php';
    
    $proId = $_POST['proId'];
    $circuitId = $_POST['circId'];      // Get from url and put into form
    $newTitle = $_POST['circTitle'];
    $oldTitle;                          // Get from the database (NOT NEEDED IN THIS SCENARIO)


    if (empty($proId) || empty($circuitId) || empty($newTitle))
    {
        header("Location: ../alter-circuit-title.php?error=emptyfields&proid=".$proId."&circid=".$circuitId);
        exit(); 
    }    
    else
    {
        // Scan database for this specific circuit
        $sql = "UPDATE circuits SET circuit_title = '".$newTitle."' WHERE circuit_id = '".$circuitId."'";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../alter-circuit-title.php?error=sqlerror&proid=".$proId."&circid=".$circuitId);
            exit();
        }
        else
        {
            mysqli_stmt_execute($stmt);            
            //$result = mysqli_stmt_get_result($stmt);

            header("Location: ../unique-programme.php?proid=".$proId);
            exit();
            
            
        } // End of db query
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else
{
    header("Location: ../alter-circuit-title.php");
    exit();
}


?>