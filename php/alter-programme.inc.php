<?php


if (isset($_POST['alter-programme-submit']))
{
    require 'dbh.inc.php';
    
    $proId = $_POST['proId'];
    $newTitle = $_POST['proTitle'];


    if (empty($proId) || empty($newTitle))
    {
        header("Location: ../alter-programme.php?error=emptyfields&proid=".$proId);
        exit(); 
    }    
    else
    {
        // Scan database for this specific circuit
        $sql = "UPDATE programmes SET programme_title = '".$newTitle."' WHERE programme_id = '".$proId."'";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../alter-programme.php?error=sqlerror&proid=".$proId);
            exit();
        }
        else
        {
            mysqli_stmt_execute($stmt);            
            //$result = mysqli_stmt_get_result($stmt);

            header("Location: ../programmes.php");
            exit();
            
            
        } // End of db query
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else
{
    header("Location: ../alter-programme.php");
    exit();
}


?>