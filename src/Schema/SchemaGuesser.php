<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema\Schema;

final class SchemaGuesser
{
    /**
     * Guesses a component schema based on the given data.
     * Since some elements cannot be inferred (nullable, oneOf, mixed types)
     * this always remains a 'guess'.
     */
    public static function guess(array $data): array
    {
        // Are we dealing with a flat object or a list?
        // If it's a list, we will recursively guess based on the first item in the data.
        if (self::isObject($data) === false) {
            if (count($data) === 0) {
                return [
                    'type' => 'array'
                ];
            }

            $firstElement = reset($data);
            return [
                'type' => 'array',
                'items' => self::guessType($firstElement)
            ];
        }

        return self::guessObject($data);
    }

    private static function guessObject(array $data): array
    {
        $schema = [
            'type' => 'object',
            'properties' => []
        ];

        // If it's a flat object, process normally.
        foreach ($data as $key => $value) {
            $schema['properties'][$key] = self::guessType($value);
        }

        return $schema;
    }

    private static function guessType($value): array
    {
        if (is_string($value)) {
            return [
                'type' => 'string'
            ];
        }

        if (is_int($value)) {
            return [
                'type' => 'integer'
            ];
        }

        if (is_numeric($value)) {
            return [
                'type' => 'number'
            ];
        }

        // Recursively guess nested types.
        if (is_array($value)) {
            if (count($value) === 0) {
                return [
                    'type' => 'array'
                ];
            }

            if (self::isObject($value)) {
                return self::guess($value);
            }

            $firstElement = reset($value);
            return [
                'type' => 'array',
                'items' => self::guessType($firstElement)
            ];
        }

        if (is_bool($value)) {
            return [
                'type' => 'boolean'
            ];
        }

        // If the value is null, we default to a nullable string.
        if (is_null($value)) {
            return [
                'type' => 'string',
                'nullable' => true
            ];
        }

        throw SorryCouldNotGuessValueType::becauseTheValueWasNotInATypeWeRecognise($value);
    }

    /**
     * Checks if array is an associative array object or a simple list.
     */
    private static function isObject(array $value): bool
    {
        $keys = array_keys($value);
        return is_string(array_shift($keys));
    }
}