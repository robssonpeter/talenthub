<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class NewRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Moderator',
            ],
            [
                'name' => 'Recruiter',
            ]
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
