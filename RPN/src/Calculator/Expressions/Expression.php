<?php 

namespace Calculator\Expressions;

use Struct\Stack;

interface Expression
{
	public function calculateExp(): float;

	public function returnResult(): Stack;
}