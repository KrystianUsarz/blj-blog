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