<?php

namespace Calculator\Expressions;
use Struct\Stack;
use Exception;

class Division implements Expression
{
	private $stack;

	public function __construct($stack)
	{
		$this->stack = $stack;
	}

	public function calculateExp(): float
	{
		$divider = $this->stack->pop();
		$dividend = $this->stack->pop();
		

		if($divider == 0)
			throw new Exception(
				'Division by zero');

		return $dividend / $divider;
	}

	public function returnResult(): Stack
	{
		$this->stack->push(
			$this->calculateExp());

		return $this->stack;
	}
}