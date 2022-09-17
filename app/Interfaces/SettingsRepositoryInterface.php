<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

/**
 * Salary Repository Interface
 */
interface SettingsRepositoryInterface {
    // Index Salary
    public function indexSettings();
    public function storeSettings(Request $request);
}
//
