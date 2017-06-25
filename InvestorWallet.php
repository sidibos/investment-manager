<?php
namespace LendInvest;

class InvestorWallet
{
    /**
     * @var Money
     */
    private $money;

    /**
     * @param Money $money
     */
    public function __construct(Money $money)
    {
        $this->money = $money;
    }

    /**
     * @return Money
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * subtract Money from Investor Wallet
     * @param Money $moneyToSubtract
     * @throws \Exception
     */
    public function subtract(Money $moneyToSubtract)
    {
        $this->hasEnoughFund($moneyToSubtract->getAmount());

        $this->money->deduct($moneyToSubtract);
    }

    /**
     * check that Investor has enough money in the Wallet
     * @param $amount
     * @throws \Exception
     */
    public function hasEnoughFund($amount)
    {
        if($amount > $this->money->getAmount()){
            throw new \Exception("Error - Insufficient fund in the wallet - available {$this->money->getAmount()} - required {$amount}");
        }
    }
}