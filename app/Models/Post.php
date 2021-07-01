<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//모델은 하나의 레코드다. 
class Post extends Model
{
    //protected $table = 'my_posts'; 테이블 지정 
    use HasFactory;
}
