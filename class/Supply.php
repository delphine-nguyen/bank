<?php

class Supply extends Transaction
{
    private BankAccount $account;
    public function __construct(
        Client $client,
        DateTime $date,
        bool $success,
        float $amount,
        BankAccount $account,
        string $msg
    ) {
        parent::__construct(
            client: $client,
            date: $date,
            success: $success,
            amount: $amount,
            msg: $msg
        );
        $this->account = $account;
    }

    /**
     * Get the value of account
     *
     * @return BankAccount
     */
    public function getAccount(): BankAccount
    {
        return $this->account;
    }

    /**
     * Set the value of account
     *
     * @param BankAccount $account
     *
     * @return self
     */
    public function setAccount(BankAccount $account): self
    {
        $this->account = $account;
        return $this;
    }
}
