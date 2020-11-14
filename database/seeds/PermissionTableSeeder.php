<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permission = [
            //Role CRUD
            [
                'name' => 'role-list',
                'display_name' => 'Display Role Listing',
                'description' => 'See only Listing Of Role',
                'user_id' => User::all()->random()->id
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role'
            ,
            'user_id' => User::all()->random()->id
],
            [
                'name' => 'role-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Role'
            ,
            'user_id' => User::all()->random()->id
],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role'
            ,
            'user_id' => User::all()->random()->id
],
            //Client CRUD
            [
                'name'=> 'client-create',
                'display_name'=>'Create Client',
                'description'=>'Create Client'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'client-list',
                'display_name'=>'Display Client',
                'description'=>'Display Client'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'client-edit',
                'display_name'=> 'Edit Client',
                'description'=> 'Edit Client'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'client-delete',
                'display_name'=> 'Delete Client',
                'description'=> 'Delete Client'
            ,
            'user_id' => User::all()->random()->id
],
            //Vendor CRUD
            [
                'name'=> 'vendor-create',
                'display_name'=>'Create Vendor',
                'description'=> 'Create Vendor'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'vendor-list',
                'display_name'=> 'Display vendors',
                'description'=> 'Display vendors'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'vendor-edit',
                'display_name'=> 'Edit vendor',
                'description'=> 'Edit vendor'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'vendor-delete',
                'display_name'=> 'Delete Vendor',
                'description'=> 'Delete vendor'
            ,
            'user_id' => User::all()->random()->id
],
            //invoice CRUD
            [
                'name'=> 'invoice-create',
                'display_name'=> 'Create invoice',
                'description'=> 'Create invoice'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'invoice-list',
                'display_name'=> 'display invoice',
                'description'=> 'Display invoice'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'invoice-edit',
                'display_name'=> 'Edit invoice',
                'description'=> 'Edit invoice'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'invoice-delete',
                'display_name'=> 'Delete invoice',
                'description'=> 'Delete invoice'
            ,
            'user_id' => User::all()->random()->id
],
            //Payment CRUD
            [
                'name'=> 'payment-create',
                'display_name'=> 'Create Payment',
                'description'=> 'Create Payment'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'payment-list',
                'display_name'=> 'Display payment',
                'description'=> 'Display payment'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'payment-edit',
                'display_name'=> 'Edit Payment',
                'description'=> 'Edit Payment'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'payment-delete',
                'display_name'=> 'Delete payment',
                'description'=> 'Delete payment'
            ,
            'user_id' => User::all()->random()->id
],
            //Quotation CRUD
            [
                'name'=> 'quotation-create',
                'display_name'=> 'Create quotation',
                'description'=> 'Create quotation'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'quotation-list',
                'display_name'=> 'Display quotation',
                'description'=> 'Display quotation'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'quotation-edit',
                'display_name'=> 'Edit quotation',
                'description'=> 'Edit quotation'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'quotation-delete',
                'display_name'=> 'Delete quotation',
                'description'=> 'Delete quotation'
            ,
            'user_id' => User::all()->random()->id
],
            //Purchase CRUD
            [
                'name'=> 'purchase-create',
                'display_name'=> 'create purchase',
                'description'=> 'create purchase'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'purchase-list',
                'display_name'=> 'display purchases',
                'description'=> 'display purchases'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'purchase-edit',
                'display_name'=> 'Edit purchase',
                'description'=> 'Edit purchase'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'purchase-delete',
                'display_name'=> 'delete purchase',
                'description'=> 'delete purchase'
            ,
            'user_id' => User::all()->random()->id
],
            //Product CRUD
            [
                'name'=> 'product-create',
                'display_name'=> 'create product',
                'description'=> 'create product'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'product-list',
                'display_name'=> 'display products',
                'description'=> 'display products'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'product-edit',
                'display_name'=> 'edit product',
                'description'=> 'edit product'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'product-delete',
                'display_name'=>'delete product',
                'description'=> 'delete product'
            ,
            'user_id' => User::all()->random()->id
],
            //Employee CRUD
            [
                'name'=> 'employee-create',
                'display_name'=> 'create employee',
                'description'=> 'create employee'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'employee-list',
                'display_name'=> 'display employee',
                'description'=> 'display employee'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'employee-edit',
                'display_name'=> 'edit employee',
                'description'=> 'edit employee'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'employee-delete',
                'display_name'=> 'delete employee',
                'description'=> 'delete employee'
            ,
            'user_id' => User::all()->random()->id
],
            //reimbursement CRUD
            [
                'name'=> 'reimbursement-create',
                'display_name'=>'create reimbursement',
                'description'=> 'create reimbursement'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'reimbursement-list',
                'display_name'=> 'display reimbursement',
                'description'=> 'display reimbursement'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'reimbursement-edit',
                'display_name'=> 'edit reimbursement',
                'description'=> 'edit reimbursement'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'reimbursement-delete',
                'display_name'=> 'delete reimbursement',
                'description'=> 'delete reimbursement'
            ,
            'user_id' => User::all()->random()->id
],
            //attendance CRUD
            [
                'name'=> 'attendance-create',
                'display_name'=> 'create attendance',
                'description'=> 'create attendance'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'attendance-list',
                'display_name'=> 'display attendance',
                'description'=> 'display attendance'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'attendance-edit',
                'display_name'=> 'edit attendance',
                'description'=> 'edit attendance'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'attendance-delete',
                'display_name'=> 'delete attendance',
                'description'=> 'delete attendance'
            ,
            'user_id' => User::all()->random()->id
],
            //employee termination CRUD
            [
                'name'=> 'termination-create',
                'display_name'=> 'create termination',
                'description'=> 'create termination'
                ,
                'user_id' => User::all()->random()->id
],[
                'name'=> 'termination-list',
                'display_name'=> 'display termination',
                'description'=> 'display termination'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'termination-edit',
                'display_name'=> 'edit termination',
                'description'=> 'edit termination'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'termination-delete',
                'display_name'=> 'delete termination',
                'description'=> 'delete termination'
            ,
            'user_id' => User::all()->random()->id
],
            //Department CRUD
            [
                'name' => 'department-list',
                'display_name' => 'Display Department List',
                'description' => 'See only listing of department'
            ,
            'user_id' => User::all()->random()->id
],
            [
                'name'=>'department-edit',
                'display_name' => 'Edit department',
                'description' => 'Edit department'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=>'department-create',
                'display_name'=>'Create Department',
                'description'=>'Create Department'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=>'department-delete',
                'display_name'=>'Delete Department',
                'description'=>'Delete Department',
            'user_id' => User::all()->random()->id
],
            //job title CRUD
            [
                'name'=> 'jobTitle-create',
                'display_name'=> 'create Job Title',
                'description'=> 'create job title'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'jobTitle-list',
                'display_name'=> 'display job titles',
                'description'=> 'display job title'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'jobTitle-edit',
                'display_name'=> 'edit job title',
                'description'=> 'edit job title'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'jobTitle-delete',
                'display_name'=> 'delete job title',
                'description'=> 'delete job title'
            ,
            'user_id' => User::all()->random()->id
],
            //job categories CRUD
            [
                'name'=> 'jobCategory-create',
                'display_name'=> 'Create Job Category',
                'description'=> 'Create job category'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'jobCategory-list',
                'display_name'=> 'display job category',
                'description'=> 'display job category'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'jobCategory-edit',
                'display_name'=> 'edit job category',
                'description'=> 'edit job category'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'jobCategory-delete',
                'display_name'=> 'delete job category',
                'description'=> 'delete job category'
            ,
            'user_id' => User::all()->random()->id
],
            //work shift
            [
                'name'=> 'workShift-create',
                'display_name'=> 'create work shift',
                'description'=> 'create work shift'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'workShift-list',
                'display_name'=> 'display work shift',
                'description'=> 'display work shift'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'workShift-edit',
                'display_name'=> 'edit work shift',
                'description'=> 'edit work shift'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'workShift-delete',
                'display_name'=> 'delete work shift',
                'description'=> 'delete work shift'
            ,
            'user_id' => User::all()->random()->id
],
            //working days
            [
                'name'=> 'workingDays-create',
                'display_name'=> 'create working days',
                'description'=> 'create working days'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'workingDays-list',
                'display_name'=> 'display working days',
                'description'=> 'display working days'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'workingDays-edit',
                'display_name'=> 'edit working days',
                'description'=> 'edit working days'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'workingDays-delete',
                'display_name'=> 'delete working days',
                'description'=> 'delete working days'
            ,
            'user_id' => User::all()->random()->id
],
            //holiday CRUD
            [
                'name'=> 'holiday-create',
                'display_name'=> 'create holiday',
                'description'=> 'create holiday'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'holiday-list',
                'display_name'=> 'display holidays',
                'description'=> 'display holidays',
            'user_id' => User::all()->random()->id
],[
                'name'=> 'holiday-edit',
                'display_name'=> 'edit holiday',
                'description'=> 'edit holiday'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'holiday-delete',
                'display_name'=> 'delete holiday',
                'description'=> 'delete holiday'
            ,
            'user_id' => User::all()->random()->id
],
            //leave type CRUD
            [
                'name'=> 'leaveType-create',
                'display_name'=> 'Create Leave Type',
                'description'=> 'Create Leave Type'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'leaveType-list',
                'display_name'=> 'display leave type',
                'description'=> 'display leave type'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'leaveType-edit',
                'display_name'=> 'Edit leave Type',
                'description'=> 'Edit leave type'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'leaveType-delete',
                'display_name'=> 'delete leave type',
                'description'=> 'delete leave type'
            ,
            'user_id' => User::all()->random()->id
],
            //pay grades CRUD
            [
                'name'=> 'payGrade-create',
                'display_name'=> 'create pay grades',
                'description'=> 'create pay grades'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'payGrade-list',
                'display_name'=> 'display paygrades',
                'description'=> 'display paygrades'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'payGrade-edit',
                'display_name'=> 'edit paygrade',
                'description'=> 'edit paygrade'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'payGrade-delete',
                'display_name'=> 'delete paygrade',
                'description'=> 'delete paygrade'
            ,
            'user_id' => User::all()->random()->id
],
            //salary component CRUD
            [
                'name'=> 'salaryComponent-create',
                'display_name'=> 'Create Salary Component',
                'description'=> 'Create Salary Component'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'salaryComponent-list',
                'display_name'=> 'display salary component',
                'description'=> 'display salary component'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'salaryComponent-edit',
                'display_name'=> 'Edit salary component',
                'description'=> 'Edit salary component'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'salaryComponent-delete',
                'display_name'=> 'delete salary component',
                'description'=> 'delete salary component'
            ,
            'user_id' => User::all()->random()->id
],
            //employment status CRUD
            [
                'name'=> 'empStatus-create',
                'display_name'=> 'create employee status',
                'description'=> 'create employee status'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'empStatus-list',
                'display_name'=> 'display employee status',
                'description'=> 'display employee status'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'empStatus-edit',
                'display_name'=> 'edit employee status',
                'description'=> 'edit employee status'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'empStatus-delete',
                'display_name'=> 'delete employee status',
                'description'=> 'delete employee status'
            ,
            'user_id' => User::all()->random()->id
],
            //tax CRUD
            [
                'name'=> 'tax-create',
                'display_name'=> 'create tax',
                'description'=> 'create tax'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'tax-list',
                'display_name'=> 'display tax',
                'description'=> 'display tax'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'tax-edit',
                'display_name'=> 'edit tax',
                'description'=> 'edit tax'
            ,
            'user_id' => User::all()->random()->id
],[
                'name'=> 'tax-delete',
                'display_name'=> 'delete tax',
                'description'=> 'delete tax',
                'user_id' => User::all()->random()->id
            ]
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}