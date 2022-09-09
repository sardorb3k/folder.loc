<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Interfaces\AttendanceRepositoryInterface;

class AttendanceController extends Controller
{
    private $attendanceService;
    public function __construct(AttendanceRepositoryInterface $attendanceService) {
        $this->attendanceService = $attendanceService;
        // Middleware
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->attendanceService->indexAttendance();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->attendanceService->storeAttendance($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show_red($id, Request $request)
    {
        return $this->attendanceService->show($id, $request);
    }
    public function show($id, $date)
    {
        return $this->attendanceService->showAttendance($id, $date);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->attendanceService->updateAttendance($request, $id);
    }

}
