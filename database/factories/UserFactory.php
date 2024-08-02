<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

// use Faker\Generator as Faker;


// $factory->define(User::class, function (Faker $faker) {
//     return [
//         'name' => fake()->name,
//         'email' => fake()->unique()->safeEmail,
//         'email_verified_at' => now(),
//         'password' => bcrypt('password'), // password
//         'remember_token' => Str::random(10),
//         // 他のカラム
//     ];
// });

// factory->state(User::class, 'admin', function (Faker $faker) {
//     return [
//         'is_admin' => true,
//     ];
// });

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        
        $faker = FakerFactory::create();
        
        return [
            'name' => $faker->name(),
            'kana' => $faker->name(), // 'kanaName'メソッドは存在しないので、必要に応じてカスタムロジックが必要かもしれません
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'postal_code' => $faker->postcode(),
            'address' => $faker->address(),
            'phone_number' => $faker->phoneNumber(),
        ];
            }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }


}
