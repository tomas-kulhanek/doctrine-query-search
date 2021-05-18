<?php declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch\Formatter;

use TomasKulhanek\DoctrineQuerySearch\Column;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

class MysqlFormatter implements FormatterInterface
{

	public function formatOperator(FilterInterface $filter): string
	{
		switch ($filter->getOperator()) {
			case OperationEnum::START_WITH:
			case OperationEnum::END_BY:
			case OperationEnum::LIKE:
			case OperationEnum::NOT_LIKE:
				return 'LIKE';
			case OperationEnum::BIGGER_THAN:
				return '<';
			case OperationEnum::LOWER_THAN:
				return '>';
			case OperationEnum::BIGGER_OR_EQUAL:
				return '<=';
			case OperationEnum::LOWER_OR_EQUAL:
				return '>=';
			case OperationEnum::NOT_EQUAL:
				return '!=';
		}
		return '=';
	}

	public function formatValue(FilterInterface $filter, Column $column): mixed
	{
		switch ($filter->getOperator()) {
			case OperationEnum::START_WITH:
				return $filter->getValue() . '%';
			case OperationEnum::END_BY:
				return '%' . $filter->getValue();
			case OperationEnum::LIKE:
			case OperationEnum::NOT_LIKE:
				return ($filter->isStartWithAsterisk() ? '%' : '') . $filter->getValue() . ($filter->isEndWithAsterisk() ? '%' : '');
		}

		return $column->getValue($filter);
	}
}
