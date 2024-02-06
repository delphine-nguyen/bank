<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];

    try {
        require_once("./dbh.inc.php");  // Connect to DB

        $query = "INSERT INTO client (lastname, firstname, email, birthday) VALUES (:lastname, :firstname, :email, :birthday);";

        $statement = $pdo->prepare($query);

        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":birthday", $birthday);
        $statement->bindParam(":firstname", $firstname);

        $statement->execute();

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
