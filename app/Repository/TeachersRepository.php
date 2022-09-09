<?php

namespace App\Repository;

use App\Interfaces\TeachersRepositoryInterface;
use App\Http\Requests\UpdateTeachersRequest;
use App\Interfaces\TeachersServiceInterface;
use App\Http\Requests\StoreTeachersRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Teacher;
use Illuminate\Support\Facades\Redirect;

class TeachersRepository implements TeachersRepositoryInterface
{
    private $teachers;
    private $teacherService;
    public function __construct(TeachersServiceInterface $teacherService, Teacher $teachers)
    {
        $this->teachers = $teachers;
        $this->teacherService = $teacherService;
    }
    public function indexTeachers(): View
    {
        $teachers = $this->teacherService->getAllTeachersPaginated(10);
        $count = $this->teacherService->getCountTeachers();

        return view('teachers.index', compact('teachers', 'count'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function showTeachers(int $id): View
    {
        $teacher = $this->teacherService->getTeacherById($id);
        return view('teachers.show', compact('teacher'));
    }
    public function createTeachers(): View
    {
        return view('teachers.create');
    }
    public function editTeachers(): View
    {
        return view('teachers.edit');
    }
    public function storeTeachers(Request $request): RedirectResponse
    {
        $this->teacherService->createTeacher($request);
        
        return redirect()->route('teachers.index')
            ->with('success', 'Teacher created successfully.');
    }
    public function destroyTeachers(int $teachers): RedirectResponse
    {
        $teacher = $this->teacherService->deleteTeacher($teachers);
        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
    public function updateTeachers(Request $request, $id): RedirectResponse
    {
        /**
         *  Request update_action is used to determine which action to perform
         */
        if ($request->update_action == 'personal') {
            /**
             * Update teacher information
             */
            $teacher =  $this->teacherService->updateTeacher($request, $id);
            return redirect()->route('teachers.index')
                ->with('success', 'Teacher updated successfully');
        } elseif ($request->update_action == 'password') {
            /**
             * Update teacher password
             */
            $this->teacherService->updatePassword($request, $id);
            return redirect()->route('teachers.index')
                ->with('success', 'Teacher password updated successfully');
        }
    }
}
