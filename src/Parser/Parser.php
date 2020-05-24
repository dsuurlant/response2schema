<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema\Parser;

use cebe\openapi\spec\OpenApi;

interface Parser
{
    public static function parse(string $body): OpenApi;
}