<?php

namespace App\Repository;

use App\Interfaces\SalaryRepositoryInterface;
use App\Interfaces\SalaryServiceInterface;
use App\Models\Salary;
use App\Interfaces\TeachersServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryRepository implements SalaryRepositoryInterface
{
    /**
     * Inxdex
     */
    public function indexSalary($date)
    {
        $date_all = explode('-', $date);
        $count_list = DB::select('SELECT COUNT(*) AS count FROM salary WHERE YEAR (created_at)= ? AND MONTH (created_at)=?', [$date_all[0], $date_all[1]]);

        if($count_list == 1){
            // Teacher list
        }else{
            // Teacher list
            $teachers = app(TeachersServiceInterface::class)->getAllTeachers();
        }
        $count = 4;
        return view('salary.index', compact('teachers', 'count', 'date'));
    }
    /**
     * Create
     */
    public function createSalary()
    {
        $salary = new Salary();
        return $salary;
    }
    /**
     * Store
     */
    public function storeSalary(Request $request, $id)
    {
        $salary = Salary::find($id);
        $salary->teacher_id = $request->teacher_id;
        $salary->salary = $request->salary;
        $salary->save();
        return $salary;
    }
    /**
     * Show
     */
    public function showSalary($date, $id)
    {
        $groups = app(SalaryServiceInterface::class)->getGroupById($id);
        return view('salary.show', compact('groups', 'id', 'date'));
    }
    public function showStudents($date, $teacher_id, $id)
    {
        $students = app(SalaryServiceInterface::class)->getStudent($id, $date);
        return view('salary.show_students', compact('students'));
    }

    /**
     * Edit
     */
    public function editSalary($id)
    {
        $salary = Salary::find($id);
        return $salary;
    }
    /**
     * Update
     */
    public function updateSalary(Request $request, $id)
    {
        $salary = Salary::find($id);
        $salary->teacher_id = $request->teacher_id;
        $salary->salary = $request->salary;
        $salary->save();
        return $salary;
    }
    /**
     * Destroy
     */
    public function destroySalary($id)
    {
        $salary = Salary::find($id);
        $salary->delete();
        return $salary;
    }
}

//