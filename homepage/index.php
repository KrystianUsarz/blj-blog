
<?php 
    include '../common/db.php';
    $comment = '';
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

    <body id="body">
        <?php include '../vorlage/blog-vorlage.php';?>

        <div class="layoutMessageBoxes">
            <?php
            $stmt = $pdo->query('SELECT * FROM `blog`');
            $stmt2 = $pdo->query('SELECT * FROM `comments`');
            foreach($stmt->fetchAll() as $task) {?>
                <div class="messageBox">
                    <h5 class="userName"><?php echo ($task['creator']) ?></h5>
                    <p class="dateAndTime"> created at:  <?php echo ($task['create_date']) ?></p>    
                    <p class="blogText"><?php echo ($task['context']) ?></p>

                    <h5 class="commentTitle">Commentare</h5>
                        

                    <?php foreach($stmt2->fetchAll() as $task2){?>
                        <p class="commentText"><?php echo ($task2['comment']) ?></p>  
                    <?php   }?>

                <div class="commentOption">
                                <label for="comment">Kommentieren</label>
                                <textarea class="TextBox" name="comment" id="comment" cols="30" rows="4"></textarea>
                            </div>    
                </div>
        <?php   }?>
        </div>
    </body>

</html>