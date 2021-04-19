<?php declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use Doctrine\DBAL\Types\Types;

class DateColumn extends DateTimeColumn
{

    protected string $format = 'Y-m-d';

	public function getType(): string
    {
        return Types::DATE_IMMUTABLE;
    }

}
