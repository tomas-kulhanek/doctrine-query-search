<?php
declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\Types\UlidType;
use Symfony\Component\Uid\Ulid;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

/**
 * @extends Column<Ulid>
 */
class SymfonyUlidRelationColumn extends Column
{
    protected function getAllowedOperators(): array
    {
        return [
            OperationEnum::EQUAL,
        ];
    }

    public function getType(): string
    {
        return UlidType::NAME;
    }

    public function getValue(FilterInterface $filterColumn): Ulid
    {
        return Ulid::fromString($filterColumn->getValue());
    }
}
