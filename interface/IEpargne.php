<?php

require_once("./class/Transaction.php");

interface IEpargne
{
    public function computeInterest(): float;

    public function addInterest(): Transaction;
}
