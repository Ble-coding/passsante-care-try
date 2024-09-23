<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class DefaultAssignPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */




    public function run(): void 
    {
        $roles = Role::whereIn('name', ['patient', 'doctor', 'assistant'])->get(); //récupère les rôles avec les noms "patient" et "doctor" à partir de la base de données.
        $permissions = Permission::whereIn('name', ['manage_appointments', 'manage_patient_visits', 'manage_transactions'])->get(); //Cela récupère les permissions avec les noms spécifier
        foreach ($permissions as $permission) {
            foreach ($roles as $role) {
                $role->givePermissionTo($permission->id);
            }
        }


    

    }
}
