<?php
namespace LendInvest;

class InvestorWallet
{
    private $money;

    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    public function getMoney()
    {
        return $this->money;
    }

    public function subtract(Money $moneyToSubtract)
    {
        $this->hasEnoughFund($moneyToSubtract->getAmount());

        $this->money->deduct($moneyToSubtract);
    }

    public function hasEnoughFund($amount)
    {
        if($amount > $this->money->getAmount()){
            throw new \Exception("Error - Insufficient fund in the wallet - available {$this->money->getAmount()} - required {$amount}");
        }
    }
}