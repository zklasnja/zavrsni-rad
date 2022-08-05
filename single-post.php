<?php
include_once('db-connect.php');
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body class="va-l-page va-l-page--single">

    <?php include('header.php');

    $error = null;

    if (isset($_GET['post_id'])) {

        //making a query to get all data needed to display a single post
        $sql = "SELECT p.id, p.author_id, p.title , p.created_at, p.body, a.id, a.ime, a.prezime, a.pol
                    FROM posts as p INNER JOIN authors as a ON p.author_id = a.id
                    WHERE p.id = {$_GET['post_id']}";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $singlePost = $statement->fetch(PDO::FETCH_ASSOC);
    }
    ?>
    <main role="main" class="container">

        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="blog-post">
                    <?php if (!$singlePost) {
                        echo "Sorry, but we could not find this post!";
                    } else { ?>

                        <h2 class="blog-post-title"><?php echo $singlePost['title']; ?></h2>
                        <p class="blog-post-meta"><?php echo $singlePost['created_at'] ?> by <a href="#"><?php echo "${singlePost['ime']} ${singlePost['prezime']}"; ?></a></p>
                        <p> <?php echo $singlePost['body'];
                        } ?></p>
                </div><!-- /.blog-post -->
                <div class="comments">
                    <h3><strong>Comments</strong></h3>

                    <?php include('comments.php') ?>
                </div>

            </div><!-- /.blog-main -->

            <?php include('sidebar.php') ?>

        </div><!-- /.row -->

    </main><!-- /.container -->

    <?php include('footer.php'); ?>

</body>

</html>