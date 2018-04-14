<?php

require 'vendor/autoload.php';

use Money\Money;
use Money\Currency;
use Products\Product;
use Products\Bundle;
use Products\Discounted;

$milk = new Product('milk', Money::PLN(1000000));
$ham = new Product('ham', Money::PLN(3000));

$fruits = new Bundle('fruits', 
	[new Product('apple',Money::PLN(20000)), 
	new Product('pear',Money::PLN(1))]);
$fruits->addProduct(new Product('banana',
 Money::PLN(30000)));

$discounted_milk = new Discounted(10, $milk);
$totalPrice = Money::PLN(0);



$products = [
    $milk,
    $ham,
    $fruits,
    $discounted_milk
];

foreach ($products as $product) {
    echo $product->getName() . PHP_EOL;
    
    $totalPrice = $totalPrice->add($product->getPrice());
}

echo 'TOTAL PRICE: ...' . $totalPrice->getAmount();