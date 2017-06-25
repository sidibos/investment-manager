<?php
namespace Tests;

use LendInvest\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public $amount = 20.22;

    public function testCanCreateMoney()
    {
        $money = new Money(20);
        $this->assertInstanceOf(Money::class, $money);
    }

    public function testMoneyAmount()
    {
        $money = new Money($this->amount);
        $this->assertEquals($this->amount, $money->getAmount());
    }

    public function testCanDeduct()
    {
        $money          = new Money(100);
        $moneyToDeduct  = new Money(40);
        $money->deduct($moneyToDeduct);
        $this->assertEquals(60,$money->getAmount());
    }

    public function testFailedDeduction()
    {
        $this->expectException('Exception');
        $money          = new Money(40);
        $moneyToDeduct  = new Money(50);
        $money->deduct($moneyToDeduct);
    }
}