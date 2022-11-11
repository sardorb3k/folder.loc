<?php

namespace App\Services;

/**
 * Attendance Service Interface
 */

use App\Models\Attendance;
use App\Models\Exams;
use App\Models\Students;
use App\Models\GroupStudents;
use App\Interfaces\AttendanceServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;

class AttendanceService implements AttendanceServiceInterface
{
    private $attendance;
    private $groups;
    public function __construct(Attendance $attendance, Groups $groups)
    {
        $this->attendance = $attendance;
        $this->groups = $groups;
    }
    /**
     * Attendance Service indexService
     */
    public function getStudents(int $id, $date)
    {
        $count = DB::select(
            DB::raw("SELECT COUNT(*) as count FROM attendance WHERE group_id=:id AND attendance_date=:attendance_date"),
            ['attendance_date' => $date, 'id' => $id]
        );
        $date_all = explode('-', $date);

        if ($count[0]->count == 0) {
            $students = DB::select("SELECT
                        us.id,
                        us.firstname,
                        us.lastname,
                        us.image,
                        (
                        SELECT
                            COUNT(*)
                        FROM
                            attendance
                        WHERE
                            student_id = us.id AND group_id = $id AND mark = 1 AND YEAR(attendance_date) = '$date_all[0]' AND MONTH(attendance_date) = '$date_all[1]'
                    ) AS attendance_a,
                    (
                        SELECT
                            COUNT(*)
                        FROM
                            attendance
                        WHERE
                            student_id = us.id AND group_id = $id AND mark = 0 AND YEAR(attendance_date) = '$date_all[0]' AND MONTH(attendance_date) = '$date_all[1]'
                    ) AS attendance_n,
                    'as' AS mark
                    FROM
                        group_students AS gs
                    LEFT JOIN users AS us
                    ON
                        us.id = gs.student_id
                    WHERE
                        gs.group_id = $id AND us.status = 'active'");
            $status = false;
        } else {
            $students = DB::select("SELECT
                us.id,
                us.firstname,
                us.lastname,
                us.image,
                (
                    SELECT
                        COUNT(*)
                    FROM
                        attendance
                    WHERE
                        student_id = us.id AND group_id = $id AND mark = 1 AND YEAR(attendance_date) = '$date_all[0]' AND MONTH(attendance_date) = '$date_all[1]'
                ) AS attendance_a,
                (
                    SELECT
                        COUNT(*)
                    FROM
                        attendance
                    WHERE
                        student_id = us.id AND group_id = $id AND mark = 0 AND YEAR(attendance_date) = '$date_all[0]' AND MONTH(attendance_date) = '$date_all[1]'
                ) AS attendance_n,
                (
                    SELECT
                        mark
                    FROM
                        attendance
                    WHERE
                        student_id = us.id AND attendance_date = '$date' AND group_id = $id
                ) AS mark
                FROM
                    group_students AS gs
                LEFT JOIN users AS us
                ON
                    us.id = gs.student_id
                WHERE
                    gs.group_id = $id AND us.status = 'active'");
            $status = true;
        }
        return array("status" => $status, "students" => $students);
    }
    /**
     * Store Attendance
     */
    public function storeAttendance(Request $request)
    {
        if (isset($request->attendance)) {
            foreach ($request->attendance as $key => $value) {
                $attendance = new Attendance;
                $attendance->student_id = $key;
                $attendance->group_id = $request->group_id;
                $attendance->mark = $value;
                $attendance->attendance_date = $request->attendance_date;
                $attendance->updated_at = date("Y-m-d H:i:s");
                $attendance->save();
            }
        }
    }
    /**
     * Update Attendance
     */
    public function updateAttendance(Request $request, int $id)
    {
        // dd($request->all());
        if (isset($request->attendance)) {
            foreach ($request->attendance as $key => $value) {
                // Attendance update
                $attendance = Attendance::where('student_id', $key)
                    ->where('group_id', $id)
                    ->where('attendance_date', $request->attendance_date)
                    ->first();
                if (isset($attendance)) {
                    $attendance->mark = $value;
                    $attendance->updated_at = date("Y-m-d H:i:s");
                    $attendance->save();
                } else {
                    $attendance = new Attendance;
                    $attendance->student_id = $key;
                    $attendance->group_id = $request->group_id;
                    $attendance->mark = $value;
                    $attendance->attendance_date = $request->attendance_date;
                    $attendance->updated_at = date("Y-m-d H:i:s");
                    $attendance->save();
                }
            }
        }
    }

    // get All Groups pagination
    public function getAllGroupsPagination($perPage = 10)
    {
        if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin') {
            $date_year = Date('Y');
            $date_month = Date('m');
            $date_day = Date('d');
            $groups = $this->groups
                ->leftJoin('users as ut', 'ut.id', '=', 'groups.teacher_id')
                ->leftJoin('users as ua', 'ua.id', '=', 'groups.assistant_id')
                ->leftJoin('group_level as gl', 'gl.id', '=', 'groups.level')
                ->select(
                    DB::raw('(SELECT count(*) from group_students where group_id = groups.id) as students_count'),
                    DB::raw('(SELECT COUNT(*) FROM `attendance` WHERE YEAR(attendance_date) = "' . $date_year . '" and MONTH(attendance_date) = "' . $date_month . '" and day(attendance_date) = "' . $date_day . '" and mark = 1 and group_id = groups.id) as mark_atten'),
                    DB::raw('(SELECT COUNT(*) FROM `attendance` WHERE YEAR(attendance_date) = "' . $date_year . '" and MONTH(attendance_date) = "' . $date_month . '" and day(attendance_date) = "' . $date_day . '" and mark = 0 and group_id = groups.id) as mark_notatten'),
                    'ut.firstname as teacher_firstname',
                    'ut.lastname as teacher_lastname',
                    'ua.firstname as assistant_firstname',
                    'ua.lastname as assistant_lastname',
                    'gl.name as level',
                    'groups.id',
                    'groups.name',
                    'groups.lessonstarttime',
                    'groups.lessonendtime',
                    'groups.days',
                    'groups.created_at'
                )
                ->where('groups.status', 'active')
                ->latest('groups.created_at')
                ->get();
            // dd($groups);
        } else {
            $userid = Auth::user()->id;
            if (Auth::user()->role == 'teacher') {
                $groups = $this->groups
                    ->leftJoin('users as ut', 'ut.id', '=', 'groups.teacher_id')
                    ->leftJoin('users as ua', 'ua.id', '=', 'groups.assistant_id')
                    ->leftJoin('group_level as gl', 'gl.id', '=', 'groups.level')
                    ->select(DB::raw('(SELECT count(*) from group_students where group_id = groups.id) as students_count'), 'ut.firstname as teacher_firstname', 'ut.lastname as teacher_lastname', 'ua.firstname as assistant_firstname', 'ua.lastname as assistant_lastname', 'gl.name as level', 'gl.name as level', 'groups.id', 'groups.lessonstarttime', 'groups.lessonendtime', 'groups.name', 'groups.days', 'groups.created_at')
                    ->where([['ut.id', $userid], ['groups.status', 'active']])
                    ->latest('groups.created_at')
                    ->get();
            } else {
                $groups = $this->groups
                    ->leftJoin('users as ut', 'ut.id', '=', 'groups.teacher_id')
                    ->leftJoin('users as ua', 'ua.id', '=', 'groups.assistant_id')
                    ->leftJoin('group_level as gl', 'gl.id', '=', 'groups.level')
                    ->select(DB::raw('(SELECT count(*) from group_students where group_id = groups.id) as students_count'), 'ut.firstname as teacher_firstname', 'ut.lastname as teacher_lastname', 'ua.firstname as assistant_firstname', 'ua.lastname as assistant_lastname', 'gl.name as level', 'gl.name as level', 'groups.id', 'groups.lessonstarttime', 'groups.lessonendtime', 'groups.name', 'groups.days', 'groups.created_at')
                    ->where([['ut.id', $userid], ['groups.status', 'active']])
                    ->latest('groups.created_at')
                    ->get();
            }
        }
        return $groups ?? [];
    }
}
//
