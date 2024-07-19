<?php
    if(!empty($_POST['login'])){
        $N=$_POST['name'];
        $L=$_POST['login'];
        $P=$_POST['password'];

        $P=hash('sha256',$P);
        $N=htmlentities($N);
        $L=htmlentities($L);

        require("connect.php");

        $N=mysqli_real_escape_string($connection,$N);
        $L=mysqli_real_escape_string($connection,$L);

        //sprawdzenie czy istnieje juz taki user
        $query="select * from authors where name='$N' and login='$L'";
        $result=mysqli_query($connection,$query);
        if($result){
            $how_many_reaults=mysqli_num_rows($result);
            if($how_many_reaults!=0)
            {
                header('Location:save_user.php?info=user_exist');
                exit();
            }
        }
        //-------------
        $query="insert into authors values('','$N','$L','$P')";
        $result=mysqli_query($connection,$query);
        if($result){
            //sukces
            header('Location:save_user.php?info=rejestr_ok');
            exit();
        }
        else{
            //error
            header('Location:save_user.php?info=rejestr_error');
            exit();
        }
    }
    else
    {
        header('Location:save_user.php?info=empty');
        exit();
    }

?>