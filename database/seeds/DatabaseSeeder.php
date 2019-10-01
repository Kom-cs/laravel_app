<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() //run()...内部で定義した処理を実行する。
    {
        // $this->call(UsersTableSeeder::class);
        $this ->call(TodosTableSeeder::class); //::class。。。。名前解決(処理対象のクラスをインスタンスと紐づけることが出来る処理)。call()はファイルの呼び出し。
    }
}
