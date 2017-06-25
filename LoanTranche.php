<?php
namespace LendInvest;

class LoanTranche
{
    public $interestRate;
    protected $balance;
    public $loan;

    public function __construct(Money $balance, Loan $loan, $interestRate)
    {
        $this->loan                         = $loan;
        $this->balance                      = $balance;
        $this->interestRate                 = number_format($interestRate, 2);
    }

    public function deductInvestment(Money $moneyToInvest)
    {
        $this->checkLoanTrancheAvailableInvestment($moneyToInvest->getAmount());
        $this->balance->deduct($moneyToInvest);
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function checkLoanTrancheAvailableInvestment($amountToInvest)
    {
        if($amountToInvest > $this->balance->getAmount()) {
            throw new \Exception("Error - Maximum amount to invest has been reached - available {$this->balance->getAmount()} - required {$amountToInvest}");
        }
    }
}