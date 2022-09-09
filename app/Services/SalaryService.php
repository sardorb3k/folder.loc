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
    public function getGroupById($id) {
        return DB::select("SELECT gp.id, gp.name,
        (SELECT concat(us.lastname,' ',us.firstname) AS teacher_id FROM users AS us WHERE us.id = gp.teacher_id) AS teacher_id,
        (SELECT concat(us.lastname,' ',us.firstname) AS teacher_id FROM users AS us WHERE us.id = gp.assistant_id) AS assistant_id,
        gp.lessontime,gp.days,gp.level
        FROM
        groups AS gp
        WHERE
        gp.teacher_id = ? OR gp.assistant_id = ?", [$id, $id]);
    }
    public function getStudent($id, $date) {
        $date_all = explode('-', $date);
        $students = DB::select(
            DB::raw("SELECT 
            us.id, 
            gp_s.id AS group_id,
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
student_id = us.id AND group_id = gp_s.id) AS
           payment,
            (
           SELECT COUNT(*) AS count
           FROM attendance
           WHERE student_id = us.id AND mark = 0 and MONTH(attendance_date) = :mon2 AND YEAR(attendance_date) = :yo2) AS att_attended
           FROM 
           group_students AS gp_s
           LEFT JOIN users AS us ON us.id = gp_s.student_id
           WHERE 
           group_id = :id"), ['id' => $id, 'mon' => $date_all[1], 'yo' => $date_all[0], 'yo2' => $date_all[0], 'mon2' => $date_all[1]]);
    
        return $students;
    }
}
//