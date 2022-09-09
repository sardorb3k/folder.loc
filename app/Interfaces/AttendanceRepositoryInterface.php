<?php
namespace App\Interfaces;
/**
 * Attendance Repository Interface
 */
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Interface AttendanceRepositoryInterface
 * @package App\Interfaces
 */
interface AttendanceRepositoryInterface
{
    /**
     * Attendance Repository indexRepository
     */
    public function indexAttendance(): View;
    public function show(int $id, Request $request): RedirectResponse;
    public function showAttendance(int $id, $date): View;
    public function storeAttendance(Request $request): RedirectResponse;
    public function updateAttendance(Request $attendance, int $id): RedirectResponse;
}
