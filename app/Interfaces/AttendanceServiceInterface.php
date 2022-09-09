<?php
namespace App\Interfaces;
/**
 * Attendance Service Interface
 */
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Attendance;

interface AttendanceServiceInterface
{
    /**
     * Attendance Service indexService
     */
    public function getStudents(int $id, $date);
    /// storeAttendance
    public function storeAttendance(Request $request);
    // updateAttendance
    public function updateAttendance(Request $attendance, int $id);
}
//
