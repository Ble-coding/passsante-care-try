<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultAssistantHolidayPermissionSeeder extends Seeder
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

        $permission = [
            'name' => 'manage_assistants_holiday',
            'display_name' => 'Manage Assistants Holiday',
            'guard_name' => 'web',
        ];

        $holidayPermissionExist = Permission::where('name', 'manage_assistants_holiday')->exists();

        if (! $holidayPermissionExist) {
            $holidayPermission = Permission::create($permission);

            $adminRoles = User::role('clinic_admin')->get();
            foreach ($adminRoles as $adminRole) {
                if (! $adminRole->hasPermissionTo('manage_assistants_holiday')) {
                    $adminRole->givePermissionTo($holidayPermission);
                } 
            }

            $assistantRoles = User::role('assistant')->get();
            foreach ($assistantRoles as $assistantRole) {
                if (! $assistantRole->hasPermissionTo('manage_assistants_holiday')) {
                    $assistantRole->givePermissionTo($holidayPermission);
                }
            }
        }
    }
}
