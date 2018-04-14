<?php 

namespace Tests\Tests\Unit;

require __DIR__ . '/../../vendor/autoload.php';
use PHPUnit\Framework\TestCase;
use Calculator\Expressions\Addition;
use Calculator\Expressions\Subtraction;
use Calculator\Expressions\Multiplication;
use Calculator\Expressions\Division;
use Struct\Stack;
use Calculator\RPNCalculator;

class RPNCalculatorTest extends TestCase
{
	/**
	 * @dataProvider getDataForAddition
	 * @param $summand1
	 * @param $summand2
	 * @param $sum
	 */


	public function testAddition($summand1,
		$summand2, $sum)
	{
		//Arrange
		$stack = new Stack();
		$stack->push($summand1);
		$stack->push($summand2);
		$add = new Addition($stack);

		//Act
		$addition_result = $add->calculateExp();

		//Assert
		$this->assertEquals($addition_result,
			$sum);

	}

	public function getDataForAddition()
	{
		return [
			[1, 1, 2],
			[2, 0, 2],
			[-3, 7, 4],
			[-4, -90, -94],
			[-11, 11, 0]
		];
	}

	/**
	 * @dataProvider getDataForSubtraction
	 * @param $minuend
	 * @param $subtrahend
	 * @param $difference
	 */


	public function testSubtraction($minuend,
		$subtrahend, $difference)
	{
		//Arrange
		$stack = new Stack();
		$stack->push($minuend);
		$stack->push($subtrahend);
		$sub = new Subtraction($stack);

		//Act
		$sub_result = $sub->calculateExp();

		//Assert
		$this->assertEquals($sub_result,
			$difference);
	}

	public function getDataForSubtraction()
	{
		return [
			[1, 1, 0],
			[2, 0, 2],
			[0, 2, -2],
			[-4, -90, 86],
			[-11, -3, -8]
		];
	}

	/**
	 * @dataProvider getDataForMultiplication
	 * @param $factor1
	 * @param $factor2
	 * @param $product
	 */


	public function testMultiplication(
		$factor1, $factor2, $product)
	{
		//Arrange
		$stack = new Stack();
		$stack->push($factor1);
		$stack->push($factor2);
		$mul = new Multiplication($stack);

		//Act
		$mul_result = $mul->calculateExp();

		//Assert
		$this->assertEquals($mul_result,
			$product);
	}

	public function getDataForMultiplication()
	{
		return [
			[1, 1, 1],
			[3, 0, 0],
			[0, 3, 0],
			[-4, -1, 4],
			[4, 1, 4],
			[10, 30, 300],
			[4, -2, -8]
		];
	}

	/**
	 * @dataProvider getDataForDivision
	 * @param $factor1
	 * @param $factor2
	 * @param $product
	 */


	public function testDivision(
		$dividend, $divider, $quotient)
	{
		//Arrange
		$stack = new Stack();
		$stack->push($dividend);
		$stack->push($divider);
		$div = new Division($stack);

		//Act
		$div_result = $div->calculateExp();

		//Assert
		$this->assertEquals($div_result,
			$quotient);
	}
    
    /**
     * @expectedException \Exception
     */


	public function testDivisionByZero()
	{
		//Arrange
		$stack = new Stack();
		$stack->push(10);
		$stack->push(0);
		$div = new Division($stack);

		//Act
		$div_result = $div->calculateExp();

		
	}

	public function getDataForDivision()
	{
		return [
			[1, 1, 1],
			[3, 1, 3],
			[1, 3, 1/3],
			[8, 4, 2],
			[9, 5, 9/5],
			[-30, 10, -3],
			[4, -2, -2]
		];
	}


	/**
	 * @dataProvider getDataForRPN
	 * @param $expression
	 * @param $rpn_result
	 */

	public function testRPN($expression, 
		$rpn_result)
	{
		//Arrange
		$calculator = new RPNCalculator();

		//Act
		$calculated_expression = $calculator
		->calculateExpression($expression);

		//Assert

		$this->assertEquals($rpn_result, 
			$calculated_expression);
	}

	public function getDataForRPN()
	{
		return [
			['2 3 + 5 /', 1],
			['1 1 - 6 *', 0],
			['2 2 + 3 2 * *', 24]
		];
	}

}


