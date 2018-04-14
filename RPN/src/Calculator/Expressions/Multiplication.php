<?php

namespace Calculator\Expressions;
use Struct\Stack;

class Multiplication implements Expression
{
	private $stack;

	public function __construct($stack)
	{
		$this->stack = $stack;
	}

	public function calculateExp(): float
	{
		return $this->stack->pop()
		 * $this->stack->pop();
	}

	public function returnResult(): Stack
	{
		$this->stack->push(
			$this->calculateExp());

		return $this->stack;
	}
}