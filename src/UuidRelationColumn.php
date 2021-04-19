<?php declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use Doctrine\DBAL\Types\Types;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

class UuidRelationColumn extends Column
{

	/**
	 * @return string[]
	 */
	protected function getAllowedOperators(): array
	{
		return [
			OperationEnum::EQUAL,
		];
	}

	public function getType(): string
	{
		return Types::STRING;
	}

	/**
	 * @param FilterInterface $filterColumn
	 * @return UuidInterface
	 */
	public function getValue(FilterInterface $filterColumn): UuidInterface
	{
		return Uuid::fromString($filterColumn->getValue());
	}

}
