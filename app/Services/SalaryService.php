<?php

namespace App\Services;

use App\Models\Salary;
use App\Interfaces\SalaryServiceInterface;
use App\Interfaces\GroupsServiceInterface;
use Illuminate\Support\Facades\DB;

class SalaryService implements SalaryServiceInterface
{
    private $group;
    public function __construct(GroupsServiceInterface $group)
    {
        $this->group = $group;
    }
    public function getAllTeachersSalary()
    {

        return Salary::all();
    }
    public function getGroupById($id)
    {
        return DB::select("SELECT gp.id, gp.name,
        (SELECT concat(us.lastname,' ',us.firstname) AS teacher_id FROM users AS us WHERE us.id = gp.teacher_id) AS teacher_id,
        (SELECT concat(us.lastname,' ',us.firstname) AS teacher_id FROM users AS us WHERE us.id = gp.assistant_id) AS assistant_id,
        gp.lessonstarttime,gp.days,gp.level
        FROM
        groups AS gp
        WHERE
        gp.teacher_id = ? OR gp.assistant_id = ?", [$id, $id]);
    }
    public function getStudent($id, $date)
    {
        $date_all = explode('-', $date);
        $students = DB::select(
            DB::raw("SELECT
            us.id,
            gp_s.group_id AS group_id,
            us.lastname,
            us.firstname,
            us.phone,
            us.birthday,
            (
           SELECT COUNT(*) AS count
           FROM attendance
           WHERE student_id = us.id AND mark = 1 AND MONTH(attendance_date) = :mon AND YEAR(attendance_date) = :yo) AS
           att_ap,
            (
                SELECT amount
FROM
payments
WHERE
student_id = us.id AND group_id = gp_s.group_id and MONTH(payment_start) = :payM AND YEAR(payment_start) = :payY ) AS
           payment,
            (
                SELECT amount
FROM
salary_students
WHERE
student_id = us.id AND group_id = gp_s.group_id and MONTH(salarydate) = :amountM AND YEAR(salarydate) = :amountY ) AS
    amount,

            (
           SELECT COUNT(*) AS count
           FROM attendance
           WHERE student_id = us.id AND mark = 0 and MONTH(attendance_date) = :mon2 AND YEAR(attendance_date) = :yo2) AS att_attended
           FROM
           group_students AS gp_s
           LEFT JOIN users AS us ON us.id = gp_s.student_id
           WHERE
           group_id = :id"),
            [
                'id' => $id,
                'mon' => $date_all[1],
                'yo' => $date_all[0],
                'yo2' => $date_all[0],
                'mon2' => $date_all[1],
                'payM' => $date_all[1],
                'payY' => $date_all[0],
                'amountY' => $date_all[0],
                'amountM' => $date_all[1],
                ]
        );
        // dd($students);
        return $students;
    }


    // Teacher list for salary
    public function getTeacherList($date)
    {
        $date_all = explode('-', $date);
        $teacher = DB::select(
            DB::raw("SELECT DISTINCT
            usr.id,
            usr.firstname,
            usr.lastname,
            (
            SELECT
                COUNT(grlist.id)
            FROM
                groups AS grlist
            WHERE
                grlist.teacher_id = usr.id
        ) AS group_count,
        (
            SELECT
                COUNT(gr_s.id)
            FROM
                group_students AS gr_s
            INNER JOIN groups AS grs
            ON
                grs.id = gr_s.group_id
            WHERE
                grs.teacher_id = usr.id
        ) AS students_count,
        (
            SELECT
                COALESCE(SUM(sry_s.amount), 0)
            FROM
                salary_students AS sry_s
            INNER JOIN groups AS grs
            ON
                grs.id = sry_s.group_id
            WHERE
                grs.teacher_id = usr.id AND YEAR(sry_s.salarydate) = :dateY AND MONTH(sry_s.salarydate) = :dateM
        ) AS salary
        FROM
            `users` AS usr
        WHERE
            usr.role = 'teacher' OR usr.role = 'assistant'"),[
                'dateY' => $date_all[0],
                'dateM' => $date_all[1],
            ]
        );
        return $teacher;
    }
}
// by id from group stundents table.
// SELECT count(*) as count FROM `group_students` WHERE group_id = 3
