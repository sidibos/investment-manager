<?php
namespace LendInvest;

class InvestorInterestCalculator
{
    public $investors = [];
    protected $investorEarnings = [];

    public function addInvestor(Investor $investor)
    {
        $this->investors[] = $investor;
    }

    protected function generateEarnings($fromDate, $toDate)
    {
        foreach($this->investors as $investor){ /** @var Investor $investor */
            $investorGain = 0;
            foreach($investor->getInvestments() as $investment){ /** @var Investment $investment */
                $investorGain += $investment->getMonthlyInterests($fromDate, $toDate);
            }

            $this->investorEarnings[] = ['investorName'=>$investor->name, 'investorEarnings'=>number_format($investorGain,2)];
        }
    }

    public function getInvestorsEarnings($fromDate, $toDate)
    {
        $this->generateEarnings($fromDate, $toDate);
        return $this->investorEarnings;
    }
}