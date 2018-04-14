<?php

require_once 'vendor/autoload.php';

use Struct\Stack;
use Calculator\RPNCalculator;
use Calculator\Expressions\Addition;
use Calculator\Expressions\Subtraction;
use Calculator\Expressions\Multiplication;
use Calculator\Expressions\Division;

$exp = implode(' ', $argv);

$calc = new RPNCalculator();
echo $calc->calculateExpression($exp) . PHP_EOL;

