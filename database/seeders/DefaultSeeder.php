<?php

namespace Database\Seeders;

use App\Constants\PermissionConstant;
use App\Models\Default\Permission;
use App\Models\Default\Role;
use App\Models\Default\Setting;
use App\Models\Default\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['id' => Str::ulid(), 'key' => 'app_name', 'value' => 'PPDB - SMP N 1 Anjir Muara', 'type' => 'text'],
            ['id' => Str::ulid(), 'key' => 'app_logo', 'value' => '', 'type' => 'image'],
            ['id' => Str::ulid(), 'key' => 'school_address', 'value' => '', 'type' => 'text'],
            ['id' => Str::ulid(), 'key' => 'school_coordinate', 'value' => '-2.847033238005219|114.27978515625001', 'type' => 'text'],
            ['id' => Str::ulid(), 'key' => 'school_max_distance', 'value' => '25', 'type' => 'text'],
            ['id' => Str::ulid(), 'key' => 'page_registration_requirements', 'value' => '', 'text' => ''],
        ];

        Setting::insert($settings);

        foreach (PermissionConstant::LIST as $permission) {
            Permission::insert(['id' => Str::ulid(), ...$permission]);
        }

        $role = Role::create(['name' => 'admin']);

        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $role->rolePermissions()->create(['permission_id' => $permission->id]);
        }

        User::create([
            'name' => 'Super Administrator',
            'email' => 'root@admin.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Administator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role_id' => $role->id,
        ]);

        $guest = Role::create(['name' => Role::GUEST]);
        $permission = Permission::where('name', 'view-shortlink')->first();
        $guest->rolePermissions()->create(['permission_id' => $permission->id]);
    }
}
