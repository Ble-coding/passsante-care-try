<?php

namespace Database\Seeders;

use App\Models\ClinicScheduleAssistant;
use Illuminate\Database\Seeder;

class DefaultClinicSchedulesAssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinicScheduleExist = ClinicScheduleAssistant::first();

        if (! $clinicScheduleExist) {
            for ($i = 1; $i <= 8; $i++) {
                ClinicScheduleAssistant::create([
                    'day_of_week' => ($i == 8) ? 0 : $i,
                    'start_time' => '12:00 AM',
                    'end_time' => '11:45 PM',  
                ]);
            }
        }
    }
}
