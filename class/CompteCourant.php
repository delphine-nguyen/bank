<?php

require_once("./class/BankAccount.php");
require_once("./class/Client.php");

class CompteCourant extends BankAccount
{

    public function __construct(
        Client $client,
        int $overDraftAllowed,
        int $balance,
        float $interestRate
    ) {
        parent::__construct(
            client: $client,
            overDraftAllowed: $overDraftAllowed,
            balance: $balance,
            interestRate: $interestRate
        );
    }

    public function computeBill(): float
    {
        return self::$basePrice;
    }
}
