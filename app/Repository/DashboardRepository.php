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
        users.role = 'student'
    ORDER BY day  DESC");


        // $students = GroupItems::join('users', 'group_items.student_id', '=', 'users.id')->select("users.id", "group_items.id as group_id", "users.lastname", "users.firstname", "users.phone")->where('group_id', $group->id)->get();
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

        return view('dashboard.admin', compact('attendance_n', 'groups'));
    }

    // studentDashboard
    public function studentDashboard(): View
    {
        $user_id = Auth::user()->id;
        // return $user_id."Salom";


        // $students = GroupItems::join('users', 'group_items.student_id', '=', 'users.id')->select("users.id", "group_items.id as group_id", "users.lastname", "users.firstname", "users.phone")->where('group_id', $group->id)->get();
        $groups = DB::select(DB::raw("SELECT
        groups.name,
        groups.level,
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
    WHERE
        group_students.student_id = :user_id LIMIT 20;"), [
            'user_id' => $user_id
        ]);

        // Exam results
        $exams = DB::select(DB::raw("SELECT
        exam_results.result,
        exams.exam_type,
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
        groups.level
    FROM
        `payments`
    LEFT JOIN groups ON groups.id = payments.group_id
    WHERE
        payments.student_id = :user_id LIMIT 20"), [
            'user_id' => $user_id
        ]);
        return view('dashboard.student', compact('groups', 'exams', 'attendance', 'payments'));
    }
}

//
