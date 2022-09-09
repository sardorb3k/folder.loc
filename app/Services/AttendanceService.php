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

class AttendanceService implements AttendanceServiceInterface
{
    private $attendance;
    public function __construct(Attendance $attendance) {
        $this->attendance = $attendance;
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
                    'users.phone',
                    'users.birthday'
                )
                ->where('group_id', $id)
                ->get();
            $status = false;
        } else {
            $students = DB::select(
                DB::raw(
                    "SELECT us.id,us.firstname,us.lastname,us.birthday,us.phone,us.`status`,(
                        SELECT mark FROM attendance AS ad WHERE ad.student_id=us.id AND ad.attendance_date=:attendade_date AND ad.group_id = gs.group_id) AS mark FROM group_students AS gs LEFT JOIN users AS us ON us.id=gs.student_id WHERE gs.group_id=:group_id"
                ),
                [
                    'group_id' => $id,
                    'attendade_date' => $date
                ]
            );
            $status = true;
        }
        return array("status" => $status, "students" => $students);
    }
    /**
     * Store Attendance
     */
    public function storeAttendance(Request $request)
    {
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
    /**
     * Update Attendance
     */
    public function updateAttendance(Request $request, int $id)
    {
        // dd($request->all());
        foreach ($request->attendance as $key => $value) {
            // Attendance update
            // $attendance = Attendance::where('student_id', $key)
            //     ->where('group_id', $id)
            //     ->where('attendance_date', $request->attendance_date)
            //     ->first();
            // $attendance->mark = $value;
            // $attendance->updated_at = date("Y-m-d H:i:s");
            // $attendance->save();
            // DB update
            $attendance = DB::update(
                DB::raw(
                    "UPDATE attendance SET mark=:mark,updated_at=:updated_at WHERE student_id=:student_id AND group_id=:group_id AND attendance_date=:attendance_date"
                ),
                [
                    'mark' => $value,
                    'updated_at' => date("Y-m-d H:i:s"),
                    'student_id' => $key,
                    'group_id' => $id,
                    'attendance_date' => $request->attendance_date
                ]
            );
        }
    }

}
//
