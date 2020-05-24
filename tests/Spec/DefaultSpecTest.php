<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema\Tests\Spec;

use DSuurlant\Response2Schema\Schema\SchemaGuesser;
use DSuurlant\Response2Schema\Spec\DefaultSpec;
use PHPUnit\Framework\TestCase;

final class DefaultSpecTest extends TestCase
{
    /** @test */
    public function it_should_have_a_valid_open_api_spec(): void
    {
        $schema = SchemaGuesser::guess(['id' => 1, 'name' => 'test']);
        $spec = DefaultSpec::default($schema);

        TestCase::assertArrayHasKey('openapi', $spec);
        TestCase::assertArrayHasKey('info', $spec);
        TestCase::assertArrayHasKey('title', $spec['info']);
        TestCase::assertArrayHasKey('version', $spec['info']);
        TestCase::assertArrayHasKey('description', $spec['info']);
        TestCase::assertArrayHasKey('paths', $spec);
        TestCase::assertArrayHasKey('components', $spec);
        TestCase::assertArrayHasKey('schemas', $spec['components']);
        TestCase::assertArrayHasKey('Resource', $spec['components']['schemas']);
        TestCase::assertSame($schema, $spec['components']['schemas']['Resource']);
    }
}