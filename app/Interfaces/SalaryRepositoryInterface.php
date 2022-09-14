<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

/**
 * Salary Repository Interface
 */
interface SalaryRepositoryInterface {
    // Index Salary
    public function indexSalary($date);
    // Create Salary
    public function createSalary();
    // Store Salary
    public function storeSalary(Request $request, $id);
    // Store Salary List
    public function storeSalaryList(Request $request);
    // Show Salary
    public function showSalary($date, $id);
    // Edit Salary
    public function editSalary($id);
    // Update Salary
    public function updateSalary(Request $request, $id);
    // Update Salary List
    public function updateSalaryList(Request $request, $id);
    // Destroy Salary
    public function destroySalary($id);
    public function showStudents($date, $teacher_id, $id);
}
//
