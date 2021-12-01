
<?php 
    include '../common/db.php';
    $comment = '';

    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $comment = htmlspecialchars(trim($_POST['comment'] ?? ''));

        if ($comment === '') {
            $errors[] = 'Bitte geben Sie einen Kommentar ein.';
        }

        if (count($errors) === 0) {
            $stmt = $pdo->prepare('INSERT INTO comments (blogFK, comment)
            VALUES (:BlogFK, :Comment)');

            $commentedPost = $_POST['blogNR'];
            $stmt->execute([':BlogFK' => $commentedPost, ':Comment' => $comment]);
        }else{

        }
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

    <body id="body">
        <?php include '../vorlage/blog-vorlage.php';?>

        <!-- Fehler aus Formular anzeigen -->
        <?php if (count($errors) > 0) { ?>
            <div class="error-box">
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?= $error ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <div class="layoutMessageBoxes">
            <?php
            $stmt = $pdo->query('SELECT * FROM `blog`');

            foreach($stmt->fetchAll() as $task) {?>
                <div class="messageBox">
                    <h5 class="userName"><?php echo ($task['creator']) ?></h5>
                    <p class="dateAndTime"> created at:  <?php echo ($task['create_date']) ?></p>
                    <h6 class="blogTitle"><?php echo ($task['title']) ?></h6>

                    <?php if($task['url'] !== NULL) {?>
                    <img class="blogPicture" src="<?php echo ($task['url']) ?>">
                    <?php } ?>
                    
                    <p class="blogText"><?php echo ($task['context']) ?></p>

                    <?php $blogID = ($task['ID']) ?>
                    <p>
                    -------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    </p>
                    <h5 class="commentTitle">Kommentare</h5>   

                    <form class="commentOption" action="" method="POST">
                        <div>
                            <label for="comment">Kommentieren</label>
                            <textarea class="TextBox" name="comment" id="comment" cols="30" rows="4"></textarea>
                            <input type="hidden" id="blogNR" name="blogNR" value="<?= $blogID?>">
                        </div>
                        <input class="btnCommentPublish" type="submit" value="Kommentar publizieren">
                    </form>

                    

                </div>
        <?php   }?>
        </div>
    </body>

</html>