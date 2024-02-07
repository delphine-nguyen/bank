<?php

require_once("./class/BankAccount.php");
require_once("./class/Client.php");

class CompteCourant extends BankAccount
{
    private float $overDraftAllowed;

    public function __construct(
        Client $client,
        int $balance,
        float $interestRate,
        float $overDraftAllowed
    ) {
        parent::__construct(
            client: $client,
            balance: $balance,
            interestRate: $interestRate
        );
        $this->overDraftAllowed = $overDraftAllowed;
    }

    public function computeBill(): float
    {
        return self::$basePrice;
    }

    /**
     * Get the value of overDraftAllowed
     *
     * @return float
     */
    public function getOverDraftAllowed(): float
    {
        return $this->overDraftAllowed;
    }

    /**
     * Set the value of overDraftAllowed
     *
     * @param float $overDraftAllowed
     *
     * @return self
     */
    public function setOverDraftAllowed(float $overDraftAllowed): self
    {
        $this->overDraftAllowed = $overDraftAllowed;
        return $this;
    }

    public function billAccount(): void
    {
        $bill = $this->computeBill();
        $this->withdraw($bill);
    }
}
