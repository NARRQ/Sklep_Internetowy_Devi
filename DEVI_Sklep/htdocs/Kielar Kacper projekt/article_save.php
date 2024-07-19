<?php
    if(isset($_POST['title']))
    {
        session_start();
        if(isset($_SESSION['logged_in']) && $_SESSION['ip']=$_SERVER['REMOTE_ADDR'])
        {
            $T=$_POST['title'];
            $C=$_POST['content'];
            $ID=$_SESSION['logged_in'];

            $T=htmlentities($T);

            require('connect.php');

            $T=mysqli_real_escape_string($connection,$T);

            $query="insert into articles values('','$T','$C','$ID','curdate()')";
            $result=mysqli_query($connection,$query);
            if($result)
            {
                //sukces
                header('Location:article_add.php?info=article_ok');
                exit();
            }
            else
            {
                //error
                header('Location:article_add.php?info=article_error');
                exit();
            }
        }
        else
        {
            exit();
        }   
    }
    else
        {
            header('Location:article_add.php?info=empty');
            exit();
        }    
?>