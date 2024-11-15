<?php
declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use Doctrine\DBAL\Types\Types;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

/**
 * @extends Column<int>
 */
class IntegerColumn extends Column
{
    protected function getAllowedOperators(): array
    {
        return [
            OperationEnum::BIGGER_THAN,
            OperationEnum::LOWER_THAN,
            OperationEnum::BIGGER_OR_EQUAL,
            OperationEnum::LOWER_OR_EQUAL,
            OperationEnum::EQUAL,
        ];
    }

    public function getType(): string
    {
        return Types::INTEGER;
    }

    public function getValue(FilterInterface $filterColumn): int
    {
        return intval($filterColumn->getValue());
    }
}
