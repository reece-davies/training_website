<?php

if (isset($_POST['new-programme-submit']))
{
    require 'dbh.inc.php';

    $title = $_POST['pro-title'];

    

    /*
        1.) Get values from database (and increment MAX programme id by 1)
        2.) Start session with with variable values
        3.) Insert values into database
        4.) Go to new page with passing variables
    */

    if (empty($title))
    {
        header("Location: ../programmes.php?error=emptyfields");
        exit(); 
    }    
    else
    {

        //////////////////////////////////
        // 1.) GET VALUES FROM DATABASE //
        //////////////////////////////////


        $sql = "SELECT MAX(programme_id) FROM programmes";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../programmes.php?error=sqlerrorselect");
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

                session_start();

                $proId = (int)$row['MAX(programme_id)'];
                $proId = $proId + 1;
                $proTitle = $_POST['pro-title'];
                $replaceSessionUserId = $_SESSION['userId'];
                $currentDate = date("y/m/d");

                
                $sql = "INSERT INTO programmes (user_id, programme_id, programme_title, date) VALUES ('$replaceSessionUserId', '$proId', '$proTitle', '$currentDate')";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../programmes.php?error=sqlerrorinsert");
                    exit();
                }
                else
                {
                    
                    mysqli_stmt_execute($stmt);

                    ///////////////////////
                    // 2.) START SESSION //
                    ///////////////////////

                                    
                    //session_start();
                    //$_SESSION['proId'] = $proId;
                    //$_SESSION['proTitle'] = $proTitle;


                    /////////////////////////////////////////
                    // 4.) GO TO NEW PAGE (WITH VARIABLES) //
                    /////////////////////////////////////////

                    //header("Location: ../unique-programme.php&uid=".$user_id."&proid=".$proId."&proTitle=".$proTitle);


                    header("Location: ../unique-programme.php?proid=".$proId);
                    exit();
                }

                

            }
            else 
            {
                header("Location: ../programmes.php?error=sqlerror");
                exit();
            }


        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else
{
    header("Location: ../programmes.php");
    exit();
}


?>