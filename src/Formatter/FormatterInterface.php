<?php declare(strict_types=1);


namespace TomasKulhanek\DoctrineQuerySearch\Formatter;

use TomasKulhanek\QuerySearch\Params\FilterInterface;

interface FormatterInterface
{
	public function formatValue(FilterInterface $filter): string;

	public function formatOperator(FilterInterface $filter): string;
}
