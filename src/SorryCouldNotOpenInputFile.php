<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema;

final class SorryCouldNotOpenInputFile extends \DomainException
{
    public static function becauseItDoesntExist(string $file): self
    {
        return new self(
            "Sorry, could not open input file at location {$file} because it does not exist."
        );
    }
}