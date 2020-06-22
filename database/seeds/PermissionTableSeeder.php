<?php

use Illuminate\Database\Seeder;
use App\Permission;

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
                'description' => 'See only Listing Of Role'
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role'
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Role'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role'
            ],
            //Client CRUD
            [
                'name'=> 'client-create',
                'display_name'=>'Create Client',
                'description'=>'Create Client'
            ],[
                'name'=> 'client-list',
                'display_name'=>'Display Client',
                'description'=>'Display Client'
            ],[
                'name'=> 'client-edit',
                'display_name'=> 'Edit Client',
                'description'=> 'Edit Client'
            ],[
                'name'=> 'client-delete',
                'display_name'=> 'Delete Client',
                'description'=> 'Delete Client'
            ],
            //Vendor CRUD
            [
                'name'=> 'vendor-create',
                'display_name'=>'Create Vendor',
                'description'=> 'Create Vendor'
            ],[
                'name'=> 'vendor-list',
                'display_name'=> 'Display vendors',
                'description'=> 'Display vendors'
            ],[
                'name'=> 'vendor-edit',
                'display_name'=> 'Edit vendor',
                'description'=> 'Edit vendor'
            ],[
                'name'=> 'vendor-delete',
                'display_name'=> 'Delete Vendor',
                'description'=> 'Delete vendor'
            ],
            //invoice CRUD
            [
                'name'=> 'invoice-create',
                'display_name'=> 'Create invoice',
                'description'=> 'Create invoice'
            ],[
                'name'=> 'invoice-list',
                'display_name'=> 'display invoice',
                'description'=> 'Display invoice'
            ],[
                'name'=> 'invoice-edit',
                'display_name'=> 'Edit invoice',
                'description'=> 'Edit invoice'
            ],[
                'name'=> 'invoice-delete',
                'display_name'=> 'Delete invoice',
                'description'=> 'Delete invoice'
            ],
            //Payment CRUD
            [
                'name'=> 'payment-create',
                'display_name'=> 'Create Payment',
                'description'=> 'Create Payment'
            ],[
                'name'=> 'payment-list',
                'display_name'=> 'Display payment',
                'description'=> 'Display payment'
            ],[
                'name'=> 'payment-edit',
                'display_name'=> 'Edit Payment',
                'description'=> 'Edit Payment'
            ],[
                'name'=> 'payment-delete',
                'display_name'=> 'Delete payment',
                'description'=> 'Delete payment'
            ],
            //Quotation CRUD
            [
                'name'=> 'quotation-create',
                'display_name'=> 'Create quotation',
                'description'=> 'Create quotation'
            ],[
                'name'=> 'quotation-list',
                'display_name'=> 'Display quotation',
                'description'=> 'Display quotation'
            ],[
                'name'=> 'quotation-edit',
                'display_name'=> 'Edit quotation',
                'description'=> 'Edit quotation'
            ],[
                'name'=> 'quotation-delete',
                'display_name'=> 'Delete quotation',
                'description'=> 'Delete quotation'
            ],
            //Purchase CRUD
            [
                'name'=> 'purchase-create',
                'display_name'=> 'create purchase',
                'description'=> 'create purchase'
            ],[
                'name'=> 'purchase-list',
                'display_name'=> 'display purchases',
                'description'=> 'display purchases'
            ],[
                'name'=> 'purchase-edit',
                'display_name'=> 'Edit purchase',
                'description'=> 'Edit purchase'
            ],[
                'name'=> 'purchase-delete',
                'display_name'=> 'delete purchase',
                'description'=> 'delete purchase'
            ],
            //Product CRUD
            [
                'name'=> 'product-create',
                'display_name'=> 'create product',
                'description'=> 'create product'
            ],[
                'name'=> 'product-list',
                'display_name'=> 'display products',
                'description'=> 'display products'
            ],[
                'name'=> 'product-edit',
                'display_name'=> 'edit product',
                'description'=> 'edit product'
            ],[
                'name'=> 'product-delete',
                'display_name'=>'delete product',
                'description'=> 'delete product'
            ],
            //Employee CRUD
            [
                'name'=> 'employee-create',
                'display_name'=> 'create employee',
                'description'=> 'create employee'
            ],[
                'name'=> 'employee-list',
                'display_name'=> 'display employee',
                'description'=> 'display employee'
            ],[
                'name'=> 'employee-edit',
                'display_name'=> 'edit employee',
                'description'=> 'edit employee'
            ],[
                'name'=> 'employee-delete',
                'display_name'=> 'delete employee',
                'description'=> 'delete employee'
            ],
            //reimbursement CRUD
            [
                'name'=> 'reimbursement-create',
                'display_name'=>'create reimbursement',
                'description'=> 'create reimbursement'
            ],[
                'name'=> 'reimbursement-list',
                'display_name'=> 'display reimbursement',
                'description'=> 'display reimbursement'
            ],[
                'name'=> 'reimbursement-edit',
                'display_name'=> 'edit reimbursement',
                'description'=> 'edit reimbursement'
            ],[
                'name'=> 'reimbursement-delete',
                'display_name'=> 'delete reimbursement',
                'description'=> 'delete reimbursement'
            ],
            //attendance CRUD
            [
                'name'=> 'attendance-create',
                'display_name'=> 'create attendance',
                'description'=> 'create attendance'
            ],[
                'name'=> 'attendance-list',
                'display_name'=> 'display attendance',
                'description'=> 'display attendance'
            ],[
                'name'=> 'attendance-edit',
                'display_name'=> 'edit attendance',
                'description'=> 'edit attendance'
            ],[
                'name'=> 'attendance-delete',
                'display_name'=> 'delete attendance',
                'description'=> 'delete attendance'
            ],
            //employee termination CRUD
            [
                'name'=> 'termination-create',
                'display_name'=> 'create termination',
                'description'=> 'create termination',
            ],[
                'name'=> 'termination-list',
                'display_name'=> 'display termination',
                'description'=> 'display termination'
            ],[
                'name'=> 'termination-edit',
                'display_name'=> 'edit termination',
                'description'=> 'edit termination'
            ],[
                'name'=> 'termination-delete',
                'display_name'=> 'delete termination',
                'description'=> 'delete termination'
            ],
            //Department CRUD
            [
                'name' => 'department-list',
                'display_name' => 'Display Department List',
                'description' => 'See only listing of department'
            ],
            [
                'name'=>'department-edit',
                'display_name' => 'Edit department',
                'description' => 'Edit department'
            ],[
                'name'=>'department-create',
                'display_name'=>'Create Department',
                'description'=>'Create Department'
            ],[
                'name'=>'department-delete',
                'display_name'=>'Delete Department',
                'description'=>'Delete Department',
            ],
            //job title CRUD
            [
                'name'=> 'jobTitle-create',
                'display_name'=> 'create Job Title',
                'description'=> 'create job title'
            ],[
                'name'=> 'jobTitle-list',
                'display_name'=> 'display job titles',
                'description'=> 'display job title'
            ],[
                'name'=> 'jobTitle-edit',
                'display_name'=> 'edit job title',
                'description'=> 'edit job title'
            ],[
                'name'=> 'jobTitle-delete',
                'display_name'=> 'delete job title',
                'description'=> 'delete job title'
            ],
            //job categories CRUD
            [
                'name'=> 'jobCategory-create',
                'display_name'=> 'Create Job Category',
                'description'=> 'Create job category'
            ],[
                'name'=> 'jobCategory-list',
                'display_name'=> 'display job category',
                'description'=> 'display job category'
            ],[
                'name'=> 'jobCategory-edit',
                'display_name'=> 'edit job category',
                'description'=> 'edit job category'
            ],[
                'name'=> 'jobCategory-delete',
                'display_name'=> 'delete job category',
                'description'=> 'delete job category'
            ],
            //work shift
            [
                'name'=> 'workShift-create',
                'display_name'=> 'create work shift',
                'description'=> 'create work shift'
            ],[
                'name'=> 'workShift-list',
                'display_name'=> 'display work shift',
                'description'=> 'display work shift'
            ],[
                'name'=> 'workShift-edit',
                'display_name'=> 'edit work shift',
                'description'=> 'edit work shift'
            ],[
                'name'=> 'workShift-delete',
                'display_name'=> 'delete work shift',
                'description'=> 'delete work shift'
            ],
            //working days
            [
                'name'=> 'workingDays-create',
                'display_name'=> 'create working days',
                'description'=> 'create working days'
            ],[
                'name'=> 'workingDays-list',
                'display_name'=> 'display working days',
                'description'=> 'display working days'
            ],[
                'name'=> 'workingDays-edit',
                'display_name'=> 'edit working days',
                'description'=> 'edit working days'
            ],[
                'name'=> 'workingDays-delete',
                'display_name'=> 'delete working days',
                'description'=> 'delete working days'
            ],
            //holiday CRUD
            [
                'name'=> 'holiday-create',
                'display_name'=> 'create holiday',
                'description'=> 'create holiday'
            ],[
                'name'=> 'holiday-list',
                'display_name'=> 'display holidays',
                'description'=> 'display holidays',
            ],[
                'name'=> 'holiday-edit',
                'display_name'=> 'edit holiday',
                'description'=> 'edit holiday'
            ],[
                'name'=> 'holiday-delete',
                'display_name'=> 'delete holiday',
                'description'=> 'delete holiday'
            ],
            //leave type CRUD
            [
                'name'=> 'leaveType-create',
                'display_name'=> 'Create Leave Type',
                'description'=> 'Create Leave Type'
            ],[
                'name'=> 'leaveType-list',
                'display_name'=> 'display leave type',
                'description'=> 'display leave type'
            ],[
                'name'=> 'leaveType-edit',
                'display_name'=> 'Edit leave Type',
                'description'=> 'Edit leave type'
            ],[
                'name'=> 'leaveType-delete',
                'display_name'=> 'delete leave type',
                'description'=> 'delete leave type'
            ],
            //pay grades CRUD
            [
                'name'=> 'payGrade-create',
                'display_name'=> 'create pay grades',
                'description'=> 'create pay grades'
            ],[
                'name'=> 'payGrade-list',
                'display_name'=> 'display paygrades',
                'description'=> 'display paygrades'
            ],[
                'name'=> 'payGrade-edit',
                'display_name'=> 'edit paygrade',
                'description'=> 'edit paygrade'
            ],[
                'name'=> 'payGrade-delete',
                'display_name'=> 'delete paygrade',
                'description'=> 'delete paygrade'
            ],
            //salary component CRUD
            [
                'name'=> 'salaryComponent-create',
                'display_name'=> 'Create Salary Component',
                'description'=> 'Create Salary Component'
            ],[
                'name'=> 'salaryComponent-list',
                'display_name'=> 'display salary component',
                'description'=> 'display salary component'
            ],[
                'name'=> 'salaryComponent-edit',
                'display_name'=> 'Edit salary component',
                'description'=> 'Edit salary component'
            ],[
                'name'=> 'salaryComponent-delete',
                'display_name'=> 'delete salary component',
                'description'=> 'delete salary component'
            ],
            //employment status CRUD
            [
                'name'=> 'empStatus-create',
                'display_name'=> 'create employee status',
                'description'=> 'create employee status'
            ],[
                'name'=> 'empStatus-list',
                'display_name'=> 'display employee status',
                'description'=> 'display employee status'
            ],[
                'name'=> 'empStatus-edit',
                'display_name'=> 'edit employee status',
                'description'=> 'edit employee status'
            ],[
                'name'=> 'empStatus-delete',
                'display_name'=> 'delete employee status',
                'description'=> 'delete employee status'
            ],
            //tax CRUD
            [
                'name'=> 'tax-create',
                'display_name'=> 'create tax',
                'description'=> 'create tax'
            ],[
                'name'=> 'tax-list',
                'display_name'=> 'display tax',
                'description'=> 'display tax'
            ],[
                'name'=> 'tax-edit',
                'display_name'=> 'edit tax',
                'description'=> 'edit tax'
            ],[
                'name'=> 'tax-delete',
                'display_name'=> 'delete tax',
                'description'=> 'delete tax'
            ]
        ];

        foreach ($permission as $key => $value) {
            Permission::create($value);
        }
    }
}
