<?php
namespace LendInvest;

class Money
{
    private $amount;
    private $currency;

    public function __construct($amount, $currency = 'GBP')
    {
        $this->amount   = number_format($amount, 2, '.', '');
        $this->currency = $currency;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function deduct(Money $moneyToDeduct)
    {
        $this->checkFund($moneyToDeduct->getAmount());
        $this->amount = number_format($this->amount - $moneyToDeduct->getAmount(), 2, '.', '');
    }

    public function checkFund($amountToDeduct)
    {
        if($this->amount < $amountToDeduct){
            throw new \Exception("Error - Cannot deduct {$amountToDeduct} from {$this->amount}");
        }
    }

}