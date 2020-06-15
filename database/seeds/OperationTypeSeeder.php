<?php

use Illuminate\Database\Seeder;

class OperationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operation_types')->insert(['ext_id' => 0, 'name' => 'Любая операция']);
        DB::table('operation_types')->insert(['ext_id' => 1, 'name' => 'Продажа']);
        DB::table('operation_types')->insert(['ext_id' => 3, 'name' => 'Долгострочная аренда']);
        DB::table('operation_types')->insert(['ext_id' => 4, 'name' => 'Посуточная аренда']);
    }
}
