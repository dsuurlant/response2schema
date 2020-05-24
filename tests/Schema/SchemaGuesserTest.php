<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema\Tests\Schema;

use DSuurlant\Response2Schema\Schema\SchemaGuesser;
use DSuurlant\Response2Schema\Tests\Fixtures\OrderFixture;
use DSuurlant\Response2Schema\Tests\Fixtures\UserFixture;
use PHPUnit\Framework\TestCase;

final class SchemaGuesserTest extends TestCase
{
    /** @test */
    public function it_should_correctly_guess_the_users_schema(): void
    {
        $fixture = UserFixture::many(10);
        $sut = SchemaGuesser::guess($fixture);

        $expected = [
            'type' => 'array',
            'items' => [
                'type' => 'object',
                'properties' => [
                    'id' => [
                        'type' => 'string'
                    ],
                    'name' => [
                        'type' => 'string'
                    ],
                    'email' => [
                        'type' => 'string'
                    ],
                    'phoneNumber' => [
                        'type' => 'string'
                    ],
                    'address' => [
                        'type' => 'object',
                        'properties' => [
                            'streetName' => [
                                'type' => 'string'
                            ],
                            'streetNumber' => [
                                'type' => 'integer'
                            ],
                            'streetSuffix' => [
                                'type' => 'string',
                                'nullable' => true
                            ],
                            'city' => [
                                'type' => 'string',
                            ],
                            'postcode' => [
                                'type' => 'string'
                            ],
                            'country' => [
                                'type' => 'string'
                            ],
                            'geo' => [
                                'type' => 'object',
                                'properties' => [
                                    'lat' => [
                                        'type' => 'number'
                                    ],
                                    'long' => [
                                        'type' => 'number'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'verified' => [
                        'type' => 'boolean'
                    ],
                    'createdOn' => [
                        'type' => 'string'
                    ],
                    'lastLogin' => [
                        'type' => 'string'
                    ],
                    'profile' => [
                        'type' => 'object',
                        'properties' => [
                            'displayName' => [
                                'type' => 'string'
                            ],
                            'avatar' => [
                                'type' => 'string'
                            ],
                            'website' => [
                                'type' => 'string'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        TestCase::assertSame($expected, $sut);
    }

    /** @test */
    public function it_should_correctly_guess_the_order_schema(): void
    {
        $fixture = OrderFixture::single();
        $sut = SchemaGuesser::guess($fixture);

        $expected = [
            'type' => 'object',
            'properties' => [
                'id' => [
                    'type' => 'string'
                ],
                'orderDate' => [
                    'type' => 'string'
                ],
                'userId' => [
                    'type' => 'string'
                ],
                'products' => [
                    'type' => 'array',
                    'items' => [
                        'type' => 'object',
                        'properties' => [
                            'id' => [
                                'type' => 'string'
                            ],
                            'name' => [
                                'type' => 'string'
                            ],
                            'price' => [
                                'type' => 'object',
                                'properties' => [
                                    'basePrice' => [
                                        'type' => 'integer'
                                    ],
                                    'discount' => [
                                        'type' => 'number'
                                    ],
                                    'fee' => [
                                        'type' => 'integer'
                                    ],
                                    'currency' => [
                                        'type' => 'string'
                                    ]
                                ]
                            ],
                            'quantity' => [
                                'type' => 'integer'
                            ]
                        ]
                    ]
                ],
                'metadata' => [
                    'type' => 'object',
                    'properties' => [
                        'attributes' => [
                            'type' => 'object',
                            'properties' => [
                                'type' => [
                                    'type' => 'string'
                                ],
                                'object' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'type' => [
                                            'type' => 'string',
                                            'nullable' => true
                                        ]
                                    ]
                                ],
                                'array' => [
                                    'type' => 'array',
                                    'items' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'item' => [
                                                'type' => 'string'
                                            ],
                                            'number' => [
                                                'type' => 'integer'
                                            ]
                                        ]
                                    ]
                                ],
                                'properties' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'boolean' => [
                                            'type' => 'boolean'
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        'empty' => [
                            'type' => 'array'
                        ]
                    ]
                ]
            ]
        ];

        TestCase::assertSame($expected, $sut);
    }
}