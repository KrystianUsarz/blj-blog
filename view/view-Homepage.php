<?php include './models/model-Homepage.php' ?> 

<!DOCTYPE html>
<html>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Krystians Blog</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="./CSS/Blog-Vorlage-Style.css">
        <link rel="stylesheet" href="./CSS/Homepage-Style.css">
    </head>

    <body id="body">
        <?php  include 'view-Blog-Vorlage.php' ?>

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

            foreach($stmt->fetchAll() as $blogTable) {?>
                <div class="messageBox">
                    <h5 class="userName"><?php echo ($blogTable['creator']) ?></h5>
                    <p class="dateAndTime"> created at:  <?php echo ($blogTable['create_date']) ?></p>
                    <h6 class="blogTitle"><?php echo ($blogTable['title']) ?></h6>

                    <?php if($blogTable['url'] == "") {?>
                    
                    <?php } else{?>
                        <img class="blogPicture" src="<?php echo ($blogTable['url']) ?>">
                    <?php } ?>

                    <p class="blogText"><?php echo ($blogTable['context']) ?></p>

                    <p>
                    -------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    </p>
                    <?php $blogID = ($blogTable['ID']) ?>

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
                            if($commentTable['blogFK'] === $blogTable['ID']){?>
                                <p class="commentText"><?php echo ($commentTable['comment'])?></p><?php
                            }else{

                            }
                        }
                        ?>
                        <div class="likeDislike">
                            <form class="btnLike" action="" method="POST" name="like">
                                <input type="submit" id="like" name="like" value="like">
                                <p>likes: <?php echo $blogTable['likes'] ?></p>
                                <input type="hidden" id="likedBlogNR" name="likedBlogNR" value="<?= $blogID?>">
                            </form>

                            <form class="btnLike" action="" method="POST" name="dislike">
                                <input type="submit" id="dislike" name="dislike" value="dislike">
                                <p>dislikes: <?php echo $blogTable['dislikes'] ?></p>
                                <input type="hidden" id="dislikedBlogNR" name="dislikedBlogNR" value="<?= $blogID?>">
                            </form>
                        </div>
                    </div>
                </div>
        <?php   }?>
        </div>
        <div class="footer">
            <?php  include 'view-footer.php'; ?>
        </div>
    </body>

</html>