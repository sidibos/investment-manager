<?php
namespace LendInvest;

class Loan
{
    /**
     * @var DateTime
     */
    public $startDate;

    /**
     * @var DateTime
     */
    public $endDate;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var array
     */
    public $tranches = [];

    /**
     * @param $startDate
     * @param $endDate
     * @param string $currency
     */
    public function __construct($startDate, $endDate, $currency = "GBP")
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
        $this->currency  = $currency;
    }

    /**
     * add LoanTranche to the loan
     * @param LoanTranche $loanTranche
     */
    public function addTranche(LoanTranche $loanTranche)
    {
        $this->tranches[] = $loanTranche;
    }

    /**
     * check that the loan is still opened
     * @throws \Exception
     */
    public function checkLoanIsOpened()
    {
        if(strtotime($this->endDate) < time()){
            throw new \Exception("Error - This loan is closed");
        }
    }
}