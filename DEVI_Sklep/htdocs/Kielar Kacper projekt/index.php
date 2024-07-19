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
<?php
    require('logged-as.php');
?>
<div id="main-content">

<?php
        //wyswietlanie
        require('connect.php');

        $query="SELECT title,content,authors.Name FROM `articles` LEFT JOIN authors on authors.Id_author=articles.id_author";
        $result=mysqli_query($connection,$query);
        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                echo "<h2> {$row['title']}</h2> <br><h3>Autor: {$row['Name']}</h3>";?> 
                <div id="article_space">
                    <?php echo "{$row['content']}";?>
                    <hr>
                </div>
                <?php
            }
        }
        else
        {
            header("Location:index.php?info=show_error");
                exit();
        }        

        //komunikaty
        if(isset($_GET['info'])){
            if($_GET['info']=="error_add-article") echo "Nie Zalogowano";
            if($_GET['info']=="show_error") echo "nie wyswietlono";
            if($_GET['info']=="log-out-error") echo "nie wylogowano";
        }
    ?>
</div>
    
<div id="footer"></div>
</body>
</html>