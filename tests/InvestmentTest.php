<?php
namespace Tests;

use LendInvest\Loan;
use LendInvest\Money;
use LendInvest\Investment;
use LendInvest\LoanTranche;
use PHPUnit\Framework\TestCase;

class InvestmentTest extends TestCase
{
    public $loan;
    public $loanTranche;

    public function setUp(){
        $this->loan = new Loan('01-05-2017', date('d-m-Y H:i:s', strtotime('+1 day')));
        $this->loanTranche = new LoanTranche(new Money(1000), $this->loan, 5);
    }

    public function testCanCreateInvestment()
    {
        $investment = new Investment($this->loanTranche, new Money(100), '02-05-2017');
        $this->assertInstanceOf(Investment::class, $investment);
    }

    public function testMonthlyInterest()
    {
        $investment = new Investment($this->loanTranche, new Money(100), '01-05-2017');
        $monthlyInterest = $investment->getMonthlyInterests('01-05-2017', '31-05-2017');
        $this->assertEquals(5, $monthlyInterest);
    }

    public function testMoneyInvested()
    {
        $investment = new Investment($this->loanTranche, new Money(100), '02-05-2017');
        $this->assertEquals(100, $investment->moneyInvested->getAmount());
    }
}