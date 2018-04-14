<?php 

namespace Products;
use Money\Money;
use Money\Currency;
use Products\Product;

class StandardProduct implements Product
{
    private $standard_product_name;
    private $standard_product_price;

    public function __construct(String $product_name, Money $price)
    {
    	$this->standard_product_name = $product_name;
    	$this->standard_product_price = $price;
    }

    public function getName(): string
    {
    	return $this->standard_product_name;
    }

    public function getPrice(): Money
    {
    	return $this->standard_product_price;
    }
}