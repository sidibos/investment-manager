<?php
namespace LendInvest;

class LoanTranche
{
    /**
     * @var float
     */
    public $interestRate;

    /**
     * @var Money
     */
    protected $balance;

    /**
     * @var Loan
     */
    public $loan;

    /**
     * @param Money $balance
     * @param Loan $loan
     * @param $interestRate
     */
    public function __construct(Money $balance, Loan $loan, $interestRate)
    {
        $this->loan                         = $loan;
        $this->balance                      = $balance;
        $this->interestRate                 = number_format($interestRate, 2);
    }

    /**
     * deducts Money from LoanTranche balance
     * @param Money $moneyToInvest
     * @throws \Exception
     */
    public function deductInvestment(Money $moneyToInvest)
    {
        $this->checkLoanTrancheAvailableInvestment($moneyToInvest->getAmount());
        $this->balance->deduct($moneyToInvest);
    }

    /**
     * returns LoanTranche Balance
     * @return Money
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * check there is enough fund in loanTranche balance
     * @param $amountToInvest
     * @throws \Exception
     */
    public function checkLoanTrancheAvailableInvestment($amountToInvest)
    {
        if($amountToInvest > $this->balance->getAmount()) {
            throw new \Exception("Error - Maximum amount to invest has been reached - available {$this->balance->getAmount()} - required {$amountToInvest}");
        }
    }
}