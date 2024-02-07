<?php

require_once("./class/Client.php");
require_once("./class/Transaction.php");


abstract class BankAccount
{
    private string $accountNumber;
    private Client $client;
    private float $balance;
    private static int $counter = 1;
    private float $interestRate;

    protected static int $basePrice = 25;

    public function __construct(
        Client $client,
        int $balance,
        float $interestRate
    ) {
        $this->accountNumber = str_pad(self::$counter++, 12 - strlen(self::$counter), '0', STR_PAD_LEFT);
        $this->client = $client;
        $this->balance = $balance;
        $this->interestRate = $interestRate;

        $client->addAccount($this);
    }


    abstract public function getOverDraftAllowed(): float;

    /**
     * Get the value of accountNumber
     *
     * @return int
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * Set the value of accountNumber
     *
     * @param int $accountNumber
     *
     * @return self
     */
    public function setAccountNumber(int $accountNumber): self
    {
        $this->accountNumber = $accountNumber;
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

    /**
     * Get the value of balance
     *
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * Set the value of balance
     *
     * @param float $balance
     *
     * @return self
     */
    public function setBalance(float $balance): self
    {
        $this->balance = $balance;
        return $this;
    }

    abstract public function computeBill(): float;

    public function __toString(): string
    {

        $display = $this->getAccountNumber() . " " .
            $this->getBalance() . " euros ";
        $display .= $this->getBalance() > 0 ? ":-) " : ":-( ";
        $display .= "(Overdraft allowed: " . $this->getOverDraftAllowed() . "€)";
        return $display;
    }

    /**
     * Get the value of interestRate
     *
     * @return float
     */
    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    /**
     * Set the value of interestRate
     *
     * @param float $interestRate
     *
     * @return self
     */
    public function setInterestRate(float $interestRate): self
    {
        $this->interestRate = $interestRate;
        return $this;
    }  // TODO : function never used

    private function checkOverDraft(float $amount)
    {
        # Check that withdrawal is allowed
        $overDraft = $this->getBalance() - $amount;
        if ($overDraft < 0) {
            if ($this->getOverDraftAllowed() <= -$overDraft) {
                return false;
            }
        }
        return true;
    }

    public function withdraw(
        float $amount
    ): Transaction {

        $accountNumber = $this->getAccountNumber();

        # Check that withdrawal is allowed
        if ($this->checkOverDraft(amount: $amount)) {
            $this->setBalance($this->getBalance() - $amount);
            $success = true;
            $msg = "- $amount euros on $accountNumber";
        } else {
            $success = false;
            $msg = "Withdrawal unauthorized: maximum overdraft reached on $accountNumber";
        }

        return new Transaction(
            client: $this->client,
            date: new DateTime(),
            success: $success,
            amount: -$amount,
            account: $this,
            type: "withdraw",
            msg: $msg
        );
    }

    public function supply(
        float $amount
    ): Transaction {

        $accountNumber = $this->getAccountNumber();

        $this->setBalance($this->getBalance() + $amount);
        $success = true;
        $msg = "+ $amount euros on $accountNumber";

        return new Transaction(
            client: $this->client,
            date: new DateTime(),
            success: $success,
            amount: $amount,
            account: $this,
            msg: $msg,
            type: "supply"
        );
    }

    public function transfer(
        BankAccount $recipient,
        float $amount
    ) {

        $transactions = [];

        $withdrawal = $this->withdraw($amount);
        array_push($transactions, $withdrawal);
        if ($withdrawal->getSuccess()) {
            $supply = $recipient->supply($amount);
            array_push($transactions, $supply);
        }

        return $transactions;
    }
}
