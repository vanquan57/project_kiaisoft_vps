<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Province;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::all()->pluck('id')->toArray();
        $provinceId = Province::all()->pluck('id')->toArray();
        $districtId = District::all()->pluck('id')->toArray();
        $wardId = Ward::all()->pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($userId),
            'code' => Str::uuid(),
            'phone' => $this->faker->numerify('09#########'),
            'email' => $this->faker->unique()->safeEmail,
            'province_id' => $this->faker->randomElement($provinceId),
            'district_id' => $this->faker->randomElement($districtId),
            'ward_id' => $this->faker->randomElement($wardId),
            'address' => $this->faker->address,
            'status' => $this->faker->randomElement([1, 2, 3, 4]),
        ];
    }
}
