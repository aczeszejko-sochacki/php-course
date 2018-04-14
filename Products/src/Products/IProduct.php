<?php

namespace Products;

use Money\Money;
use Money\Currency;

interface IProduct{
	public function getName(): string;

	public function getPrice(): Money;
}