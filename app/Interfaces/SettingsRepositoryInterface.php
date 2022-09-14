<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

/**
 * Salary Repository Interface
 */
interface SalaryRepositoryInterface {
    // Index Salary
    public function indexSettings($date);
    public function updateSettings(Request $request, $id);
    public function storeSettings(Request $request, $id);
}
//
