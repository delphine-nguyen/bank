<?php

require_once("./class/BankAccount.php");
require_once("./class/Transaction.php");

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
}
