<?php
declare(strict_types=1);


namespace TomasKulhanek\DoctrineQuerySearch\Decorator\Doctrine;

use TomasKulhanek\DoctrineQuerySearch\Exception\FilterException;
use TomasKulhanek\DoctrineQuerySearch\Column;
use TomasKulhanek\DoctrineQuerySearch\Decorator\DecoratorInterface;
use TomasKulhanek\DoctrineQuerySearch\Formatter\FormatterInterface;
use TomasKulhanek\DoctrineQuerySearch\Util\QueryNameGenerator;
use Doctrine\ORM\QueryBuilder;
use TomasKulhanek\QuerySearch\Params\FilterInterface;
use TomasKulhanek\QuerySearch\Params\RequestParamsInterface;
use TomasKulhanek\QuerySearch\Params\SortInterface;

class OrmDecorator implements DecoratorInterface
{

    public function __construct(
        private FormatterInterface $formatter
    ) {
    }

    /**
     * @param string $column
     * @param Column[] $columns
     * @return Column
     * @throws FilterException
     */
    protected function getColumnDefinition(string $column, array $columns): Column
    {
        if (empty($columns[$column])) {
            throw new FilterException(
                sprintf('Unknown column "%s".', $column)
            );
        }

        return $columns[$column];
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param array<int, FilterInterface> $filters
     * @param Column[] $columns
     * @throws FilterException
     */
    protected function applyFilters(QueryBuilder $queryBuilder, array $filters, array $columns): void
    {
        $qbGenerator = new QueryNameGenerator();
        /** @var FilterInterface $filterColumn */
        foreach ($filters as $filterColumn) {
            $column = $this->getColumnDefinition($filterColumn->getField(), $columns);

            $parameter = $qbGenerator->generateParameterName($column->getColumn());

            $expression = sprintf(
                '%s %s :%s',
                $column->getColumn(),
                $this->formatter->formatOperator($filterColumn),
                $parameter
            );

            $queryBuilder->andWhere($expression)
                ->setParameter(
                    $parameter,
                    $this->formatter->formatValue($filterColumn, $column),
                    $column->getType()
                );
        }
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param array<int, SortInterface> $sorts
     * @param Column[] $columns
     * @throws FilterException
     */
    protected function applySorting(QueryBuilder $queryBuilder, array $sorts, array $columns): void
    {
        if (empty($sorts)) {
            return;
        }

        foreach ($sorts as $sortColumn) {
            $queryBuilder->addOrderBy(
                $this->getColumnDefinition($sortColumn->getField(), $columns)->getColumn(),
                $sortColumn->getDirection()
            );
        }
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param RequestParamsInterface $filter
     * @param Column[] $columns
     * @return void
     * @throws FilterException
     */
    public function decorate(QueryBuilder $queryBuilder, RequestParamsInterface $filter, array $columns): void
    {
        $this->applyFilters($queryBuilder, $filter->getFilters(), $columns);
        $this->applySorting($queryBuilder, $filter->getSorts(), $columns);


        if ($filter->hasPagination()) {
            $queryBuilder
                ->setFirstResult($filter->getPagination()->getOffset())
                ->setMaxResults($filter->getPagination()->getLimit());
        }
    }
}
