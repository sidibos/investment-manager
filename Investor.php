<?php
namespace LendInvest;

class Investor
{
    /**
     * @var String
     */
    public $name;

    /**
     * @var InvestorWallet
     */
    public $wallet;

    /**
     * @var array
     */
    protected $investments = [];

    /**
     * @param $name
     * @param InvestorWallet $wallet
     */
    public function __construct($name, InvestorWallet $wallet)
    {
        $this->name   = $name;
        $this->wallet = $wallet;
    }

    /**
     * allows investor to invest in a loan tranche
     * @param LoanTranche $loanTranche
     * @param Money $moneyToInvest
     * @param $investmentStartDate
     * @throws \Exception
     */
    public function investIn(LoanTranche $loanTranche, Money $moneyToInvest, $investmentStartDate)
    {
        $loanTranche->loan->checkLoanIsOpened();
        $this->wallet->subtract($moneyToInvest);
        $loanTranche->deductInvestment($moneyToInvest);

        $this->investments[] = new Investment($loanTranche, $moneyToInvest, $investmentStartDate);
    }

    /**
     * @return array
     */
    public function getInvestments()
    {
        return $this->investments;
    }
}