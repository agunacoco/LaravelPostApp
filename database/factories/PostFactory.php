<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $users = null;
    protected $posts = null;

    public function __construct(){
        parent::__construct(); // 부모로부터 상속받는다고 명시해준다. 
        $this->users=User::all();
        $this->posts=Post::all();
    }

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class; // Post 모델의 속성을 정의한다.

    /**
     * Define the model's default state.
     *
     * @return array
     */
    // definition 메소드는 팩토리를 사용하여 모델을 만들 때 적용해야하는 기본 속성 값 집합을 반환.
    public function definition()
    {
        return [
            'title' => $this->faker->text(10), // faker 속성을 통해 팩토리는 샘플 테이트를 위한 다양한 종류의 랜덤 데이터를 편리하게 생성할 수 있다.
            'content' => $this->faker->sentence(), // faker의 언어설정을 바꾸고 싶으면 app.php의 "faker_locale"를 수정하면 된다.
            'user_id' => $this->users->random()->id, //users에서 랜덤으로 아이디를 가져온다.
            //'user_id' => User::factory()->create()->id, //여기서 직접 user를 만든다. 
        ];
    }
}
