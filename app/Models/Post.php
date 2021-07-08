<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//모델은 하나의 레코드다. 
//명확히 정의된 models를 통해 쉽게 DB에 데이터 저장, 복원 작업 가능.
//데이터베이스 테이블에서 정보를 찾거나 저장할 때 쓰인다.
class Post extends Model
{
    //protected $table = 'my_posts'; 테이블 지정 
    use HasFactory;


    public function imagePath()
    {
        $path = env('IMAGE_PATH', '/storage/images/');
        $imageFile = $this->image ?? 'nono.jpg';
        return $path . $imageFile;
    }

    public function user()
    {
        return $this->belongsTo(User::class); // function으로 user를 부를 수 있다. 
    }
}
