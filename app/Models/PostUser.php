<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 같은 사용자가 한번만 조회할 수 있도록 post_id랑 user_id를 가져와서 factory를 이용해 샘플을 만들도록 PostUser을 만들었다.  
class PostUser extends Model
{
    use HasFactory;

    protected $table='post_user'; // 모델에서 table 속성을 정의하여 테이블 이름을 직접 지정할 수 있다.
    public $timestamps = false; // 모델의 timestamps속성을 false로 지정하여 기본적으로 활성화되는 created_at와 updateed_at 타임스탬프 값을 사용하지 않을 수(비활성화) 있습니다. 

    public function post() {
        return $this->belongsTo(Post::class);  //1:n이므로 PostUser가 Post에 속한다.
    }
}
