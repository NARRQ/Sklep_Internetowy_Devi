<?php
    session_start();
    if(isset($_SESSION['logged_in']))
    {
        $_SESSION['logged_in']=0;
        header("Location:../index.php");
    }    
    else
    {
        header("Location:.//index.php?info=log-out-error");
        exit();
    }
?>