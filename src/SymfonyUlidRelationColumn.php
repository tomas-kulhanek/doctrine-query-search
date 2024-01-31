<?php
declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use Doctrine\DBAL\Types\Types;
use Symfony\Component\Uid\Ulid;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

class SymfonyUlidRelationColumn extends Column
{

    /**
     * @return OperationEnum[]
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

    public function getValue(FilterInterface $filterColumn): Ulid
    {
        return Ulid::fromString($filterColumn->getValue());
    }
}
