<?php

namespace Cart;

class PromotionChecker
{
    private $cart_to_promotion;
    private $promotion_conditions;

	public function __construct(Cart $cart,
		PromotionConditions $promotion_conditions)
	{
        $this->cart_to_promotion = $cart;
        $this->promotion_conditions = 
         $promotion_conditions;     
	}

	public function isOnPromotion()
	{
		$conditions = 
		 $this->promotion_conditions->getConditions();


		 foreach ($conditions as $condition) {
		 	if($condition != '__construct'
		 		and $condition != 'getConditions'){

		 		if(call_user_func(array(
		 			$this->promotion_conditions, 
		 			$condition))){
		 			return True;
		 		}
		 	}	 	
		 }

		 return False;
	}
}