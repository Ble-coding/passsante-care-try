<?php

namespace Database\Seeders;

// use App\Models\Permission;
// use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
     
        
        // Récupérer le rôle "Assistant" ou le créer s'il n'existe pas encore
        $roleAssistant = Role::where('name', 'Assistant')->firstOrCreate(['name' => 'Assistant']);
        
        // Récupérer les autorisations à accorder au rôle "Assistant"
        $permissionsToAssign = [
            'manage_profils_sociaux_usagers',
            'manage_interventions',
            'manage_patient_assistance',
            'manage_occupations', 
            'manage_historique',

            'manage_assistant_sessions',
            'manage_appointments',
            'manage_assistant_appointments',
        ];
        
        // Accorder les autorisations au rôle "Assistant"
        foreach ($permissionsToAssign as $permissionName) {
            $permission = Permission::where('name', $permissionName)->first();
        
            if ($permission) {
                $roleAssistant->givePermissionTo($permission);
            }
        }
        

    }
}
