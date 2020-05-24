<?php

declare(strict_types=1);

namespace DSuurlant\Response2Schema\Tests\Fixtures;

use Faker\Factory;

final class UserFixture implements Fixture
{
    public static function single(): array
    {
        $faker = Factory::create();

        return [
            'id' => $faker->uuid,
            'name' => $faker->name,
            'email' => $faker->safeEmail,
            'phoneNumber' => $faker->e164PhoneNumber,
            'address' => [
                'streetName' => $faker->streetName,
                'streetNumber' => (int) $faker->buildingNumber,
                'streetSuffix' => null,
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'country' => $faker->country,
                'geo' => [
                    'lat' => $faker->latitude,
                    'long' => $faker->longitude
                ]
            ],
            'verified' => $faker->boolean,
            'createdOn' => $faker->dateTime->format(DATE_ATOM),
            'lastLogin' => $faker->dateTime->format(DATE_ATOM),
            'profile' => [
                'displayName' => $faker->userName,
                'avatar' => $faker->imageUrl(200, 200, 'cats'),
                'website' => $faker->url,
            ]
        ];
    }

    public static function many(int $amount): array
    {
        $users = [];
        for ($i = 0; $i < $amount; $i++) {
            $users[] = self::single();
        }

        return $users;
    }

}