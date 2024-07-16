<?php
    if(isset($_POST['login']))
    {
        $L=$_POST['login'];
        $P=$_POST['password'];

        $P=hash('sha256',$P);
        $L=htmlentities($L);

        require("connect.php");
        $L=mysqli_real_escape_string($connection,$L);

        $query=""; //dostosować do bazy
        $result=mysqli_query($connection,$query);   //$connection -> connect
        if($result)
        {
            $how_many_records=mysqli_num_rows($result);
            if($how_many_records == 1)
            {
                $row = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['logged_in'] = $row['Id_author'];
                $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];


                header("Location:login.php?info=login_ok");
                exit();
            }
            else {
                header("Location:login.php?info=login_error");
                exit();
            } 
        }
    }
    else
    {
        header('Location:login.php?info=empty');
        exit();
    }
?>