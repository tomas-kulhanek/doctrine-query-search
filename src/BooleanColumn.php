<?php
declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use Doctrine\DBAL\Types\Types;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

/**
 * @extends Column<bool>
 */
class BooleanColumn extends Column
{
    protected function getAllowedOperators(): array
    {
        return [OperationEnum::EQUAL];
    }

    public function getType(): string
    {
        return Types::BOOLEAN;
    }

    public function getValue(FilterInterface $filterColumn): bool
    {
        return !empty($filterColumn->getValue());
    }
}
