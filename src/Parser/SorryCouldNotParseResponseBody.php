<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema\Parser;

final class SorryCouldNotParseResponseBody extends \DomainException
{
    public static function becauseTheBodyIsNotValidJson(): self
    {
        return new self("Sorry, could not parse the response body because it is not valid json.");
    }
}