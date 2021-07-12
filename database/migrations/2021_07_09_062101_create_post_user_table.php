<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  
            $table->unsignedBigInteger('post_id'); 
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->timestamp('created_at')->default(new Expression('now()'));   //timestamp 시간 - 업데이트 시간이랑 작성 시간을 만들어준다.
            $table->unique(['user_id', 'post_id']); // 중복 저장 안되게 해준다. 
        });
    }

    /**
     * Reverse the migrations.
     *s
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_user');
    }
}
 