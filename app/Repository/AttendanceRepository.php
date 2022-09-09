<?php
namespace App\Repository;
/**
 * Attendance Repository
 */

use App\Interfaces\AttendanceRepositoryInterface;
use App\Interfaces\AttendanceServiceInterface;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Exams;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Interfaces\GroupsServiceInterface;
class AttendanceRepository implements AttendanceRepositoryInterface{
    private $attendance;
    private $attendanceService;
    public function __construct(AttendanceServiceInterface $attendanceService, GroupsServiceInterface $groupService) {
        $this->attendanceService = $attendanceService;
        $this->groupService = $groupService;
    }
    /**
     * Attendance Repository indexRepository
     */
    public function indexAttendance(): View{
        $groups = $this->groupService->getAllGroups();
        $count = $this->groupService->getCountGroups();
        return view('attendance.index', compact('groups', 'count'));
    }
    public function show(int $id,  Request $request):RedirectResponse{
        $date = $request->input('date') ?? date('Y-m-d');
        return redirect()->route('attendance.show', ['id' => $id, 'date' => $date]);
    }
    public function showAttendance(int $id, $date): View{
        $count = $this->groupService->getCountGroupStudents($id);
        $students = $this->attendanceService->getStudents($id, $date);
        return view('attendance.show', compact('students', 'count', 'date', 'id'));
    }
    public function storeAttendance(Request $request): RedirectResponse{
        /**
         * Attendance Repository storeRepository
         */
        // dd($request->all());
        $this->attendanceService->storeAttendance($request);
        return redirect()->route('attendance.index');
    }
    public function updateAttendance(Request $attendance, int $id): RedirectResponse{
        /**
         * Attendance Repository updateRepository
         */
        $this->attendanceService->updateAttendance($attendance, $id);
        return redirect()->route('attendance.index');
    }

}

//
