
<?php 
    include '../common/db.php';
    $comment = '';
    $like = false;
    $dislike = false;

    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $comment = htmlspecialchars(trim($_POST['comment'] ?? ''));

        if($_POST['like'] === 'like')
        {
            $like = true;
            $dislike = false;
        }
        else if($_POST['dislike'] === 'dislike'){
            $like = false;
            $dislike = true;
        }
        else{
            $like = false;
            $dislike = false;
        }

        

        if($like === true){
            $likedPostID = $_POST['likedBlogNR'];
            $stmt = $pdo->query('SELECT * FROM `blog` where ID =' . $likedPostID);
            $task = $stmt->fetchAll();
            $like = false;

            $stmt = $pdo->exec('UPDATE blog set likes = likes + 1 Where ID ='  . $likedPostID );
        }
        else if($dislike === true){
           
            $dislikedPostID = $_POST['dislikedBlogNR'];
            $stmt = $pdo->query('SELECT * FROM `blog` where ID =' . $dislikedPostID);
            $task = $stmt->fetchAll();
            $dislike = false;

            $stmt = $pdo->exec('UPDATE blog set dislikes = dislikes + 1 Where ID ='  . $dislikedPostID );
        }
        else if($like === false && $dislike === false){
            
            if ($comment === '') {
                $errors[] = 'Bitte geben Sie einen Kommentar ein.';
            }

            if (count($errors) === 0) {
                $stmt = $pdo->prepare('INSERT INTO comments (blogFK, comment)
                VALUES (:BlogFK, :Comment)');
    
                $commentedPost = $_POST['blogNR'];
                $stmt->execute([':BlogFK' => $commentedPost, ':Comment' => $comment]);
            }
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

                    <?php if($task['url'] == "") {?>
                    
                    <?php } else{?>
                        <img class="blogPicture" src="<?php echo ($task['url']) ?>">
                    <?php } ?>

                    <p class="blogText"><?php echo ($task['context']) ?></p>

                    <p>
                    -------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    </p>
                    <?php $blogID = ($task['ID']) ?>

                    <div class="commentSection">
                        <h5 class="commentTitle">Kommentare</h5>   

                        <form class="commentOption" action="" method="POST">
                            <div>
                                <label for="comment">Kommentieren</label>
                                <textarea class="TextBox" name="comment" id="comment" cols="30" rows="4"></textarea>
                                <input type="hidden" id="blogNR" name="blogNR" value="<?= $blogID?>">
                            </div>
                            <input class="btnCommentPublish" type="submit" value="Kommentar publizieren">
                        </form>

                        <?php $stmt = $pdo->query('SELECT * FROM `comments`');
                        foreach($stmt->fetchAll() as $commentTable){
                            if($commentTable['blogFK'] === $task['ID']){?>
                                <p class="commentText"><?php echo ($commentTable['comment'])?></p><?php
                            }else{

                            }
                        }
                        ?>
                        <div class="likeDislike">
                            <form class="btnLike" action="" method="POST" name="like">
                                <input type="submit" id="like" name="like" value="like">
                                <p>likes: <?php echo $task['likes'] ?></p>
                                <input type="hidden" id="likedBlogNR" name="likedBlogNR" value="<?= $blogID?>">
                            </form>

                            <form class="btnLike" action="" method="POST" name="dislike">
                                <input type="submit" id="dislike" name="dislike" value="dislike">
                                <p>dislikes: <?php echo $task['dislikes'] ?></p>
                                <input type="hidden" id="dislikedBlogNR" name="dislikedBlogNR" value="<?= $blogID?>">
                            </form>
                        </div>
                    </div>
                </div>
        <?php   }?>
        </div>
        <div class="footer">
            <?php  include '../vorlage/footer.php'; ?>
        </div>
    </body>

</html>