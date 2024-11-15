<?php
declare(strict_types=1);


namespace TomasKulhanek\DoctrineQuerySearch\Formatter;

use TomasKulhanek\DoctrineQuerySearch\Column;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

interface FormatterInterface
{
    /**
     * @template T
     * @param Column<T> $column
     * @return T|string
     */
    public function formatValue(FilterInterface $filter, Column $column): mixed;

    public function formatOperator(FilterInterface $filter): string;
}
