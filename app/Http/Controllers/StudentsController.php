<?php

namespace App\Http\Controllers;

use App\Interfaces\StudentsRepositoryInterface;
use App\Http\Requests\UpdateStudentsRequest;
use App\Http\Requests\StoreStudentsRequest;
use App\Models\ExamResults;
use App\Models\GroupStudents;
use App\Models\SalaryStudents;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use DataTables;

class StudentsController extends Controller
{
    private $studentService;
    /**
     * Constructor.
     */
    public function __construct(StudentsRepositoryInterface $studentService)
    {
        $this->studentService = $studentService;
        // Middleware for authentication.
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::leftJoin('group_students', 'group_students.student_id', '=', 'users.id')
            ->leftJoin('groups', 'groups.id', '=', 'group_students.group_id')
            ->leftJoin('group_level', 'group_level.id', '=', 'groups.level')
            ->where([['users.role', 'student'], ['users.status', 'active']])
            ->select('group_level.name as group_level', 'groups.name as group_name', 'users.*')
            ->latest('users.created_at')
            ->get();

        return  view('students.index', [
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentsRequest $request)
    {
        return $this->studentService->storeStudents($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = User::findOrFail($id);
        return view('students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('students.show', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->studentService->updateStudents($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $student = User::findOrFail($id);
        $file_path = 'uploads/student/' . $student->image;
        unlink($file_path);
        GroupStudents::where('student_id', $id)->delete();
        SalaryStudents::where('student_id', $id)->delete();
        ExamResults::where('student_id', $id)->delete();
        $student->delete();

        return redirect()->route('students.archives')->with('success', 'Student has been deleted successfully');
    }
    public function group($id)
    {
        return $this->studentService->group($id);
    }

    public function attendance($id)
    {
        return $this->studentService->attendance($id);
    }

    // payments
    public function payments($id)
    {
        return $this->studentService->payments($id);
    }
    // exam
    public function exam($id)
    {
        return $this->studentService->exam($id);
    }

    public function archives()
    {
        $students = User::leftJoin('group_students', 'group_students.student_id', '=', 'users.id')
            ->leftJoin('groups', 'groups.id', '=', 'group_students.group_id')
            ->leftJoin('group_level', 'group_level.id', '=', 'groups.level')
            ->where([['users.role', 'student'], ['users.status', 'inactive']])
            ->select('group_level.name as group_level', 'groups.name as group_name', 'users.*')
            ->latest('users.created_at')
            ->get();
        return view('students.archives', ['students' => $students]);
    }

    // archive student
    public function archive(Request $request, $id)
    {
        $student = User::findOrFail($id);
        $student->status = 'inactive';
        $student->archive_reason = $request->archive_reason;
        $student->archived_at = Carbon::now();
        $student->save();
        return redirect()->route('students.index')->with('success', 'Student has been archived');
    }

    // unarchive student
    public function unarchive($id)
    {
        $student = User::findOrFail($id);
        $student->status = 'active';
        $student->archive_reason = '';
        $student->archived_at = Carbon::now();
        $student->save();
        return redirect()->route('students.archives')->with('success', 'Student has been unarchived');
    }
}
