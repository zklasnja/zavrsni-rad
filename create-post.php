<?php
include_once('db-connect.php');
?>

<!doctype html>
<html lang="en">

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

<body>
    <?php include('header.php');
    $error = null;
    date_default_timezone_set('Europe/Belgrade');

    $sql = "SELECT * FROM authors";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $authors = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_POST['submit'])) {

        $body = $_POST['body'];
        $title = $_POST['title'];
        $author = $_POST['author_id'];
        $created_at = date('Y-m-d H:i:s', time());


        if (empty($body) || empty($title) || empty($author)) {
            $error = "Title, Author and Body of the Blog post are required!";
        } else {
            $sql = "INSERT INTO posts (
                title, body, author_id, created_at)
            VALUES (
                '$title', '$body', '$author', '$created_at')";
            $statement = $connection->prepare($sql);
            $statement->execute();
            header('location: ./posts.php');
        }
    }
    ?>

    <main role="main" class="container">
        <div class="row">
            <form action="create-post.php" method="POST" id="postsForma">
                <div>
                    <div class="inputWrapper">
                        <label for="title" class="label">Title</label>
                        <input type="text" id="title" name="title" placeholder="Enter title">
                    </div>
                    <div class="inputWrapper">
                        <label for="author" class="label">Author</label>
                        <select id="author" name="author_id">
                            <option disabled selected>Select the Author</option>
                            <?php foreach ($authors as $author) { ?>
                                <option value=<?php echo $author['id']; ?> class="<?php echo $author['pol']; ?>">
                                    <?php echo "${author['ime']} ${author['prezime']}" ?></span>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="inputWrapper">
                        <label for="body" class="label">Body</label>
                        <textarea name="body" placeholder="Enter Body of the Blog" rows="5" id="bodyPosts"></textarea><br>
                    </div>
                    <span style=color:red> <?php echo $error; ?></span><br>
                    <button type="submit" name="submit" class="submit">Submit</button>
                </div>
            </form>
            <?php include('sidebar.php') ?>
        </div><!-- /.row -->
    </main><!-- /.container -->
    <?php include('footer.php'); ?>
</body>

</html>