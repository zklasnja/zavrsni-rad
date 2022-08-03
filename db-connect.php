<?php
// ako su mysql username/password i ime baze na vasim racunarima drugaciji
// obavezno ih ovde zamenite
$servername = "127.0.0.1";
$username = "root";
$password = "Woodchair777";
$dbname = "blog";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

function getData($connection, $sql, $isFetchAll = true)
{
    $statement = $connection->prepare($sql);
    $statement->execute();
    return $isFetchAll ? $statement->fetchAll(PDO::FETCH_ASSOC) : $statement->fetch(PDO::FETCH_ASSOC);
}
?>