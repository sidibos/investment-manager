<?php
namespace Tests;

use LendInvest\Money;
use LendInvest\Loan;
use LendInvest\Investor;
use LendInvest\LoanTranche;
use LendInvest\InvestorWallet;
use PHPUnit\Framework\TestCase;

class InvestorTest extends TestCase
{
    public function testCanCreateInvestor()
    {
        $investor = new Investor('Investor 1', new InvestorWallet(new Money(2000)));
        $this->assertInstanceOf(Investor::class, $investor);
    }

    public function testInvestorCanInvest()
    {
        $investor = new Investor('Investor 1', new InvestorWallet(new Money(2000)));
        $loan = new Loan('16-07-2017', date('d-m-Y H:i:s', strtotime('+1 day')));
        $loanTranche = new LoanTranche(new Money(4000), $loan, 4);
        $investor->investIn($loanTranche, new Money(1000), '20-07-2017');

        $moneyInvested = $investor->getInvestments()[0]->getMoneyInvested();

        $this->assertEquals(1000, $moneyInvested->getAmount());
    }

    public function testInvestorFundLimit()
    {
        $this->expectException('Exception');
        $investor = new Investor('Investor 1', new InvestorWallet(new Money(1000)));
        $loan = new Loan('16-07-2017', date('d-m-Y H:i:s', strtotime('+1 day')));
        $loanTranche = new LoanTranche(new Money(4000), $loan, 4);
        $investor->investIn($loanTranche, new Money(1100), '20-07-2017');
    }

    public function testLoanClosedInvestment()
    {
        $this->expectException('Exception');
        $loan = new Loan('16-07-2017', '24-07-2017');
        $investor = new Investor('Investor 1', new InvestorWallet(new Money(1000)));
        $loanTranche = new LoanTranche(new Money(4000), $loan, 4);
        $investor->investIn($loanTranche, new Money(1100), '20-07-2017');
    }
}