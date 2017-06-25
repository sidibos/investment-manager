<?php
namespace Tests;

use LendInvest\Loan;
use LendInvest\Money;
use LendInvest\Investor;
use LendInvest\LoanTranche;
use LendInvest\InvestorWallet;
use PHPUnit\Framework\TestCase;

class LoanTrancheTest extends TestCase
{
    public $balance;
    public $loan;

    public function setUp()
    {
        $this->balance = new Money(1000.50);
        $this->loan = new Loan('24-06-2017', date('d-m-Y H:i:s', strtotime('+1 day')));
    }

    public function testCanCreateLoanTranche()
    {
        $loanTranche = new LoanTranche($this->balance, $this->loan,1.5);
        $this->assertInstanceOf(LoanTranche::class, $loanTranche);
    }

    public function testLoanTrancheBalance()
    {
        $loanTranche = new LoanTranche($this->balance, $this->loan,1.5);
        $this->assertEquals(1000.50, $loanTranche->getBalance()->getAmount());
    }

    public function testCanDeductInvestmentFromLoanTranche()
    {
        $loanTranche = new LoanTranche($this->balance, $this->loan, 1.5);
        $loanTranche->deductInvestment(new Money(500));
        $this->assertEquals(500.50, $loanTranche->getBalance()->getAmount());
    }

    public function testLoanTrancheBalanceReached()
    {
        $this->expectException('Exception');

        $loanTranche = new LoanTranche($this->balance, $this->loan, 1.5);
        $investor1 = new Investor('Investor 1', new InvestorWallet(new Money(1000)));
        $investor2 = new Investor('Investor 2', new InvestorWallet(new Money(1000)));

        $investor1->investIn($loanTranche, new Money(900), '30-06-2017');
        $investor2->investIn($loanTranche, new Money(200), '30-06-2017');
    }
}