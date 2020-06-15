<?php

use Illuminate\Database\Seeder;

class RealtyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Для Квартиры:
        DB::table('realty_types')->insert(['ext_id' => 2, 'category_ext_id' => 1, 'name' => 'Квартира']);
        DB::table('realty_types')->insert(['ext_id' => 3, 'category_ext_id' => 1, 'name' => 'Комнаты']);

        // Для ‘Дома’:
        DB::table('realty_types')->insert(['ext_id' => 5, 'category_ext_id' => 4, 'name' => 'Дом']);
        DB::table('realty_types')->insert(['ext_id' => 6, 'category_ext_id' => 4, 'name' => 'Часть']);
        DB::table('realty_types')->insert(['ext_id' => 7, 'category_ext_id' => 4, 'name' => 'Дачи']);

        // Для коммерческой недвижимости:
        DB::table('realty_types')->insert(['ext_id' => 14, 'category_ext_id' => 10, 'name' => 'Площади']);
        DB::table('realty_types')->insert(['ext_id' => 15, 'category_ext_id' => 10, 'name' => 'Склады']);
        DB::table('realty_types')->insert(['ext_id' => 16, 'category_ext_id' => 10, 'name' => 'Производство']);
        DB::table('realty_types')->insert(['ext_id' => 17, 'category_ext_id' => 10, 'name' => 'Рестораны']);
        DB::table('realty_types')->insert(['ext_id' => 18, 'category_ext_id' => 10, 'name' => 'Объект']);
        DB::table('realty_types')->insert(['ext_id' => 19, 'category_ext_id' => 10, 'name' => 'Отель']);
        DB::table('realty_types')->insert(['ext_id' => 20, 'category_ext_id' => 10, 'name' => 'Пансионаты']);
        DB::table('realty_types')->insert(['ext_id' => 21, 'category_ext_id' => 10, 'name' => 'Помещения свободного назначения']);
        DB::table('realty_types')->insert(['ext_id' => 22, 'category_ext_id' => 10, 'name' => 'Бизнес']);

        // Для офисов:
        DB::table('realty_types')->insert(['ext_id' => 11, 'category_ext_id' => 13, 'name' => 'Офисные помещения']);
        DB::table('realty_types')->insert(['ext_id' => 12, 'category_ext_id' => 13, 'name' => 'Офисные здания']);

        // Для участков:
        DB::table('realty_types')->insert(['ext_id' => 25, 'category_ext_id' => 24, 'name' => 'Под застройку']);
        DB::table('realty_types')->insert(['ext_id' => 26, 'category_ext_id' => 24, 'name' => 'Коммерческие']);
        DB::table('realty_types')->insert(['ext_id' => 27, 'category_ext_id' => 24, 'name' => 'Сельскохозяйственные']);
        DB::table('realty_types')->insert(['ext_id' => 28, 'category_ext_id' => 24, 'name' => 'Рекреационные']);
        DB::table('realty_types')->insert(['ext_id' => 29, 'category_ext_id' => 24, 'name' => 'Природные']);

        // Для гаражей:
        DB::table('realty_types')->insert(['ext_id' => 31, 'category_ext_id' => 30, 'name' => 'Бокс']);
        DB::table('realty_types')->insert(['ext_id' => 32, 'category_ext_id' => 30, 'name' => 'Паркинг']);
        DB::table('realty_types')->insert(['ext_id' => 33, 'category_ext_id' => 30, 'name' => 'Кооператив']);
        DB::table('realty_types')->insert(['ext_id' => 34, 'category_ext_id' => 30, 'name' => 'Гараж']);
        DB::table('realty_types')->insert(['ext_id' => 35, 'category_ext_id' => 30, 'name' => 'Стоянка']);
    }
}
