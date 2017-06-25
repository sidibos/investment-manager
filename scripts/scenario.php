<?php
#!/bin/sh

require_once dirname(__FILE__).'/../global.php';

use \LendInvest\Loan;
use \LendInvest\Money;
use \LendInvest\LoanTranche;
use \LendInvest\InvestorWallet;
use \LendInvest\Investor;
use \LendInvest\InvestorInterestCalculator;

date_default_timezone_set('America/New_York');

$loan = new Loan('01-10-2015', '15-11-2015');

$trancheA = new LoanTranche(new Money(1000), $loan, 3);
$trancheB = new LoanTranche(new Money(1000), $loan, 6);
$loan->addTranche($trancheA);
$loan->addTranche($trancheB);

$investorWallet = new InvestorWallet(new Money(1000));

$investor1  = new Investor('Investor 1', new InvestorWallet(new Money(1000)));
$investor2  = new Investor('Investor 2', new InvestorWallet(new Money(1000)));
$investor3  = new Investor('Investor 3', new InvestorWallet(new Money(1000)));
$investor4  = new Investor('Investor 4', new InvestorWallet(new Money(1000)));

$interestCalculator = new InvestorInterestCalculator();

try {
    $investor1->investIn($trancheA, new Money(1000), '3-10-2015');
} catch (Exception $e) {
    echo $e->getMessage().' 1'.PHP_EOL;
}

try {
    $investor2->investIn($trancheA, new Money(1), '04-10-2015');
} catch(Exception $e){
    echo $e->getMessage().' 2'.PHP_EOL;
}

try {
    $investor3->investIn($trancheB, new Money(500), '10-10-2015');
} catch(Exception $e){
    echo $e->getMessage().' 3'.PHP_EOL;
}

try {
    $investor4->investIn($trancheB, new Money(1100), '25-10-2015');
} catch(exception $e){
    echo $e->getMessage().' 4'.PHP_EOL;
}


$interestCalculator->addInvestor($investor1);
$interestCalculator->addInvestor($investor2);
$interestCalculator->addInvestor($investor3);
$interestCalculator->addInvestor($investor4);

$earnings = $interestCalculator->getInvestorsEarnings('01-10-2015', '31-10-2015');
foreach($earnings as $earning)
{
    echo $earning['investorName']." earning ".$earning['investorEarnings']. ' pounds'.PHP_EOL;
}