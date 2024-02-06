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
        <form action="./dbh.inc.php" method="post">
            <label for="name">Name</label>
            <input type="text">

            <label for="firstname">Firstname</label>
            <input type="text" name="firstname">

            <label for="birthday">Birthday</label>
            <input type="date" name="birthday">

            <label for="balance">Balance</label>
            <input type="number" name="balance">

            <label for="email">Email</label>
            <input type="mail" name="email">

            <label for="type">Type of account</label>
            <select name="type">
                <option value="compteCourant">Compte courant</option>
                <option value="livretA">Livret A</option>
                <option value="epl">EPL</option>
            </select>

            <button type="submit">Submit</button>
        </form>
    </main>
</body>

</html>