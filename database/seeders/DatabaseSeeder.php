<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         // create permissions
         Permission::create(['name' => 'edit task']);
         Permission::create(['name' => 'delete task']);
         Permission::create(['name' => 'assign task']);
         Permission::create(['name' => 'list task']);
         Permission::create(['name' => 'show task']);
 
         // this can be done as separate statements

         $admin = Role::create(['name' => 'admin']);
         $admin->givePermissionTo(Permission::all());

         $user = Role::create(['name' => 'user']);
         $user->givePermissionTo('edit task');
         $user->givePermissionTo('show task');
         $user->givePermissionTo('list task'); 

    }
}
