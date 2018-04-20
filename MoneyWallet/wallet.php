<?php

require 'vendor/autoload.php';

use Wallet\Wallet;
use Money\Money;
use Money\Currency;

$wallet = new Wallet('wallet');
$wallet->createHistory();
$wallet->activate('init');
$wallet->activateArchive('init');
$wallet->deposit(Money::PLN(10));
$wallet->depositArchive(Money::PLN(10));
$wallet->deposit(Money::PLN(20));
$wallet->depositArchive(Money::PLN(20));
$wallet->withdraw(Money::PLN(3));
$wallet->withdrawArchive(Money::PLN(3));
$wallet->deactivate('banned');
$wallet->deactivateArchive('banned');

var_dump($wallet);

$events = json_decode(file_get_contents('data/Wallets/wallet.txt'));

//Event Sourcing
$new_wallet = new Wallet('wallet_from_events');
$new_wallet = $new_wallet->fromEvents($events);
var_dump($new_wallet);
