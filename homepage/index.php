
<?php

$user = 'root';
$password = ''  ;
$database = 'blog';

$pdo = new PDO('mysql:host=localhost;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
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
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php include '../vorlage/blog-vorlage.php';?>

        <div class="layoutMessageBoxes">
            <?php
            global $blogCount;
            $blogCount = 0;

                $stmt = $pdo->query('SELECT * FROM `blog`');
                foreach($stmt->fetchAll() as $task) {
                    $blogCount++;?>
                    <div class="messageBox">
                    <h5 class="userName"><?php echo ($task['creator']) ?></h5>
                    <p class="blogText"><?php echo ($task['context']) ?></p>
                    </div>
            <?php  } ?>
        </div>
    </body>

</html>