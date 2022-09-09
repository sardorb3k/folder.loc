<?php
namespace App\Interfaces;
/**
 * Students Service Interface
 */
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Student;
interface StudentsServiceInterface {
    /**
     * Get all students.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllStudents();
    /**
     * Get count students.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountStudents(): int;
    public function getAllStudentsPaginated(int $perPage): LengthAwarePaginator;
    /**
     * Get student by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudentById($id);
    /**
     * Update student.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStudent(Request $request, int $id);
    /**
     * Password update student.
     */
    public function updatePassword(Request $request, int $id);
    /**
     * Delete student.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteStudent($id): void;
    /**
     * Store student.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeStudent(Request $request): void;
    public function GetStudentGroupById($id);
}


//
