<?php
    session_start();
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']!=0)
    {
        require('connect.php');
        $id=$_SESSION['logged_in'];
        $query="select name from authors where Id_author=$id";
        $result=mysqli_query($connection,$query);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            ?>
            <div id="menu">
            <?php
            echo "<div id=\"sign\" onclick=\"location.href='article_add.php'\">Dodaj artykuł</a></div>";
            echo "<div id=\"sign\" onclick=\"location.href='log-out.php'\">Wyloguj</a></div>";
            echo "<div id='log'>Jestes zalogowany jako <b>{$row['name']}</b></div><br>";
            ?>
            </div>
            <?php
        }
    }
    else{
        ?>
        <link rel="stylesheet" href="style.css">
        <div id="menu">
            <div id="sign" onclick="location.href='login.php'">Zaloguj się</div>
            <div id="sign" onclick="location.href='save_user.php'">Rejestracja</div>
            
        </div>
        <?php
    }
?>