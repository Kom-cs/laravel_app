<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void //void means nothing
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) { //schemaでデータベースの構造を定義
            $table->increments('id'); //新しく作るたびに自動で増加する整数をidカラムに挿入
            $table->string('title'); //titleカラム
            $table->timestamps(); //created_atとupdated_atをテーブルに挿入
        });
    }

    /**
     * Reverse the migrations. 
     *
     * @return void
     */
    public function down() //up()の取り消し
    {
        Schema::dropIfExists('todos'); //すでに存在するテーブルを削除する際の処理
    }
}
