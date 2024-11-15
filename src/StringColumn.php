<?php
declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use Doctrine\DBAL\Types\Types;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

/**
 * @extends Column<string>
 */
class StringColumn extends Column
{
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

    public function getValue(FilterInterface $filterColumn): string
    {
        return $filterColumn->getValue();
    }
}
