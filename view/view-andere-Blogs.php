<?php include './models/model-andere-Blogseiten.php' ?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Krystians Blog</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="./CSS/Blog-Vorlage-Style.css">
        <link rel="stylesheet" href="./CSS/andere-Blogseiten-Style.css">
    </head>

    <body id="body">

        <?php include 'view-Blog-Vorlage.php' ?>

        <div class="layout">
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
        <div class="footer">
            <?php  include 'view-footer.php'; ?>
        </div>
    </body>

</html>