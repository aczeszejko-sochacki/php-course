<?php

namespace Product;

use Money\Money;
use Money\Currency;

class Product{
    private $product_id;
    private $product_name;
    private $product_price;

    public function __construct(
    	$id, $name, $value, $currency){
    	$this->product_id = $id;
    	$this->product_name = $name;
    	$this->product_price = new Money($value,
    		new Currency($currency));
    }

    public function getId():string{
    	return $this->product_id;
    }

    public function getName(): string{
        return $this->product_name;
	}

	public function getPrice(): Money{
		return $this->product_price;
	}

}
