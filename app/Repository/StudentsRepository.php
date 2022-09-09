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

class StudentsRepository implements StudentsRepositoryInterface
{
    private $studentsService;
    private $examsService;
    public function __construct(StudentsServiceInterface $studentsService, ExamsServiceInterface $examsService)
    {
        $this->studentsService = $studentsService;
        $this->examsService = $examsService;
    }

    /**
     * Students Repository indexRepository
     */
    public function indexStudents(): View
    {
        return view('students.index', [
            'students' => $this->studentsService->getAllStudentsPaginated(10),
            'count' => $this->studentsService->getCountStudents()
        ]);
    }
    public function showStudents(int $id): View
    {
        return view('students.show', ['student' => $this->studentsService->getStudentById($id)]);
    }
    public function createStudents(): View
    {
        return view('students.create');
    }
    public function editStudents(int $id): View
    {
        return view('students.show', ['student' => $this->studentsService->getStudentById($id)]);
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
        return view('students.group', ['groups' => $this->studentsService->GetStudentGroupById($id), 'id' => $id]);
    }
    public function payments(int $id): View
    {
        return view('students.payments', ['student' => $this->studentsService->getStudentById($id)]);
    }
    public function attendance(int $id): View
    {
        return view('students.attendance', ['student' => $this->studentsService->getStudentById($id)]);
    }
    public function exam(int $id): View
    {
        return view('students.exam', ['exams' => $this->examsService->getStudentById($id), 'id' => $id]);
    }
}
