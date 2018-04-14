<?php

namespace Products;

use Money\Money;
use Money\Currency;

class Bundle implements IProduct{

	private $products;
	private $bundle_price;
	private $bundle_name;

	public function __construct(string $name,
	array $products){
		$this->products = $products;
		$this->bundle_name = $name;

		$this->bundle_price = $products[0]->getPrice();
		for($i = 1; $i < sizeof($products); $i++){
			$this->bundle_price = 
			$this->bundle_price->add(
				$products[$i]->getPrice());
		}
	}

	public function addProduct(IProduct $product){
		array_push($this->products, $product);

		try{
			$this->bundle_price = 
			$this->bundle_price->add($product->getPrice());
		}
		catch(Exception $wrong_currency){
            echo $wrong_currency->getMessage() . 
            PHP_EOL;
		}
	}

	public function getProducts(){
		return $this->products;
	}

	public function getName(): string{
		return $this->bundle_name;
	}

	public function getPrice(): Money{
		return $this->bundle_price;
	}
}