<?php

if (isset($_POST['signup-submit']))
{
    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['mail'];
    $emailRepeat = $_POST['conf-mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['conf-pwd'];
    
    
    if (empty($username) || empty($firstName) || empty($lastName) || empty($email) || empty($emailRepeat) || empty($password) || empty($passwordRepeat))
    {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit(); 
    }
    else if ($password !== $passwordRepeat)
    {
        header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
        exit(); 
    }
    else if ($email !== $emailRepeat)
    {
        header("Location: ../signup.php?error=emailcheck&uid=".$username."&mail=".$email);
        exit(); 
    }
    else
    {
        $sql = "SELECT username FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0)
            {
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit(); 
            }
            else
            {
                $sql = "INSERT INTO users (username, email_address, password, first_name, last_name) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else
                {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hashedPwd, $firstName, $lastName);
                    mysqli_stmt_execute($stmt);

                    
                    ////////// Login //////////
                    
                    //$sql = "SELECT * FROM users where username=? OR email_address=?";
                    $sql = "SELECT * FROM users where username=? OR email_address=?";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql))
                    {
                        header("Location: ../signup.php?error=sqlerror");
                        exit();
                    }
                    else
                    {
                        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
                        mysqli_stmt_execute($stmt);

                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_assoc($result))
                        {
                            
                            session_start();
                            $_SESSION['userId'] = $row['user_id'];
                            $_SESSION['userUid'] = $row['username'];

                            header("Location: ../index.php?signup=success");
                            exit();

                        }
                        else 
                        {
                            header("Location: ../signup.php?error=nouser");
                            exit();
                        }
                    }


                    /*
                    session_start();
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['userUid'] = $row['username'];

                    header("Location: ../index.php?login=success");
                    exit();
                    */

                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else
{
    header("Location: ../signup.php");
    exit();
}


?>