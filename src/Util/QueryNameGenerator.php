<?php
declare(strict_types=1);


namespace TomasKulhanek\DoctrineQuerySearch\Util;

final class QueryNameGenerator implements QueryNameGeneratorInterface
{
    private int $incrementedAssociation = 1;
    private int $incrementedName = 1;

    /**
     * {@inheritdoc}
     */
    public function generateJoinAlias(string $association): string
    {
        return sprintf('%s_a%d', $association, $this->incrementedAssociation++);
    }

    /**
     * {@inheritdoc}
     */
    public function generateParameterName(string $name): string
    {
        return sprintf('%s_p%d', str_replace('.', '_', $name), $this->incrementedName++);
    }
}
