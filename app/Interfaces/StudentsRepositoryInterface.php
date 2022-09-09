<?php
namespace App\Interfaces;
/**
 * Students Repository Interface
 */
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
interface StudentsRepositoryInterface {
    /**
     * Students Repository indexRepository
     */
    public function indexStudents(): View;
    public function showStudents(int $id): View;
    public function createStudents(): View;
    public function editStudents(int $id): View;
    public function storeStudents(Request $request): RedirectResponse;
    public function destroyStudents(int $students): RedirectResponse;
    public function updateStudents(Request $students, int $id): RedirectResponse;
    public function group(int $id): View;
    public function payments(int $id): View;
    public function attendance(int $id): View;
    public function exam(int $id): View;
}
