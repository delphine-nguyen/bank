<?php

class Transfer extends Transaction
{
    private BankAccount $donor;
    private BankAccount $recipient;

    public function __construct(
        Client $client,
        DateTime $date,
        bool $success,
        float $amount,
        BankAccount $donor,
        BankAccount $recipient,
        string $msg
    ) {
        parent::__construct(
            client: $client,
            date: $date,
            success: $success,
            amount: $amount,
            msg: $msg
        );
        $this->donor = $donor;
        $this->recipient = $recipient;
    }

    /**
     * Get the value of donor
     *
     * @return BankAccount
     */
    public function getDonor(): BankAccount
    {
        return $this->donor;
    }

    /**
     * Set the value of donor
     *
     * @param BankAccount $donor
     *
     * @return self
     */
    public function setDonor(BankAccount $donor): self
    {
        $this->donor = $donor;
        return $this;
    }

    /**
     * Get the value of recipient
     *
     * @return BankAccount
     */
    public function getRecipient(): BankAccount
    {
        return $this->recipient;
    }

    /**
     * Set the value of recipient
     *
     * @param BankAccount $recipient
     *
     * @return self
     */
    public function setRecipient(BankAccount $recipient): self
    {
        $this->recipient = $recipient;
        return $this;
    }
}
