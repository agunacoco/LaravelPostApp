<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Post;
use App\Models\PostUser;
use Illuminate\Database\Eloquent\Factories\Factory;

//모델을 정의하지 않으면 안된다. 그래서 정의할 모델이 있어서 factory를 사용할 수 있다. 
class PostUserFactory extends Factory
{
    protected $users = null;
    protected $posts = null;

    public function __construct(){
        parent::__construct();
        $this->users=User::all();
        $this->posts=Post::all();
    }

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostUser::class; // PostUser 모델의 속성을 정의한다. 

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //post_user테이블의 user_id, post_id 중복 해결.
        do{
        $userId = $this->users->random()->id;
        $postId = $this->posts->random()->id;
        $postUser = PostUser::where('user_id', $userId)->where('post_id', $postId);
        //user_id는 userId이고 post_id가 postId이다. 
        } while($postUser->count() != 0);
        //where절에서 PostUser에 user_id와 post_id를 가져왔을 때, 
        //postuser를 카운트했을때 0이면 바로 create하고 0이 아니면 다시 반복해서 0이 나오는 post_user 테이블에 저장되지 않은 user, post 아이디를 가져온다. 
        //create 생성은 tinker에서 하니깐 0이 아니면 다른 아이디를 가져온다.
        return [
            'user_id' => $userId,
            'post_id' => $postId,
        ];
    }
}
