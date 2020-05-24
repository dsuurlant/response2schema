<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema\Tests\Parser;

use cebe\openapi\spec\OpenApi;
use cebe\openapi\spec\Schema;
use DSuurlant\Response2Schema\Parser\JsonParser;
use DSuurlant\Response2Schema\Parser\SorryCouldNotParseResponseBody;
use PHPUnit\Framework\TestCase;

final class JsonParserTest extends TestCase
{
    /** @test */
    public function it_should_throw_an_exception_when_body_is_not_valid_json()
    {
        $invalidJson = '[{"notvalid";}]';

        $this->expectException(SorryCouldNotParseResponseBody::class);

        $sut = JsonParser::parse($invalidJson);
    }

    /** @test */
    public function it_should_return_an_api_spec_for_valid_json(): void
    {
        $validJson = '{"id":1}';
        $sut = JsonParser::parse($validJson);
        TestCase::assertInstanceOf(OpenApi::class, $sut);
    }
}