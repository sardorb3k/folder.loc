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
    // Show Salary
    public function showSalary($date, $id);
    // Edit Salary
    public function editSalary($id);
    // Update Salary
    public function updateSalary(Request $request);
    // Destroy Salary
    public function destroySalary($id);
}
//
