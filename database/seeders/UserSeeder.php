<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Fadlie Ferdiyansah',
            'username' => 'Fadlie',
            'email' => 'fadlieferdiyansah26@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
        
        $role = Role::findByName('admin');

        $user->assignRole($role);

        $writer = User::create([
            'name' => 'Writer',
            'username' => 'Writer',
            'email' => 'writer@gmail.com',
            'password' => bcrypt('writer123'),
        ]);
        
        $role = Role::findByName('writer');

        $writer->assignRole($role);
    }
}
