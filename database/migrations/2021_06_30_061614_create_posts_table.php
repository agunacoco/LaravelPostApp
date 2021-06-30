<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //매개변수로 테이블 이름, 컬럼을 받는다. 
        //
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('content');
            $table->string('image')->nullable();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps(); //복수선언 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //rollback 명령어 사용시 실행.
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
