<?php

namespace App\Exports;

use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return User::query();
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->dob,
            $user->marital_status,
            $user->country,
            $user->blood_group,
            $user->religious,
            $user->gender,
            $user->terminate_status,
            Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d/m/Y H:i:s'),
            Carbon::createFromFormat('Y-m-d H:i:s', $user->updated_at)->format('d/m/Y H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Dob',
            'Marital Status',
            'Country',
            'Blood Group',
            'Id number',
            'Religious',
            'Gender',
            'Terminate Status',
            'Created At',
            'Updated At'
        ];
    }
}
