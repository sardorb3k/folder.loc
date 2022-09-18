<?php

namespace App\Repository;

/**
 * Dashboard Repository
 */

use App\Interfaces\DashboardRepositoryInterface;
use App\Interfaces\AttendanceServiceInterface;
use App\Interfaces\GroupsServiceInterface;
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
    private $attendanceService;
    public function __construct(AttendanceServiceInterface $attendanceService, GroupsServiceInterface $groupService)
    {
        $this->attendanceService = $attendanceService;
        $this->groupService = $groupService;
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
        $user_id = Auth::user();
        // return $user_id."Salom";


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

        return view('dashboard.student', compact('groups'));
    }

    // teacherDashboard
    public function teacherDashboard(): View
    {
        return view('dashboard.teacher');
    }
}

//
