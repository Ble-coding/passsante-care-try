<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'manage_doctors',
                'display_name' => 'Manage Doctors',
            ],
            [
                'name' => 'manage_assistant',
                'display_name' => 'Manage Assistant',
            ], 
            [
                'name' => 'manage_patients',
                'display_name' => 'Manage Patients',
            ],
            [
                'name' => 'manage_appointments',
                'display_name' => 'Manage Appointments',
            ],
            [
                'name' => 'manage_assistant_appointments',
                'display_name' => 'Manage Assistant Appointments',
            ],
            [
                'name' => 'manage_patient_visits',
                'display_name' => 'Manage Patient Visits',
            ],
            [
                'name' => 'manage_staff',
                'display_name' => 'Manage Staff',
            ],
            [
                'name' => 'manage_doctor_sessions',
                'display_name' => 'Manage Doctor Sessions',
            ],
            [
                'name' => 'manage_assistant_sessions',
                'display_name' => 'Manage Assistant Sessions',
            ],
            [
                'name' => 'manage_settings',
                'display_name' => 'Manage Settings',
            ],
            [
                'name' => 'manage_services',
                'display_name' => 'Manage Services',
            ],
            [
                'name' => 'manage_specialities',
                'display_name' => 'Manage Specialities',
            ],
            [
                'name' => 'manage_countries',
                'display_name' => 'Manage Countries',
            ],
            [
                'name' => 'manage_states',
                'display_name' => 'Manage States',
            ],
            [
                'name' => 'manage_cities',
                'display_name' => 'Manage Cities',
            ],
            [
                'name' => 'manage_roles',
                'display_name' => 'Manage Roles',
            ],
            [
                'name' => 'manage_currencies',
                'display_name' => 'Manage Currencies',
            ],
            [
                'name' => 'manage_admin_dashboard',
                'display_name' => 'Manage Admin Dashboard',
            ],
            [
                'name' => 'manage_front_cms',
                'display_name' => 'Manage Front CMS',
            ],
            [
                'name' => 'manage_transactions',
                'display_name' => 'Manage Transactions',
            ],
            // Ajout de certains permission
           

            [
                'name' => 'manage_profils_sociaux_usagers',
                'display_name' => 'Manage Usagers',
            ],
            [
                'name' => 'manage_patient_assistance',
                'display_name' => 'Manage Patient Assistances',
            ],
            [
                'name' => 'manage_occupations',
                'display_name' => 'Manage Occupations',
            ], 
            [
                'name' => 'manage_historique',
                'display_name' => 'Manage Historique',
            ], 
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission); 
        }
    } 
}



