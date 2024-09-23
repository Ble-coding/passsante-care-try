<?php

namespace Database\Seeders;

use App\Models\Assistant;
use App\Models\ServiceAssistant;
use Illuminate\Database\Seeder;

class DefaultServicesAssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $input = [
            [
                'category_id' => '1',
                'name' => 'Diagnostics',
                'charges' => '500',
                'status' => ServiceAssistant::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Diagnostics.png'),
            ],
            [
                'category_id' => '2',
                'name' => 'Treatment',
                'charges' => '500',
                'status' => ServiceAssistant::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Treatment.png'),
            ],
            [
                'category_id' => '1',
                'name' => 'Surgery',
                'charges' => '500',
                'status' => ServiceAssistant::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Surgery.png'),
            ],
            [
                'category_id' => '4',
                'name' => 'Emergency',
                'charges' => '500',
                'status' => ServiceAssistant::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Emergency.png'),
            ],
            [
                'category_id' => '4',
                'name' => 'Vaccine',
                'charges' => '500',
                'status' => ServiceAssistant::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Vaccine.png'),
            ],
            [
                'category_id' => '1',
                'name' => 'Qualified Assistants',
                'charges' => '500',
                'status' => ServiceAssistant::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/qualified_doctors.png'),
            ],
        ];

        $assistant = Assistant::firstOrfail();

        foreach ($input as $data) {
            $image = $data['icon'];
            unset($data['icon']);
            $service = ServiceAssistant::create($data);
            $service->serviceAssistants()->sync($assistant->id);
        }
    }
}
