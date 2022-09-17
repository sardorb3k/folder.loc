<?php
namespace App\Interfaces;
/**
 * Settings Service Interface
 */
use Illuminate\Http\Request;
interface SettingsServiceInterface {
    /**
     * Get Settings
     * @param  int $id
     * @return array
     */
    public function storeSettings(Request $request);
}
//
