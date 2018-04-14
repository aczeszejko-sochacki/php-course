<?php

namespace Cart;

class PromotionConditions
{
	private $cart;
	private $more_products_than_x;
	private $bigger_price_than_x;
	private $bigger_price_than_y; 

    public function __construct(
    	Cart $cart, 
		$bigger_price_than_x=0,
		$more_products_than_x=0, 
		$bigger_price_than_y=0)
    {
    	$this->cart = $cart;
    	$this->more_products_than_x =
         $more_products_than_x;
        $this->bigger_price_than_x = 
         $bigger_price_than_x;
        $this->bigger_price_than_y =
         $bigger_price_than_y;
    }

    public function getConditions(){

    	return get_class_methods(PromotionConditions::class);
    }

    public function biggerPrice()
	{
		if($this->cart->getTotalPrice()->getAmount() >
		 $this->bigger_price_than_x)
			return True;
		else
			return False;
	}

	public function moreProducts()
	{
		if(count($this->cart) > 
			$this->more_products_than_x)
			return True;
		else
			return False;
	}

	public function includeTelewizor()
	{
		foreach ($this->cart->getProductsNames() as 
			$product_name) {
			if(strpos($product_name, 'TELEWIZOR') 
				!== False)
				return True;
		}

		return False;
	}

	public function moreProductsbiggerPrice()
	{
		if($this->moreProducts() and 
			$this->cart->getTotalPrice()->getAmount() >
		 $this->bigger_price_than_y)
			return True;
		else
			return False;
	}
}