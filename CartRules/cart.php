<?php

require 'vendor/autoload.php';

use Money\Money;
use Money\Currency;
use Products\Product;
use Products\StandardProduct;
use Cart\Cart;
use Cart\PromotionChecker;
use Cart\PromotionConditions;

$cart = new Cart('cart1', 
	new StandardProduct('milk', Money::PLN(2)));
$cart->addProduct(
	new StandardProduct('TELEWIZOR', Money::PLN(4)));
$cart->addProduct(
	new StandardProduct('bread', Money::PLN(3)));

$check_promotion = new PromotionChecker(
	$cart, new PromotionConditions($cart, 9, 10, 8));

if($check_promotion->isOnPromotion()) echo 'TAK' . PHP_EOL;
else echo 'NIE' . PHP_EOL;
