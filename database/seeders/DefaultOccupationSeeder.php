<?php

namespace Database\Seeders;

use App\Models\Occupation;
use Illuminate\Database\Seeder;

class DefaultOccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [
            [
                'name' => 'Agent de control',
            ],
            [
                'name' => 'Membre du bureau',
            ],
            [
                'name' => 'Sécrétaire',
            ],
            [
                'name' => 'Surveillant',
            ],
        ];

        foreach ($input as $data) {
            Occupation::create($data);
        }
    }
}
