<?php
declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

/**
 * @extends Column<Uuid>
 */
class SymfonyUuidRelationColumn extends Column
{
    protected function getAllowedOperators(): array
    {
        return [
            OperationEnum::EQUAL,
        ];
    }

    public function getType(): string
    {
        return UuidType::NAME;
    }

    public function getValue(FilterInterface $filterColumn): Uuid
    {
        return Uuid::fromString($filterColumn->getValue());
    }
}
