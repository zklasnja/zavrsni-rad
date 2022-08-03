<?php
include_once('db-connect.php');

$sql = "SELECT author, created_at, text, post_id FROM comments WHERE post_id = {$_GET['post_id']}";
$statement = $connection->prepare($sql);
$statement->execute();
$comments = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="comments">
    <div class="single-comment">
        <ul>
            <?php if (empty($comments)){
                echo "No comments on this post";
            } else {
            foreach ($comments as $comment) { ?>
            <li>
                    <div class="single-comment">
                        <div>posted by: <strong><?php echo $comment['author']; ?></strong> on <?php echo $comment['created_at']; ?></div>
                        <div><?php echo $comment['text']; ?></div>
                    </div>
            </li>
            <hr>
            <?php } }?>
        </ul>
    </div>
</div>