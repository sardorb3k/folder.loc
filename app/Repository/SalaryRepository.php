<?php

namespace App\Repository;

use App\Interfaces\SalaryRepositoryInterface;
use App\Interfaces\SalaryServiceInterface;
use App\Models\Salary;
use App\Interfaces\TeachersServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SalaryStudents;
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
        foreach ($request->amount as $key => $value) {
            $salary = new SalaryStudents;
            $salary->student_id = $key;
            $salary->group_id = $request->group_id;
            $salary->amount = $value;
            $salary->salarydate = $request->salarydate.'-01';
            $salary->save();
        }
        return redirect()->route('salary.index', ['date' => $request->salarydate]);
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
        $date_all = explode('-', $date);
        $students = app(SalaryServiceInterface::class)->getStudent($id, $date);
        $form = DB::select('SELECT amount FROM salary_students WHERE group_id = ? and MONTH(salarydate) = ? AND YEAR(salarydate) = ? LIMIT 1', [$id, $date_all[1], $date_all[0]]);
        $formStatus = $form ? false : true;
        // dd($form);
        return view('salary.show_students', compact('students', 'teacher_id', 'id', 'date', 'formStatus'));
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
        foreach ($request->amount as $key => $value) {
            $salary = SalaryStudents::where('student_id', $key)->where('salarydate', $request->salarydate.'-01')->where('group_id', $request->group_id)->first();
            $salary->amount = $value;
            $salary->save();
        }
        return redirect()->route('salary.index', ['date' => $request->salarydate]);
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
