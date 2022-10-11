<?php

namespace App\Services;

use App\Models\Salary;
use App\Interfaces\SalaryServiceInterface;
use App\Interfaces\GroupsServiceInterface;
use App\Models\Groups;
use Auth;
use Illuminate\Support\Facades\DB;

class SalaryService implements SalaryServiceInterface
{
    private $group;
    private $groups;
    public function __construct(GroupsServiceInterface $group, Groups $groups)
    {
        $this->group = $group;
        $this->groups = $groups;
    }
    public function getAllTeachersSalary()
    {
        return Salary::all();
    }
    public function getGroupById($date, $id)
    {
        return $this->groups
            ->leftJoin('users as ut', 'ut.id', '=', 'groups.teacher_id')
            ->leftJoin('users as ua', 'ua.id', '=', 'groups.assistant_id')
            ->select(DB::raw('CONCAT(ut.lastname," ", ut.firstname) AS teacher_id'), DB::raw('CONCAT(ua.lastname," ", ua.firstname) AS assistant_id'), 'groups.*')
            ->whereYear('groups.created_at', '<=', date('Y', strtotime($date)))
            ->whereMonth('groups.created_at', '<=', date('m', strtotime($date)))
            ->where('groups.teacher_id', $id)
            ->orWhere('groups.assistant_id', $id)
            ->latest('groups.created_at')
            ->get();
    }
    public function getStudent($id, $date, $teacher_id)
    {
        $date_all = explode('-', $date);
        $students = DB::select(
            DB::raw(
                "SELECT
                us.id,
                gp_s.group_id AS group_id,
                us.lastname,
                us.firstname,
                us.phone,
                us.image,
                us.birthday,
                (
                    SELECT COUNT(*) AS count
                    FROM attendance
                    WHERE student_id = us.id AND 
                        mark = 1 AND 
                        MONTH(attendance_date) = :mon AND 
                        YEAR(attendance_date) = :yo
                ) AS att_ap,
                (
                    SELECT amount
                    FROM payments
                    WHERE student_id = us.id AND 
                        group_id = gp_s.group_id AND
                        MONTH(payment_start) = :payM AND 
                        YEAR(payment_start) = :payY 
                ) AS payment,
                (   
                    SELECT amount
                    FROM salary_students
                    WHERE student_id = us.id AND 
                        group_id = gp_s.group_id AND 
                        MONTH(salarydate) = :amountM AND 
                        YEAR(salarydate) = :amountY and 
                        teacher_id = :teacher_id 
                ) AS amount,
                (
                    SELECT COUNT(*) AS count
                    FROM attendance
                    WHERE student_id = us.id AND 
                    mark = 0 and 
                    MONTH(attendance_date) = :mon2 AND 
                    YEAR(attendance_date) = :yo2
                ) AS att_attended
                
            FROM group_students AS gp_s
            LEFT JOIN users AS us ON us.id = gp_s.student_id
            WHERE group_id = :id AND 
            year(gp_s.created_at) <= :yo3 AND 
            month(gp_s.created_at) <= :mon3"
            ),
            [
                'id' => $id,
                'mon' => $date_all[1],
                'yo' => $date_all[0],
                'yo2' => $date_all[0],
                'mon2' => $date_all[1],
                'yo3' => $date_all[0],
                'mon3' => $date_all[1],
                'payM' => $date_all[1],
                'payY' => $date_all[0],
                'amountY' => $date_all[0],
                'amountM' => $date_all[1],
                'teacher_id' => $teacher_id
            ]
        );
        // dd($students);
        return $students;
    }


    // Teacher list for salary
    public function getTeacherList($date)
    {
        $date_all = explode('-', $date);
        $year = $date_all['0'];
        $month = $date_all['1'];
        $byTeacherQuery = Auth::user()->getRole() == 'teacher' || Auth::user()->getRole() == 'assistant' ? "AND usr.id = " . Auth::user()->id : "";
        $teacher = DB::select("SELECT DISTINCT
            usr.id,
            usr.firstname,
            usr.lastname,
            usr.role,
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
                or grs.assistant_id = usr.id
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
                grs.teacher_id = usr.id AND YEAR(sry_s.salarydate) = $year AND MONTH(sry_s.salarydate) = $month and sry_s.teacher_id = usr.id
        ) AS salary,
        (
            SELECT
                COALESCE(SUM(sry_s.amount), 0)
            FROM
                salary_students AS sry_s
            INNER JOIN groups AS grs
            ON
                grs.id = sry_s.group_id
            WHERE
                grs.assistant_id = usr.id AND YEAR(sry_s.salarydate) = $year AND MONTH(sry_s.salarydate) = $month and sry_s.teacher_id = usr.id
        ) AS salary_assistent,
        (
            SELECT
            	sry.salary
            FROM
            	salary as sry
            WHERE
            	sry.teacher_id = usr.id
            and YEAR(sry.salarydate) = $year
            and MONTH(sry.salarydate) = $month
            ) as salary_action
        FROM
            `users` AS usr
        WHERE
            (usr.role = 'teacher' OR usr.role = 'assistant')" . $byTeacherQuery);
        // dd($teacher);
        return $teacher;
    }
}
// by id from group stundents table.
// SELECT count(*) as count FROM `group_students` WHERE group_id = 3
