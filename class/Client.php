<?php

require_once("./class/BankAccount.php");
require_once("./class/Bank.php");

class Client
{
    private string $id;
    private string $name;
    private string $firstname;
    private string $email;
    private DateTime $birthday;
    private array $accounts = [];
    private static int $counter = 0;
    private array $transactions = [];

    public function __construct(
        string $name,
        string $firstname,
        string $email,
        DateTime $birthday,
        Bank $bank
    ) {
        $this->name = $name;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->birthday = $birthday;
        $this->id = chr(rand(65, 90)) . chr(rand(65, 90)) . str_pad(self::$counter++, 7 - strlen(self::$counter), '0', STR_PAD_LEFT);
        $bank->addClient($this);
    }

    /**
     * Get the value of id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of firstname
     *
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param string $firstname
     *
     * @return self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of birthday
     *
     * @return DateTime
     */
    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    /**
     * Set the value of birthday
     *
     * @param DateTime $birthday
     *
     * @return self
     */
    public function setBirthday(DateTime $birthday): self
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getAccounts(): array
    {
        return $this->accounts;
    }

    public function addAccount(BankAccount $newAccount): string
    {
        if (count($this->accounts) > 3) {
            return "Can't own more than 3 accounts at a time";
        }
        foreach ($this->accounts as $account) {
            if ($newAccount->getAccountNumber() == $account->getAccountNumber()) {
                return "Account already in list of accounts";
            }
        }
        array_push($this->accounts, $newAccount);
        return "Account successfully added";
    }

    public function __toString(): string
    {
        $display =
            "CLIENT <br>" .
            "ID : " . $this->getId() . "<br>" .
            "Name : " . $this->getName() . "<br>" .
            "Firstname : " . $this->getFirstname() . "<br>" .
            "Birthday : " . $this->getBirthday()->format("d/m/Y") . "<br><br>" .
            "ACCOUNTS <br> <br> " .
            "Account number | Balance <br> <br>";

        foreach ($this->accounts as $account) {
            $display .= $account;
            $display .= "<br>----------------------------------<br>";
        }

        return $display;
    }

    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
