<?php

namespace App\Http\Controllers;

use App\Interfaces\SalaryRepositoryInterface;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    private $salary;
    public function __construct(SalaryRepositoryInterface $salary)
    {
        $this->salary = $salary;
        // Middleware for authentication.
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date)
    {
        return $this->salary->indexSalary($date);
    }

    public function index_red(Request $date)
    {
        $date = $date->datetime ?? date('Y-m');
        return redirect()->route('salary.index', ['date' => $date]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        return $this->salary->storeSalary($request, $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show($date, $id)
    {
        return $this->salary->showSalary($date, $id);
    }

    // Store Salary List
    public function storeSalaryList(Request $request)
    {
        return $this->salary->storeSalaryList($request);
    }

    // Update Salary List
    public function updateSalaryList(Request $request, $id)
    {
        return $this->salary->updateSalaryList($request, $id);
    }


    /**
     * Show group students
     */
    public function show_students($date, $teacher_id, $id)
    {
        return $this->salary->showStudents($date, $teacher_id, $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->salary->updateSalary($request, $id);
    }

}
