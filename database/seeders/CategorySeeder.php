<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categories = [
            [
                'name' => [
                    'ua' => 'екскурсія',
                    'en' => 'excursion',
                    'ru' => 'экскурсия',
                ],
            ],
            [
                'name' => [
                    'ua' => 'відпочинок',
                    'en' => 'vacation',
                    'ru' => 'отдых',
                ]
            ],
        ];

        foreach ($categories as $key => $value) {
            Category::create($value);
        }

        /*$translations = [
            'en' => 'Name in English',
            'nl' => 'Naam in het Nederlands'
        ];

        $newsItem = new Category(); // This is an Eloquent model
        $newsItem->setTranslation('name', $translations)
            ->save();

        Category::create($newsItem);*/

        /*Category::create([
            'name' => [
                'en' => 'Name in English',
                'nl' => 'Naam in het Nederlands'
            ],
        ]);*/
    }
}
