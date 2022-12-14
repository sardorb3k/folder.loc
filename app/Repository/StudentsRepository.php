<?php

namespace App\Repository;

/**
 * Students Repository
 */

use App\Http\Requests\UpdateStudentsRequest;
use App\Http\Requests\StoreStudentsRequest;
use App\Interfaces\ExamsServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Student;
use App\Interfaces\StudentsServiceInterface;
use App\Interfaces\StudentsRepositoryInterface;
use App\Models\User;

class StudentsRepository implements StudentsRepositoryInterface
{
    private $studentsService;
    private $examsService;
    public function __construct(StudentsServiceInterface $studentsService, ExamsServiceInterface $examsService)
    {
        $this->studentsService = $studentsService;
        $this->examsService = $examsService;
    }

    public function storeStudents(Request $request): RedirectResponse
    {
        /**
         * Students Repository storeRepository
         */
        $this->studentsService->storeStudent($request);
        return redirect()->route('students.index');
    }
    public function destroyStudents(int $students): RedirectResponse
    {
        Student::destroy($students);
        return redirect()->route('students.index')->with('success', 'Students deleted successfully');
    }
    public function updateStudents(Request $request, int $id): RedirectResponse
    {
        /**
         *  Request update_action is used to determine which action to perform
         */
        if ($request->update_action == 'personal') {
            /**
             * Update teacher information
             */
            $teacher =  $this->studentsService->updateStudent($request, $id);
            return redirect()->route('students.index')->with('success', 'Students updated successfully');
        } elseif ($request->update_action == 'password') {
            /**
             * Update teacher password
             */
            $this->studentsService->updatePassword($request, $id);
            return redirect()->route('students.index')->with('success', 'Students updated successfully');
        }
    }
    public function group(int $id): View
    {
        $student = User::where('users.id', $id)->first();
        return view('students.group', ['groups' => $this->studentsService->GetStudentGroupById($id), 'id' => $id, 'student' => $student]);
    }
    public function payments(int $id): View
    {
        return view('students.payments', ['student' => $this->studentsService->getStudentById($id)]);
    }
    public function attendance(int $id): View
    {
        $student = User::where('users.id', $id)->first();
        return view('students.attendance', ['attendance' => $this->studentsService->getStudentByAttendance($id), 'id' => $id, 'student' => $student]);
    }
    public function exam(int $id): View
    {
        $student = User::where('users.id', $id)->first();
        return view('students.exam', ['exams' => $this->examsService->getStudentById($id), 'id' => $id, 'student' => $student]);
    }
}


//AA 5215055
//32301816050018
//865504064954428
//865504064954436
