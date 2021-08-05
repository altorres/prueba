<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Company;
use App\Employee;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Crea el rol administrador
        $role=Role::create(['name'=>'Admin']);

        //Se crean los permisos que directamen te se asignaran al administrador
        Permission::create(['name'=>'home'])->assignRole($role);

        Permission::create(['name'=>'company.index'])->assignRole($role);
        Permission::create(['name'=>'company.create'])->assignRole($role);
        Permission::create(['name'=>'company.show'])->assignRole($role);
        Permission::create(['name'=>'company.edit'])->assignRole($role);
        Permission::create(['name'=>'company.destroy'])->assignRole($role);

        Permission::create(['name'=>'employee.index'])->assignRole($role);
        Permission::create(['name'=>'employee.create'])->assignRole($role);
        Permission::create(['name'=>'employee.edit'])->assignRole($role);
        Permission::create(['name'=>'employee.destroy'])->assignRole($role);

        //se crea el usuario Admnistrador con su respectiva contraseña y se asigna el rol administrador
         User::create([
            'name' =>'admin',
            'email' => 'admin@admin.com',
            'password' =>Hash::make('contraseña')
        ])->assignRole('Admin');


        //factory(App\Company::class, 10)->create();
        //factory(App\Employee::class, 50)->create();






    }
}
