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
    // Group levels
    public function groupLevel(Request $request);
    // Group Level delete
    public function groupLevelDelete($id);
    // group level get by id
    public function groupLevelGetById($id);
    // group level update
    public function groupLevelUpdate(Request $request);
}
//
