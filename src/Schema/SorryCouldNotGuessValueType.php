<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema\Schema;

final class SorryCouldNotGuessValueType extends \DomainException
{
    public static function becauseTheValueWasNotInATypeWeRecognise(string $key): self
    {
        return new self("Sorry, we could not guess the type for field {$key} because we don't recognise the value.");
    }
}