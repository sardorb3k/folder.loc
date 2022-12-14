<?php

namespace App\Repository;

/**
 * Dashboard Repository
 */

use App\Interfaces\DashboardRepositoryInterface;
use App\Interfaces\AttendanceServiceInterface;
use App\Interfaces\GroupsServiceInterface;
use App\Interfaces\StudentsServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\View\View;
use App\Models\Student;
use App\Models\Exams;
use Auth;

class DashboardRepository implements DashboardRepositoryInterface
{
    private $attendance;
    private $studentService;
    private $attendanceService;
    public function __construct(AttendanceServiceInterface $attendanceService, GroupsServiceInterface $groupService, StudentsServiceInterface $studentService)
    {
        $this->attendanceService = $attendanceService;
        $this->groupService = $groupService;
        $this->studentService = $studentService;
    }
    // Teacher Dashboard
    public function teacherDashboard(): View
    {
        return view('dashboard.teacher');
    }
    /**
     * Attendance Repository indexRepository
     */
    public function adminDashboard(): View
    {
        $user_id = Auth::user();
        // return $user_id."Salom";
        $date_y = date('Y');
        $date_m = date('m');
        $date_d = date('d');
        $date_all = date('Y-m-d');
        $attendance_n = DB::select("SELECT
        CONCAT(firstname, ' ', lastname) AS fullname,
        (
        SELECT
            COUNT(*)
        FROM
            attendance
        WHERE
            attendance.mark = 0 AND attendance.student_id = users.id AND YEAR(attendance.attendance_date) = $date_y AND MONTH(attendance.attendance_date) = $date_m
    ) AS day
    FROM
        users
    WHERE
        users.status = 'active' AND
        users.role = 'student'
    ORDER BY day  DESC LIMIT 30");

        $student_hear = DB::select("SELECT coalesce(hear_about, 'Null') as title, count(*) as result FROM `users` where hear_about is not null  and hear_about != 'others-radio' GROUP BY hear_about");

        $audience_student_count = DB::select("SELECT count(*) as count FROM `users` where role = 'student' and status = 'active'");
        $audience_teacher_count = DB::select("SELECT count(*) as count FROM `users` where role = 'teacher' and status = 'active'");

        $audience_group_count = DB::select("SELECT count(*) as count FROM `groups`");
        // dd($date_all);
        $payments = DB::select("SELECT
                    DISTINCT users.id as userId,
                    CONCAT(
                        users.firstname,
                        ' ',
                        users.lastname
                    ) AS fullname,
                    pp.payment_end
                FROM
                    `payments` as pp
                LEFT JOIN users ON users.id = pp.student_id
                WHERE
                    #pp.payment_end >= $date_all and
                    users.status = 'active' and
                    pp.payment_end = (select max(p.payment_end) from payments as p where users.id = p.student_id)
                ORDER BY
                    pp.payment_end ASC
                LIMIT 30;");

        $groups = DB::select(
            DB::raw("select student_id, g.name,
        concat(uo.lastname, ' ', uo.firstname) as assistant,
        concat(ut.lastname, ' ', ut.firstname) as teacher
        from group_items
            inner join groups g on group_items.group_id = g.id
            inner JOIN users as uo ON g.teacher_id = uo.id
            LEFT JOIN users as ut ON g.assistant_id = ut.id
        where student_id = :user_id;"),
            [
                'user_id' => $user_id
            ]
        );
        $groups = DB::select("SELECT
                    DISTINCT users.id as userId,
                    CONCAT(
                        users.firstname,
                        ' ',
                        users.lastname
                    ) AS fullname,
                    pp.payment_end
                FROM
                    `payments` as pp
                LEFT JOIN users ON users.id = pp.student_id
                WHERE
                    #pp.payment_end >= $date_all and
                    users.status = 'active' and
                    pp.payment_end = (select max(p.payment_end) from payments as p where users.id = p.student_id)
                ORDER BY
                    pp.payment_end ASC
                LIMIT 30;");
        $birthdays = DB::select("SELECT * FROM `users` WHERE MONTH(birthday) = Month(now()) and DAY(birthday) >= DAY(now()) ORDER BY DAY(`users`.`birthday`) ASC LIMIT 5");
        $tasks = DB::select("SELECT *, CONCAT( DAY(deadline), ' ', CAST( MONTHNAME(deadline) AS CHAR(3) ) ) AS 'deadline_name', time(deadline) as deadline_time FROM `task` WHERE MONTH(`deadline`) = MONTH(NOW()) AND DAY(`deadline`) >= DAY(NOW()) AND users REGEXP 2 ORDER BY DAY(`deadline`) ASC");
        $amount = collect(\DB::select("SELECT SUM(amount) as amount, ( ROUND( ( SUM(amount) -( SELECT SUM(amount) FROM `payments` WHERE YEAR(`payment_date`) = 2022 AND MONTH(`payment_date`) = 12 ) ) /( SELECT SUM(amount) FROM `payments` WHERE YEAR(`payment_date`) = 2022 AND MONTH(`payment_date`) = 12 ) * 100 ) ) AS pres FROM `payments` WHERE YEAR(`payment_date`) = 2023 AND MONTH(`payment_date`) = 1"))->first();
        $user = collect(\DB::select("SELECT count(id) as count, ( ROUND( ( count(id) -( SELECT count(id) FROM `users` WHERE YEAR(`created_at`) = 2022 AND MONTH(`created_at`) = 12 ) ) /( SELECT count(id) FROM `users` WHERE YEAR(`created_at`) = 2022 AND MONTH(`created_at`) = 12 ) * 100 ) ) AS pres FROM `users` WHERE YEAR(`created_at`) = 2023 AND MONTH(`created_at`) = 1 and `status` = 'active'"))->first();

        // $audience = DB::select("SELECT CAST( MONTHNAME(created_at) AS CHAR(3) ) AS 'month', COUNT(*) FROM users WHERE created_at BETWEEN '2022/01/01' AND '2023/12/31' GROUP BY MONTH(created_at)");
        // dd($amount->amount);
        return view('dashboard.admin', compact('attendance_n', 'groups', 'student_hear', 'audience_student_count', 'audience_teacher_count', 'audience_group_count', 'payments', 'birthdays', 'tasks', 'amount', 'user'));
    }

    // studentDashboard
    public function studentDashboard(): View
    {
        $user_id = Auth::user()->id;
        // return $user_id."Salom";


        // $students = GroupItems::join('users', 'group_items.student_id', '=', 'users.id')->select("users.id", "group_items.id as group_id", "users.lastname", "users.firstname", "users.phone")->where('group_id', $group->id)->get();
        $groups = DB::select(DB::raw("SELECT
        groups.name,
        gl.name as level,
        groups.lessonstarttime,
        groups.lessonendtime,
        groups.days,
        (
        SELECT
            CONCAT(
                users.firstname,
                ' ',
                users.lastname
            )
        FROM
            users
        WHERE
            groups.teacher_id = users.id
    ) AS teacher_fullname,
    (
        SELECT
            CONCAT(
                users.firstname,
                ' ',
                users.lastname
            )
        FROM
            users
        WHERE
            groups.assistant_id = users.id
    ) AS assistant_fullname
    FROM
        `group_students`
    LEFT JOIN groups ON groups.id = group_students.group_id
    LEFT JOIN group_level as gl ON gl.id = groups.level
    WHERE
        group_students.student_id = :user_id LIMIT 20;"), [
            'user_id' => $user_id
        ]);

        // Exam results
        $exams = DB::select(DB::raw("SELECT
        exams.id,
        exam_results.result,
        exams.exam_type,
        exams.level,
        (
            SELECT
                groups.name
            FROM
                groups
            WHERE
                groups.id = exams.group_id
        ) AS group_name,
        (
            SELECT
                groups.level
            FROM
                groups
            WHERE
                groups.id = exams.group_id
        ) AS group_level
        FROM
            `exam_results`
        LEFT JOIN exams ON exam_results.exam_id = exams.id
        WHERE
        exam_results.student_id = :user_id LIMIT 20"), [
            'user_id' => $user_id
        ]);

        $attendance = app(StudentsServiceInterface::class)->getStudentByAttendance($user_id);

        // Payments
        $payments = DB::select(DB::raw("SELECT
        payments.amount,
        payments.payment_date,
        groups.name,
        (
            SELECT group_level.name
            FROM group_level
            WHERE group_level.id = groups.level
        ) as group_level
        FROM
            `payments`
        LEFT JOIN groups ON groups.id = payments.group_id
        WHERE
        payments.student_id = :user_id LIMIT 20"), [
            'user_id' => $user_id
        ]);
        // dd($attendance);
        return view('dashboard.student', compact('groups', 'exams', 'attendance', 'payments'));
    }
}

//
