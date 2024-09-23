<?php

namespace Database\Seeders;

use App\Models\ServiceAssistantCategory;
use Illuminate\Database\Seeder;

class DefaultServiceAssistantCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [
            [
                'name' => 'Cas particulier',
            ],
            [
                'name' => 'Cas enfant',
            ],
            [
                'name' => 'Cas Adulte',
            ],
            [
                'name' => 'Gynecologists',
            ],
            [
                'name' => 'physiotherapy',
            ],
            [
                'name' => 'Psychologist',
            ],
        ];

        foreach ($input as $data) {
            ServiceAssistantCategory::create($data);
        }
    }
}
