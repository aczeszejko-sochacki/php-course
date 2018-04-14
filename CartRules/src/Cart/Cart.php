<?php

namespace Cart;

use Countable;
use Products\Product;
use Money\Money;

class Cart implements Countable
{
	private $table_of_products;
	private $products_names;
	private $total_price;
	private $cart_name;

	public function __construct(string $cart_name, 
		Product $new_product)
	{
		$this->table_of_products = array($new_product);
		$this->products_names = array($new_product->getName());
		$this->total_price = $new_product->getPrice();
		$this->cart_name = $cart_name;
	}

	public function count()
	{
		return count($this->table_of_products);
	}
   
    public function addProduct(Product $new_product)
    {
        array_push($this->table_of_products, $new_product);
        array_push($this->products_names, $new_product->getName());
        $this->total_price = 
         $this->total_price->add($new_product->getPrice());
    }
    
    public function getTotalPrice(): Money
    {
        return $this->total_price;
    }

    public function getProductsNames()
    {
    	return $this->products_names;
    }

    public function addGift()
    {
    	//...
    } 
}