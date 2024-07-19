<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="menu">
    <div id="sign" onclick="location.href='index.php'">Menu Główne</a></div>
    <div id="sign" onclick="location.href='article_edit-list-admin.php'">Lista notatek</a></div>
</div>
<?php
    require('logged-as.php');
    require('connect.php');
//zapis
    if(isset($_POST['title']))
    {
        $id=$_GET['id'];
        $C=$_POST['article_value'];
        $T=$_POST['title'];
        $C=htmlentities($C);
        $T=htmlentities($T);
        $C=mysqli_real_escape_string($connection,$C);
        $T=mysqli_real_escape_string($connection,$T);

        $query="update articles set title='$T',content='$C' where id_art='$id'";
        $result=mysqli_query($connection,$query);
        if($result){
            header("Location:article_edit-list.php");
            exit();
        }
    }

//edycja
        if(isset($_GET['id']) && is_numeric($_GET['id']))
        {
            $id=$_GET['id'];
            $query="select * from articles where id_art=$id";
            $result=mysqli_query($connection,$query);
            
            if($result)
            {
                $row=mysqli_fetch_assoc($result);
    ?>            
    <div id="login">

        <form name="edit" method="post">
            Tytuł<input type="text" value="<?php echo $row['title']?>" name="title"><br>
            <textarea name="article_value" id="article_space" cols="30" rows="10"><?php echo $row['content']?></textarea>
            <br>
            <input type="submit" value="Zapisz zmiany">
        </form>
    </div>
    <?php
            }
        }    
?>
</body>
</html>