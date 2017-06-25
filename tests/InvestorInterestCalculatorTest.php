<?php
namespace Tests;

use LendInvest\Loan;
use LendInvest\Money;
use LendInvest\Investor;
use LendInvest\LoanTranche;
use LendInvest\InvestorWallet;
use PHPUnit\Framework\TestCase;
use LendInvest\InvestorInterestCalculator;


class InvestorInterestCalculatorTest extends TestCase
{
    public function testCanCreateInvestorInterestCalculator()
    {
        $investorInterestCalculator = new InvestorInterestCalculator('01-05-2017', '04-07-2017');
        $this->assertInstanceOf(InvestorInterestCalculator::class, $investorInterestCalculator);
    }

    public function testInvestorEarnings()
    {
        $loan = new Loan('01-05-2017', date('d-m-Y', strtotime('+1 dat')));
        $loanTranche = new LoanTranche(new Money(1000), $loan, 6);
        $investor = new Investor('Investor 1', new InvestorWallet(new Money(2000)));
        $investor->investIn($loanTranche, new Money(500), '01-05-2017');

        $investorInterestCalculator = new InvestorInterestCalculator();
        $investorInterestCalculator->addInvestor($investor);
        $investorMonthlyEarnings    = $investorInterestCalculator->getInvestorsEarnings('01-05-2017', '31-07-2017');

        $this->assertEquals(30, $investorMonthlyEarnings[0]['investorEarnings']);
    }
}