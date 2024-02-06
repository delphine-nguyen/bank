<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        input,
        select,
        button {
            display: block
        }
    </style>

    <title>Bank</title>
</head>

<body>
    <header>
        <h1>Bank</h1>
    </header>

    <main>
        <h2>I'm a new client</h2>
        <form action="./insert.inc.php" method="post">
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" value="Dupont">

            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" value="Jean">

            <label for="birthday">Birthday</label>
            <input type="date" name="birthday">

            <label for="email">Email</label>
            <input type="mail" name="email" value="dupont.jean@gmail.com">


            <button type="submit">Sign up</button>
        </form>

        <h2>Search client</h2>

        <form action="./search.php" class="searchForm" method="post">
            <label for="id">ID</label>
            <input type="text" name="id">

            <button type="submit">Search</button>
        </form>
        <section id="resultSearch">
            <?php
            session_start();
            if (isset($_SESSION["resultSearch"]) && !empty($_SESSION["resultSearch"])) :
                foreach ($_SESSION["resultSearch"] as $key => $value) : ?>
                    <p><?php echo $key . " : " . $value ?></p>
            <?php
                endforeach;
            endif; ?>


        </section>
    </main>
</body>

</html>