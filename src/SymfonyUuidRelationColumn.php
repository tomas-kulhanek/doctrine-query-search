<?php
declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

class SymfonyUuidRelationColumn extends Column
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
        return UuidType::NAME;
    }

    public function getValue(FilterInterface $filterColumn): Uuid
    {
        return Uuid::fromString($filterColumn->getValue());
    }
}
