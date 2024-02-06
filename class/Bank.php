<?php

require_once("./class/BankAccount.php");
require_once("./class/Transaction.php");
require_once("./class/Withdrawal.php");
require_once("./class/Transfer.php");
require_once("./class/Supply.php");

class Bank
{
    private array $clients = [];

    public function addClient(Client $client): void
    {
        $this->clients[] = $client;
    }

    private function checkOwner(
        Client $client,
        BankAccount $currentAccount
    ): bool {
        foreach ($client->getAccounts() as $account) {
            if ($account->getAccountNumber() == $currentAccount->getAccountNumber()) {
                return true;
            }
        }
        return false;
    }

    private function checkOverDraft(float $amount, BankAccount $account)
    {
        # Check that withdrawal is allowed
        $overDraft = $account->getBalance() - $amount;
        if ($overDraft < 0) {
            if ($account->getOverDraftAllowed() <= -$overDraft) {
                return false;
            }
        }
        return true;
    }

    public function withdraw(
        Client $client,
        BankAccount $currentAccount,
        float $amount
    ): Withdrawal {

        $accountNumber = $currentAccount->getAccountNumber();

        # Client owns the account
        if ($this->checkOwner($client, $currentAccount)) {

            # Check that withdrawal is allowed
            if ($this->checkOverDraft(amount: $amount, account: $currentAccount)) {
                $currentAccount->setBalance($currentAccount->getBalance() - $amount);
                $success = true;
                $msg = "- $amount euros on $accountNumber";
            } else {
                $success = false;
                $msg = "Withdrawal unauthorized: maximum overdraft reached on $accountNumber";
            }
        } else {
            $success = false;
            $msg = "Withdrawals only allowed on accounts you own";
        }
        return new Withdrawal(
            client: $client,
            date: new DateTime(),
            success: $success,
            amount: $amount,
            account: $currentAccount,
            msg: $msg
        );
    }

    public function supply(
        Client $client,
        BankAccount $currentAccount,
        float $amount
    ): Supply {

        $accountNumber = $currentAccount->getAccountNumber();

        # Client owns the account
        if ($this->checkOwner($client, $currentAccount)) {

            $currentAccount->setBalance($currentAccount->getBalance() + $amount);
            $success = true;
            $msg = "+ $amount euros on $accountNumber";
        } else {
            $success = false;
            $msg = "Supplies only allowed on accounts you own";
        }
        return new Supply(
            client: $client,
            date: new DateTime(),
            success: $success,
            amount: $amount,
            account: $currentAccount,
            msg: $msg
        );
    }

    public function transfer(
        Client $client,
        BankAccount $from,
        BankAccount $to,
        float $amount
    ): Transfer {

        $fromNumber = $from->getAccountNumber();
        $toNumber = $to->getAccountNumber();

        if ($this->checkOwner($client, $from) && $this->checkOwner($client, $to)) {
            if ($this->checkOverDraft(amount: $amount, account: $from)) {
                $from->setBalance($from->getBalance() - $amount);
                $to->setBalance($to->getBalance() + $amount);
                $success = true;
                $msg = "$amount euros trasnfered from $fromNumber to $toNumber";
            } else {
                $success = false;
                $msg = "Transfer unauthorized : maximum overdraft reached on $fromNumber";;
            }
        } else {
            $success = false;
            $msg = "Transfers only allowed between accounts you own";
        }
        return new Transfer(
            client: $client,
            date: new DateTime(),
            success: $success,
            amount: $amount,
            donor: $from,
            recipient: $to,
            msg: $msg
        );
    }
}
