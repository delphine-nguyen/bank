<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST["id"]);

    try {
        require_once("./dbh.inc.php");  // Connect to DB

        $query = "SELECT * FROM client WHERE id = :id;";

        $statement = $pdo->prepare($query);

        $statement->bindParam(":id", $id);

        $statement->execute();
        $resultSearch = $statement->fetchAll(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION["resultSearch"] = $resultSearch[0];

        $pdo = null;
        $statement = null;

        header("Location: ./index.php");
        exit();
    } catch (PDOException $e) {
        die("Query failed : " . $e->getMessage());
    }
} else {  // Redirect user to index if form accessed w/o submitting
    header("Location: ./index.php");
    exit();
}
