<?php
namespace Tests;

use LendInvest\Loan;
use PHPUnit\Framework\TestCase;

class LoanTest extends TestCase
{
    public $loanStartDate;
    public $loanEndDate;

    public function setUp()
    {
        $this->loanStartDate  = '01-06-2017';
        $this->loanEndDate    = '16-06-2017';
    }

    public function testCanCreateLoan()
    {
        $loan = new Loan('25-06-2017', '24-07-2017');
        $this->assertInstanceOf(Loan::class, $loan);
    }

    public function testFailIsOpen()
    {
        $this->expectException('Exception');
        $loanObj  = new Loan($this->loanStartDate, $this->loanEndDate);
        $loanObj->checkLoanIsOpened();
    }

    public function testLoanIsOpen()
    {
        $loanObj  = new Loan('01-06-2017', date('Y-m-d H:i:s', strtotime('+1 day')));
        $loanObj->checkLoanIsOpened();
        $this->assertTrue(true);
    }
}