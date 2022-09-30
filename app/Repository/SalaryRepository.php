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
     * Inxdexx
     */
    public function indexSalary($date)
    {
        $date_all = explode('-', $date);
        $count_list = DB::select('SELECT COUNT(*) AS count FROM salary WHERE YEAR (created_at)= ? AND MONTH (created_at)=?', [$date_all[0], $date_all[1]]);

        $form = DB::select('SELECT salary FROM salary WHERE MONTH(salarydate) = ? AND YEAR(salarydate) = ? LIMIT 1', [$date_all[1], $date_all[0]]);
        $formStatus = $form ? false : true;
        if ($count_list == 1) {
            // Teacher list
        } else {
            // Teacher list
            // $teachers = app(TeachersServiceInterface::class)->getAllTeachers();
            $teachers = app(SalaryServiceInterface::class)->getTeacherList($date);
        }
        $count = 4;
        return view('salary.index', compact('teachers', 'count', 'date', 'formStatus'));
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
            $salary->teacher_id = $request->teacher_id;
            $salary->amount = (int) str_replace(',', '', $value);
            $salary->salarydate = $request->salarydate . '-01';
            $salary->save();
        }
        return redirect()->route('salary.index', ['date' => $request->salarydate]);
    }
    // Update Salary List
    public function updateSalaryList(Request $request, $date)
    {
        if (count(array_filter($request->salary, 'is_null')) == count($request->salary)) {
            return redirect()->route('salary.index', ['date' => $request->salarydate])->with('success', 'O\'zgarish yo\'q.');
        }
        foreach ($request->salary as $key => $value) {
            if ($value != null) {
                $salary = Salary::where('teacher_id', $key)->where('salarydate', $date . '-01')->first();
                if ($salary) {
                    $salary->salary = (int) str_replace(',', '', $value);
                    $salary->save();
                } else {
                    $salary = new Salary();
                    $salary->salary = (int) str_replace(',', '', $value);
                    $salary->teacher_id = $key;
                    $salary->salarydate = $request->salarydate . '-01';
                    $salary->save();
                }
            }
        }
        return redirect()->route('salary.index', ['date' => $request->salarydate])->with('success', 'Oyliklar saqlandi.');
    }
    // Salary list save
    public function storeSalaryList(Request $request)
    {
        // dd($request->all());
        // Validation
        $request->validate([
            'salarydate' => 'required',
            'salary' => 'required',
        ]);
        foreach ($request->salary as $key => $value) {
            $salary = new Salary();
            $salary->salary = (int) str_replace(',', '', $value) ?? 0;
            $salary->teacher_id = $key;
            $salary->salarydate = $request->salarydate . '-01';
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
        $students = app(SalaryServiceInterface::class)->getStudent($id, $date, $teacher_id);
        $form = DB::select('SELECT amount FROM salary_students WHERE group_id = ? and MONTH(salarydate) = ? AND YEAR(salarydate) = ? and teacher_id = ? LIMIT 1', [$id, $date_all[1], $date_all[0], $teacher_id]);
        $formStatus = $form ? false : true;
        $crm_attendance_day = DB::select('SELECT attendance_day FROM settings WHERE id = 1')[0]->attendance_day;
        // dd($form);
        return view('salary.show_students', compact('students', 'teacher_id', 'id', 'date', 'formStatus', 'crm_attendance_day'));
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
            $salary = SalaryStudents::where('student_id', $key)->where('salarydate', $request->salarydate . '-01')->where('group_id', $request->group_id)->where('teacher_id', $request->teacher_id)->first();
            $salary->amount = (int) str_replace(',', '', $value);
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
