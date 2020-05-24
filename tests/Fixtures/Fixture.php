<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema\Tests\Fixtures;

interface Fixture
{
    /**
     * Retrieves a single fixture object for use in testing.
     */
    public static function single(): array;

    /**
     * Retrieves a list of fixture objects for use in testing.
     */
    public static function many(int $amount): array;
}