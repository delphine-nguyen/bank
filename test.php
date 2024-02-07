<?php

require_once("./class/BankAccount.php");
require_once("./class/CompteCourant.php");
require_once("./class/Client.php");
require_once("./class/LivretA.php");
require_once("./class/PlanEpargneLogement.php");
require_once("./class/Transaction.php");

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
    balance: -100,
    interestRate: 0.05
);

$account3 = new PlanEpargneLogement(
    client: $francois,
    balance: 725,
    interestRate: 0.05
);

$account4 = new PlanEpargneLogement(
    client: $francois,
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
echo $account3->withdraw(
    amount: 10
);
echo "<hr>";
echo $currentClient;

// --------------------------------

echo "<h3>Limit Overdraft reached</h3>";

echo "<hr>";
echo $account3->withdraw(
    amount: 1000
);
echo "<hr>";

echo $currentClient;

// ==============================================================

echo "<h2>Add money</h2>";

$currentClient = $francois;
echo $currentClient;

echo "<hr>";
echo $account3->supply(
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


$transactions =  $account3->transfer(
    recipient: $account4,
    amount: 100,
);

foreach ($transactions as $transaction) {
    echo "<hr>";
    echo $transaction;
}

echo "<hr>";
echo $currentClient;

// --------------------------------

echo "<h3>Limit Overdraft reached</h3>";

$transactions =  $account3->transfer(
    recipient: $account4,
    amount: 3000,
);

foreach ($transactions as $transaction) {
    echo "<hr>";
    echo $transaction;
}

echo "<hr>";
echo $currentClient;

// ==============================================================

echo "<h2>Interest</h2>";

echo "<hr>";
echo $account3->addInterest();
echo "<hr>";

echo $francois;


// ==============================================================

echo "<h2>Show all transactions of an account</h2>";

echo $francois;

foreach ($francois->getTransactions() as $transaction) {
    echo $transaction;
    echo "<hr>";
}
