<?php

require_once("./class/BankAccount.php");
require_once("./class/Client.php");
require_once("./interface/IEpargne.php");

class LivretA extends BankAccount implements IEpargne
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
        return self::$basePrice + $this->computeInterest() * 0.10;
    }

    public function computeInterest(): float
    {
        $interest = $this->getBalance() * $this->getInterestRate();

        return $interest > 0 ? $interest : 0;
    }
}
