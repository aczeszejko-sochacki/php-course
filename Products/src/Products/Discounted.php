<?php

namespace Products;

use Money\Money;
use Money\Currency;

class Discounted extends Product implements IProduct{
	private $price_reduction;
	private $product_name;
	private $product_price;

	public function __construct($percent_reduction,
		IProduct $product){
		$this->price_reduction = $percent_reduction;
		$this->product_name = $product->getName();
		$this->product_price = $product->getPrice()->
		multiply(1 - $this->price_reduction / 100);
	}

	public function getName(): string{
		return $this->product_name;
	}

	public function getPrice(): Money{
		return $this->product_price;
	}
}