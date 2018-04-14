<?php

namespace Calculator\Expressions;
use Struct\Stack;

class Subtraction implements Expression
{
	private $stack;

	public function __construct($stack)
	{
		$this->stack = $stack;
	}

	public function calculateExp(): float
	{
		$subtrahend = $this->stack->pop();
		$minuend = $this->stack->pop();

		return $minuend - $subtrahend;
	}

	public function returnResult(): Stack
	{
		$this->stack->push(
			$this->calculateExp());

		return $this->stack;
	}
}