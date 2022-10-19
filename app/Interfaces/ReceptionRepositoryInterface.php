<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

/**
 * Reception Repository Interface
 */
interface ReceptionRepositoryInterface {
    // Index Salary
    public function indexReception();
    // Create Salary
    public function createReception();
    // Store Reception
    public function storeReception(Request $request);
}
//
