<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeachersRequest;
use App\Http\Requests\UpdateTeachersRequest;
use App\Interfaces\TeachersRepositoryInterface;
use App\Models\Salary;
use App\Models\SalaryStudents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    private $teachers;
    /**
     *  Constructor.
     */
    public function __construct(TeachersRepositoryInterface $teachers)
    {
        // Services
        $this->teachers = $teachers;
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
        $teachers = User::where('status', 'active')
            ->where(function ($query) {
                $query->where('role', 'teacher')
                    ->orWhere('role', 'assistant');
            })
            ->latest()
            ->get();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->teachers->createTeachers();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeachersRequest $request)
    {
        return $this->teachers->storeTeachers($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->teachers->showTeachers($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->teachers->editTeachers($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->teachers->updateTeachers($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $teacher = User::findOrFail($id);
        $file_path = 'uploads/teacher/' . $teacher->image;
        unlink($file_path);
        Salary::where('teacher_id', $id)->delete();
        SalaryStudents::where('teacher_id', $id)->delete();
        $teacher->delete();

        return redirect()->route('teachers.archives')->with('success', 'Teacher deleted successfully.');
    }

    public function archives()
    {
        $teachers = User::where('status', 'inactive')
            ->where(function ($query) {
                $query->where('role', 'teacher')
                    ->orWhere('role', 'assistant');
            })
            ->latest()
            ->get();
        return view('teachers.archives', ['teachers' => $teachers]);
    }

    // archive teacher
    public function archive(Request $request, $id)
    {
        $teacher = User::findOrFail($id);
        $teacher->status = 'inactive';
        $teacher->archive_reason = $request->archive_reason;
        $teacher->archived_at = Carbon::now();
        $teacher->save();
        return redirect()->route('teachers.index')->with('success', 'Teacher has been archived');
    }

    // unarchive teacher
    public function unarchive($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->status = 'active';
        $teacher->archive_reason = '';
        $teacher->archived_at = Carbon::now();
        $teacher->save();
        return redirect()->route('teachers.archives')->with('success', 'Teacher has been unarchived');
    }
}
