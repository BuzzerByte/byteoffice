<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TaxesTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(EmployeeStatusTableSeeder::class);
        $this->call(JobCategoryTableSeeder::class);
        $this->call(JobTitleTableSeeder::class);
        $this->call(WorkShiftTableSeeder::class);
        $this->call(LeaveTypeTableSeeder::class);
        $this->call(WorkingDaysTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
    }
}
