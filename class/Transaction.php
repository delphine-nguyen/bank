<?php

class Transaction
{
    private int $id;
    private Client $client;
    private DateTime $date;
    private bool $success;
    private float $amount;
    private string $msg;
    private string $type;

    private BankAccount $account;

    private static int $counter = 0;

    public function __construct(
        Client $client,
        DateTime $date,
        bool $success,
        float $amount,
        string $msg,
        string $type,
        BankAccount $account
    ) {
        $this->client = $client;
        $this->date = $date;
        $this->success = $success;
        $this->amount = $amount;
        $this->msg = $msg;
        $this->account = $account;
        $this->type = $type;
        $this->id = self::$counter++;
    }

    /**
     * Get the value of date
     *
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @param DateTime $date
     *
     * @return self
     */
    public function setDate(DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get the value of success
     *
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Set the value of success
     *
     * @param bool $success
     *
     * @return self
     */
    public function setSuccess(bool $success): self
    {
        $this->success = $success;
        return $this;
    }

    /**
     * Get the value of amount
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @param float $amount
     *
     * @return self
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get the value of client
     *
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Set the value of client
     *
     * @param Client $client
     *
     * @return self
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;
        return $this;
    }

    public function __toString(): string
    {

        $date = $this->date->format("d/m/Y");
        return  "TRANSACTION n° $this->id <br>" .
            "Type: $this->type<br>" .
            "Date: $date <br>" .
            "Success: $this->success <br>" .
            "Amount: $this->amount <br>" .
            "Message: $this->msg <br>";
    }

    /**
     * Get the value of type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}
