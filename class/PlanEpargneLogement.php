<?php

require_once("./class/BankAccount.php");
require_once("./class/Client.php");
require_once("./interface/IEpargne.php");

class PlanEpargneLogement extends BankAccount implements IEpargne
{
    private static $overDraftAllowed = 0;

    public function __construct(
        Client $client,
        int $balance,
        float $interestRate
    ) {
        parent::__construct(
            client: $client,
            balance: $balance,
            interestRate: $interestRate
        );
    }

    public function getOverDraftAllowed(): float
    {
        return self::$overDraftAllowed;
    }

    public function computeBill(): float
    {
        return self::$basePrice + $this->computeInterest() * 0.025;
    }

    public function computeInterest(): float
    {
        $interest = $this->getBalance() * $this->getInterestRate();

        return $interest > 0 ? $interest : 0;
    }
}
