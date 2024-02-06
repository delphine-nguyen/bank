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
        <form action="./formHandler.inc.php" method="post">
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" value="Dupont">

            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" value="Jean">

            <label for="birthday">Birthday</label>
            <input type="date" name="birthday">

            <label for="email">Email</label>
            <input type="mail" name="email" value="dupont.jean@gmail.com">


            <button type="submit">Submit</button>
        </form>
    </main>
</body>

</html>