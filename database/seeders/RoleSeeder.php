<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'Admin']);
        $rh = Role::create(['name' => 'Recursos humanos']);
        $operacional = Role::create(['name' => 'Operaciones']);
        $contabilidad = Role::create(['name' => 'Contabilidad']);
        $direccion = Role::create(['name' => 'Direccion']);
        $sistemas = Role::create(['name' => 'Sistemas']);


        Permission::create(['name' => 'home'])->syncRoles([$admin, $rh, $operacional, $contabilidad, $direccion, $sistemas]);


        Permission::create(['name' => 'roles.index'])->syncRoles($admin);
        Permission::create(['name' => 'roles.create'])->syncRoles($admin);
        Permission::create(['name' => 'roles.edit'])->syncRoles($admin);
        Permission::create(['name' => 'roles.destroy'])->syncRoles($admin);

        Permission::create(['name' => 'permissions.index'])->syncRoles($admin);
        Permission::create(['name' => 'permissions.create'])->syncRoles($admin);
        Permission::create(['name' => 'permissions.edit'])->syncRoles($admin);
        Permission::create(['name' => 'permissions.destroy'])->syncRoles($admin);

        Permission::create(['name' => 'users.index'])->syncRoles($admin);
        Permission::create(['name' => 'users.create'])->syncRoles($admin);
        Permission::create(['name' => 'users.edit'])->syncRoles($admin);
        Permission::create(['name' => 'users.destroy'])->syncRoles($admin);

        Permission::create(['name' => 'employees.index'])->syncRoles([$admin, $rh, $direccion, $sistemas]);
        Permission::create(['name' => 'employees.create'])->syncRoles([$admin, $rh, $contabilidad,$direccion, $sistemas]);
        Permission::create(['name' => 'employees.edit'])->syncRoles([$admin, $rh, $contabilidad,$direccion, $sistemas]);
        Permission::create(['name' => 'employees.destroy'])->syncRoles([$admin, $sistemas]);

        Permission::create(['name' => 'incidences.index'])->syncRoles([$operacional,$admin, $rh, $contabilidad, $operacional,$sistemas]);
        Permission::create(['name' => 'incidences.create'])->syncRoles([$admin, $contabilidad,$rh, $operacional,$sistemas]);
        Permission::create(['name' => 'incidences.edit'])->syncRoles([$admin, $contabilidad,$rh, $sistemas]);
        Permission::create(['name' => 'incidences.destroy'])->syncRoles([$admin, $sistemas]);

        // Permission::create(['name' => 'weekly_incidences.index'])->syncRoles([$admin, $rh, $contabilidad,$sistemas]);
        // Permission::create(['name' => 'weekly_incidences.create'])->syncRoles([$admin, $rh, $contabilidad,$sistemas]);
        // Permission::create(['name' => 'weekly_incidences.update'])->syncRoles([$admin, $rh, $contabilidad,$sistemas]);
        // Permission::create(['name' => 'weekly_incidences.destroy'])->syncRoles([,$admin, $contabilidad,$sistemas]);
        
        Permission::create(['name' => 'payroll.index'])->syncRoles([$operacional,$admin, $rh, $contabilidad,$sistemas]);
        Permission::create(['name' => 'payroll.create'])->syncRoles([$admin, $contabilidad,$rh,$sistemas]);
        Permission::create(['name' => 'payroll.edit'])->syncRoles([$admin, $contabilidad ,$rh, $sistemas]);
        Permission::create(['name' => 'payroll.destroy'])->syncRoles([$admin,$sistemas]);

        Permission::create(['name' => 'reports.index'])->syncRoles([$operacional,$admin, $rh, $contabilidad,$sistemas]);
        Permission::create(['name' => 'reports.create'])->syncRoles([$admin, $contabilidad, $rh,$sistemas]);
        Permission::create(['name' => 'reports.edit'])->syncRoles([$admin, $contabilidad,$rh, $sistemas]);
        Permission::create(['name' => 'reports.destroy'])->syncRoles([$admin,$sistemas]);

        Permission::create(['name' => 'fortnightly_incidences.index'])->syncRoles([$operacional,$admin, $rh, $contabilidad,$sistemas]);
        Permission::create(['name' => 'fortnightly_incidences.create'])->syncRoles([$operacional,$admin, $rh, $contabilidad,$sistemas]);
        Permission::create(['name' => 'fortnightly_incidences.edit'])->syncRoles([$operacional,$admin, $rh, $contabilidad,$sistemas]);
        Permission::create(['name' => 'fortnightly_incidences.destroy'])->syncRoles([$operacional,$admin, $contabilidad,$sistemas]);



        $admin->givePermissionTo(Permission::all());

    }
}
