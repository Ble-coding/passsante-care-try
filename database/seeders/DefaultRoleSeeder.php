<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'clinic_admin',
                'display_name' => 'Clinic Admin',
                'is_default' => true,
            ],
            [
                'name' => 'doctor',
                'display_name' => 'Doctor',
                'is_default' => true,
            ],
            [
                'name' => 'patient',
                'display_name' => 'Patient',
                'is_default' => true,
            ],
            // Ajout du role assistant 
            [
                'name' => 'assistant',
                'display_name' => 'Assistant',
                'is_default' => true,
            ],
        ];

        foreach ($roles as $role) {
            $roleExist = Role::whereName($role)->exists();
            if (! $roleExist) {
                Role::create($role);
            }
        }

        /** @var Role $adminRole */
        $adminRole = Role::whereName('clinic_admin')->first(); //Cela récupère le rôle de type "clinic_admin".

        /** @var User $user */
        $user = User::whereEmail('admin@infycare.com')->first(); //Cela récupère l'utilisateur avec l'adresse e-mail "admin@infycare.com".


        //Cela récupère toutes les permissions et les organise dans un tableau associatif avec l'ID de la permission comme clé et le nom de la permission comme valeur.
        $allPermission = Permission::pluck('name', 'id');
        $adminRole->givePermissionTo($allPermission); //Cela donne toutes les permissions au rôle "clinic_admin".
        if ($user) {
            $user->assignRole($adminRole); //: Cela attribue le rôle "clinic_admin" à l'utilisateur "admin@infycare.com".
        } 
 
        // LES DOCTEURS 
        $doctorRole = Role::whereName('doctor')->first();
        $doctor = User::whereEmail('doctor@infycare.com')->first();
        if ($doctor) {
            $doctor->assignRole($doctorRole);
        }


        // LES PATIENTS 
        $patientRole = Role::whereName('patient')->first();
        $doctor = User::whereEmail('patient@infycare.com')->first();
        if ($doctor) {
            $doctor->assignRole($patientRole);
        }


        // LES ASSISTANTS 
        $assistantRole = Role::whereName('assistant')->first();
        $doctor = User::whereEmail('assistant@infycare.com')->first();
        if ($doctor) {
            $doctor->assignRole($assistantRole);
        }

    }
}


