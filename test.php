<?php

require_once("./class/BankAccount.php");
require_once("./class/CompteCourant.php");
require_once("./class/Client.php");
require_once("./class/LivretA.php");
require_once("./class/PlanEpargneLogement.php");
require_once("./class/Transaction.php");
require_once("./class/Withdrawal.php");
require_once("./class/Transfer.php");
require_once("./class/Supply.php");

$bank = new Bank();

$jean = new Client(
    name: "Dupont",
    firstname: "Jean",
    email: "jean.dupont@gmail.com",
    birthday: new DateTime("2000/09/19"),
    bank: $bank
);

$francois = new Client(
    name: "Doe",
    firstname: "François",
    email: "francois.doe@gmail.com",
    birthday: new DateTime("2000/10/28"),
    bank: $bank
);

$account1 = new CompteCourant(
    client: $jean,
    overDraftAllowed: 100,
    balance: 1000,
    interestRate: 0.05
);

$account2 = new LivretA(
    client: $jean,
    overDraftAllowed: 100,
    balance: -100,
    interestRate: 0.05
);

$account3 = new PlanEpargneLogement(
    client: $francois,
    overDraftAllowed: 50,
    balance: 725,
    interestRate: 0.05
);

$account4 = new PlanEpargneLogement(
    client: $francois,
    overDraftAllowed: 0,
    balance: 830,
    interestRate: 0.05
);


echo "<h1>Bank</h1>";

// ==============================================================

echo "<h2>Withdraw money</h2>";

$currentClient = $francois;
echo $currentClient;

// --------------------------------

echo "<h3>No overdraft</h3>";

echo "<hr>";
echo $bank->withdraw(
    client: $currentClient,
    currentAccount: $account3,
    amount: 10
);
echo "<hr>";
echo $currentClient;

// --------------------------------

echo "<h3>Limit Overdraft reached</h3>";

echo "<hr>";
echo $bank->withdraw(
    client: $currentClient,
    currentAccount: $account3,
    amount: 1000
);
echo "<hr>";

echo $currentClient;

// ==============================================================

echo "<h2>Add money</h2>";

$currentClient = $francois;
echo $currentClient;

echo "<hr>";
echo $bank->supply(
    client: $currentClient,
    currentAccount: $account3,
    amount: 100
);
echo "<hr>";
echo $currentClient;

// ==============================================================

echo "<h2>Transfer money</h2>";

$currentClient = $francois;
echo $currentClient;

// --------------------------------

echo "<h3>No overdraft</h3>";

echo "<hr>";
echo $bank->transfer(
    client: $currentClient,
    from: $account3,
    to: $account4,
    amount: 100,
);
echo "<hr>";
echo $currentClient;

// --------------------------------

echo "<h3>Limit Overdraft reached</h3>";

echo "<hr>";
echo $bank->transfer(
    client: $currentClient,
    from: $account3,
    to: $account4,
    amount: 1000,
);
echo "<hr>";

// ==============================================================

echo "<h2>Only owners can interact with their account</h2>";

echo "<hr>";
echo $bank->transfer(
    client: $jean,
    from: $account3,
    to: $account4,
    amount: 1000,
);

echo "<hr>";
echo $bank->supply(
    client: $jean,
    currentAccount: $account3,
    amount: 100
);

echo "<hr>";
echo $bank->withdraw(
    client: $jean,
    currentAccount: $account3,
    amount: 10
);


$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";