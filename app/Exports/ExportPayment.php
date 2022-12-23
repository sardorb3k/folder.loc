<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;

class ExportPayment implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $form = DB::select("SELECT concat( YEAR(users.created_at), '-', MONTH(users.created_at),'-',DAY(users.created_at)) AS start_date, CONCAT( users.firstname, ' ', users.lastname ) AS fullname, ( SELECT CONCAT( group_level.name, ' ', groups.name ) AS NAME FROM `groups` LEFT JOIN group_level ON groups.level = group_level.id WHERE groups.id = payments.group_id ) AS group_name, payments.amount, payments.payment_start FROM `payments` LEFT JOIN users ON payments.student_id = users.id");
        return collect($form);
    }

    public function headings(): array
    {
        return
        [
            'Start Date',
            'Name',
            'Group',
            'Paid Amount',
            'Date',
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
