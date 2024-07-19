<?php
    require('logged-as.php');
    if(empty($_SESSION['logged_in']))
    {
        header("Location:index.php?info=error_add-article");
        exit();
    }
    if($_SESSION['logged_in']!='5')
    {
        header("Location:index.php?info=error_add-article");
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin edit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="menu">
            <div id="sign" onclick="location.href='index.php'">Menu Główne</a></div>
</div>
<div id="main-content">

    <?php
        require('connect.php');

        if(isset($_GET['id']) && is_numeric($_GET['id']))
        {
            $id=$_GET['id'];
            $query="delete from articles where id_art=$id";
            $result=mysqli_query($connection,$query);
            if($result){
                echo "<div id=\"com\">Usunięto artykuł!</div>";
            }
        }


        $query="select id_art,title,content,authors.Name FROM `articles` left JOIN authors on authors.Id_author=articles.id_author";
        $result=mysqli_query($connection,$query);
        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<h2> Tytuł: {$row['title']}</h2> <h3>Autor:</h3> {$row['Name']} <br>";?> 
                <div id="article_space">
                    <?php echo "{$row['content']}";?>
                </div>
                <?php
                echo
                "<a href=\"article_edit-list-admin.php?id={$row['id_art']}\">USUŃ</a> 
                <a href=\"article_edit-content-admin.php?id={$row['id_art']}\">EDYTUJ</a> 
                <hr>";
            }
        }
?>
</div>
</body>
</html>