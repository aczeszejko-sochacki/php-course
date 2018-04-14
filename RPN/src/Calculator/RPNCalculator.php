<?php 

namespace Calculator;
use Calculator\Expressions\Addition;
use Calculator\Expressions\Subtraction;
use Calculator\Expressions\Multiplication;
use Calculator\Expressions\Division;
use Struct\Stack;

class RPNCalculator implements Calculator
{
	private $stack;

	public function __construct()
	{
		$this->stack = new Stack();
	}

	public function calculateExpression(
		$expression)
	{
		$signs = explode(' ', $expression);

		foreach ($signs as $sign) {
			
			if(is_numeric($sign)){
				$this->stack->push($sign);
			}

			else{

				switch($sign){

					case('+'):
						$add = new Addition(
							$this->stack);
						$this->stack = 
						 $add->returnResult();
						
						break;

					case('-'):
						$add = new Subtraction(
							$this->stack);
						$this->stack = 
						 $add->returnResult();
						
						break;

					case('*'):
						$add = new Multiplication(
							$this->stack);
						$this->stack = 
						 $add->returnResult();
						
						break;

					case('/'):
						$add = new Division(
							$this->stack);
						$this->stack = 
						 $add->returnResult();
						
						break;
				}
			}
		}

		return $this->stack->pop();
	}
}