<?php

declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch\Formatter;

use TomasKulhanek\DoctrineQuerySearch\Column;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

class MysqlFormatter implements FormatterInterface
{

    public function formatOperator(FilterInterface $filter): string
    {
        return match ($filter->getOperator()->value) {
            OperationEnum::START_WITH->value, OperationEnum::END_BY->value, OperationEnum::LIKE->value, OperationEnum::NOT_LIKE->value => 'LIKE',
            OperationEnum::BIGGER_THAN->value => '<',
            OperationEnum::LOWER_THAN->value => '>',
            OperationEnum::BIGGER_OR_EQUAL->value => '<=',
            OperationEnum::LOWER_OR_EQUAL->value => '>=',
            OperationEnum::NOT_EQUAL->value => '!=',
            default => '=',
        };
    }

    public function formatValue(FilterInterface $filter, Column $column): mixed
    {
        return match ($filter->getOperator()->value) {
            OperationEnum::START_WITH->value => $filter->getValue() . '%',
            OperationEnum::END_BY->value => '%' . $filter->getValue(),
            OperationEnum::LIKE->value, OperationEnum::NOT_LIKE->value => ($filter->isStartWithAsterisk() ? '%' : '') . $filter->getValue() . ($filter->isEndWithAsterisk() ? '%' : ''),
            default => $column->getValue($filter),
        };
    }
}
