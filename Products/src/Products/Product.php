<?php

namespace Products;

use Money\Money;
use Money\Currency;

class Product implements IProduct{
	private $product_name;
	private $product_price;

    public function __construct(
    	string $name, Money $price){
    	$this->product_name = $name;
    	$this->product_price = $price;
    }

	public function getName(): string{
        return $this->product_name;
	}

	public function getPrice(): Money{
		return $this->product_price;
	}
}


