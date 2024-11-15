<?php
declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use TomasKulhanek\DoctrineQuerySearch\Exception\FilterException;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

/**
 * @extends Column<DateTimeImmutable>
 */
class DateTimeColumn extends Column
{
    protected string $format = DateTimeInterface::ATOM;

    protected function getAllowedOperators(): array
    {
        return [
            OperationEnum::BIGGER_THAN,
            OperationEnum::BIGGER_OR_EQUAL,
            OperationEnum::LOWER_THAN,
            OperationEnum::LOWER_OR_EQUAL,
            OperationEnum::EQUAL,
        ];
    }

    public function getType(): string
    {
        return Types::DATETIME_IMMUTABLE;
    }

    /**
     * @throws FilterException
     */
    public function getValue(FilterInterface $filterColumn): DateTimeImmutable
    {
        $dateTime = DateTimeImmutable::createFromFormat($this->format, $filterColumn->getValue());
        if (!$dateTime) {
            throw new FilterException(
                sprintf(
                    'Date format for column "%s" is not valid. Format must be "%s"',
                    $filterColumn->getField(),
                    $this->format
                )
            );
        }
        return $dateTime;
    }
}
