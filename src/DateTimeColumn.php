<?php declare(strict_types=1);

namespace TomasKulhanek\DoctrineQuerySearch;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use TomasKulhanek\DoctrineQuerySearch\Exception\FilterException;
use TomasKulhanek\QuerySearch\Enum\OperationEnum;
use TomasKulhanek\QuerySearch\Params\FilterInterface;

class DateTimeColumn extends Column
{

    protected string $format = DateTimeImmutable::ATOM;

    /**
     * @return string[]
     */
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
     * @param FilterInterface $filterColumn
     * @return DateTimeImmutable
     */
    public function getValue(FilterInterface $filterColumn): DateTimeImmutable
    {
        if (!is_string($filterColumn->getValue())) {
            throw new FilterException(
                sprintf('Date format for column "%s" is not valid. Format must be "%s"', $filterColumn->getField(), $this->format)
            );
        }
        $dateTime = DateTimeImmutable::createFromFormat($this->format, $filterColumn->getValue());
        if (!$dateTime) {
            throw new FilterException(
                sprintf('Date format for column "%s" is not valid. Format must be "%s"', $filterColumn->getField(), $this->format)
            );
        }
        return $dateTime;
    }

}
