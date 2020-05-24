<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema;

final class SorryCouldNotGenerateOpenApiFile extends \DomainException
{
    public static function becauseTheOutputFileIsNotInAValidFormat(string $file): self
    {
        return new self(
            "Sorry, could not generate an OpenAPI file for you, because the output file {$file} is not in a valid format." .
            " You should specify one of: " . implode(", ", Response2Schema::VALID_FORMATS)
        );
    }

    public static function becauseThereWasAnErrorWritingTheFileToDisk(string $message): self
    {
        return new self(
            "Sorry, could not generate an OpenAPI file for you, because there was an error writing it to disk: {$message}"
        );
    }
}