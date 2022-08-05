<?php
include_once('db-connect.php');

$sql = "SELECT c.id, c.author_id, c.post_id, c.created_at, c.text, a.id, a.ime, a.prezime, a.pol
                    FROM comments as c INNER JOIN authors as a ON c.author_id = a.id
                    WHERE c.post_id = {$_GET['post_id']}";
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
                        <div>posted by: <strong><?php echo "${comment['ime']} ${comment['prezime']}"; ?></strong> on <?php echo $comment['created_at']; ?></div>
                        <div><?php echo $comment['text']; ?></div>
                    </div>
            </li>
            <hr>
            <?php } }?>
        </ul>
    </div>
</div>