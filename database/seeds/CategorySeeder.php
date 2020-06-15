<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['ext_id' => 1, 'name' => 'Квартиры']);
        DB::table('categories')->insert(['ext_id' => 4, 'name' => 'Дома']);
        DB::table('categories')->insert(['ext_id' => 10, 'name' => 'Коммерческая']);
        DB::table('categories')->insert(['ext_id' => 13, 'name' => 'Офисы']);
        DB::table('categories')->insert(['ext_id' => 24, 'name' => 'Участки']);
        DB::table('categories')->insert(['ext_id' => 30, 'name' => 'Гаражи']);
    }
}
