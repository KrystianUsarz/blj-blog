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
    
    </body>

</html>