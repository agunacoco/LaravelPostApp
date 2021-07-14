<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

//팩토리는 database/factory 디렉토리에 생성.
//데이터베이스에 몇몇 샘플 레코드를 입력하는 것이 필요할 때 수동으로 입력하는 대신에 모델 패토리를 사용.
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class; // User 모델의 속성을 정의했다.

    /**
     * Define the model's default state.
     *
     * @return array
     */
    //definition 메소드는 팩토리를 사용하여 모델을 만들 때 적용해야하는 기본 속성 값 집합을 반환.
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
