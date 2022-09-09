<?php

namespace App\Http\Controllers;

use App\Interfaces\StudentsRepositoryInterface;
use App\Http\Requests\UpdateStudentsRequest;
use App\Http\Requests\StoreStudentsRequest;
use Illuminate\Http\Request;
use App\Models\Student;

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
        /**
         * Index Students method. Get all students.
         */
        return $this->studentService->indexStudents();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->studentService->createStudents();
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
        return $this->studentService->showStudents($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->studentService->editStudents($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentsRequest $request, $id)
    {
        return $this->studentService->updateStudents($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->studentService->destroyStudents($id);
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
}
