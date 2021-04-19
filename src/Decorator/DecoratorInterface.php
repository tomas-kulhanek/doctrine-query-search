<?php declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch\Decorator;

use TomasKulhanek\DoctrineQuerySearch\Column;
use Doctrine\ORM\QueryBuilder;
use TomasKulhanek\QuerySearch\Params\RequestParamsInterface;

interface DecoratorInterface
{
	/**
	 * @param QueryBuilder $queryBuilder
	 * @param RequestParamsInterface $filter
	 * @param Column[] $columns
	 * @return void
	 */
	public function decorate(QueryBuilder $queryBuilder, RequestParamsInterface $filter, array $columns): void;
}
