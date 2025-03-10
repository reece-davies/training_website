<?php

if (isset($_POST['login-submit']))
{
    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid']; // username AND email
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password))
    {
        header("Location: ../login.php?error=emptyfields");
        exit();
    }
    else
    {
        //$sql = "SELECT * FROM users where username=? OR email_address=?";
        $sql = "SELECT * FROM users where username=? OR email_address=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result))
            {
                $pwdCheck = password_verify($password, $row['password']);

                if ($pwdCheck == false)
                {
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
                else if ($pwdCheck == true)
                {
                    session_start();
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['userUid'] = $row['username'];

                    header("Location: ../programmes.php?login=success");
                    exit();
                }
                else {
                    header("Location: ../login.php?error=wrongpwd");
                    exit();
                }
            }
            else 
            {
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }

}
else
{
    header("Location: ../login.php");
    exit();
}

?>