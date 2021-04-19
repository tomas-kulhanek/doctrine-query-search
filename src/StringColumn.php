<?php declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use Doctrine\DBAL\Types\Types;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

class StringColumn extends Column
{

	/**
	 * @return string[]
	 */
	protected function getAllowedOperators(): array
	{
		return [
			OperationEnum::START_WITH,
			OperationEnum::END_BY,
			OperationEnum::LIKE,
			OperationEnum::EQUAL,
		];
	}

	public function getType(): string
	{
		return Types::STRING;
	}

	/**
	 * @param FilterInterface $filterColumn
	 * @return string
	 */
	public function getValue(FilterInterface $filterColumn): string
	{
		return (string) $filterColumn->getValue();
	}

}
