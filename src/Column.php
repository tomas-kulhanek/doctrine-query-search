<?php

declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

abstract class Column
{
    public function __construct(private readonly string $column)
    {
    }

    abstract public function getType(): string;

    /**
     * @return OperationEnum[]
     */
    abstract protected function getAllowedOperators(): array;

    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @param FilterInterface $filterColumn
     * @return mixed
     */
    abstract public function getValue(FilterInterface $filterColumn): mixed;
}
