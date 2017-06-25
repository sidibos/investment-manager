<?php
namespace LendInvest;

class Loan
{
    public $startDate;
    public $endDate;
    public $currency;
    public $tranches = [];

    public function __construct($startDate, $endDate, $currency = "GBP")
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
        $this->currency  = $currency;
    }

    public function addTranche(LoanTranche $loanTranche)
    {
        $this->tranches[] = $loanTranche;
    }

    public function isOpen()
    {
        if(strtotime($this->endDate) < time()){
            throw new \Exception("Error - This loan is closed");
        }
    }
}