<?php

$user = 'admin';
$password = 'Depole2005?';
$database = 'blog';

$pdo = new PDO('mysql:host=localhost;dbname= ' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$stmt = $pdo->query('SELECT creator FROM `blogs`');
foreach($stmt->fetchAll() as $task) {
    var_dump($task);
}
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
            <div class="messageBox">
                <h4 class="userName">Krystian<br><br></h4>
                <p class="blogText">hallo zusammen dies ist mein erster Blogartikel ich hoffe mein 
                    Kontent wird euch gefallen :)
                </p>
            </div>
        </div>
    </body>

</html>