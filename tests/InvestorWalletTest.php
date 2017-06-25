<?php
namespace Tests;

use LendInvest\Money;
use LendInvest\InvestorWallet;
use PHPUnit\Framework\TestCase;

class InvestorWalletTest extends TestCase
{
    public function testCanCreateInvestorWallet()
    {
        $investorWallet = new InvestorWallet(new Money(2000));
        $this->assertInstanceOf(InvestorWallet::class, $investorWallet);
    }

    public function checkWalletMoney()
    {
        $investorWallet = new InvestorWallet(new Money(2000));
        $this->assertEquals(2000, $investorWallet->getMoney()->getAmount());
    }

    public function testCanSubstractFromWallet()
    {
        $investorWallet = new InvestorWallet(new Money(2000));
        $investorWallet->subtract(new Money(500));

        $this->assertEquals(1500, $investorWallet->getMoney()->getAmount());
    }

    public function testInsufficientFundInTheWallet()
    {
        $this->expectException('Exception');
        $investorWallet = new InvestorWallet(new Money(100));
        $investorWallet->subtract(new Money(400));
    }
}