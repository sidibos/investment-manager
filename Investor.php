<?php
namespace LendInvest;

class Investor
{
    public $name;
    public $wallet;
    protected $investments = [];

    public function __construct($name, InvestorWallet $wallet)
    {
        $this->name   = $name;
        $this->wallet = $wallet;
    }

    public function investIn(LoanTranche $loanTranche, Money $moneyToInvest, $investmentStartDate)
    {
        $this->wallet->subtract($moneyToInvest);
        $loanTranche->deductInvestment($moneyToInvest);

        $this->investments[] = new Investment($loanTranche, $moneyToInvest, $investmentStartDate);
    }

    public function getInvestments()
    {
        return $this->investments;
    }
}