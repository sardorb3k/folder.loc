<?php

namespace App\Services;

use App\Models\Payments;
use App\Interfaces\PaymentsServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\GroupStudents;

class PaymentsService implements PaymentsServiceInterface
{
    /**
     * Payments Service indexService
     */

    public function getStudents(int $id, $date)
    {
        // dd($id, $date);
        $date_all = explode('-', $date);

        // dd($date_all);
        $count = DB::select(
            DB::raw("SELECT COUNT(*) AS count FROM payments WHERE MONTH (payment_start)=:date_month AND YEAR (payment_start)=:date_year AND group_id = :id"),
            [
                'date_month' => $date_all[1],
                'date_year' => $date_all[0],
                'id' => $id
            ]
        );

        if ($count[0]->count == 0) {
            $students = GroupStudents::join(
                'users',
                'group_students.student_id',
                '=',
                'users.id'
            )
                ->select(
                    'users.id',
                    'group_students.id as group_id',
                    'users.lastname',
                    'users.firstname',
                    'users.image',
                )
                ->where('group_id', $id)
                ->get();
            $status = false;
            $date_salary = false;
        } else {
            $date_m = $date_all[1] ?? NULL;
            $date_y = $date_all[0] ?? NULL;
            $students = DB::select(
                "SELECT us.id, us.firstname, us.lastname, us.image,
                    (
                    SELECT pay2.amount
                    FROM payments AS pay2
                    WHERE pay2.student_id=us.id AND pay2.group_id=$id AND MONTH (pay2.payment_start)=$date_m AND YEAR (pay2.payment_start)=$date_y
                    ) AS amount,
                    (
                    SELECT pay.payment_start
                    FROM payments AS pay
                    WHERE pay.student_id=us.id AND pay.group_id=gs.group_id AND MONTH (pay.payment_start)=$date_m AND YEAR (pay.payment_start)=$date_y
                    ) AS payment_start,
                    (
                    SELECT pay.payment_end
                    FROM payments AS pay
                    WHERE pay.student_id=us.id AND pay.group_id=gs.group_id AND MONTH (pay.payment_start)=$date_m AND YEAR (pay.payment_start)=$date_y
                    ) AS payment_end
                FROM group_students AS gs 
                LEFT JOIN users AS us ON us.id=gs.student_id
                WHERE gs.group_id=$id"
            );
            $status = true;
            $date_salary = DB::select(
                "SELECT payment_date FROM `payments`
                WHERE MONTH(payment_date) = $date_m and YEAR(payment_date) = $date_y LIMIT 1"
            );
        }
        return array("status" => $status, "students" => $students, "date_salary" => $date_salary[0]->payment_date ?? NULL);
    }
}
//
