<?php
namespace LendInvest;

class Investment
{
    /**
     * @var DateTime
     */
    public $investmentStartDate;

    /**
     * @var Money
     */
    public $moneyInvested;

    /**
     * @var LoanTranche
     */
    public $loanTranche;

    /**
     * @param LoanTranche $loanTranche
     * @param Money $moneyInvested
     * @param $investmentStartDate
     */
    public function __construct(LoanTranche $loanTranche, Money $moneyInvested, $investmentStartDate)
    {
        $this->loanTranche          = $loanTranche;
        $this->moneyInvested        = $moneyInvested;
        $this->investmentStartDate  = $investmentStartDate;
    }

    /**
     * calculate investors monthly interests
     * @param $fromDate
     * @param $toDate
     * @return int|string
     */
    public function getMonthlyInterests($fromDate, $toDate)
    {
        if(strtotime($this->investmentStartDate) < strtotime($toDate)){
            $calculationStartDate = (strtotime($this->investmentStartDate) < strtotime($fromDate)) ? $fromDate : $this->investmentStartDate;
            $startDate = new \DateTime($calculationStartDate);
            $endDate   = new \DateTime($toDate);
            $investmentNumberOfDays = $startDate->diff($endDate)->days;
            $fromDateObj = new \DateTime($fromDate);
            $monthNumberOfDays = $fromDateObj->diff($endDate)->days;

            $dailyRate  = $this->loanTranche->interestRate/$monthNumberOfDays;

            return number_format(
                ($this->moneyInvested->getAmount()*$dailyRate/100)*$investmentNumberOfDays,
                2,
                '.',
                ''
            );
        }

        return 0;
    }

    /**
     * return Money invested
     * @return Money
     */
    public function getMoneyInvested()
    {
        return $this->moneyInvested;
    }
}