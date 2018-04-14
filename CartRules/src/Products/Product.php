<?php

namespace Products;

use Money\Money;
use Money\Currency;

interface Product
{
	public function getName(): string;

	public function getPrice(): Money;
}