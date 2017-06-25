<?php
namespace LendInvest;

class InvestorInterestCalculator
{
    /**
     * @var array
     */
    public $investors = [];

    /**
     * @var array
     */
    protected $investorEarnings = [];

    /**
     * add investor
     * @param Investor $investor
     */
    public function addInvestor(Investor $investor)
    {
        $this->investors[] = $investor;
    }

    /**
     * generate Investors monthly interests earnings
     * @param $fromDate
     * @param $toDate
     */
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

    /**
     * returns Investors monthly interest earnings
     * @param $fromDate
     * @param $toDate
     * @return array
     */
    public function getInvestorsEarnings($fromDate, $toDate)
    {
        $this->generateEarnings($fromDate, $toDate);
        return $this->investorEarnings;
    }
}