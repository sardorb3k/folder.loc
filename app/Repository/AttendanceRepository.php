<?php

namespace App\Repository;

/**
 * Attendance Repository
 */

use App\Interfaces\AttendanceRepositoryInterface;
use App\Interfaces\AttendanceServiceInterface;
use App\Interfaces\GroupsServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\View\View;
use App\Models\Student;
use App\Models\Exams;

class AttendanceRepository implements AttendanceRepositoryInterface
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
    public function indexAttendance(): View
    {
        $groups = $this->attendanceService->getAllGroupsPagination(10);
        $count = $this->groupService->getCountGroups();
        return view('attendance.index', compact('groups', 'count'));
    }

    public function show(int $id,  Request $request): RedirectResponse
    {
        $date = $request->input('date') ?? date('Y-m-d');
        return redirect()->route('attendance.show', ['id' => $id, 'date' => $date]);
    }

    public function showAttendance(int $id, $date): View
    {
        $students = $this->attendanceService->getStudents($id, $date);
        $count = count($students);
        $group = $this->groupService->getGroupInfoById($id);
        $crm_attendance_day = DB::select('SELECT attendance_day FROM settings WHERE id = 1')[0]->attendance_day;
        return view('attendance.show', compact('students', 'count', 'date', 'id', 'crm_attendance_day', 'group'));
    }
    public function storeAttendance(Request $request): RedirectResponse
    {
        /**
         * Attendance Repository storeRepository
         */
        $this->attendanceService->storeAttendance($request);
        return redirect()->back()->with('success', 'Davomat saqlandi.');
    }
    public function updateAttendance(Request $attendance, int $id): RedirectResponse
    {
        /**
         * Attendance Repository updateRepository
         */
        $this->attendanceService->updateAttendance($attendance, $id);
        return redirect()->back()->with('success', 'Davomat saqlandi.');
    }
}

//
