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
    $error = $success = null;

    if (isset($_POST['submit'])) {

        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $pol = $_POST['pol'];

        if (empty($ime) || empty($prezime) || empty($pol)) {
            $error = "First Name, Last Name and Gender are required to create an Author!";
        } else {
            $sql = "INSERT INTO authors (
                ime, prezime, pol)
            VALUES (
                '$ime', '$prezime', '$pol')";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $success = "Author successfuly created!";
        }
    }
    ?>

    <main role="main" class="container">
        <div class="row">
            <form action="create-author.php" method="POST" id="postsForma">
                <div>
                    <div class="inputWrapper">
                        <label for="ime" class="label">First Name</label>
                        <input type="text" id="ime" name="ime" placeholder="Enter First Name">
                    </div>
                    <div class="inputWrapper">
                        <label for="prezime" class="label">Last Name</label>
                        <input type="text" id="prezime" name="prezime" placeholder="Enter Last Name">
                    </div>
                    <div class="radioWrapper">
                        <input type="radio" id="pol" name="pol" value="M">
                        <label for="m">Male</label><br>
                        <input type="radio" id="pol" name="pol" value="Z">
                        <label for="z">Female</label><br>
                    </div>
                    <span style=color:red> <?php echo $error; ?></span><br>
                    <button type="submit" name="submit" class="submit">Submit</button>
                </div>
            </form>
            <div>
                <span style=color:green> <?php echo $success; ?></span><br>
            </div>
            <?php include('sidebar.php') ?>
        </div><!-- /.row -->
    </main><!-- /.container -->
    <?php include('footer.php'); ?>
</body>

</html>