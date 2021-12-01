<?php


$pdo = new PDO('mysql:host=mysql2.webland.ch;dbname=d041e_dagomez', 'd041e_dagomez', '54321_Db!!!', [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Krystians Blog</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="../vorlage/blog-vorlage.css">
        <link rel="stylesheet" href="andere-Blogseiten-Style.css">
    </head>

    <body id="body">

        <?php include '../vorlage/blog-vorlage.php'; ?>

        <div class="otherBlogs">
            <?php
            $stmt = $pdo->query('SELECT description, url from urls order by description asc');

            foreach ($stmt->fetchAll() as $x){
                $name = $x['description'];
                $url = $x['url'];
                echo "<a class='andereBlogs' href='$url'>$name</a>";
                echo "&nbsp&nbsp&nbsp";
            }
            ?>
        </div>
    
    </body>

</html>