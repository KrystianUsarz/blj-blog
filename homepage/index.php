
<?php 
    include '../common/db.php';
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
            <?php $blogCount-1;
                } ?>
        </div>
    </body>

</html>