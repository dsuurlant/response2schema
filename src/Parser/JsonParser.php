<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema\Parser;

use cebe\openapi\spec\OpenApi;
use DSuurlant\Response2Schema\Schema\SchemaGuesser;
use DSuurlant\Response2Schema\Spec\DefaultSpec;
use JsonException;

final class JsonParser implements Parser
{
    public static function parse(string $body): OpenApi
    {
        try {
            $data = self::decode($body);
            $schema = SchemaGuesser::guess($data);
            $spec = new OpenApi(
                DefaultSpec::default($schema)
            );

            return $spec;
        } catch (JsonException $exception) {
            throw SorryCouldNotParseResponseBody::becauseTheBodyIsNotValidJson();
        }
    }

    private static function decode(string $body): array
    {
        return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
    }

}