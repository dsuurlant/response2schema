<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema\Tests\Fixtures;

use Faker\Factory;

/**
 * Represents more complex data with fields that resemble OpenAPI specification attributes.
 */
final class OrderFixture implements Fixture
{
    public static function single(): array
    {
        $faker = Factory::create();

        return [
            'id' => $faker->uuid,
            'orderDate' => $faker->dateTime->format(DATE_ATOM),
            'userId' => $faker->uuid,
            'products' => [
                [
                    'id' => $faker->uuid,
                    'name' => $faker->sentence(3),
                    'price' => [
                        'basePrice' => $faker->numberBetween(10000, 999999),
                        'discount' => $faker->randomFloat(2, 0, 0.5),
                        'fee' => $faker->numberBetween(1000, 9999),
                        'currency' => $faker->currencyCode
                    ],
                    'quantity' => $faker->numberBetween(1, 10)
                ],
                [
                    'id' => $faker->uuid,
                    'name' => $faker->sentence(3),
                    'price' => [
                        'basePrice' => $faker->numberBetween(10000, 999999),
                        'discount' => $faker->randomFloat(2, 0, 0.5),
                        'fee' => $faker->numberBetween(1000, 9999),
                        'currency' => $faker->currencyCode
                    ],
                    'quantity' => $faker->numberBetween(1, 10)
                ]
            ],
            'metadata' => [
                'attributes' => [
                    'type' => $faker->word,
                    'object' => [
                        'type' => null
                    ],
                    'array' => [
                        [
                            'item' => $faker->slug,
                            'number' => $faker->randomDigitNotNull
                        ],
                        [
                            'item' => $faker->slug,
                            'number' => $faker->randomDigitNotNull
                        ],
                        [
                            'item' => $faker->slug,
                            'number' => $faker->randomDigitNotNull
                        ]
                    ],
                    'properties' => [
                        'boolean' => $faker->boolean
                    ]
                ],
                'empty' => []
            ]
        ];
    }

    public static function many(int $amount): array
    {
        $orders = [];
        for ($i = 0; $i < $amount; $i++) {
            $orders[] = self::single();
        }

        return $orders;
    }

}